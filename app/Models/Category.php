<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'slug', 'description', 'parent_id', 'image', 'status'];

    // make static method rules
    public static function rules($id = 0){
        return [
            'name' => "required|string|min:3|max:255|unique:categories,name,$id",
            'parent_id' => [
                'nullable',
                'integer',
                'exists:categories,id',
            ],
            'description' => [
                'nullable',
                'min:3',
                'max:255',
            ],
            'image' => [
                'image',
                'mimes:jpg,png,jpeg,gif',
            ],
            'status' => 'in:active,archived',
        ];
    }
}
