<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Approval extends Model
{
    protected $table = 'approval';
    protected $primaryKey = "id";
    protected $fillable = [	
        'user_id',
        'category_id',
        'title',
        'slug',
        'description',
        'image',
        'content',
        'views_count',
        'status',
    ];
    protected $casts = [
        'created_at' => 'datetime:d/m/Y', // Change your format
        'updated_at' => 'datetime:d/m/Y',
    ];

    public function category()
    {
        return $this->belongsTo(\App\Models\Categories::class, 'category_id', 'id');
    }

    public function getCategory($id){
        return Categories::where('id',$id)->get();
    }
    public function getUser($id){
        return User::where('id',$id)->get();
    }

    public function user()
    {
        return $this->belongsTo(\App\User::class, 'user_id', 'id');
    }

    public function comment()
    {
        return $this->hasMany(\App\Models\Comments::class, 'news_id', 'id')->orderBy('news_id');
    }

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title',
                'onUpdate' => true
            ]
        ];
    }
}