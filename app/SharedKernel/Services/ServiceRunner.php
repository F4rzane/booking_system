<?php

namespace App\SharedKernel\Services;

use App\SharedKernel\Services\Contracts\HasDataBagInterface;

use Closure;
use App\SharedKernel\Services\Traits\HasDataBag;
use App\SharedKernel\Services\Contracts\ServiceInterface;

use Throwable;
use App\SharedKernel\Services\Exceptions\ServiceException;
use Illuminate\Contracts\Container\BindingResolutionException;

final class ServiceRunner implements HasDataBagInterface
{
    use HasDataBag;

    protected ?Closure $catchMethod;
    protected ?Closure $finalMethod;

    public function __construct(
        protected array $services,
        protected array $data = []
    ) {
        $this->initDataBag($this->data);
    }

    public static function make(
        array $services,
        array $data = []
    ): self {
        return new self($services, $data);
    }

    /**
     * @throws Throwable
     * @throws BindingResolutionException
     */
    public function run(): self
    {
        try {
            foreach ($this->services as &$service) {
                if (is_string($service)) {
                    if (!class_exists($service)) {
                        throw ServiceException::notFound();
                    }

                    $service = app()->make($service);
                }

                if (!$service instanceof ServiceInterface) {
                    throw ServiceException::serviceInterface();
                }
            }

            foreach ($this->services as &$service) {
                if ($service instanceof HasDataBagInterface) {
                    $service->setDataBag($this->getDataBag());
                }

                $service->run();

                if ($service instanceof HasDataBagInterface) {
                    $this->setDataBag($service->getDataBag());
                }
            }
        } catch (Throwable $th) {
            isset($this->catchMethod) ? ($this->catchMethod)($th) : throw $th;
        } finally {
            !isset($this->finalMethod) ?: ($this->finalMethod)($this->dataBag);
        }

        return $this;
    }

    public function catch(Closure $catch): self
    {
        $this->catchMethod = $catch;

        return $this;
    }

    public function finally(Closure $method): self
    {
        $this->finalMethod = $method;

        return $this;
    }
}
