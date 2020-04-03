<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CarMake extends Model
{
    protected $fillable = ['name'];
    protected $hidden = ['id', 'created_at', 'updated_at'];

    /**
     * @return HasMany
     */
    public function carModels()
    {
        return $this->hasMany(CarModel::class, 'make_id', 'id')->orderBy('name');
    }

    /**
     * @return HasMany
     */
    public function cars()
    {
        return $this->hasMany(Car::class, 'make_id', 'id');
    }
}
