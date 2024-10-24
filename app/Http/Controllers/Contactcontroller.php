<?php

namespace App\Http\Controllers;

use App\Models\Chambre;
use App\Models\Reservation;
use App\Models\User;
use Exception;
use PDF;
use DateTime;
use Illuminate\Http\Request;
use App\Models\Message;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Mail\myEmail;
use App\Mail\contact_email;
use App\Mail\resetPassword_email;
use App\Mail\respoEmail;
use App\Mail\reservation_Email;
use App\Mail\Update_UserEmail;
use Illuminate\Support\Facades\Mail;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Hash;

class Contactcontroller extends Controller
{


    public function submit(Request $request)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'subject' => 'required',
            'message' => 'required',
        ]);
       
        // Create a new message object and save it to the database
        $Message = new Message();
        $Message->name = $request->input('name');
        $Message->email =$request->input('email');
        $Message->subject =$request->input('subject');
        $Message->message =$request->input('message');
        
        $test=$Message->save();
        
        if($test){
            //send this message to Admin’s gmail
            $data = [
                "subject"=>"Contact Form",
                "fullname"=>$Message->name,
                "email"=>$Message->email,
                "about"=>$Message->subject,
                "message"=>$Message->message
                
                ];
            try
            {
                Mail::to("the.Hoteru@gmail.com")->send(new contact_email($data));
                
            }
            catch(Exception $e){}

            return response()->json('Success');}
        else
            return response()->json('Error');

       
        
        
    }
    
    public function addrespo(Request $request)
    {   
        
        $id1= User::where('email', '=', $request->input('email'))
                    ->value('id_user');

        $id2= User::where('username', '=', $request->input('username'))
                    ->value('id_user');
        
        if(!$id1 && !$id2){
        $user = new User();
        $user->typeofuser ="Respo";
        $user->username = $request->input('username');
        $user->email =$request->input('email');
        $user->password =$request->input('password');
        
        
        $test=$user->save();
        
        if($test){
                try
                {
                    Mail::to($user->email)->send(new respoEmail($user));
                    
                }
                catch(Exception $e){}

            return response()->json('SUCCESS');
        }
        else
            return response()->json('ERROR');
 
        }else{
            return response()->json('IS_EXISTE');
        }
    }
    public function correctstatut()
    {
        
        $results = Reservation::select('id_chambre', DB::raw('MAX(date_fin) as closest_date'))
                ->groupBy('id_chambre')
                ->get();

        
        foreach($results as $result){
           if( $result-> closest_date < Carbon::now()){
            
             Chambre::where('id_chambre','=',$result->id_chambre )
                ->update(['available' => 1]);
           }
        }
   

    }



    public function reserver(Request $request)
    {  
        

            
        $username=$request->input('username');
        $reservation = new Reservation();
        $reservation->fullname = $request->input('fullname');
        $reservation->phone = $request->input('phone');
        $reservation->type_chambre = $request->input('type_chambre');
        $reservation->date_debut = Carbon::createFromFormat('Y-m-d', $request->input('date_debut'));
        $reservation->date_fin = Carbon::createFromFormat('Y-m-d', $request->input('date_fin'));
        $start=$reservation->date_debut ;
        $end=$reservation->date_fin ;
        
        try{


            $idch = DB::table('chambres')
            ->where('type_chambre','=',$reservation->type_chambre)
                ->select('id_chambre')
                ->whereNotIn('id_chambre', function ($query) use ($start, $end) {
                    $query->select('id_chambre')
                          ->from('reservations')
                          ->whereBetween('date_debut', [$start, $end])
                          ->orWhereBetween('date_fin', [$start, $end])
                          ->orWhere(function ($query) use ($start, $end) {
                              $query->where('date_debut', '<=', $start)
                                    ->where('date_fin', '>=', $end);
                          });
                })
                ->value('id_chambre');

        
        }catch(Exception $e){
            
        }

        $iduser= User::where('username', '=', $username)
                    ->value('id_user');


        
        $reservation->id_user=$iduser;

        
        if(!$idch)
            return response()->json('NULL');
        else{

            
            
            $reservation->id_chambre=$idch;

            $prix= Chambre::where('id_chambre', '=', $idch)
                    ->value('prix');

            $date_debut_obj = new DateTime($start);
            $date_fin_obj = new DateTime($end);
            $interval = $date_debut_obj->diff($date_fin_obj);
            $nbr_nights = $interval->format('%a');

            $total= $nbr_nights * $prix;
            $reservation->total=$total;
            $check=$reservation->save();




            if($check){
                //send email to this user about his reservation
                $email= User::where('username', '=', $username)
                            ->value('email');
                $data = [
                    "subject"=>"You make a Reservation In Hoteru",
                    "fullname"=>$reservation->fullname,
                    "phone"=>$reservation->phone,
                    "type_chambre"=>$reservation->type_chambre,
                    "date_debut"=>$reservation->date_debut,
                    "date_fin"=>$reservation->date_fin,
                    "total"=>$reservation->total
                    ];
                
                try
                {
                    Mail::to($email)->send(new reservation_Email($data));
                    
                }
                catch(Exception $e){}

                return response()->json('SUCCESS');
            }else
                return response()->json('ERROR');

        }

    }
    
    public function delete_account(Request $request){
        $id_user=$request->input('id_user');
        if ($id_user) {

            try {
                $email=User::where('id_user',$id_user)
                    ->value('email');
                //deleting reservations of this user automaticly befor deleting user’s account
                DB::table('users')
                    ->where('id_user', $id_user)
                    ->delete();
                    try
                    {
                        $data = [
                            "subject"=>"Deleting Your Account",
                            "message"=>"Your account has been deleted. For more information, please contact the administrator of Hoteru. You can reach them by emailing [the.hoteru@gmail.com]."
                        ];
                       
                        Mail::to($email)->send(new myEmail($data));
                        
                    }
                    catch(Exception $e){
                    }
                 return response()->json('SUCCESS');
            }catch(Exception $e){
                return response()->json('ERROR');
            }
        } 
        else {
            return response()->json('ERROR');
        }
       

    }
    
    
    public function updateprofile_password(Request $request){
        $id_user=$request->input('id_user');
        $password=($request->input('new_password'));
        $old_password=($request->input('old_password'));
        

        $pswd = DB::table('users')
                ->where('id_user', $id_user)
                ->value('password');

        if($old_password==$pswd){
          
        try {
            DB::table('users')
                ->where('id_user', $id_user)
                ->update([
                    
                    'password' => $password
                ]);
                try
                    {
                        $email = DB::table('users')
                                ->where('id_user', $id_user)
                                ->value('email');
                        $data = [
                            "subject"=>"Update Your Password",
                            "message"=>"Your Hoteru Account password has changed ($email) "
                            ];
                       
                        Mail::to($email)->send(new myEmail($data));
                        
                    }
                    catch(Exception $e){
                    }
                return response()->json('SUCCESS');
        } catch (Exception $e) {
            
            return response()->json('ERROR');
        }

         }else{
            return response()->json('INCORRECT_PASSWORD');
         }


    }
    public function updateprofile_username(Request $request){
        $id_user=$request->input('id_user');
        $username=$request->input('new_username');
        if($request->input('new_username')!=""){
        try {
            DB::table('users')
                ->where('id_user', $id_user)
                ->update([
                    
                    'username' => $username
                ]);
                return response()->json('SUCCESS');
        } catch (Exception $e) {
            
            return response()->json('ERROR');
        }

        
    

    }

    }
    

    public function update_user(Request $request){
        
        $typeofuser =$request->input('typeofuser');
        $username = $request->input('username');
        $email =$request->input('email');
        $password =$request->input('password');


        try {
            DB::table('users')
                ->where('id_user', $request->input('id_user'))
                ->update([
                    
                    'username' => $username,
                    'email' => $email,
                    'password' => $password,
                    'typeofuser' => $typeofuser

                ]);
                try
                {
                    $data=[
                        'username' => $username,
                        'email' => $email,
                        'password' => $password
                    
                    ];
                    Mail::to($data['email'])->send(new Update_UserEmail($data));
                    
                }
                catch(Exception $e){}
                
                return response()->json('SUCCESS');
        } catch (Exception $e) {
            
            return response()->json('ERROR');
        }
    }

    public function delete_message(Request $request){
        $id_message=$request->input('id_message');
        if ($id_message) {

            try {
                DB::table('messages')
                    ->where('id_message', $id_message)
                    ->delete();
                
                 return response()->json('SUCCESS');
            }catch(Exception $e){
                return response()->json('ERROR');
            }
        } 
        else {
            return response()->json('ERROR');
        }
       

    }
    public function delete_allmessages(){
            try {
                DB::table('messages')
                    ->delete();
                
                 return response()->json('SUCCESS');
            }catch(Exception $e){
                return response()->json('ERROR');
            }
        } 
    
    public function Reset_Password(Request $request){
        //send 
        $ema=$request->input('email');

        $email=DB::table('users')
                    ->where('email', $ema)
                    ->value('email');
        if(!$email)
                return response()->json('NotYours');

        $password=DB::table('users')
                    ->where('email', $email)
                    ->value('password');

        

        $username=DB::table('users')
                    ->where('email', $email)
                    ->value('username');

        $data = [
            "subject"=>"Reset Password",
            "username"=>$username,
            "password"=>$password
            ];
        try
        {
            Mail::to($email)->send(new resetPassword_email($data));
            return response()->json('SUCCESS');
            
        }
        catch(Exception $e){
            return response()->json('ERROR');
        }

    }





    public function generateFacteur($reservationId)
    {
        // Retrieve the reservation details based on the reservationId
        $reservation = Reservation::where('id_reservation', $reservationId)->first();
        $reservation->prix=Chambre::where('id_chambre', '=',$reservation->id_chambre)
                            ->value('prix');

        // Generate the PDF using the reservation details
        $pdf = PDF::loadView('facteur', ['reservation' => $reservation]);

        // Set the response headers for PDF file download
        $headers = [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'attachment; filename="reservation_facteur_' .$reservationId . '.pdf"',
        ];

        // Return the PDF as a response
        return response($pdf->output(), 200, $headers);
    }

























}


