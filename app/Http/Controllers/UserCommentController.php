<?php

namespace App\Http\Controllers;

use App\Models\UserComment;
use Illuminate\Http\Request;

class UserCommentController extends Controller
{
    //
    public function store(Request $request)
    {
        $fields = $request->validate([
            'rating' => ['required'],
            'comment_message' => ['required'],
            'book_id' => ['required'],
        ]);
        $fields['user_id'] = auth()->user()->id;
        UserComment::create($fields);
        return back()->with('message', 'komentar sukses terkirim');
    }
}