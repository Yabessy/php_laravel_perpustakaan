<?php

namespace App\Http\Controllers;

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
    public function index()
    {
        //
        return "Lending Api";
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
        // dd($request->all());
        $request->validate([
            'user_id' => ['required', 'numeric'],
            'book_id' => ['required', 'numeric'],
            'amount' => ['required', 'numeric', 'gt:min'],
            'start' => ['required', 'date'],
            'duration' => ['required', 'numeric', 'gte:min', 'lte:14'],
        ]);
        $end_of_lend = date('Y-m-d', strtotime($request->start . ' + ' . $request->duration . ' days'));

        $book = Book::find($request->book_id);
        if ($book) {
            $check = $book->remaining_books - $request->amount;
            if ($check > 0) {
                $book->remaining_books = $book->remaining_books - $request->amount;
                $book->save();
            } else {
                // dd($check);
                return back()->with('message', 'peminjaman gagal, stock buku kurang');
            }
        }

        Lending::create([
            'user_id' => $request->user_id,
            'book_id' => $request->book_id,
            'amount' => intval($request->amount),
            'start_of_lend' => $request->start,
            'end_of_lend' => $end_of_lend,
        ]);
        if ($request->start > date('Y-m-d')) {
            return redirect('history/1')->with('message', "Berhasil Meminjam");
        }
        return redirect('history/2')->with('message', "Berhasil Meminjam");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Lending  $lending
     * @return \Illuminate\Http\Response
     */
    public function show(Lending $lending, $type = 1)
    {
        //
        $url = url()->current();
        if ($type == 1) {
            $dateNow = date('Y-m-d');
            $history = DB::table('lendings')
                ->join('users', 'lendings.user_id', '=', 'users.id')
                ->join('books', 'lendings.book_id', '=', 'books.id')
                ->where('lendings.user_id', '=', auth()->user()->id)
                ->where('lendings.start_of_lend', '>', $dateNow)
                ->orderByDesc('lendings.start_of_lend')
                ->get();
            // dd($history);
            return view('user.history', [
                "history" => $history,
                "url" => $url,
            ]);
        } else if ($type == 2) {
            $dateNow = date('Y-m-d');
            $history = DB::table('lendings')
                ->join('users', 'lendings.user_id', '=', 'users.id')
                ->join('books', 'lendings.book_id', '=', 'books.id')
                ->where('lendings.user_id', '=', auth()->user()->id)
                ->where('lendings.start_of_lend', '<=', $dateNow)
                ->where('lendings.end_of_lend', '>=', $dateNow)
                ->orderByDesc('lendings.start_of_lend')
                ->get();
            // dd($history);
            return view('user.history', [
                "history" => $history,
                "url" => $url,
            ]);
        } else if ($type == 3) {
            $dateNow = date('Y-m-d');
            $history = DB::table('lendings')
                ->join('users', 'lendings.user_id', '=', 'users.id')
                ->join('books', 'lendings.book_id', '=', 'books.id')
                ->where('lendings.user_id', '=', auth()->user()->id)
                ->where('lendings.end_of_lend', '<', $dateNow)
                ->orderByDesc('lendings.start_of_lend')
                ->get();
            // dd($history);
            return view('user.history', [
                "history" => $history,
                "url" => $url,
            ]);
        }
        return redirect('history/1');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Lending  $lending
     * @return \Illuminate\Http\Response
     */
    public function edit(Lending $lending)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Lending  $lending
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Lending $lending)
    {
        //

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Lending  $lending
     * @return \Illuminate\Http\Response
     */
    public function destroy(Lending $lending)
    {
        //
    }
}