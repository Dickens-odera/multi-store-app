<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductPurchase;
use App\Http\Requests\ProductPurchaseRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use App\Events\ProductPurchased;
use Event;

class ProductPurchaseController extends Controller
{
    public function purchase(ProductPurchaseRequest $request, $id){
        $product = Product::with('user','store')->find($id);
        $validator = Validator::make($request->all, $request->rules());
        if($validator->fails()){
            return back()->with('error', $validator->errors()->first());
        }else{
            try{
                $purchase = ProductPurchase::create(
                    array_merge(
                        $request->validated(),
                        [
                            'user_id' => Auth::id(),
                            'product_id' => $product->id
                        ]
                    ))
                if($purchase){
                    //TODO integrate stripe payments here
                    //TODO send email notification to both customer and store owner
                    ProductPurchased::dispatch($product);
                    return back()->with('success', 'Product bought successfully, kindly check your email for the order details');
                }else{
                    return back()->with('error','Failed to buy product, please try again later');
                }
            }catch(\Exception $ex){
                Log::critical('Something went wrong purchasing the product. ERROR '.$ex->getMessage());
                return back()->with('error','Something went wrong purchasing the product, please try again later');
            }
        }
    }
}
