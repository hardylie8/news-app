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
     * Get the parent Commentable model (user or news).
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

    public function getUsernameAttribute()
    {
        $user = new User();
        return $user->find($this['users_id'])->name ?? '';
    }
}