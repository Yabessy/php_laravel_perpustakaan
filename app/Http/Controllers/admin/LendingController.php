<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Lending;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LendingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $lendings = DB::table('lendings')
            ->join('users', 'lendings.user_id', '=', 'users.id')
            ->join('books', 'lendings.book_id', '=', 'books.id')
            ->select('users.*', 'books.*', 'lendings.*')
            ->get();

        if ((isset($request->filter) || $request->filter == '0') && isset($request->book_id) && isset($request->user_id)) {
            $lendings = DB::table('lendings')
                ->join('users', 'lendings.user_id', '=', 'users.id')
                ->join('books', 'lendings.book_id', '=', 'books.id')
                ->where('status', '=', $request->filter)
                ->where('book_id', 'like', $request->book_id)
                ->where('user_id', 'like', $request->user_id)
                ->select('users.*', 'books.*', 'lendings.*')
                ->get();
            // dd("a");
        } elseif (isset($request->filter) || $request->filter == '0') {
            $lendings = DB::table('lendings')
                ->join('users', 'lendings.user_id', '=', 'users.id')
                ->join('books', 'lendings.book_id', '=', 'books.id')
                ->where('status', '=', $request->filter)
                ->select('users.*', 'books.*', 'lendings.*')
                ->get();
            // dd($lendings);
        }
        return view('librarian.lending.index', [
            'lendings' => $lendings,
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
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
        $req = $request->validate([
            'id' => ['required', 'numeric'],
            'type' => ['required', 'numeric'],
        ]);
        // dd($req);
        if ($req['type'] == 2) {
            $lending = DB::table('lendings')->where('id', '=', $req['id'])->get();
            if ($lending[0]->status == 2) {
                $book = Book::find($lending[0]->book_id);
                $book->remaining_books = $book->remaining_books + $lending[0]->amount;
                $book->save();
            }
            DB::table('lendings')->where('id', '=', $req['id'])->update(['status' => 3]);
        } else if ($req['type'] == 1) {
            $lending = DB::table('lendings')->where('id', '=', $req['id'])->get();
            if (!$lending[0]->status) {
                $book = Book::find($lending[0]->book_id);
                $book->remaining_books = $book->remaining_books - $lending[0]->amount;
                $book->save();
            }
            DB::table('lendings')->where('id', '=', $req['id'])->update(['status' => 2]);
        } else {
            $lending = DB::table('lendings')->where('id', '=', $req['id'])->get();
            $book = Book::find($lending[0]->book_id);

            if ($book && $lending[0]->status) {
                $book->remaining_books = $book->remaining_books + $lending[0]->amount;
                $book->save();
                DB::table('lendings')->where('id', '=', $req['id'])->update(['status' => 0]);
            }
        }
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
