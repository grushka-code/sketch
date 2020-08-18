<?php

namespace App\Modules\Stats\Models\Regions;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    protected $table = 'regions';

    protected $fillable = [
        'name',
    ];

    public $timestamps = false;


    public function peoples(){
        return $this->hasMany(Peoples::class);
    }
}
