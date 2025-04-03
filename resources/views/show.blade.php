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
                <div class="card-header">
                    Viewing {{ $shipping->package_name }}
                    <a href="javascript: history.go(-1)"><span class="float-right fa fa-backward"> Back</span></a>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                        <table class="table table-light table-responsive">
                            <tbody>
                                <tr>
                                    <td>Tracking No</td>
                                    <td>{{ $shipping->tracking_no }}</td>
                                </tr>
                                <tr>
                                    <td>Package Name</td>
                                    <td>{{ $shipping->package_name }}</td>
                                </tr>
                                <tr>
                                    <td>Package Description</td>
                                    <td>{{ $shipping->package_description }}</td>
                                </tr>
                                <tr>
                                    <td>Branch Name</td>
                                    <td>{{ $shipping->branch_name }}</td>
                                </tr>
                                <tr>
                                    <td>Sender Name </td>
                                    <td>{{ $shipping->sender_name }}</td>
                                </tr>
                                <tr>
                                    <td>Sender Contact </td>
                                    <td>{{ $shipping->sender_contact }}</td>
                                </tr>
                                <tr>
                                    <td>Sender Email </td>
                                    <td>{{ $shipping->sender_email }}</td>
                                </tr>
                                <tr>
                                    <td>Sender Address </td>
                                    <td>{{ $shipping->sender_address }}</td>
                                </tr>
                                <tr>
                                    <td>Sender City </td>
                                    <td>{{ $shipping->sender_city }}</td>
                                </tr>
                                <tr>
                                    <td>Sender Province </td>
                                    <td>{{ $shipping->sender_province }}</td>
                                </tr>
                                <tr>
                                    <td>Sender Country </td>
                                    <td>{{ $shipping->sender_country }}</td>
                                </tr>

                                <tr>
                                    <td>Recipient Name </td>
                                    <td>{{ $shipping->recipient_name }}</td>
                                </tr>
                                <tr>
                                    <td>Recipient Contact </td>
                                    <td>{{ $shipping->recipient_contact }}</td>
                                </tr>
                                <tr>
                                    <td>Recipient Email </td>
                                    <td>{{ $shipping->recipient_email }}</td>
                                </tr>
                                <tr>
                                    <td>Recipient Address </td>
                                    <td>{{ $shipping->recipient_address }}</td>
                                </tr>
                                <tr>
                                    <td>Recipient City </td>
                                    <td>{{ $shipping->recipient_city }}</td>
                                </tr>
                                <tr>
                                    <td>Recipient Province </td>
                                    <td>{{ $shipping->recipient_province }}</td>
                                </tr>
                                <tr>
                                    <td>Recipient Country </td>
                                    <td>{{ $shipping->recipient_country }}</td>
                                </tr>

                                <tr>
                                    <td>Weight</td>
                                    <td>{{ $shipping->weight }}</td>
                                </tr>
                                <tr>
                                    <td>Length</td>
                                    <td>{{ $shipping->length }}</td>
                                </tr>
                                <tr>
                                    <td>Width</td>
                                    <td>{{ $shipping->width }}</td>
                                </tr>
                                <tr>
                                    <td>Height</td>
                                    <td>{{ $shipping->height }}</td>
                                </tr>

                                <tr>
                                    <td>Price</td>
                                    <td>R{{ $shipping->price }}</td>
                                </tr>
                                <tr>
                                    <td>Remarks</td>
                                    <td>{{ $shipping->remarks }}</td>
                                </tr>

                            </tbody>
                        </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
