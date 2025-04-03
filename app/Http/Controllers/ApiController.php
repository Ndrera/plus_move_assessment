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
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class ApiController extends Controller
{
   
    /**
     * Get all the courier shipment details.
     * 
     */
    public function getAllCouriers( $id ){

        $shippings = \DB::table( 'couriers' )
        ->join( 'packages', 'packages.id', 'couriers.package_id' )
        ->join( 'courier_actions', 'couriers.id', 'courier_actions.courier_id' )
        ->join( 'statuses', 'courier_actions.status_id', 'statuses.id' )
        ->join( 'branches', 'branches.id', 'couriers.branch_id' )
        ->where( 'couriers.deleted_at', '=', null )
        ->where( 'couriers.created_by', '=', $id )
        ->select( 'couriers.id', 'couriers.tracking_no', 'packages.package_name', 'packages.package_description', 'branches.branch_name', 
        'couriers.sender_name', 'couriers.sender_contact', 'couriers.sender_email', 'couriers.sender_address', 'couriers.sender_city', 'couriers.sender_province', 
        'couriers.sender_country', 'couriers.recipient_name', 'couriers.recipient_contact', 'couriers.recipient_email', 'couriers.recipient_address', 
        'couriers.recipient_city', 'couriers.recipient_province', 'couriers.recipient_country', 'couriers.weight', 'couriers.length', 
        'couriers.width', 'couriers.height', 'couriers.price', 'courier_actions.remarks', 'statuses.status_name' )
        ->get();
        
        if( empty($shippings[0])  ){

            return response()->json([
                'status' => false,
                'message' => 'error',
                'errors' => 'No records found in our database'
            ], 422);

        }else{

            return response()->json([
                'status' => true,
                'message' => 'Package shipments retrieved successfully',
                'data' => $shippings
            ], 200);
        }
    }


    /**
     * Create courier shipment.
     * 
     */
    public function createCourier( Request $request ){

        //validation
        $validator = Validator::make($request->all(), [
            'package_name' => 'required',
            'package_description' => 'required',
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
            'created_by' => 'required',
        ]);

        //validation output
        if ($validator->fails()) {

            return response()->json([
                'status' => false,
                'message' => 'error',
                'errors' => $validator->errors()
            ], 404);
        }


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
                'branch_id' => 4,
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
                'created_by' => $request->created_by,
                'updated_by' => $request->created_by
   
            ];
            $courier = Courier::create( $courier_data );


            //CourierAction
            if( $courier ){

                $courier_action_data = [
                    'courier_id' => $courier->id,
                    'action_date' => now(),
                    'remarks' => "Corporate package created, ready for driver pick up.",
                    'status_id' => 7,
                    'updated_by' => $request->created_by
        
                ];
                $courier_action = CourierAction::create( $courier_action_data );


                //LoadManagement
                $load_data = [
                    'user_id' => $request->created_by,
                    'courier_id' => 0,
                    'status_id' =>  7
                ];
                $save_load = LoadManagement::create( $load_data );



                //User
                $user = User::find( $request->created_by);

                //send email notification to the organization / client
                $tracking_no     = $courier->tracking_no;
                $corporate_email = $user->email;
                $subject    = view('mail.corporatesubject', [ 'tracking_no' => $tracking_no ])->render();
                $email_body = view('mail.corporatemessage', [ 'tracking_no' => $tracking_no ])->render();

                $mail = $this->sendSMTPEmail( $corporate_email, $subject , $email_body );

                return response()->json([
                    'status' => true,
                    'message' => 'Package shipment created successfully',
                    'package_data' => $package,
                    'courier_data' => $courier,
                    'courier_action_data' => $courier_action,
                    'email_subject' => $subject,
                    'email_body' => $email_body
                ], 200);

            }
        }
        

    }





 
    /**
     * Get single courier shipment details
     * 
     */
    public function getCourier( $tracking_no ){

        $shipping = \DB::table( 'couriers' )
        ->join( 'packages', 'packages.id', 'couriers.package_id' )
        ->join( 'courier_actions', 'couriers.id', 'courier_actions.courier_id' )
        ->join( 'statuses', 'courier_actions.status_id', 'statuses.id' )
        ->join( 'branches', 'branches.id', 'couriers.branch_id' )
        ->where( 'couriers.deleted_at', '=', null )
        ->where( 'couriers.tracking_no', '=', $tracking_no )
        ->select( 'couriers.id', 'couriers.tracking_no', 'packages.package_name', 'packages.package_description', 'branches.branch_name', 
        'couriers.sender_name', 'couriers.sender_contact', 'couriers.sender_email', 'couriers.sender_address', 'couriers.sender_city', 'couriers.sender_province', 
        'couriers.sender_country', 'couriers.recipient_name', 'couriers.recipient_contact', 'couriers.recipient_email', 'couriers.recipient_address', 
        'couriers.recipient_city', 'couriers.recipient_province', 'couriers.recipient_country', 'couriers.weight', 'couriers.length', 
        'couriers.width', 'couriers.height', 'couriers.price', 'courier_actions.remarks', 'statuses.status_name'    )
        ->first();

        if( empty($shipping)  ){

            return response()->json([
                'status' => false,
                'message' => 'error',
                'errors' => 'Record not found in our database'
            ], 422);

        }else{

            return response()->json([
                'status' => true,
                'message' => 'Package shipment retrieved successfully',
                'data' => $shipping
            ], 200);
        }
    }


    /**
     * Update the courier shipment details
     * 
     */
    public function updateCourier( Request $request ){

        //validation
        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'package_name' => 'required',
            'package_description' => 'required',
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
            'updated_by' => 'required',
        ]);


         //validation output
         if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'error',
                'errors' => $validator->errors()
            ], 404);
        }


        //Courier
        $courier = Courier::find( $request->id );
        if( empty($courier)  ){
            return response()->json([
                'status' => false,
                'message' => 'error',
                'errors' => 'Record not found in our database'
            ], 422);
        }

        
        $courier_data = [
            'sender_name' => $request->sender_name,
            'sender_contact' => $request->sender_contact,
            'sender_email' => $request->sender_email,
            'sender_address' => $request->sender_address,
            'sender_city' => $request->sender_city,
            'sender_province' => $request->sender_province,
            'sender_country' => $request->sender_country,
            'recipient_name' => $request->recipient_name,
            'recipient_contact' => $request->recipient_contact,
            'recipient_email' => $request->recipient_email,
            'recipient_address' => $request->recipient_address,
            'recipient_city' => $request->recipient_city,
            'recipient_province' => $request->recipient_province,
            'recipient_country' => $request->recipient_country,
            'updated_by' => $request->updated_by

        ];
        $update = $courier->update( $courier_data );


        //Package
        $package = Package::find( $courier->package_id );

        $package_data = [
            'package_name' => $request->package_name,
            'package_description' =>  $request->package_description
        ];
        $update_package= $package->update( $package_data );

        return response()->json([
            'status' => true,
            'message' => 'Package shipment updated successfully',
            'courier_data' => $courier_data,
            'package_data' => $package_data
        ], 200);
    }


    /**
     * Delete courier shipment details
     * 
     */
    public function deleteCourier( Request $request ){

        //validation
        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'updated_by' => 'required',
        ]);


        //validation output
        if ($validator->fails()) {

            return response()->json([
                'status' => false,
                'message' => 'error',
                'errors' => $validator->errors()
            ], 404);
        }


        //Courier
        $id      = $request->id;
        $courier = Courier::find( $id );

        $courier_data = [
            'deleted_at'  => now(),
            'updated_by' => $request->updated_by
        ];
        $update =  $courier->update( $courier_data );

        return response()->json([
            'status' => true,
            'message' => 'Package shipment deleted successfully',
            'courier_data' => $courier_data
        ], 200);
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
