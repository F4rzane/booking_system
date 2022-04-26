<?php

namespace App\Models\Employee;

use Database\Factories\Employee\EmployeeFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\SerializeDateTrait;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Factories\Factory;

class Employee extends Model
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

    protected static function newFactory(): Factory
    {
        return EmployeeFactory::new();
    }


}
