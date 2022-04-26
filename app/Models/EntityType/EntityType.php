<?php

namespace App\Models\EntityType;

use App\Models\Entity\Entity;
use Database\Factories\Entity\FacilityFactory;
use Database\Factories\EntityType\EntityTypeFactory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Model;

use App\Models\SerializeDateTrait;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EntityType extends Model
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
        'title',
        'alternative_title',
        'email',
        'phones',
        'website',
        'province',
        'city',
        'address',
        'latitude',
        'longitude',
        'slug',
        'status',
    ];

    public function entities(): HasMany
    {
        return $this->hasMany(Entity::class);
    }

    protected static function newFactory(): Factory
    {
        return EntityTypeFactory::new();
    }


}
