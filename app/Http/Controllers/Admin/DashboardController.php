<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Store;
use App\Models\User;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Services\AdminService;

class DashboardController extends Controller
{
    public $adminService;

    public function __construct(AdminService $adminService){
        $this->adminService = $adminService;
    }

    public function index(){
        $totalStores        = Store::count();
        $totalUsers         = User::count();
        $totalProducts      = Product::count();
        $users              = $this->adminService->getUsers();
        $stores             = $this->adminService->getStores();
        $drivers            = $this->adminService->listDrivers();
        $products           = $this->adminService->getProducts();

        return view('admin.dashboard',[
            'totalStores'       => $totalStores,
            'totalUsers'        => $totalUsers,
            'users'             => $users,
            'stores'            => $stores,
            'drivers'           => $drivers,
            'products'          => $products,
            'totalProducts'     => $totalProducts
        ]);
    }
}
