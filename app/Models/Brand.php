<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;
    protected $table = 'brands';

    protected $fillable = [
        'name',
        'slug',
        'status',
        'category_id'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class,'category_id','id');
    }
    public static function rules($brand_id)
    {
        return [
            'name'        => 'required|string',
            'slug'        => 'required|unique:brands,slug,' . $brand_id,
            'status'      => 'nullable',
            'category_id' => 'required|integer'
        ];
    }
}
