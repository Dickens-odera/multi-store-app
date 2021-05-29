<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\VehicleType;
use Illuminate\Http\Request;
use App\Models\Driver;
use App\Http\Requests\DriverRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\DriverUpdateRequest;
class DriverController extends Controller
{
    public function index()
    {
        $products = auth()->user()->products;
        $drivers = Driver::with('vehicle','user')->latest()->paginate(5);
        return view('admin.drivers.index', compact('drivers','products'));
    }

    public function create()
    {
        $vehicle_types = VehicleType::orderBy('name')->get();
        return view('admin.drivers.create', compact('vehicle_types'));
    }

    public function store(DriverRequest $request)
    {
        $validator = Validator::make($request->all(), $request->rules());
        if($validator->fails()){
            return back()->with('error',$validator->errors()->first());
        }else{
            try{
                if(Driver::create(array_merge($request->validated(),['added_by' => Auth::id()]))){
                    return redirect()->route('drivers.index')->with('success','Driver created successfully');
                }else{
                    return back()->with('error','Failed to add driver, please try again');
                }
            }catch (\Exception $exception){
                Log::critical('Something went wrong adding a new driver. ERROR: '.$exception->getTraceAsString());
                return back()->with('error','Something went wrong adding a new driver, please try again later');
            }
        }
    }

    public function show($id)
    {
        $driver = Driver::with('vehicle','user')->find($id);
        return view('admin.drivers.show', compact('driver'));
    }

    public function edit($id)
    {
        $driver = Driver::with('vehicle','user')->find($id);
        $vehicle_types = VehicleType::orderBy('name')->get();
        return view('admin.drivers.edit', compact('driver','vehicle_types'));
    }

    public function update(DriverUpdateRequest $request, $id)
    {
        $driver = Driver::with('vehicle','user')->find($id);
        $validator = Validator::make($request->all(), $request->rules());
        if($validator->fails()){
            return back()->with('error',$validator->errors()->first());
        }else{
            try{
                if($driver->update($request->validated())){
                    return back()->with('success','Driver updated successfully');
                }else{
                    return back()->with('error','Failed to update driver details, please try again');
                }
            }catch (\Exception $exception){
                Log::critical('Something went wrong updating driver details. ERROR: '.$exception->getTraceAsString());
                return back()->with('error','Something went wrong updating driver details, please try again later');
            }
        }
    }

    public function destroy($id)
    {
        $driver = Driver::with('vehicle','user')->find($id);
        try{
            if($driver->delete()){
                return redirect()->route('drivers.index')->with('success','Driver details deleted successfully');
            }else{
                return back()->with('error','Failed to delete driver details, please try again');
            }
        }catch (\Exception $exception){
            Log::critical('Something went wrong deleting driver details. ERROR: '.$exception->getTraceAsString());
            return back()->with('error','Failed to delete driver details, please try again later');
        }
    }
}
