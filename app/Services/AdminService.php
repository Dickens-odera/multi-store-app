<?php


namespace App\Services;


use App\Models\Store;
use App\Models\User;

class AdminService
{
    public function getStores(){
        return Store::latest()->take(10)->get();
    }

    public function getUsers(){
        return User::latest()->take(10)->get();
    }

    public function getProducts(){
        // return products
    }
}
