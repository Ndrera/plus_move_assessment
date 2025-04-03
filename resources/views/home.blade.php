@extends('layouts.app')


@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-3 display-none">

            <!-- NAV -->
            @if( $role == 1 )
                @include('inc.adminnav')
            @endif

            @if( $role == 2 )
                @include('inc.warehousenav')
            @endif

            @if( $role == 3 )
                @include('inc.drivernav')
            @endif

        </div>

        <div class="col-md-9">
            <div class="card" style="min-height: 100%">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif


                    <div class="row mt-3">
                        <div class="col-4">
                            <a href="#" class="link-underline-light">
                                <div class="card text-center">
                                    <div class="card-body">
                                        <img class="" src="{{ asset('images/cargo.png') }}" style="width: 150px !important; height: 80px !important;" alt="">
                                        <h2 class="text-center">{{ $delivered }}</h2>
                                        <h6>Total Packages Delivered</h6>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-4">
                            <a href="#" class="link-underline-light">
                                <div class="card text-center">
                                    <div class="card-body">
                                        <img class="" src="{{ asset('images/shipping.gif') }}" style="width: 150px !important; height: 80px !important;"  alt="">
                                        <h2 class="text-center">{{ $shipping }}</h2>
                                        <h6>Shipping Now</h6>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-4">
                            <a href="#" class="link-underline-light">
                                <div class="card text-center">
                                    <div class="card-body">
                                        <img class="" src="{{ asset('images/cargo.png') }}" style="width: 150px !important; height: 80px !important;" alt="">
                                        <h2 class="text-center">{{ $vehicles }}</h2>
                                        <h6>Total Vehicles</h6>
                                    </div>
                                </div>
                            </a>
                        </div>

                    </div>

                    <!--- #### --->
                    <div class="row mt-3">
                        <div class="col-md-6">
                            <h6 class="text-muted">Shipping Summary</h6>
                            <table class="table table-hover table-light">

                                <tr>
                                    <td>#</td>
                                    <td>Picked Packages</td>
                                    <td>{{ $picked }}</td>
                                </tr>
                                <tr>
                                    <td>#</td>
                                    <td>Received Packages</td>
                                    <td>{{ $received }}</td>
                                </tr>
                                <tr>
                                    <td>#</td>
                                    <td>Delayed Packages</td>
                                    <td>{{ $delayed }}</td>
                                </tr>
                                <tr>
                                    <td>#</td>
                                    <td>Returned Packages</td>
                                    <td>{{ $returned }}</td>
                                </tr>

                            </table>
                        </div>
                        <div class="col-md-6">
                            <h6 class="text-muted">Movements by Location</h6>
                            <table class="table table-hover table-dark">
                                @if ($locations->count() >0)
                                    @foreach ($locations as $location)
                                        <tr>
                                            <td>{{ $location->location_name }}</td>
                                            <td>
                                                @php
                                                    
                                                    
                                                    $movement = \DB::table( 'couriers' )
                                                    ->join( 'courier_actions', 'couriers.id', 'courier_actions.courier_id' )
                                                    ->join( 'statuses', 'courier_actions.status_id', 'statuses.id' )
                                                    ->where( 'courier_actions.status_id', '=', 3)
                                                    ->where( 'couriers.recipient_province', '=', $location->location_name)
                                                    ->select( 'couriers.id' )
                                                    ->count();

                                                     echo $movement;

                                                @endphp
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr><td colspan="2">No Items currently added</td></tr>
                                @endif
                            </table>
                        </div>
                    </div>



              
            </div>
        </div>
    </div>
</div>
@endsection
