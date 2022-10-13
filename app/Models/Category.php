<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;


     /**
     * The attributes that are mass assignable.
     *
     * 
     */
    protected $fillable = [
        'name',
        'description',
        'category_id',
    ];


    public function categories(){
        return $this->hasMany(Category::class);

    }

    public function childrenCategories(){
        return $this->hasMany(Category::class)->with('categories');
    }

    public function childCategory(){
        return $this->belongsTo(Category::class,'category_id');
    }


    /**
     * The articles that belong to the Category 
     */
    public function articles(){
        return $this->belongsToMany(Article::class);
    }





}
