<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class CarModel extends Model
{
    use SoftDeletes;

    protected $fillable = ['name', 'make_id'];
    protected $hidden = ['id', 'make_id', 'created_at', 'updated_at', 'deleted_at'];

    /**
     * @return BelongsTo
     */
    public function carMake()
    {
        return $this->belongsTo(CarMake::class, 'make_id', 'id')->orderBy('name');
    }

    /**
     * @return HasMany
     */
    public function cars()
    {
        return $this->hasMany(Car::class, 'model_id', 'id');
    }
}
