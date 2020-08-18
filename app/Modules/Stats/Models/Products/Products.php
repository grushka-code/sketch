<?php

namespace App\Modules\Stats\Models\Products;

use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    protected $table = 'products';

    protected $fillable = [
        'name',
    ];

    public $timestamps = false;


    public function prices(){
        return $this->hasMany(Prices::class);
    }
}
