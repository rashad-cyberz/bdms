<?php

namespace App\Livewire;

use App\Models\BloodType;
use App\Models\User;
use Livewire\Component;

class UsersList extends Component
{


    public $pincode = '';
    public $group = "All";


    public function mount()
    {


        $this->pincode = auth()->user()->zip_code;
    }
    public function render()
    {


        $bloodTypes = BloodType::pluck('code', 'id');


        $users = User::where('zip_code', $this->pincode);
        if($this->group != "All"){

            $groupId = $bloodTypes->search($this->group);


            $users =  $users->where('blood_type_id', $groupId);


        }


        $users =  $users->get();
        return view('livewire.users-list', ['users' => $users , 'blood_types' => $bloodTypes]);
    }



}
