<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'first_name',
        'last_name',
        'gender',
        'email',
        'tel',
        'address',
        'building',
        'detail',
    ];

    //リレーション
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    //姓+名
    public function getFullNameAttribute()
    {
        return $this->last_name . '　' . $this->first_name;
    }

    //性別
    public function getGenderLabelAttribute()
    {
        $labels = [
            1 => '男性',
            2 => '女性',
            3 => 'その他',
        ];

        return $labels[$this->gender];
    }

}
