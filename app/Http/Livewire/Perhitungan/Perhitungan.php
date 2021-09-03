<?php

namespace App\Http\Livewire\Perhitungan;

use App\Models\Product;
use App\Models\Transaction;
use Livewire\Component;

class Perhitungan extends Component
{
    public $minSupport = 0, $minCf = 0;
    public function render()
    {
        $data = Transaction::transaction()->groupBy('kode');
        return view('livewire.perhitungan.perhitungan',[
            'trans' => $data,
            'products' => Product::product_transactions(),
            'alltrans' => Transaction::transaction()
        ]);
    }
}
