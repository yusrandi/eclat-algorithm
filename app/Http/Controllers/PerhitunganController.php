<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;

class PerhitunganController extends Controller
{
    public function index()
    {
        $data = Transaction::transaction()->groupBy('kode');
        // return $data;
        return view('pages.perhitungan');
    }
}
