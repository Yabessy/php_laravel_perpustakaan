<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserComment extends Model
{
    protected $fillable = ['user_id','book_id','rating','comment_message'];
    use HasFactory;
    // protected $primaryKey = 'comment_id';
}