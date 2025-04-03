<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Package;
use App\Models\Courier;
use App\Models\CourierAction;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use App\Models\Status;
use App\Models\LoadManagement;
use App\Models\Rate;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CourierController extends Controller
{
    /**
     * Show a form to create courier shipment.
     * 
     */
    public function index(){
        $role = Auth::user()->role_id;
        $role_data  = Role::find( $role );
        $role_name = Str::lower( $role_data->role_name );

        return view('courier', compact('role', 'role_name'));
    }


    /**
     * Save or create courier shipment.
     *
     * The driver loads this information when they are picking up the package. 
     */
    public function store( Request $request ){

        $this->validate($request, [
            'package_name' => 'required',
            'package_description' => 'required',
            'branch_id' => 'required',
            'sender_name' => 'required',
            'sender_contact' => 'required',
            'sender_email' => 'required',
            'sender_address' => 'required',
            'sender_city' => 'required',
            'sender_province' => 'required',
            'sender_country' => 'required',
            'recipient_name' => 'required',
            'recipient_contact' => 'required',
            'recipient_email' => 'required',
            'recipient_address' => 'required',
            'recipient_city' => 'required',
            'recipient_province' => 'required',
            'recipient_country' => 'required',
            'weight' => 'required',
            'length' => 'required',
            'width' => 'required',
            'height' => 'required',
            'remarks' => 'required',
        ]);



        //Package
        $package_data = [
            'package_name' => $request->package_name,
            'package_description' =>  $request->package_description
        ];

        $package = Package::create( $package_data );

        if( $package ){

            //Rate
            $rate = Rate::first();

            //Courier
            $courier_data = [
                'branch_id' => $request->branch_id,
                'package_id' => $package->id,
                'tracking_no' => 'TCK-'.random_int(1000000, 9999999),
                'sender_name' => $request->sender_name,
                'sender_contact' => $request->sender_contact,
                'sender_email' => $request->sender_email,
                'sender_address' => $request->sender_address,
                'sender_city' => $request->sender_city,
                'sender_province' => $request->sender_province,
                'sender_pin' => 'SND-'.random_int(1000, 9999),
                'sender_country' => $request->sender_country,
                'recipient_name' => $request->recipient_name,
                'recipient_contact' => $request->recipient_contact,
                'recipient_email' => $request->recipient_email,
                'recipient_address' => $request->recipient_address,
                'recipient_city' => $request->recipient_city,
                'recipient_province' => $request->recipient_province,
                'recipient_pin' => 'RCV-'.random_int(1000, 9999),
                'recipient_country' => $request->recipient_country,
                'courier_desc' => 'Moving with speed, integrity, and competance.',
                'weight' => $request->weight,
                'length' => $request->length,
                'width' => $request->width,
                'height' => $request->height,
                'price' => ( $request->weight * $rate->per_kg_rate ),
                'created_by' => auth()->user()->id,
                'updated_by' => auth()->user()->id
            ];

            $courier = Courier::create( $courier_data );


            //CourierAction
            if( $courier ){

                $courier_action_data = [
                    'courier_id' => $courier->id,
                    'action_date' => now(),
                    'remarks' => $request->remarks,
                    'status_id' => 1,
                    'updated_by' => auth()->user()->id,
                    'price' =>  $request->price
        
                ];

                $courier_action = CourierAction::create( $courier_action_data );


                //LoadManagement
                $load_data = [
                    'user_id' => auth()->user()->id,
                    'courier_id' => 0,
                    'status_id' =>  1
                ];

                $save_load = LoadManagement::create( $load_data );


                //send email notification
                $tracking_no     = $courier->tracking_no;
                $sender_email    = $courier->sender_email;
                $recipient_email = $courier->recipient_email;
                $subject    = view('mail.subject', [ 'tracking_no' => $tracking_no ])->render();
                $email_body = view('mail.message', [ 'tracking_no' => $tracking_no ])->render();

                $mail = $this->sendSMTPEmail( $sender_email, $subject , $email_body );

                return redirect('/courier')->with('status', 'Package has been picked up, and its ready for shipping!');
            }
        }
    }


    /**
     * Get all the courier shipment details.
     * 
     */
    public function shippings(){
        $role = Auth::user()->role_id;
        $role_data  = Role::find( $role );
        $role_name = Str::lower( $role_data->role_name );

        $shippings = \DB::table( 'couriers' )
        ->join( 'packages', 'packages.id', 'couriers.package_id' )
        ->join( 'courier_actions', 'couriers.id', 'courier_actions.courier_id' )
        ->join( 'statuses', 'courier_actions.status_id', 'statuses.id' )
        ->where( 'couriers.deleted_at', '=', null )
        ->select( 'couriers.id', 'couriers.tracking_no', 'packages.package_name', 'couriers.sender_name', 'couriers.sender_email', 'couriers.recipient_name', 'couriers.recipient_email', 'courier_actions.status_id', 'statuses.status_name'    )
        ->orderBy( 'id', 'desc' )
        ->simplePaginate(6);

        return view('shippings', compact('shippings', 'role', 'role_name'));
    }



    /**
     * Get courier shipment details, by referencing a status.
     * 
     */
    public function getShippingByStatus( $id ){
        $role = Auth::user()->role_id;
        $role_data  = Role::find( $role );
        $role_name = Str::lower( $role_data->role_name );

        //pick status color
        $color = $this->colorPicker( $id );

        
        $shippings = \DB::table( 'couriers' )
        ->join( 'packages', 'packages.id', 'couriers.package_id' )
        ->join( 'courier_actions', 'couriers.id', 'courier_actions.courier_id' )
        ->join( 'statuses', 'courier_actions.status_id', 'statuses.id' )
        ->where( 'couriers.deleted_at', '=', null )
        ->where( 'courier_actions.status_id', '=', $id )
        ->select( 'couriers.id', 'couriers.tracking_no', 'packages.package_name', 'couriers.sender_name', 'couriers.sender_email', 'couriers.recipient_name', 'couriers.recipient_email', 'courier_actions.status_id', 'statuses.status_name'    )
        ->orderBy( 'id', 'desc' )
        ->simplePaginate(6);

        return view('shippingstatus', compact('shippings', 'color', 'role', 'role_name'));
    }
 


    /**
     * Show or display a single courier shipment details.
     * 
     */
    public function show($id){
        $role = Auth::user()->role_id;

        $shipping = \DB::table( 'couriers' )
        ->join( 'packages', 'packages.id', 'couriers.package_id' )
        ->join( 'courier_actions', 'couriers.id', 'courier_actions.courier_id' )
        ->join( 'statuses', 'courier_actions.status_id', 'statuses.id' )
        ->join( 'branches', 'branches.id', 'couriers.branch_id' )
        ->where( 'couriers.id', '=', $id )
        ->select( 'couriers.id', 'couriers.tracking_no', 'packages.package_name', 'packages.package_description', 'branches.branch_name', 
        'couriers.sender_name', 'couriers.sender_contact', 'couriers.sender_email', 'couriers.sender_address', 'couriers.sender_city', 'couriers.sender_province', 
        'couriers.sender_country', 'couriers.recipient_name', 'couriers.recipient_contact', 'couriers.recipient_email', 'couriers.recipient_address', 
        'couriers.recipient_city', 'couriers.recipient_province', 'couriers.recipient_country', 'couriers.weight', 'couriers.length', 
        'couriers.width', 'couriers.height', 'couriers.price', 'courier_actions.remarks', 'statuses.status_name'    )
        ->first();

        return view('show', compact('shipping', 'role'));
    }



    /**
     * Update changes in the courier shipment data.
     * 
     * Tracking movements and sending email notification.
     * 
     */
    public function update( Request $request ){

        $courier_id      = $request->id;
        $tracking_no     = $request->tracking_no;
        $status_id       = $request->status_id;
        $sender_email    = $request->sender_email;
        $recipient_email = $request->recipient_email;
        $user_id         = auth()->user()->id;

        //assign corporate shipments to a driver
        if($status_id == 1 ){  // Picked
            $this->corporateLoadManagement( $courier_id, $user_id  );
        }


        //assign hipments to a driver.
        if( $status_id == 3 ){      //Shipping   
            $this->loadManagement( $courier_id );
        }


        //
        $courier_action = CourierAction::where([ 'courier_id' => $courier_id ]);
        $status_id_data = [
            'status_id' =>  $status_id ,
            'updated_by' => auth()->user()->id
        ];
        $update = $courier_action->update( $status_id_data );


        if( $update ){
            //status
            $status  = Status::find( $status_id );

            //send email notification
            $subject = view('mail.subject', [ 'tracking_no' => $tracking_no ])->render();
            $body    = view('mail.statusmessage', [ 'status' => $status->status_name, 'tracking_no' => $tracking_no ])->render();
            
            $mail    = $this->sendSMTPEmail( $sender_email, $subject , $body );
        }

        return redirect()->back()->with('status', 'Package status has been changed successfull!');
    }




    /**
     * Assign a courier shipment package, to a driver.
     * 
     */
    public function loadManagement( $courier_id ){

       $loads =  \DB::table( 'load_management' )
       ->select('user_id', \DB::raw('count(*) as total'))
       ->where( 'load_management.status_id', '=', 1 )
       ->where( 'load_management.courier_id', '=', 0 )
       ->groupBy('user_id')
       ->orderBy( 'total', 'desc' )
       ->first();

       if($loads){

            //LoadManagement
            $save_update = LoadManagement::updateOrCreate(
                [ 'user_id' =>  $loads->user_id, 'courier_id' => 0 ],
                [
                    'courier_id' => $courier_id ,
                    'status_id' => 3
                ]
            );
       }  
    }



    /**
     * Assign corporate courier shipments to a driver.
     * 
     * These courier shipments are created via an API
     * 
     */
    public function corporateLoadManagement( $courier_id, $user_id ){

        $loads =  \DB::table( 'load_management' )
        ->select('user_id', \DB::raw('count(*) as total'))
        ->where( 'load_management.status_id', '=', 7 )
        ->where( 'load_management.courier_id', '=', 0 )
        ->groupBy('user_id')
        ->orderBy( 'total', 'desc' )
        ->first();
 
        if($loads){
 
             //LoadManagement
             $save_update = LoadManagement::updateOrCreate(
                 [ 'status_id' => 7 , 'courier_id' => 0 ],
                 [
                     'user_id' =>  $user_id,
                     'courier_id' => 0,
                     'status_id' => 1
                 ]
             );
 
        }
        
     }



    /**
     * Delete courier shipment.
     * 
     */
    public function destroy( Request $request ){

        $id      = $request->id;
        $courier = Courier::find( $id );

        $courier_data = [
            'deleted_at'  => now(),
            'updated_by' => auth()->user()->id
        ];
        $update =  $courier->update( $courier_data );

        return redirect()->back()->with('status', 'Package shipment has been deleted, Sucessfully!');
    }



    /**
     * Pick color
     */
    public function colorPicker( $id ){

        switch( $id ){
            case 1:
                $color = "primary";
                break;
            case 2:
                $color = "success";
                break;
            case 3:
                $color = "warning";
                break;
            case 4:
                $color = "danger";
                break;
            case 5:
                $color = "secondary";
                break;
            case 6:
                $color = "info";
                break;
            case 7:
                $color = "dark";
                break;
            default:
                $color = "primary";
        }

        return $color;
    }


    /*
    * Returned Packages
    *
    * Set package status to "Returned"
    * We run this functionality in a scheduled cron job, that runs daily at 5pm.
    * 
    */
    public function return(){
        $courier_action = CourierAction::where( 'status_id', '!=', 6 )->update(['status_id' =>  5]);
        return $courier_action;
    }


    /**
     * Please use you own credentials
     * 
     * [NOTE:] I opted to use PHPMailer instead of Mailtrap. So you guy can recieve actual mails, 
     * 
     * Send Emails
     * 
     */
	public function sendSMTPEmail(  $to, $subject, $email_body  ){

		$mail 				= new PHPMailer();
        $mail->isSMTP();
        $mail->Host 		= env('MAIL_HOST');
        $mail->SMTPAuth 	= true;
		$mail->SMTPSecure 	= env('MAIL_ENCRYPTION'); 
        $mail->Username	 	= env('MAIL_USERNAME');
        $mail->Password 	= env('MAIL_PASSWORD');
		$mail->Port 		= env('MAIL_PORT');

        $mail->setFrom( env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
        $mail->addReplyTo( env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
        $mail->addAddress($to, '');

        $mail->Subject 		= $subject;
        $mail->AltBody    	= "";

		$mail->MsgHTML($email_body);
        $mail->IsHTML(true);

		if ($mail->send()) {
			return 1;
		}else {
			return 0;
		}


	}









}
