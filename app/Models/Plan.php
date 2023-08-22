<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory;

    const BASIC_PLAN_TRIAL = 3;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'slug',
        'stripe_plan',
        'price',
        'description',
    ];

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }
}
