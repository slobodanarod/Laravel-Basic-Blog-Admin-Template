<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $table = 'categories';

    public static $types = [
        "Blog",
        "Doctor",
        "Medicine"
    ];

    protected $appends = [
        'parent'
    ];

    static function getTypes(){
        return Category::$types;
    }

    public function parent(){
        return $this->belongsTo('App\Models\Category', 'parent_id');
    }

    public function getParentsNames() {
        if($this->parent) {
            return $this->parent->getParentsNames(). " > " . $this->name;
        } else {
            return $this->name;
        }
    }
}
