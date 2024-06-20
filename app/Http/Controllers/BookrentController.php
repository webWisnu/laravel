<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\book;
use App\Models\user;
use App\Models\RentLogs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class BookrentController extends Controller
{
    public function index()
    {

        $book = book::all();
        // $user = User::all();

        return view('book-rent', ['book' => $book]);
    }


    public function store(Request $request)
    {
        $request['rent_date'] = Carbon::now()->toDateString();
        $request['return_date'] = Carbon::now()->addDay(4)->toDateString();


        $book = book::findOrFail($request->book_id)->only('status');

        if ($book['status'] !=  'in stock') {

            Session::flash('message', 'Buku ini sedang di pinjam tunggu hingga buku di kembalikan');
            Session::flash('alert-class', 'alert-danger');
            return redirect('book-rent');
        } else {

            $count  = RentLogs::where('user_id', $request->user_id)->where('actual_return_date')
            ->count();


            if($count >= 3){
                Session::flash('message', 'Anda telah Mencapai limit peminjaman');
                Session::flash('alert-class', 'alert-danger');
                return redirect('book-rent');
            }
            try {
                DB::begintransaction();

                RentLogs::create($request->all());

                $book = book::findOrFail($request->book_id);
                $book->status = 'no stock';
                $book->save();
                DB::commit();

                Session::flash('message', 'Pinjam Buku Berhasil');
                Session::flash('alert-class', 'alert-success');
                return redirect('book-rent');
            } catch (\Throwable $th) {
                DB::rollback();
            }
        }
    }
}