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

                    <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Filter table values..">
                    <table id="myTable" class="table table-striped table-inverse table-responsive-sm">
                        <thead class="thead-inverse">
                            <tr>
                                <th>#</th>
                                <th>Tracking No</th>
                                <th>Package Name</th>
                                <th>Sender</th>
                                <th>Recipient</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($shippings as $key => $shipping)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $shipping->tracking_no }}</td>
                                    <td>{{ $shipping->package_name }}</td>
                                    <td>{{ $shipping->sender_name }}</td>
                                    <td>{{ $shipping->recipient_name }}</td>
                                    <td>
                                        
                                        <span class="badge badge-pill bg-{{$color}}">{{ Str::ucfirst($shipping->status_name) }}</span>
                                    </td>
                                    <td>
                                        <a href="{{ route( $role_name.'.show', $shipping->id) }}"  class="btn btn-outline-light">
                                            <i class="fa fa-eye text-secondary"></i>
                                        </a>
                                        <button type="button" class="btn btn-outline-light" data-bs-toggle="modal" data-bs-target="#modal{{ $shipping->id }}">
                                            <i class="fa fa-pencil text-secondary"></i>
                                        </button>
                                        <button type="button"  class="btn btn-outline-light"  data-bs-toggle="modal" data-bs-target="#modalDelete{{ $shipping->id }}">
                                            <i class="fa fa-trash text-danger"></i>
                                        </button>

                                       <!-- Button trigger modal -->
                                        <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                            -
                                        </button>


                                        {{--  Edit status modal  --}}
                                        <!-- Modal -->
                                        <div class="modal fade" id="modal{{ $shipping->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Change Status</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>


                                                <form action="{{ route( $role_name.'.edit') }}" method="post">
                                                    @csrf
                                                <div class="modal-body">
                                                            <input type="hidden" name="id" value="{{ $shipping->id }}">
                                                            <input type="hidden" name="tracking_no" value="{{ $shipping->tracking_no }}">
                                                            <input type="hidden" name="sender_email" value="{{ $shipping->sender_email }}">
                                                            <input type="hidden" name="recipient_email" value="{{ $shipping->recipient_email }}">

                                                            <div class="form-group">
                                                                <label for="status_id">Status</label>
                                                                <select class="form-select" name="status_id" id="status_id">
                                                                    @php

                                                                        if( $shipping->status_id == 7 ){
                                                                            
                                                                            echo "<option  selected value='7'>Corporate</option>
                                                                                  <option   value='1'>Picked</option>";
                                                                            
                                                                        }else{

                                                                            $statuses = App\Models\Status::all();
                                                                            foreach( $statuses as $status ){

                                                                                if( $status->id >= $shipping->status_id ){
                                                                                    $selected = (  $shipping->status_name  == $status->status_name ) ? "selected" : "";
                                                                                    echo "<option  {$selected} value='{$status->id}'>{$status->status_name}</option>";
                                                                                }

                                                                            }
                                                                            
                                                                        }
                                                                    @endphp

                                                            </select>
                                                            </div>
                                                            
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Submit</button>
                                                </div>
                                                </form>


                                                </div>
                                            </div>
                                        </div>

                                        {{--  Delete modal and form  --}}
                                        <div class="modal fade" id="modalDelete{{ $shipping->id }}"tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Delete Shipment</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>

                                                <form action="{{ route( $role_name.'.delete') }}" method="post">
                                                    @csrf
                                                    <div class="modal-body">
                                                            <p>Are you sure you want to delete this shipment?</p>
                                                            <input type="hidden" name="id" value="{{ $shipping->id }}">

                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-danger">Yes</button>
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                                                    </div>
                                                </form>


                                                </div>
                                            </div>
                                        </div>



                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                    </table>

                        {{ $shippings->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
