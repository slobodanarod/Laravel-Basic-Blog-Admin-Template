<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;
    protected $table = 'blogs';


    public function tags(){
        return $this->belongsToMany(Tag::class)->withPivot('tag_id');
    }

    public function getTags(){
        $tags = '';
        foreach($this->tags as $tag){
            $tags .= $tag->name . ",";
        }
        return $tags;
    }

    public function categories(){
        return $this->belongsToMany(Category::class)->withPivot('category_id');
    }

    public function getCategories(){
        return $this->categories;
    }

}
