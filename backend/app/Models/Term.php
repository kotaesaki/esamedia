<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Term extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'term_name',
        'term_slug',
        'term_description',
        'taxonomy',
        'parent',
    ];

    protected $primaryKey = 'term_id';

    public function posts()
    {
        return $this->belongsToMany(
            'App\Models\Post',
            'post_term',
            'term_id',
            'post_id'
        );
    }
}
