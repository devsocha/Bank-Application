<?php

namespace App\Repositories;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserRepository
{
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function getAllUsers()
    {
        return $this->user->all();
    }

    public function createUser($data)
    {
        $user = new $this->user();
        $user->name = $data['name'];
        $user->surname = $data['surname'];
        $user->email = $data['email'];
        $user->password = Hash::make($data['password']);
        $user->save();
        return $user->fresh();
    }
    public function getUserById($id)
    {
        return $this->user->where('id',$id)->get();
    }
    public function update($data,$id)
    {
        $user = $this->user->find($id);
        $user->name = $data['name'];
        $user->surname = $data['surname'];
        $user->email = $data['email'];
        $user->save();
        return $user->fresh();
    }
    public function delete($id)
    {
        $user = $this->user->find($id);
        $username = $user->name .' '.$user->surname;
        $user->delete();
        return 'Poprawnie usunięto usera - '.$username;
    }
}
