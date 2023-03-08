<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
    protected $fillable = ['book_type', 'isbn', 'title', 'tags', 'release_date', 'publisher', 'author', 'synopsis', 'remaining_books', 'book_cover'];
}