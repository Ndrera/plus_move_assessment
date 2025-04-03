@extends('layouts.app')


@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4 display-none">

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

        <div class="col-md-8">
            <div class="card" style="min-height: 100%">
                <div class="card-header">{{ __('Buses') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <br>
                    <div class="row">
                        <div class="col-md-5">
                            <h4>Add New Vehicle</h4>
                            <form class="" method="post" action="{{ route( $role_name.'.vehicle-add') }}">
                                @csrf
                                <div class="col-md-12 mt-3">
                                    <div class="form-group">
                                        <label for="my-input">Vehicle Name</label>
                                        <input id="my-input" value="{{ old('vehicle_name') }}" class="form-control @error('vehicle_name') is-invalid @enderror" type="text" name="vehicle_name">
                                        @error('vehicle_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-12 mt-3">
                                    <div class="form-group">
                                        <label for="vehicle_model">Vehicle Model</label>
                                        <input id="vehicle_model" class="form-control @error('vehicle_model') is-invalid @enderror" type="text" name="vehicle_model" value="{{ old('vehicle_model') }}">
                                        @error('vehicle_model')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-12 mt-3">
                                    <div class="form-group">
                                        <label for="vehicle_registration">Vehicle Registration</label>
                                        <input id="vehicle_registration" class="form-control @error('vehicle_registration') is-invalid @enderror" type="text" name="vehicle_registration" value="{{ old('vehicle_registration') }}">
                                        @error('vehicle_registration')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-12 mt-3">
                                    <div class="form-group">
                                        <label for="vin_no">VIN No</label>
                                        <input id="vin_no" class="form-control @error('vin_no') is-invalid @enderror" type="text" name="vin_no" value="{{ old('vin_no') }}">
                                        @error('vin_no')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-12 mt-3">
                                    <div class="form-group">
                                        <label for="vehicle_mileage">Vehicle Mleage</label>
                                        <input id="vehicle_mileage" class="form-control @error('vehicle_mileage') is-invalid @enderror" type="text" name="vehicle_mileage" value="{{ old('vehicle_mileage') }}">
                                        @error('vehicle_mileage')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-12 mt-3">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>

                        </div>
                        <div class="col-md-7">
                            <h4>All Available Vehicles</h4>
                            <table class="table table-striped table-bordered table-inverse table-responsive-sm">
                                <thead class="thead-inverse">
                                    <tr>
                                        <th>#</th>
                                        <th>Vehicle Name</th>
                                        <th>Vehicle Reg</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @if ($vehicles->count() > 0)
                                        @foreach ($vehicles as $key => $vehicle)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $vehicle->vehicle_name }}</td>
                                            <td>{{ $vehicle->vehicle_registration }}</td>
                                            <td>
                                                <a onclick="confirm('Are you sure you want to delete')" href="{{ route( $role_name.'.vehicle-delete', $vehicle->id) }}"  class="btn btn-outline-light">
                                                    <i class="fa fa-trash text-danger"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        @endforeach
                                        @else
                                            <tr><td colspan="3" class="text-center">No vehicle added yet</td></tr>
                                        @endif
                                    </tbody>
                            </table>

                                {!! $vehicles->links() !!}

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
