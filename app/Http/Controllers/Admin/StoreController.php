<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRequest;
use App\Models\Store;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    public function index()
    {
        $stores = Store::latest()->paginate(10);
        $users = User::orderBy('name','ASC')->get();
        return view('admin.stores.index', compact('stores', 'users'));
    }

    public function create()
    {
        //get a list of users to assign them store ownership
        $users = User::orderBy('name','ASC')->get();
        return view('admin.stores.create', compact('users'));
    }

    public function store(StoreRequest $request)
    {
        $validator = Validator::make($request->all(), $request->rules());
        if($validator->fails()){
            return back()->with('error',$validator->errors()->first());
        }else{
            try{
                if(Store::create($request->validated())){
                    return back()->with('success','Store created successfully');
                }else{
                    return back()->with('error','Failed to create new store, please try again');
                }
            }catch (\Exception $exception){
                Log::critical('Something went wrong creating a new store. ERROR: '.$exception->getTraceAsString());
                return back()->with('error','Something went wrong creating a new store, please try again later');
            }
        }
    }

    public function show($id)
    {
        $store = Store::with('user')->find($id);
        return view('admin.stores.details', compact('store'));
    }

    public function edit($id)
    {
        $store = Store::with('user')->find($id);
        $users = User::orderBy('name','ASC')->get();
        return view('admin.stores.edit', compact('store','users'));
    }

    public function update(StoreRequest $request, $id)
    {
        $store = Store::with('user')->find($id);
        $validator = Validator::make($request->all(), $request->rules());
        if($validator->fails()){
            return back()->with('error',$validator->errors()->first());
        }else{
           try{
               $storeUpdate = $store->update($request->validated());
               if($storeUpdate){
                   return back()->with('success','Store updated successfully');
               }else{
                   return back()->with('error','Failed to update store, please try again');
               }
           }catch (\Exception $exception){
               Log::critical('Something went wrong updating store ID '.$store->id.' '. 'REASON: '.$exception->getMessage());
               return back()->with('error','Something went wrong updating store, please try again later');
           }
        }
    }

    public function destroy($id)
    {
        $store = Store::with('user')->find($id);
        try{
            if($store->delete()){
                return back()->with('success','Store deleted successfully');
            }else{
                return back()->with('error','Failed to delete store, please try again');
            }
        }catch (\Exception $exception){
            Log::critical('Something went wrong deleting store number '.$store->id.' '.'REASON: '.$exception->getMessage());
            return back()->with('error','Something went wrong deleting store, please try again later');
        }
    }

    public function activate($id){
        $store = Store::with('user')->find($id);
        try{
            $activateStore = $store->update([
                'status' => Store::STATUS_ACTIVE
            ]);
            if($activateStore){
                return back()->with('success','Store activated successfully');
            }else{
                return back()->with('error','Failed to activate store, please try again');
            }
        }catch(\Exception $exception){
            Log::critical('Something went wrong activating store number '.$store->id.' '.'REASON: '.$exception->getMessage());
            return back()->with('error','Something went wrong activating store, please try again later');
        }
    }

    public function deactivate($id){
        $store = Store::with('user')->find($id);
        try{
            $deactivateStore = $store->update([
                'status' => Store::STATUS_DEACTIVATED
            ]);
            if($deactivateStore){
                return back()->with('success','Store deactivated successfully');
            }else{
                return back()->with('error','Failed to deactivate store, please try again');
            }
        }catch (\Exception $exception){
            Log::critical('Something went wrong deactivating store number '.$store->id.' '.'REASON: '.$exception->getMessage());
            return back()->with('error','Something went wrong deactivating store, please try again later');
        }
    }
}
