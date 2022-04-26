<?php

namespace App\Models\Booking;

use App\Models\Entity\Entity;
use Database\Factories\Booking\BookingFactory;
use Database\Factories\Entity\EntityFactory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Model;

use App\Models\SerializeDateTrait;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Booking extends Model
{
    use HasFactory,
        SoftDeletes,
        SerializeDateTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    ];

    public function entity(): belongsTo{
        return $this->belongsTo(Entity::class);
    }

    protected static function newFactory(): Factory
    {
        return BookingFactory::new();
    }

}
