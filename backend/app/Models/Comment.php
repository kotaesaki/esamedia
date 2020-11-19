<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'comment_post_id',
        'comment_author',
        'comment_author_email',
        'comment_author_url',
        'comment_content',
        'comment_author_ip'
    ];
    protected $primaryKey = 'comment_id';

    public function post()
    {
        return $this->belongsTo('App\Models\Post');
    }
}
