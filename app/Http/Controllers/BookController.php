<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookController extends Controller
{
    //
    public function index(Request $request)
    {
        $non_akademik['items'] = DB::table('books')->where('book_type', '=', 0)->limit(12)->get();
        $non_akademik['type'] = 'Non-Akademik';
        $akademik['items'] = DB::table('books')->where('book_type', '=', 1)->limit(12)->get();
        $akademik['type'] = 'Akademik';
        $fantasy['items'] = DB::table('books')->where('tags', 'like', '%fantasy%')->limit(12)->get();
        $fantasy['type'] = 'Fantasy';
        $books = [
            $non_akademik,
            $akademik,
            $fantasy
        ];
        if ($request->search || $request->tags || isset($request->book_type)) {
            $query = DB::table('books')
                ->where('title', 'like', '%' . $request->search . '%')
                ->orWhere('tags', 'like', '%' . $request->search . '%')
                ->orWhere('isbn', '=', $request->search)->limit(18)->get();
            // dd(array($searchMain));
            if ($request->tags > 0) {
                $query = DB::table('books')
                    ->where('tags', 'like', '%' . $request->tags . '%')
                    ->where('title', 'like', '%' . $request->search . '%')
                    ->orWhere('isbn', '=', $request->search)->limit(18)->get();
            }
            // dd($request->all());
            if (isset($request->book_type)) {
                $query = DB::table('books')
                    ->where('book_type', '=', $request->book_type)
                    ->where('tags', 'like', '%' . $request->tags . '%')
                    ->where('title', 'like', '%' . $request->search . '%')
                    ->orWhere('isbn', '=', $request->search)->limit(18)->get();
            }
            $search['items'] = $query;
            $books = [$search];
        }
        return view('book.index', [
            'books' => $books,
        ]);
    }
    public function show(Book $book)
    {
        $comment = DB::table('user_comments')
        ->join('users', 'user_comments.user_id', '=', 'users.id')
        ->join('books', 'user_comments.book_id', '=');
        return view('book.show', [
            'book' => $book,
        ]);
    }

    public function type(Request $request, $type)
    {
        if ($request->type === "Non-Akademik") {
            $type = 0;
            return view('book.type', [
                'books' => DB::table('books')->where('book_type', '=', $type)->orWhere('tags', 'like', '% ' . $type . '%')->paginate(18),
            ]);
        } else if ($request->type === "Akademik") {
            $type = 1;
            return view('book.type', [
                'books' => DB::table('books')->where('book_type', '=', $type)->orWhere('tags', 'like', '% ' . $type . '%')->paginate(18),
            ]);
        }
        return view('librarian.book.type', [
            'books' => DB::table('books')->where('tags', 'like', '%' . $type . '%')->paginate(18),
        ]);
    }
}