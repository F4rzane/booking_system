<?php

namespace App\SharedKernel\Services;

use App\SharedKernel\Services\Contracts\ServiceInterface;
use App\SharedKernel\Services\Contracts\HasDataBagInterface;

use Illuminate\Support\Facades\Validator;
use App\SharedKernel\Services\Traits\HasDataBag;

use Throwable;
use Illuminate\Validation\ValidationException;
use App\SharedKernel\Services\Exceptions\ServiceException;

abstract class AbstractService implements ServiceInterface, HasDataBagInterface
{
    use HasDataBag;

    protected DataBag $validatedDataBag;

    abstract protected function execute(): void;

    public static function make(...$args): static
    {
        return app()->makeWith(static::class, $args);
    }

    protected function rules(): array
    {
        return [];
    }

    /**
     * @throws ValidationException
     */
    final protected function validate(array $data): bool
    {
        $rules = $this->rules();

        if (count($rules)) {
            $this->validatedDataBag = new DataBag(Validator::make($data, $rules)->validate());
        }

        return true;
    }

    /**
     * @throws ValidationException|Throwable
     */
    final public function run(): static
    {
        try {
            $this->dataBag ?? $this->initDataBag([]);
            $this->validatedDataBag = new DataBag();

            $this->validate($this->dataBag->all());

            $this->execute();
        } catch (ValidationException $ex) {
            throw ServiceException::validation($ex);
        } catch (Throwable $th) {
            throw  $th;
        }

        return $this;
    }
}
