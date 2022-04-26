<?php

namespace App\SharedKernel\Actions;

use App\SharedKernel\Contracts\ActionInterface;

use Illuminate\Auth\AuthenticationException;
use Lorisleiva\Actions\Concerns\AsAction;
use App\SharedKernel\Traits\WithAttributes;
use App\SharedKernel\Traits\UserAuthenticationTrait;
use App\SharedKernel\Traits\AdminAuthenticationTrait;

use Illuminate\Http\JsonResponse;
use Lorisleiva\Actions\ActionRequest;
use Illuminate\Support\Facades\Validator;
use App\SharedKernel\DTOs\Responses\MessageDTO;
use App\SharedKernel\DTOs\Responses\ResponseDTO;

use Throwable;
use App\SharedKernel\Exceptions\BaseException;
use App\SharedKernel\Contracts\ExceptionInterface;
use App\SharedKernel\Exceptions\UnexpectedException;
use App\SharedKernel\Exceptions\ValidationException;
use Illuminate\Validation\ValidationException as BaseValidationException;

abstract class AbstractAction implements ActionInterface
{
    use AsAction,
        WithAttributes;

    protected bool $authority = false;

    /**
     * @param ActionRequest $request
     * @return bool
     * @throws AuthenticationException
     */
    final public function authorize(ActionRequest $request): bool
    {
        return true;
    }

    #TODO: rename method to checkAuthorization
    protected function checkAccess(): void
    {
    }

    protected function responseMessage(): ?MessageDTO
    {
        return null;
    }

    /**
     * @throws BaseException
     * @throws Throwable
     */
    public function asController(ActionRequest $request, ...$args): JsonResponse
    {
        try {
            $this->fillFromRequest($request);

            $this->validateAttributes();

            $response = new ResponseDTO();

            $result = call_user_func('static::controller', ...$args);

            if (is_array($result)) {
                $response->result = $result;
            }
            $response->meta->message = $this->responseMessage();
        } catch (BaseValidationException $ex) {
            $response = ValidationException::make($ex)->response();
        } catch (ExceptionInterface $ex) {
            $response = $ex->response();
            if (is_debug() && !is_production() && $ex instanceof UnexpectedException) {
                throw $ex;
            }
        } catch (Throwable $th) {
            $ex = UnexpectedException::unknown($th);
            $response = $ex->response();
            if (is_debug() && !is_production()) {
                throw $th;
            }
        }

        return $response->toResponse();
    }

    public static function run(...$arguments)
    {
        $action = static::make();

        $attributes = [];
        if (isset($arguments['attributes'])) {
            $attributes = $arguments['attributes'] ?? [];
            unset($arguments['attributes']);
        }

        try {
            if (method_exists($action, 'asObjectRules')) {
                $rules = $action->asObjectRules();
            } elseif (method_exists($action, 'rules')) {
                $rules = $action->rules();
            } else {
                $rules = [];
            }

            $validatedAttributes = Validator::make($attributes, $rules)->validate();
        } catch (BaseValidationException $ex) {
            throw UnexpectedException::validation($ex);
        }

        $action->fill($attributes);
        $action->setValidatedAttributes($validatedAttributes);

        return $action->handle(...$arguments);
    }
}
