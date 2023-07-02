<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'tire_id',
        'size',
        'number',
        'tire_maker',
        'inch',
        'year',
        'oblateness',
        'ditch',
        'eveluation',
        'type_id',
        'strength',
        'specification',
        'foil',
        'image',
    ];

    /**
     * 種別の取得
     */
    public function type()
    {
        return $this->belongsTo(Type::class,'type_id');
    }
}
