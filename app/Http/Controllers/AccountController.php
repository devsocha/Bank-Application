<?php

namespace App\Http\Controllers;

use App\Services\AccountService;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    protected $accountService;

    public function __construct(AccountService $accountService)
    {
        $this->accountService = $accountService;
    }
    public function createUserAccount(Request $request)
    {
        $data = $request->only([
            'id',
            'currency'
        ]);
        $result= ['status'=>200];
        try{
            $result['data'] = $this->accountService->newAccount($data);
        }catch (\Exception $e)
        {
            $result= [
                'status'=>500,
                'message'=>$e->getMessage(),
            ];
        }
        return response()->json($result,$result['status']);
    }
    public function makeTransaction(Request $request)
    {
        $data = $request->only([
            'numberFrom',
            'numberTo',
            'money'
        ]);

        $result = ['status'=>200];
        try{
            $result['data'] = $this->accountService->transaction($data);
        }catch (\Exception $e)
        {
            $result= [
            'status'=>500,
            'message'=>$e->getMessage(),
        ];
        }
        return response()->json($result,$result['status']);
    }
}
