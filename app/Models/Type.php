<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    use HasFactory;

    protected $fillable = [
        'type_name'
    ];

    /**
     * 商品との関係
     */
    public function items()
    {
        return $this->hasMany(Item::class);
    }
}
