<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Darryldecode\Cart\CartCondition;


class InvoiceController extends Controller
{
    public function index()
    {
        $condition = new CartCondition([
            'name' => 'pajak',
            'type' => 'tax',
            'target' => 'total',
            'value' => 0,
            'order' => 1

        ]);
        \Cart::session(auth()->id())->condition($condition);
        $items = \Cart::session(Auth()->id())->getContent()->sortBy(function ($cart){
            return $cart->attributes->get('added_at');
        });
        if(\Cart::isEmpty()){
            $cartData = [];
        }else{
            foreach ($items as $item) {
                $cart[] = [
                    'rowId' => $item->id,
                    'name' => $item->name,
                    'qty' => $item->quantity,
                    'pricesingle' => $item->price,
                    'price' => $item->getPriceSum(),
                ];
            }
            $cartData = collect($cart);
        }
        $sub_total = \Cart::session(Auth()->id())->getSubTotal();
        $total = \Cart::session(Auth()->id())->getTotal();

        $newCondition = \Cart::session(Auth()->id())->getCondition('pajak');
        $pajak = $newCondition->getCalculatedValue($sub_total);

        $summary = [
            'sub_total' => $sub_total,
            'total' => $total,
            'pajak' => $pajak,

        ];

        setlocale(LC_TIME, 'id_ID');
        \Carbon\Carbon::setLocale('id');
        \Carbon\Carbon::now()->formatLocalized("%A, %d %B %Y");

        $today = Carbon::now()->isoFormat('dddd, D MMMM Y');

        // return $cartData;
        return view('pages.invoice',[
            'carts' => $cartData,
            'summary' => $summary,
            'tgl' => $today 
        ]);
    }

    public function submit()
    {
        $userId = Auth()->id();
       \Cart::session($userId)->clear();

       return redirect('/'); 
    }
}
