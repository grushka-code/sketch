<?php

namespace App\Modules\Stats\Models\Regions;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Peoples extends Model
{
    use Sortable;

    protected $table = 'peoples';

    protected $fillable = [
        'date',
        'creator',
        'region_id',
        'count',
        'males',
        'females',
        'short',
        'tall',
        'source'
    ];

    public function region(){
        return $this->belongsTo(Region::class);
    }

    public function creator(){
        return $this->belongsTo(User::class,'id','creator');
    }
}
