<?php

namespace App\Modules\Stats\Models\Products;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Prices extends Model
{
    use Sortable;

    protected $table = 'prices';

    public $sortable = [
        'id',
        'date',
        'creator',
        'product_id',
        'price_uah',
        'price_usd',
        'price_eur',
        'price_bitcoin',
        'source'
    ];

    protected $fillable = [
        'date',
        'creator',
        'product_id',
        'price_uah',
        'price_usd',
        'price_eur',
        'price_bitcoin',
        'source'
    ];

    public function product(){
        return $this->belongsTo(Products::class);
    }

    public function creator(){
        return $this->belongsTo(User::class,'id','creator');
    }

}
