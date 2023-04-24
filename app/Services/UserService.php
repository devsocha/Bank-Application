<?php
namespace App\Services;

use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Validator;

class UserService
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function getAllUsers()
    {
        return $this->userRepository->getAllUsers();
    }

    public function createUser($data)
    {
        $validator = Validator::make($data,
        [
            'name'=>'required',
            'surname'=>'required',
            'email'=>'email | required',
            'password'=>'required'
        ]);
        return $this->userRepository->createUser($data);
    }
    public function getUserById($id)
    {
        return $this->userRepository->getUserById($id);
    }
    public function updateUser($data, $id)
    {
        $validator = Validator::make($data,[
            'name'=>'required',
            'surname'=>'required',
            'email'=>'required',
        ]);
        return $this->userRepository->update($data,$id);
    }
    public function deleteUser($id)
    {
        return $this->userRepository->delete($id);
    }
}
