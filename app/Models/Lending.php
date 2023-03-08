<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lending extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'book_id', 'status', 'amount', 'start_of_lend', 'end_of_lend'];
}