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
use App\Mail\ClientPromotionalEmail;
use Event;
use Mail;

class ProductPurchaseController extends Controller
{
    public function purchase(ProductPurchaseRequest $request, $id){
        $product = Product::with('user','store')->find($id);
        $validator = Validator::make($request->all(), $request->rules());
        if($validator->fails()){
            return back()->with('error', $validator->errors()->first());
        }else{
            try{
                if( (int)$request->qty > $product->in_stock ){
                    return back()->with('error','Sorry, the product is out of stock for now, please chcek in later on');
                }elseif( $request->qty <= 0  )
                {
                    return back()->with('error','Sorry, Please indicate a valid product quantity to purchase');
                }else{
                    $purchase = ProductPurchase::create(
                        array_merge(
                            $request->validated(),
                            [
                                'user_id'       => Auth::id(),
                                'product_id'    => $product->id,
                                'total'         => $product->price * $request->qty
                            ]
                    ));
                if($purchase){
                    //TODO integrate stripe payments here
                    //update product stock count
                    $product->update([
                        'in_stock' => $product->in_stock - $request->qty
                    ]);
                    //send mail to store and product owner
                    $sendmail = ProductPurchased::dispatch($product);
                    if(!$sendmail){
                        return back()->with('error','Product bought successfully but failed to send email notification');
                    }
                    return redirect()->route('products.index')->with('success', 'Product bought successfully, kindly check your email for the order details');
                }else{
                    return back()->with('error','Failed to buy product, please try again later');
                }
                }
            }catch(\Exception $ex){
                Log::critical('Something went wrong purchasing the product. ERROR '.$ex->getMessage());
                return back()->with('error','Something went wrong purchasing the product, please try again later');
            }
        }
    }
    public function sendMail(Request $request, $id){
        $client = ProductPurchase::with('customer','product')->find($id);
        $data = [
            'message'   => $request->message,
            'customer'  => $client,
            'url'       => route('login')
        ];
        try{
            $sendmail = Mail::to($client->customer->email)->send( new ClientPromotionalEmail($data));
            if(!$sendmail){
                return back()->with('error','Failed to send promotional email, please try again later.');
            }else{
                return back()->with('success','Promotional Email sent successfully to client');
            }
        }catch(\Exception $ex){
            Log::critical('Failed to send promotional email. ERROR: '.$ex->getTraceAsString());
            return back()->with('error','Could not send email, please try again later');
        }
    }
    public function purchases(){
        //list all products
    }
}
