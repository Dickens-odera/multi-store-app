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

    public function listDrivers(){
        return User::get()->filter(function($user){
            return $user->role == User::DRIVER_ROLE;
        });
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
        // return products
    }
}
