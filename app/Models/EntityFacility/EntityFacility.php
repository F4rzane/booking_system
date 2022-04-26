<?php

namespace App\Models\EntityFacility;

use App\Models\Entity\Entity;
use App\Models\Facility\Facility;
use Illuminate\Database\Eloquent\Model;

use App\Models\SerializeDateTrait;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Database\Factories\EntityFacility\EntityFacilityFactory;

class EntityFacility extends Model
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
        'entity_id',
        'facility_id',
    ];

    protected static function newFactory(): Factory
    {
        return EntityFacilityFactory::new();
    }

    public function entity(): BelongsTo
    {
        return $this->belongsTo(Entity::class);
    }

    public function facility(): BelongsTo
    {
        return $this->belongsTo(Facility::class);
    }


}
