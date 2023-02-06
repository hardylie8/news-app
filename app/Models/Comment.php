<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $appends = ['username'];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var string[]
     */
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    /**
     * the attribute that can be filled
     * @var string[]
     */
    protected $fillable = [
        'users_id',
        'news_id',
        'title'
    ];

    /**
     * Model relationship definition.
     * Comments belongs to news 
     *
     * @return belongsTo
     */
    public function news()
    {
        return $this->belongsTo(News::class);
    }

    /**
     * Get the parent Commentable model (user or news).
     */
    public function users()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * get user name attribute 
     * @return string|null 
     */
    public function getUsernameAttribute()
    {
        $user = new User();
        return $user->find($this['users_id'])->name ?? '';
    }
}
