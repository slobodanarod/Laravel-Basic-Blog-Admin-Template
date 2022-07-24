<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;
    protected $table = "settings";

    public static $types = [
        "Text",
        "Image",
        "TextArea",
        "Select"
    ];

    public static $mains = [
        "Seo",
        "General",
        "Special"
    ];

    static function getTypes(){
        return Setting::$types;
    }

    static function getMains(){
        return Setting::$mains;
    }

}
