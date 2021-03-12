<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use cebe\markdown\GithubMarkdown as Markdown;

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
        'post_excerpt'
    ];
    protected $primaryKey = 'post_id';

    public $timestamps = false;

    public function terms()
    {
        return $this->belongsToMany(
            'App\Models\Term',
            'post_term',
            'post_id',
            'term_id'
        );
    }
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
    public function comment()
    {
        return $this->hasMany('App\Models\Comment');
    }
    public function parse()
    {
        $parser = new Markdown();
        return $parser->parse($this->post_content);
    }
    public function getMarkBodyAttribute()
    {
        return $this->parse();
    }
}
