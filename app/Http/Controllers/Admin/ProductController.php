<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('user','store')->latest()->paginate(5);
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $stores = auth()->user()->stores ?? NULL;
        return view('admin.products.create', compact('stores'));
    }

    public function store(ProductRequest $request)
    {
        $fileUrl = null;
        $validator = Validator::make($request->all(), $request->rules());
        if($validator->fails()){
            return back()->with('error', $validator->errors()->first());
        }else{
            if($request->hasFile('avatar')){
                $avatar  = $request->file('avatar');
                $fileUrl = $avatar->storeAs('vendor_products/avatars',auth()->user()->name.'/'.time());
            }
            $productData = [
                'name'          =>  $request->name,
                'description'   =>  $request->description,
                'slug'          =>  Str::slug($request->name, '-'),
                'price'         =>  round($request->price, 2),
                'user_id'       =>  Auth::id(),
                'store_id'      =>  $request->store_id,
                'in_stock'      =>  (int)$request->in_stock,
                'avatar'        =>  $fileUrl
            ];
            try{
                if(Product::create($productData)){
                    return redirect()->route('products.index')->with('success','Product created successfully');
                }else{
                    return back()->with('error','Failed to create the new product, please try again');
                }
            }catch (\Exception $exception){
                Log::critical('Failed to create the new product. ERROR: '.$exception->getTraceAsString());
                return back()->with('error','Failed to create the new product, please try again later');
            }
        }
    }

    public function show($id)
    {
        $product   = Product::with('user','store')->find($id);
        return view('admin.products.show', compact('product'));
    }

    public function edit($id)
    {
        $product   = Product::with('user','store')->find($id);
        $stores = auth()->user()->stores ?? NULL;
        return view('admin.products.show', compact('product','stores'));
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        $product   = Product::with('user','store')->find($id);
        try{
            if($product->delete()){
                Storage::delete($product->avatar);
                return back()->with('success','Product deleted successfully');
            }else{
                return back()->with('error','Failed to delete product, please try again');
            }
        }catch (\Exception $exception){
            Log::critical('Something went wrong deleting product details. ERROR: '.$exception->getTraceAsString());
            return back()->with('error','Something went wrong deleting product details. Please try again later');
        }
    }
}
