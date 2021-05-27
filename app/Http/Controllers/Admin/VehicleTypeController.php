<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\VehicleType;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class VehicleTypeController extends Controller
{
    public function index()
    {
        $vehicle_types = VehicleType::latest()->get();
        return view('admin.vehicle_types.index', compact('vehicle_types'));
    }

    public function create()
    {
        return view('admin.vehicle_types.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'type' => 'required|unique:vehicle_types,name|string|min:3|max:55'
        ]);
        if($validator->fails()){
            return back()->with('error',$validator->errors()->first());
        }
        try{
            $newVehicleType = VehicleType::create([
                'name' => $request->type
            ]);
            if($newVehicleType){
                return redirect()->route('vehicle_types.index')->with('success','Vehicle type created successfully');
            }else{
                return back()->with('error','Failed to create vehicle type, please try again');
            }
        }catch(\Exception $exception){
            Log::critical('Something went wrong creating a new vehicle type.ERROR: '.$exception->getTraceAsString());
            return back()->with('error','Something went wrong creating a new vehicle type, please try again');
        }
    }

    public function show($id)
    {
        $vehicle_type = VehicleType::find($id);
        return view('admin.vehicle_types.show', compact('vehicle_type'));
    }

    public function edit($id)
    {
        $vehicle_type = VehicleType::find($id);
        return view('admin.vehicle_types.edit', compact('vehicle_type'));
    }

    public function update(Request $request, $id)
    {
        $vehicle_type = VehicleType::find($id);
        $validator = Validator::make($request->all(), [
            'type' => 'required|string'
        ]);
        if($validator->fails()){
            return back()->with('error',$validator->errors()->first());
        }else{
            try{
                if($vehicle_type->update(['name' => $request->type])){
                    return back()->with('success','Vehicle type updated successfully');
                }else{
                    return back()->with('error','Failed to update vehicle type, please try again later');
                }
            }catch (\Exception $exception){
                Log::critical('Something went wrong updating vehicle type with ID of '.$vehicle_type->id.' ERROR: '.$exception->getMessage());
                return back()->with('error','Something went wrong updating vehicle type, please try again later');
            }
        }
    }

    public function destroy($id)
    {
        $vehicle_type = VehicleType::find($id);
        try{
            if($vehicle_type->delete()){
                return back()->with('success','Vehicle type deleted successfully');
            }else{
                return back()->with('error','Failed to delete vehicle type, please try again');
            }
        }catch(\Exception $ex){
            Log::critical('Something went wrong deleting vehicle type '.$vehicle_type->id.' ERROR: '.$ex->getMessage());
            return back()->with('error','Something went wrong deleting vehicle type,please try again later');
        }
    }
}
