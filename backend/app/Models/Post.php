<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'post_author',
        'post_title',
        'post_content',
        'post_status',
        'file_name',
        'file_path',
        'post_date',
        'post_modified',
    ];
    protected $primaryKey = 'post_id';

    public $timestamps = false;
}
