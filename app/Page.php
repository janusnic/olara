<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Interfaces\StaticPagesInterface;

class Page extends Model implements StaticPagesInterface {

    protected $fillable = ['slug', 'title', 'article', 'description', 'tags'];

    public static function findBySlug($slug)
    {
        return static::where('slug', $slug)->first();
    }
}
