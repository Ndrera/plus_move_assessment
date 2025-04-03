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
                <div class="card-header">{{ __('Add Package Shipping') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form action="{{ route( $role_name.'.store' ) }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-12 mt-3">
                                <div class="form-group">
                                    <label for="package_name">Package Name</label>
                                    <input id="package_name" class="form-control @error('package_name') is-invalid @enderror" type="text" name="package_name" value="{{ old('package_name') }}">
                                    @error('package_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12 mt-3">
                                <div class="form-group">
                                    <label for="package_description">Package Description</label>
                                    <textarea name="package_description" id="" class="form-control @error('package_description') is-invalid @enderror">
                                        {{ old('package_description') }}
                                    </textarea>
                                    @error('package_description')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-12 mt-3">
                                <div class="form-group">
                                    <label for="branch_id">Branch</label>

                                    <select class="form-select" name="branch_id" id="branch_id" required>
                                    @php
                                        $branches = App\Models\Branch::all();
                                        foreach( $branches as $branch ){
                                            echo "<option value='{$branch->id}'>{$branch->branch_name}</option>";
                                        }
                                    @endphp
                                </select>

                                </div>
                            </div>

                            <div class="col-md-6 mt-3">
                                <div class="form-group">
                                    <label for="sender_name">Sender Name</label>
                                    <input id="sender_name" class="form-control @error('sender_name') is-invalid @enderror" type="text" name="sender_name" value="{{ old('sender_name') }}">
                                    @error('sender_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6 mt-3">
                                <div class="form-group">
                                    <label for="sender_contact">Sender Contact</label>
                                    <input id="sender_contact" class="form-control @error('sender_contact') is-invalid @enderror" type="text" name="sender_contact" value="{{ old('sender_contact') }}" placeholder="07xxxxxxxxx">
                                    @error('sender_contact')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6 mt-3">
                                <div class="form-group">
                                    <label for="sender_email">Sender Email</label>
                                    <input id="sender_email" class="form-control @error('sender_email') is-invalid @enderror" type="text" name="sender_email" value="{{ old('sender_email') }}">
                                    @error('sender_email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="col-md-6 mt-3">
                                <div class="form-group">
                                    <label for="sender_address">Sender Address</label>
                                    <input id="sender_address" class="form-control @error('sender_address') is-invalid @enderror" type="text" name="sender_address" value="{{ old('sender_address') }}">
                                    @error('sender_address')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6 mt-3">
                                <div class="form-group">
                                    <label for="sender_city">Sender City</label>
                                    <input id="sender_city" class="form-control @error('sender_city') is-invalid @enderror" type="text" name="sender_city" value="{{ old('sender_city') }}" >
                                    @error('sender_city')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>



                            <div class="col-md-6 mt-3">
                                <div class="form-group">
                                    <label for="sender_province">Sender Province</label>
                                    <select class="form-select" name="sender_province" id="sender_province" required>
                                        @php
                                            $locations = App\Models\Location::all();
                                            foreach( $locations as $location ){
                                                echo "<option value='{$location->location_name}'>{$location->location_name}</option>";
                                            }
                                        @endphp
                                    </select>

                                    
                                </div>
                            </div>

                            <div class="col-md-12 mt-3">
                                <div class="form-group">
                                    <label for="sender_country">Sender Country</label>
                                    <input id="sender_country" class="form-control @error('sender_country') is-invalid @enderror" type="text" name="sender_country" value="{{ old('sender_country') }}" >
                                    @error('sender_country')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                             <div class="col-md-6 mt-3">
                                <div class="form-group">
                                    <label for="recipient_name">Recipient Name</label>
                                    <input id="recipient_name" class="form-control @error('recipient_name') is-invalid @enderror" type="text" name="recipient_name" value="{{ old('recipient_name') }}">
                                    @error('recipient_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6 mt-3">
                                <div class="form-group">
                                    <label for="recipient_contact">Recipient Contact</label>
                                    <input id="recipient_contact" class="form-control @error('recipient_contact') is-invalid @enderror" type="text" name="recipient_contact" value="{{ old('recipient_contact') }}" placeholder="07xxxxxxxxx">
                                    @error('recipient_contact')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="col-md-6 mt-3">
                                <div class="form-group">
                                    <label for="recipient_email">Recipient Email</label>
                                    <input id="recipient_email" class="form-control @error('recipient_email') is-invalid @enderror" type="text" name="recipient_email" value="{{ old('recipient_email') }}" >
                                    @error('recipient_email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="col-md-6 mt-3">
                                <div class="form-group">
                                    <label for="recipient_address">Recipient Address</label>
                                    <input id="recipient_address" class="form-control @error('recipient_address') is-invalid @enderror" type="text" name="recipient_address" value="{{ old('recipient_address') }}">
                                    @error('recipient_address')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 mt-3">
                                <div class="form-group">
                                    <label for="recipient_city">Recipient City</label>
                                    <input id="recipient_city" class="form-control @error('recipient_city') is-invalid @enderror" type="text" name="recipient_city" value="{{ old('recipient_city') }}" >
                                    @error('recipient_city')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>



                            <div class="col-md-6 mt-3">
                                <div class="form-group">
                                    <label for="recipient_province">Recipient Province</label>
                                    <select class="form-select" name="recipient_province" id="recipient_province" required>
                                        @php
                                            $locations = App\Models\Location::all();
                                            foreach( $locations as $location ){
                                                echo "<option value='{$location->location_name}'>{$location->location_name}</option>";
                                            }
                                        @endphp
                                    </select>

                                    
                                </div>
                            </div>

                            <div class="col-md-12 mt-3">
                                <div class="form-group">
                                    <label for="recipient_country">Recipient Country</label>
                                    <input id="recipient_country" class="form-control @error('recipient_country') is-invalid @enderror" type="text" name="recipient_country" value="{{ old('recipient_country') }}" >
                                    @error('recipient_country')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                             <div class="col-md-3 mt-3">
                                <div class="form-group">
                                    <label for="weight">weight</label>
                                    <input id="weight" class="form-control @error('weight') is-invalid @enderror" type="text" name="weight" value="{{ old('weight') }}" >
                                    @error('weight')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-3 mt-3">
                                <div class="form-group">
                                    <label for="length">Length</label>
                                    <input id="length" class="form-control @error('length') is-invalid @enderror" type="text" name="length" value="{{ old('length') }}" >
                                    @error('length')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-3 mt-3">
                                <div class="form-group">
                                    <label for="width">Width</label>
                                    <input id="width" class="form-control @error('width') is-invalid @enderror" type="text" name="width" value="{{ old('width') }}" >
                                    @error('width')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-3 mt-3">
                                <div class="form-group">
                                    <label for="height">Height</label>
                                    <input id="height" class="form-control @error('height') is-invalid @enderror" type="text" name="height" value="{{ old('height') }}" >
                                    @error('height')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-12 mt-3">
                                <div class="form-group">
                                    <label for="remarks">Remarks</label>
                                    <textarea name="remarks" id="" class="form-control @error('remarks') is-invalid @enderror">
                                        {{ old('remarks') }}
                                    </textarea>
                                    @error('remarks')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                        </div>
                        <div class="d-grid gap-2 col-6 mx-auto mt-3">
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <button type="reset" class="btn btn-secondary">Reset</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
