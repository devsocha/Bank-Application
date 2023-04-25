<?php

namespace App\Services;

use App\Repositories\AccountRepository;
use Illuminate\Support\Facades\Validator;


class AccountService
{
    protected $accountRepository;

    public function __construct(AccountRepository $accountRepository)
    {
        $this->accountRepository = $accountRepository;
    }
    public function newAccount($data)
    {
        $validator = Validator::make($data, [
            'id'=>'required',
            'currency'=>'required',
        ]);

        $data['currency'] = strtoupper($data['currency']);
        if(!in_array($data['currency'],['PLN','EUR','USD'])){
            throw new \Exception('Błędna waluta');
        }
        return $this->accountRepository->new($data);
    }

    public function transaction($data)
    {
        $validator = Validator::make($data,[
            'numberFrom'=>'required',
            'numberTo'=>'required',
            'money'=>'required',
        ]);
        $money = floor((float)$data['money']*100)/100;
        if(!$this->accountRepository->checkBalance($data['numberFrom'],$money))
        {
            throw new \Exception('Konto nie posiada wystarczających środków');
        }
        $this->accountRepository->addMoney($data['numberTo'],$money);
        return $this->accountRepository->sendMoney($data['numberFrom'],$money);
    }
}
