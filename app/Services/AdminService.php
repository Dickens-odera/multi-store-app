<?php
namespace App\Services;

use App\Models\Driver;
use App\Models\Store;
use App\Models\User;
use App\Models\Product;

class AdminService
{
    public function getStores(){
        return Store::latest()->take(10)->get();
    }

    public function getUsers(){
        return User::latest()->take(10)->get();
    }

    public function listDrivers(){
        return Driver::take(5)->latest()->get();
    }

    public function listClients(){
        return User::get()->filter(function($user){
            return $user->role === USER::CLIENT_ROLE;
        });
    }

    public function listStoreOwners(){
        return User::get()->filter(function($user){
            return $user->role === USER::STORE_OWNER_ROLE;
        });
    }
    public function getProducts(){
        return Product::with('user','store')->latest()->get();
    }
}
