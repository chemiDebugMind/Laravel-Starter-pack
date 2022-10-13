<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;


    protected $fillable = [
        'title',
        'body',
        'image',
        'user_id'
    ];

    /**
     * Get the categories for the Article 
     */
    public function categories(){
        return $this->belongsToMany(Category::class,'article_categories','article_id','category_id');
    }

    public function user(){
        return $this->belongsTo(User::class);
    }


    /**
     * Stroe new Article
     */
    public function StoreArticle($request){
        try {

            $article = new Article;
            $article->title = $request->title;
            $article->body = $request->body;
            $article->user_id = auth()->user()->id;

            if (request()->hasFile('image')) {
                $file = request()->file('image');
                $image = $file->hashName();
                $file->storeAs('articles',auth()->user()->id.'/'.$image,'');
                $article->image = $image;

            }

            $article->save();
            
            $article->categories()->sync($request->category_id);


            return [
                'status' => true,
                'message' => 'Article has been created!',
            ];
        } catch (Exception $e) {
            return [
                'status' => false,
                'message' => 'Something went wrong '.$e,
            ];
        }

    }


     /**
     * Stroe new Article
     */
    public function updateArticle($request,$id){
        try {

            $article = $this->findOrFail($id);
            $article->title = $request->title;
            $article->body = $request->body;
            $article->user_id = auth()->user()->id;

            if (request()->hasFile('image')) {
                $file = request()->file('image');
                $image = $file->hashName();
                $file->storeAs('articles',auth()->user()->id.'/'.$image,'');
                $article->image = $image;

            }

            $article->save();
            
            $article->categories()->sync($request->category_id);


            return [
                'status' => true,
                'message' => 'Article has been updated!',
            ];
        } catch (Exception $e) {
            return [
                'status' => false,
                'message' => 'Something went wrong '.$e,
            ];
        }

    }


}
