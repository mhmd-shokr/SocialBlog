<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Post extends Model
{
    use HasFactory;
    protected $fillable=[
        'title',
        'slug',
        'user_id',
        'image',
        'content',
        'image',
        'category_id'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }
    public function claps(){
        return $this->hasMany(clap::class);
    }


    public function readTime($wordPerTime=100){
        $wordCount=str_word_count(strip_tags($this->content));
        $minutes=ceil($wordCount/$wordPerTime);
        return max(1,$minutes);
    }

    public function imageUrl(){
        if($this->image){
            return Storage::url($this->image);
        }
        return null;
    }
}
