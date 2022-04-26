<?php

namespace App\Models\OfficeOpeningHours;

use Illuminate\Database\Eloquent\Model;

use App\Models\SerializeDateTrait;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use App\Models\Media\Media;
use App\Models\Account\User;
use App\Models\Doctor\Doctor;
use App\Models\ClinicDoctor\ClinicDoctor;

use Database\Factories\Clinic\EmployeeFactory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class OfficeOpeningHours extends Model
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

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */

}
