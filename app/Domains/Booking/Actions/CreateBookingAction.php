<?php

namespace App\Domains\Booking\Actions;

use App\Domains\Booking\Exceptions\BookingException;
use App\Domains\Entity\Entity\Contracts\EntityRepositoryContract;
use App\SharedKernel\Actions\Resources\AbstractCreateAction;

use App\Domains\Booking\Contracts\BookingRepositoryContract;

use App\SharedKernel\Contracts\Domains\EntityDomainContract;
use App\SharedKernel\Contracts\Domains\HolidayDomainContract;
use App\SharedKernel\Contracts\Domains\OfficeOpeningHourDomainContract;
use App\SharedKernel\DTOs\BaseDTO;
use App\SharedKernel\DTOs\Booking\BookingDTO;
use App\SharedKernel\DTOs\Entity\Entity\EntityDTO;
use Illuminate\Support\Facades\DB;
use App\SharedKernel\Attributes\ResponseType;

#[ResponseType(response: ['booking' => BookingDTO::class], description: 'create new booking')]
class CreateBookingAction extends AbstractCreateAction
{
    protected string $resourceName = 'booking';

    protected function getDTO(): string
    {
        return BookingDTO::class;
    }

    public function __construct(
        protected OfficeOpeningHourDomainContract $officeOpeningHoursMainEntry,
        protected EntityDomainContract $entityMainEntry,
        protected HolidayDomainContract $holidayMainEntry,
        BookingRepositoryContract $repository
    ) {
        $this->repository = $repository;
    }

    protected function createResource(): BaseDTO|BookingDTO
    {
        $entityDTO = $this->entityMainEntry->getEntityById($this->safe()->get('entity_id'));
        $isInOpeningHours = $this->officeOpeningHoursMainEntry->isOfficeOpen($this->safe()->all());

        $isDuplicateEntityType = $this->repository->isDuplicateEntityType($this->safe()->all(), $entityDTO);
        if($isDuplicateEntityType){
            throw BookingException::duplicateEntityType();
        }
        $isAvailable = $this->repository->isEntityFree($this->safe()->all(), $entityDTO);
        if(!$isAvailable){
            throw BookingException::entityIsAlreadyBooked();
        }
        $isDayHoliday = $this->holidayMainEntry->isHoliday($this->safe()->get('day'));
        if($isDayHoliday && !$entityDTO->available_in_holidays){
            throw BookingException::entityIsNotAvailableInHolidays();
        }
        if(!$isInOpeningHours){
            throw BookingException::OfficeIsClosed();
        }

        $model = DB::transaction(function () {
            return $this->repository->forceFillCreate(
                $this->safe()->only([
                    'entity_id',
                    'employee_id',
                    'start_time',
                    'end_time',
                    'day',
                ]),
            );
        });

        return $this->getDTOInstance($model->toArray());
    }

    public function rules(): array
    {
        return [
            'entity_id' => ['required','entity_exists'],
            'employee_id' => ['required', 'employee_exists'],
            'start_time' => ['required', 'string'],
            'end_time' => ['required', 'string'],
            'day' => ['required', 'string'],
        ];
    }
}
