<?php

namespace App\Http\Livewire\User;

use App\Models\User;
use Livewire\Component;

class Index extends Component
{
    public $selectedItemId;

    protected $listeners = [
        
        'refreshParent' => '$refresh',
        'confirmed',
        'cancelled',
        'delete',
    ];

    public function create()
    {
        $this->emit('cleanVars');

        $this->dispatchBrowserEvent('openModal');
    }
    public function selectedItem($itemId, $action)
    {

        $this->selectedItemId = $itemId;
        if($action == 'delete'){
            // $this->dispatchBrowserEvent('openDeleteModal');
            $this->triggerConfirm();
        }else{
            $this->dispatchBrowserEvent('openModal');
            $this->emit('getModelId',$this->selectedItemId);

        }
        
        // $this->action = $action;
    }
    public function delete()
    {
        $delete = User::destroy($this->selectedItemId);
            if($delete) {
                $this->isSuccess("Data Deleted Successfully");
            }else{
                $this->isError("Data Delete Failed");
            }

    }
    public function render()
    {
        return view('livewire.user.index',[
            'users' => User::orderBy('name','ASC')->get()
        ]);
    }

    public function triggerConfirm()
    {
        $this->confirm('Do you wish to continue ?', [
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
        $this->alert('success', 'Success', [
            'position' =>  'top-end', 
            'timer' =>  3000,  
            'toast' =>  true, 
            'text' =>  $msg, 
            'confirmButtonText' =>  'Ok', 
            'cancelButtonText' =>  'Cancel', 
            'showCancelButton' =>  false, 
            'showConfirmButton' =>  false, 
      ]);
    }
    public function isError($msg)
    {
        $this->alert('error', 'Error', [
            'position' =>  'top-end', 
            'timer' =>  3000,  
            'toast' =>  true, 
            'text' =>  $msg, 
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
