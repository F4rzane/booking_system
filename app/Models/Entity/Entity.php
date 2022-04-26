<?php

namespace App\Models\Entity;

use App\Models\EntityType\EntityType;
use Database\Factories\Entity\EntityFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\SerializeDateTrait;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Factories\Factory;


class Entity extends Model
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
        'id',
        'created_at',
        'updated_at'
    ];

    public function entityType(): BelongsTo
    {
        return $this->belongsTo(EntityType::class);
    }

    protected static function newFactory(): Factory
    {
        return EntityFactory::new();
    }


}
