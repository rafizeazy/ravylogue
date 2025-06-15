<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\User;
use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;


class Like extends Model
{
    protected $fillable = [
        'user_id',
        'post_id',
    ];

    // Relationship: Like belongs to a User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relationship: Like belongs to a Post
    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
