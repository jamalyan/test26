<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Car extends Model
{
    protected $fillable = ['name', 'make_id', 'model_id', 'year', 'mileage', 'color', 'price'];

    /**
     * @return BelongsTo
     */
    public function carMake()
    {
        return $this->belongsTo(CarMake::class, 'make_id', 'id');
    }

    /**
     * @return BelongsTo
     */
    public function carModel()
    {
        return $this->belongsTo(CarModel::class, 'model_id', 'id');
    }
}
