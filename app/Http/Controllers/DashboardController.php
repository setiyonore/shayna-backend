<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $income = Transaction::query()->where('transaction_status','SUCCESS')
                    ->sum('transaction_total');
        $sales = Transaction::query()->count();
        $items = Transaction::query()->orderBy('id','DESC')->take(5)->get();
        $pie = [
            'pending' => Transaction::query()->where('transaction_status','PENDING')->count(),
            'failed' => Transaction::query()->where('transaction_status','FAILED')->count(),
            'success' => Transaction::query()->where('transaction_status','SUCCESS')->count(),
        ];
        return view('pages.dashboard')->with([
            'income' =>$income,
            'sales' =>$sales,
            'items' =>$items,
            'pie' =>$pie
        ]);
    }
}
