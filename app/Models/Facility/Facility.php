<?php

namespace App\Models\Facility;

use App\Models\EntityType\EntityType;
use Illuminate\Database\Eloquent\Model;

use App\Models\SerializeDateTrait;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Facility extends Model
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

    public function entityType(): BelongsTo
    {
        return $this->belongsTo(EntityType::class);
    }


}
