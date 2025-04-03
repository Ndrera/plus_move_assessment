<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vehicle;
use App\Models\Location;
use App\Models\Branch;
use App\Models\Status;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $role      = Auth::user()->role_id;
        $vehicles  = Vehicle::get()->count();
        $delivered = $this->countCourier(6);
        $shipping  = $this->countCourier(3);
        $received  = $this->countCourier(2);
        $picked    = $this->countCourier(1);
        $delayed   = $this->countCourier(4);
        $returned  = $this->countCourier(5);
        $locations = Location::all();

        return view('home', compact('vehicles', 'delivered', 'shipping', 'received', 'picked', 'delayed', 'returned', 'locations', 'role') );
    }


    /**
     * Count the packages based on the their status.
     * 
     */
    public function countCourier( $id ){
        $count = \DB::table( 'couriers' )
        ->join( 'courier_actions', 'couriers.id', 'courier_actions.courier_id' )
        ->join( 'statuses', 'courier_actions.status_id', 'statuses.id' )
        ->where( 'couriers.deleted_at', '=', null )
        ->where( 'courier_actions.status_id', '=', $id )
        ->select( 'couriers.id' )
        ->count();

        return $count;
    }


}
