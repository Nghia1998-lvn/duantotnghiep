<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    protected $table = 'categories';
    protected $primaryKey = "id";
    protected $fillable = ['category', 'slug'];
    protected $casts = [
        'created_at' => 'datetime:d/m/Y', // Change your format
        'updated_at' => 'datetime:d/m/Y',
    ];

    public function news()
    {
      return $this->hasOne(News::class, 'category_id');
    }

    public function hasNews()
    {
        return $this->hasOne(News::class, 'category_id');
    } 

    public function getNews($id){
        return News::where('category_id',$id)->take(4)->get();
    }

    public function newCount()
    {
        return $this->hasMany('App\Models\News', 'category_id', 'id');
    }

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'category'
            ]
        ];
    }
}