<?php

namespace App\Models;

use App\Rules\ForbiddenName;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;

class Category extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'slug', 'description', 'parent_id', 'image', 'status'];

    // make static method rules
    public static function rules($id = 0){
        return [
            'name' => [ 
                'required',
                'string',
                'min:3',
                'max:255',
                Rule::unique('categories','name')->ignore($id),
                /********** first step closerFunc()) ************/
                // function($attribute, $value, $fails){
                //     switch(strtolower($value)){
                //         case 'admin';
                //             break;
                //         case 'root';
                //             break;
                //         case 'administrator';
                //             break;
                //     }
                //     $fails('this name is forbidden ❌'); // error message about this rule
                // }
                /********** second step General ==> rule class ************/
                // new ForbiddenName(['admin', 'adminstrator', 'root']),
                // /********** third step General ==> rule ************/
                'forbidden:admin, administrator, root',

            ],
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
