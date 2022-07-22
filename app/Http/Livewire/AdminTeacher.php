<?php

namespace App\Http\Livewire;

use App\Models\User;
use App\Models\Teacher;
use Livewire\Component;

class AdminTeacher extends Component
{
    public $allTeacher=null;
    public $stut = null;
    public function getAllTeacher()
    {
        return Teacher::with("user")->get();
    }
    public function mount()
    {
        $this->allTeacher = $this->getAllTeacher();
    }
    public function render()
    {
        return view('livewire.admin-teacher');
    }

    public function changeStatus($id, $status)
    {
        // dd($status);
        if($status == 0)
        {
            $this->stut = 1; 
        }else{
            $this->stut = 0; 

        }
      
        Teacher::where("id","=",$id)->update([
            "status"=>  $this->stut,
        ]);
        $this->allTeacher=null;
        $this->allTeacher =   $this->getAllTeacher();
      $this->dispatchBrowserEvent('status');


    }
    public function deleteTeacher($id)
    {
        User::where("id","=",$id)->delete();
        $this->allTeacher=null;
        $this->allTeacher =   $this->getAllTeacher();
        $this->dispatchBrowserEvent('delete');


    }
    
}
