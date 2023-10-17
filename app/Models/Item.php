<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;//追記9月26日

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

	public $sortable = ['tire_id','size','number'];//追記(ソートに使うカラムを指定)
    
    /**
     * 種別の取得
     */
    public function type()
    {
        return $this->belongsTo(Type::class,'type_id');
    }

}
