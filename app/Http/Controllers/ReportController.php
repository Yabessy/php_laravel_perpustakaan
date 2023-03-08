<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    //
    public function index()
    {
        return view('librarian.report.index',[
            'reports' => Report::all(),
        ]);
    }
    public function create()
    {
        return view('report');
    }
    public function store(Request $request)
    {
        $fields = $request->validate([
            'user_id' => ['required'],
            'name' => ['required'],
            'type' => ['required'],
            'message' => ['required'],
        ]);
        // dd($fields);
        Report::create($fields);
        return redirect('/laporan')->with('message', 'Sukses Terkirim');
    }
}