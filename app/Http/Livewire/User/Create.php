<?php

namespace App\Http\Livewire\User;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\ImageManager;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads;
    public $image, $name, $phone, $address, $email, $password, $selectedItemId;

    protected $listeners = [
        'getModelId',
        'forceCloseModal',
        'cleanVars'
    ];

    protected $rules = [
        'name' => 'required|string|max:255',
        'address' => 'required|string|max:255',
        'phone' => 'required|string|max:255',
        'password' => 'required|min:8',
        'email' => 'sometimes|email|max:255|unique:users',
        
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
            $this->image->store('public/photo');
            $imageName = $this->image->hashName();
            $data['image'] = $imageName;

            $this->handleImageIntervention($imageName);

        }
        $data['password'] = Hash::make($this->password);
        $data['role_id'] = 2;

        // dd($data);
        $save = User::create($data);
        $save ? $this->emit('isSuccess("berhasil")') : $this->emit('isError("Gagal")');

         $this->emit('refreshParent');
         $this->dispatchBrowserEvent('closeModal');
         $this->cleanVars();


    }
    public function update()
    {
        $validateData = [];
        
        $validateData = array_merge($validateData,[
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
        ]);
        $data = $this->validate($validateData);
        if (!empty($this->image)){
            
            $this->image->store('public/photo');
            $imageName = $this->image->hashName();
            $data['image'] = $imageName;

            $this->handleImageIntervention($imageName);

        }
        if($this->password){
            $data['password'] = Hash::make($this->password);
        }

        $save = User::find($this->selectedItemId)->update($data);
        $save ? $this->isSuccess("Data Berhasil diUbah") : $this->isError("Data Gagal diUbah");

        $this->emit('refreshParent');
        $this->dispatchBrowserEvent('closeModal');
        $this->cleanVars();

    }
    public function render()
    {
        return view('livewire.user.create');
    }
    public function handleImageIntervention($imageName)
    {
        $manager = new ImageManager();
        $image = $manager->make('storage/photo/'.$imageName)->resize(100,100);
        $image->save('storage/photos_thumb/'.$imageName);
    }
    public function cleanVars()
    {
        $this->selectedItemId = null;
        $this->image = null;
        $this->name = null;
        $this->phone = null;
        $this->address = null;
        $this->password = null;
    }

    public function getModelId($selectedItemId)
     {

        $this->selectedItemId = $selectedItemId;
        $model = User::find($this->selectedItemId);
        $this->name = $model->name;
        // $this->image = $model->image;
        $this->phone = $model->phone;
        $this->address = $model->address;
        $this->email = $model->email;

    }
     public function forceCloseModal()
     {
         $this->cleanVars();
         $this->resetErrorBag();
         $this->resetValidation();
     }
    public function triggerConfirm()
    {
        $this->confirm('yakin akan menghapus data ?', [
            'toast' => false,
            'position' => 'center',
            'showConfirmButton' => true,
            'showCancelButton' =>  true, 
            'onConfirmed' => 'delete',
            'onCancelled' => 'cancelled'
        ]);
    }

    public function isSuccess($msg)
    {
        $this->alert('success', $msg, [
            'position' =>  'top-end', 
            'timer' =>  3000,  
            'toast' =>  true, 
            'text' =>  '', 
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
            'text' =>  '', 
            'confirmButtonText' =>  'Ok', 
            'cancelButtonText' =>  'Cancel', 
            'showCancelButton' =>  false, 
            'showConfirmButton' =>  false, 
      ]);
    }
    public function confirmed()
    {
        // Example code inside confirmed callback
    
        $this->alert('success', 'Hello World!', [
            'position' =>  'top-end', 
            'timer' =>  3000,  
            'toast' =>  true, 
            'text' =>  '', 
            'confirmButtonText' =>  'Ok', 
            'cancelButtonText' =>  'Cancel', 
            'showCancelButton' =>  true, 
            'showConfirmButton' =>  true, 
      ]);
    }
    
    public function cancelled()
    {
        // Example code inside cancelled callback
    
        $this->alert('info', 'Understood');
    }
}
