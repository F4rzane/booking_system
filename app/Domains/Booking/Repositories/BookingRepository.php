<?php

namespace App\Domains\Booking\Repositories;

use App\Domains\Booking\Contracts\BookingRepositoryContract;
use App\Domains\Entity\Entity\Contracts\EntityRepositoryContract;
use App\Domains\Entity\Entity\Repositories\EntityRepository;
use App\SharedKernel\DTOs\Booking\BookingDTO;
use App\SharedKernel\DTOs\Entity\Entity\EntityDTO;
use App\SharedKernel\Repositories\BaseRepository;

use App\Models\Booking\Booking;

class BookingRepository extends BaseRepository implements BookingRepositoryContract
{
    public function model() : string
    {
        return Booking::class;
    }

    public function isEntityFree($attributes, EntityDTO $entityDTO)
    {
        $bookingsCount = Booking::query()
            ->where('entity_id', $attributes['entity_id'])
            ->where('day', $attributes['day'])
            ->where('start_time', '<=', $attributes['start_time'])
            ->where('end_time', '>=', $attributes['start_time'])
            ->orWhere(function ($q) use ($attributes) {
                return $q->where('start_time', '>', $attributes['start_time'])
                    ->where('start_time', '<=',$attributes['end_time']);
            })
            ->count();
        if(!empty($entityDTO->max_simultaneous_booking) && $entityDTO->max_simultaneous_booking <= $bookingsCount){
            return false;
        }
        return true;
    }

    public function isDuplicateEntityType($attributes, EntityDTO $entityDTO): bool
    {
        $bookingWithDuplicateType = Booking::query()
            ->where('entity_id', $attributes['entity_id'])
            ->where('employee_id', $attributes['employee_id'])
            ->where('day', $attributes['day'])
            ->whereHas('entity', function($q) use($entityDTO) {
                $q->where('entity_type_id', $entityDTO->entity_type_id);
            })
            ->get();
       if($bookingWithDuplicateType->isNotEmpty()){
           return true;
       }
       return false;
    }
}
