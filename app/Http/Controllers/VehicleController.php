<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vehicle;
use Illuminate\Support\Facades\Auth;
use App\Models\Role;
use Illuminate\Support\Str;


class VehicleController extends Controller
{
    /**
     * Show vehicles
     * 
     */
    public function index(){
        $role = Auth::user()->role_id;
        $role_data  = Role::find( $role );
        $role_name = Str::lower( $role_data->role_name );

        $vehicles = Vehicle::where( 'deleted_at', '=', null )->paginate(5);
        return view('vehicles', compact('vehicles', 'role', 'role_name'));
    }


    /**
     * Save vehicle details
     * 
     */
    public function store( Request $request ){

        $this->validate($request, [
            'vehicle_name' => 'required',
            'vehicle_model' => 'required',
            'vehicle_registration' => 'required',
            'vin_no' => 'required',
            'vehicle_mileage' => 'required',
        ]);


        //Vehicle
        $vehicle_data = [
            'vehicle_name' => $request->vehicle_name,
            'vehicle_model' => $request->vehicle_model,
            'vehicle_registration' => $request->vehicle_registration,
            'vin_no' => $request->vin_no,
            'vehicle_mileage' =>  $request->vehicle_mileage
        ];

        $vehicle = Vehicle::create( $vehicle_data );

        return redirect()->back()->with('status', 'Vehicle added successful!');
    }


    /**
     * Delete vehicle details.
     * 
     */
    public function destroy( Request $request ){

        $id = $request->id;
        $vehicle = Vehicle::find( $id );

        $vehicle_data = [
            'deleted_at'  => now()
        ];

        $update =  $vehicle->update( $vehicle_data );

        return redirect()->back()->with('status', 'Vehicle has been deleted, Sucessfully!');
    }



}
