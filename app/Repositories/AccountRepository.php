<?php

namespace App\Repositories;

use App\Models\Account;

class AccountRepository
{
    protected $account;

    public function __construct(Account $account)
    {
        $this->account = $account;
    }

    public function getCount()
    {
        return $this->account->count();
    }
    public function new($data)
    {
        $count = $this->getCount();
        $count+=rand(1000,9999);
        $account = new $this->account;
        $account->number = $count;
        $account->user_id = $data['id'];
        $account->balance = 0;
        $account->currency = $data['currency'];
        $account->save();
        return $account->fresh();
    }
    public function sendMoney($number, $money)
    {
        $account = $this->account->where('number',$number)->first();
        $account->balance -= $money;
        $account->save();
        return $account->fresh();
    }
    public function addMoney($number, $money)
    {
        $account = $this->account->where('number',$number)->first();
        $account->balance += $money;
        $account->save();
        return $account->fresh();
    }

    public function checkBalance($number, $money)
    {
        $account = $this->account->where('number',$number)->first();
        if($account->balance>$money) return true;
    }
}
