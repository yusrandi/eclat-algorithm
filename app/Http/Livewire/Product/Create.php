<?php

namespace App\Http\Livewire\Product;

use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\ImageManager;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads;
    public $image, $name, $price, $stock, $selectedItemId;

    protected $listeners = [
        'getModelId',
        'forceCloseModal',
        'cleanVars'
    ];

    protected $rules = [
        'name' => 'required|string|max:255',
        'price' => 'required',
        'stock' => 'required',
        'image' => 'image|mimes:jpg,jpeg,png|max:2048',
    ];
    protected $messages = [
        'email.required' => 'this field is required.',
        'email.email' => 'this field must a email.',
        'name.required' => 'this field is required.',
        
    ];

   public function save()
    {
        $this->selectedItemId ? $this->update() : $this->store();

    }
     public function store()
    {
        
        $data = $this->validate();
       
        if (!empty($this->image)){
            $this->image->store('public/products_photo');
            $imageName = $this->image->hashName();
            $data['image'] = $imageName;
            $this->handleImageIntervention($imageName);
        }
        $data['user_id'] = Auth::user()->id;

        $save = Product::create($data);
        $save ? $this->isSuccess("berhasil") : $this->isError("Gagal");

        $this->emit('refreshParent');
        $this->dispatchBrowserEvent('closeModal');
        $this->cleanVars();


    }
    public function update()
    {
        $validateData = [];
        
        $validateData = array_merge($validateData,[
            'name' => 'required|string|max:255',
            'price' => 'required',
            'stock' => 'required',
        ]);
        $data = $this->validate($validateData);
        if (!empty($this->image)){
            
            $this->image->store('public/products_photo');
            $imageName = $this->image->hashName();
            $data['image'] = $imageName;

            $this->handleImageIntervention($imageName);

        }
        $data['user_id'] = Auth::user()->id;
        
        $save = Product::find($this->selectedItemId)->update($data);
        $save ? $this->isSuccess("Berhasil") : $this->isError("Gagal");
        
        $this->emit('refreshParent');
        $this->dispatchBrowserEvent('closeModal');
        $this->cleanVars();

    }

    public function render()
    {
        return view('livewire.product.create');
    }
    public function handleImageIntervention($imageName)
    {
        $manager = new ImageManager();
        $image = $manager->make('storage/products_photo/'.$imageName)->resize(200,200);
        $image->save('storage/products_photo_thumb/'.$imageName);
    }
    public function cleanVars()
    {
        $this->selectedItemId = null;
        $this->image = null;
        $this->name = null;
        $this->price = null;
        $this->stock = null;
    }

    public function getModelId($selectedItemId)
     {
        $this->selectedItemId = $selectedItemId;
        $model = Product::find($this->selectedItemId);
        $this->name = $model->name;
        $this->price = $model->price;
        $this->stock = $model->stock;

    }
     public function forceCloseModal()
     {
         $this->cleanVars();
         $this->resetErrorBag();
         $this->resetValidation();
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
    public function isError($msg)
    {
        $this->alert('error', $msg, [
            'position' =>  'top-end', 
            'timer' =>  3000,  
            'toast' =>  true, 
            
            'confirmButtonText' =>  'Ok', 
            'cancelButtonText' =>  'Cancel', 
            'showCancelButton' =>  false, 
            'showConfirmButton' =>  false, 
      ]);
    }
}
