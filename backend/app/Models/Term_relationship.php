<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Term_relationship extends Model
{
    use HasFactory;
    protected $fillable = [
        'object_id',
        'term_id'
    ];
    protected $primaryKey = [
        'object_id',
        'term_id'
    ];
}
