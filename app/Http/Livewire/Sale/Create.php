<?php

namespace App\Http\Livewire\Sale;

use App\Models\Product;
use App\Models\Transaction;
use Carbon\Carbon;
use Darryldecode\Cart\Cart;
use Darryldecode\Cart\CartCondition;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class Create extends Component
{
    use WithPagination;
    public $tax = "0", $carts;

    public function render()
    {

        $condition = new CartCondition([
            'name' => 'pajak',
            'type' => 'tax',
            'target' => 'total',
            'value' => $this->tax,
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

        // dd($cartData);

        $this->carts = $cartData;

        return view('livewire.sale.create',[
            'products' => Product::orderBY('name','ASC')->get(),
            'carts' => $cartData,
            'summary' => $summary
        ]);
    }
    public function addItem($id)
    {

        $userId = Auth()->id();
        $rowId = $id;
        $cart = \Cart::session($userId)->getContent();
        $checkItemId = $cart->whereIn('id', $rowId);

        if($checkItemId->isNotEmpty()){
            // dd('not empty');
            \Cart::session($userId)->update($rowId,[
                'quantity' => [
                    'relative' => true,
                    'value' => 1
                ]
            ]);
        }else{
            // dd('empty');
            $product = Product::findOrFail($id);
        \Cart::session($userId)->add([
            'id' => $product->id,
            'name' => $product->name,
            'price' => $product->price,
            'quantity' => 1,
            'attributes' => [
                'added_at' => Carbon::now()
            ],
        ]);
        }
        
    }

    public function remove($id)
    {
        // $this->isSuccess($id);
        $userId = Auth()->id();
        \Cart::session($userId)->remove($id);
        
    }
    public function increase($rowId)
    {
        $userId = Auth()->id();
       \Cart::session($userId)->update($rowId,[
                'quantity' => [
                    'relative' => true,
                    'value' => 1
                ]
            ]);
    }
    public function decrease($rowId)
    {
        $userId = Auth()->id();
       \Cart::session($userId)->update($rowId,[
                'quantity' => [
                    'relative' => true,
                    'value' => -1
                ]
            ]);
    }

    public function saveTransaction()
    {
        setlocale(LC_TIME, 'id_ID');
        \Carbon\Carbon::setLocale('id');
        \Carbon\Carbon::now()->formatLocalized("%A, %d %B %Y");

        $today = Carbon::now()->isoFormat('dddd, D MMMM Y');
        

        $kode = $this->quickRandom();
        foreach ($this->carts as $key => $value) {
           Transaction::create([
                'kode' => $kode,
                'date' => $today,
                'product_id' => $value['rowId'],
                'qty' => $value['qty'],
                'price' => $value['price'],
                'user_id' => Auth::user()->id,
           ]);
        }
       $this->isSuccess('Transaction Success');

       return redirect()->to('/invoice');
    }

    public function isSuccess($msg)
    {
        $this->alert('success', $msg, [
            'position' =>  'top-end', 
            'timer' =>  3000,  
            'toast' =>  true, 
            
            'confirmButtonText' =>  'Ok', 
            'cancelButtonText' =>  'Cancel', 
            'showCancelButton' =>  false, 
            'showConfirmButton' =>  false, 
      ]);
    }

    public static function quickRandom($length = 16)
    {
        $pool = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';

        return substr(str_shuffle(str_repeat($pool, 5)), 0, $length);
    }
}
