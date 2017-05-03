<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

use Cviebrock\EloquentSluggable\Sluggable;

use App\Favorite;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Tag;
use App\Comment;

class Article extends Model
{
    
    use Searchable;

    use Sluggable;

    protected $sluggable = array(
        'build_from' => 'title',
        'save_to'    => 'slug',
        'separator'       => '_',
        'unique'          => true
    );

    protected $fillable = [
        'slug',
        'title',
        'summary',
        'content',
        'category_id',
        'user_id',
        'seo_title',
        'seo_desc',
        'seo_key'
    ];

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    protected $dates = ['published_at'];

    
    public function category()
    {
    	//return $this->belongsTo('App\Category');
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function tags()
    {
    	//return $this->belongsToMany('App\Tag');
        return $this->belongsToMany(Tag::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function favorited()
    {
        return (bool) Favorite::where('user_id', Auth::id())
                            ->where('article_id', $this->id)
                            ->first();
    }

}
