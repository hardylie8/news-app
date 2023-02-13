<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class News extends Model
{
    use HasFactory;
    use SoftDeletes;


    /**
     * The attributes that should be mutated to dates.
     *
     * @var string[]
     */
    protected $dates = [
        'published_at',
        'created_at',
        'updated_at',
        'deleted_at',
    ];


    /**
     * Get all of the tags for the post.
     * @return belongsToMany
     */
    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'news_has_tags', 'news_id', 'tags_id',);
    }


    /**
     * Get all of the new's comments.
     * @return hasMany
     */
    public function comments()
    {
        return $this->hasMany(Comment::class, 'news_id');
    }


    /**
     * get user name attribute 
     * @return string|null 
     */
    public function getTagNamesAttribute()
    {
        return ($this->tags()->pluck('title')->toArray());
    }


    /**
     * get published status attribute 
     * @return string|null 
     */
    public function getPublishedAttribute()
    {
        return (is_null($this->published_at) ? 'unpublished' : 'published');
    }
}
