<?php

namespace App\Livewire\Dash\Users;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class UsersLivewire extends Component
{
    use LivewireAlert;
    public $modal = false;
    public $name;
    public $email;
    public $role;
    public $password = '12345678';
    public $user;

    public function create($id = null)
    {

        if (!empty($id)) {
            $this->user  = User::find($id);
            $this->name = $this->user->name;
            $this->email = $this->user->email;
            $this->role = $this->user->role;
            $this->modal = true;
        } else {
            $this->modal = true;
        }
    }

    public function cancel()
    {
        $this->reset(['modal', 'name', 'email', 'role', 'user']);
    }


    public function store()
    {

        $this->validate([
            'name' => 'required',
            'email' => 'required|email',
            'role' => 'required',
            'password' => 'required'
        ]);

        if (!empty($this->user->id)) {
           
            $this->user->update([
                'name' => $this->name,
                'email' => $this->email,
                'role' => $this->role,
                // 'password' => Hash::make($this->password),
            ]);

            $this->alert('success', 'User Updated Successfully');
            $this->cancel();
        } else {
            User::create([
                'name' => $this->name,
                'email' => $this->email,
                'role' => $this->role,
                'password' => Hash::make($this->password),
            ]);
            $this->alert('success', 'User Created Successfully');
            $this->cancel();
        }
    }

    public function delete($id)
    {

        $u = User::find($id);
        $u->delete();
        $this->alert('success', 'User Deleted Successfully');
    }


    public function render()
    {
        $u = User::all();
        return view('livewire.dash.users.users-livewire')->with('users', $u);
    }
}
