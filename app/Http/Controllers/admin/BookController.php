<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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
            $query =  DB::table('books')
                ->where('title', 'like', '%' . $request->search . '%')
                ->orWhere('tags', 'like', '%' . $request->search . '%')
                ->orWhere('isbn', '=', $request->search)->get();
            // dd(array($searchMain));
            if ($request->tags > 0) {
                $query = DB::table('books')
                    ->where('tags', 'like', '%' . $request->tags . '%')
                    ->where('title', 'like', '%' . $request->search . '%')
                    ->orWhere('isbn', '=', $request->search)->get();
            }
            // dd($request->all());
            if (isset($request->book_type)) {
                $query = DB::table('books')
                    ->where('book_type', '=', $request->book_type)
                    ->where('tags', 'like', '%' . $request->tags . '%')
                    ->where('title', 'like', '%' . $request->search . '%')
                    ->orWhere('isbn', '=', $request->search)->get();
            }
            $search['items'] = $query;
            $books = [$search];
        }
        return view('librarian.book.index', [
            'books' => $books,
        ]);
    }

    public function type(Request $request, $type)
    {

        // dd($type);
        if ($request->type === "Non-Akademik") {
            $type = 0;
            return view('librarian.book.type', [
                'books' => DB::table('books')->where('book_type', '=', $type)->orWhere('tags', 'like', '% ' . $type . '%')->paginate(18),
            ]);
        } else if ($request->type === "Akademik") {
            $type = 1;
            return view('librarian.book.type', [
                'books' => DB::table('books')->where('book_type', '=', $type)->orWhere('tags', 'like', '% ' . $type . '%')->paginate(18),
            ]);
        }
        return view('librarian.book.type', [
            'books' => DB::table('books')->where('tags', 'like', '%' . $type . '%')->paginate(18),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('librarian.book.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        // dd($request->all());
        $bokInfo = $request->validate([
            "title" => ['required'],
            "book_type" => ['required'],
            "tags" => ['required'],
            "isbn" => ['required'],
            "release_date" => ['required'],
            "publisher" => ['required'],
            "author" => ['required'],
            "synopsis" => ['required'],
            "remaining_books" => ['required'],
        ]);
        // dd($bokInfo);
        if ($request->hasFile('book_cover')) {
            $bokInfo['book_cover'] = $request->file('book_cover')->store('covers', 'public');
        }
        Book::create($bokInfo);
        return redirect(route('admin.books.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        //
        return view('librarian.book.show', [
            'book' => $book
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {
        //
        return view('librarian.book.edit', [
            'book' => $book
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Book $book)
    {
        //
        $bokInfo = $request->validate([
            "title" => ['required'],
            "book_type" => ['required'],
            "tags" => ['required'],
            "isbn" => ['required'],
            "release_date" => ['required'],
            "publisher" => ['required'],
            "author" => ['required'],
            "synopsis" => ['required'],
            "remaining_books" => ['required'],
        ]);
        // dd($bokInfo);
        if ($request->hasFile('book_cover')) {
            $bokInfo['book_cover'] = $request->file('book_cover')->store('covers', 'public');
        }
        $book->update($bokInfo);
        return redirect()->route('admin.books.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        //
        $book->delete();
        return redirect(route('admin.books.index'));
    }
}
