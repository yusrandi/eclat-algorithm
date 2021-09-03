<?php

namespace App\Http\Livewire\Sale;

use App\Models\Product;
use App\Models\Transaction;
use Livewire\Component;
use Phpml\Association\Apriori;
use Illuminate\Support\Str;


class Index extends Component
{
    public $selectedData = [];
    public function create()
    {
        return redirect()->to('/sales/create');
    }
    public function selectedItem($id)
    {
        $this->selectedData = $id;
        $kode = $id[0]['kode'];
        $this->dispatchBrowserEvent('openModal');   
    }
    public function render()
    {
        $data = Transaction::transaction()->groupBy('kode');
        // dd($data);
        return view('livewire.sale.index',[
            'trans' => $data,
            'products' => Product::all(),
            'alltrans' => Transaction::all()
        ]);
    }
}
