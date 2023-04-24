<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\UserService;


class UserController extends Controller
{
    /**
     * Add protected variable
     */
    protected $userService;

    /**
     * Add construct
     */

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $result = ['status'=>200];
        try{
            $result['data'] = $this->userService->getAllUsers();
        }catch (\Exception $e)
        {
            $result = [
                'status'=> 500,
                'message'=>$e->getMessage(),
            ];
        }
        return response()->json($result,$result['status']);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->only([
            'name',
            'surname',
            'email',
            'password',
        ]);
        $result= ['status'=>200];
        try{
            $result['data'] = $this->userService->createUser($data);
        }catch (\Exception $e)
        {
            $result= [
                'status'=>500,
                'message'=>$e->getMessage(),
            ];
        }
        return response()->json($result,$result['status']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $result = ['status'=>200];
        try{
            $result['data'] = $this->userService->getUserById($id);
        }catch (\Exception $e)
        {
            $result = [
                'status'=>500,
                'message'=>$e->getMessage(),
            ];
        }
        return response()->json($result,$result['status']);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->only([
            'name',
            'surname',
            'email',
        ]);
        $result = ['status'=>200];
        try{
            $result['data'] = $this->userService->updateUser($data,$id);
        }catch (\Exception $e)
        {
            $result = [
                'status'=>500,
                'message'=>$e->getMessage(),
            ];
        }
        return response()->json($result,$result['status']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $result = ['status'=>200];
        try{
            $result['data'] = $this->userService->deleteUser($id);
        }catch (\Exception $e)
        {
            $result = [
                'status'=>500,
                'message'=>$e->getMessage(),
            ];
        }
        return response()->json($result,$result['status']);
    }
}
