<?php

namespace App\Http\Controllers;

use App\Client;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Support\Facades\Input;

use Redirect;
use Validator;
use Hash;
use Session;
use Auth;
use View;
use DB;
use App\DateTime;
use Illuminate\Http\Request;
use App\User;
use App\Transactions;
use App\Queue;
use App\ClientInfo;
use App\RegisterLicense;
use App\RegisterVehicle;
use App\RenewLicense;
use App\RenewVehicle;

class ClientController extends Controller {
 
    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    public function index(){
      
        return view('client.login');
    }

    public function register(){
        return view('client.register');
    }

    //customer side
    public function p_login(){
        $input = Input::all();

        $login = User::where('username',Input::get('username'))->where('password', Input::get('password'))->get();

        //login succeded?
       if( count($login) > 0){

            Session::put( 'client_info', $login );
            
            return view( '/client/index')->with('client_info',  $login[0] );
        } 
    }

    public function getLogout(){
        Session::flush();
        return Redirect::intended('/');
    }

    //views
     public function rl_view()
    {   
        $client_id = Session::get('client_info');
        $client_id = $client_id[0]->client_id;
        $data = ClientInfo::find( $client_id );
        return view('client.registerLicense')->with('data',$data);
    }

    public function renewl_view()
    {   
        $client_id = Session::get('client_info');
        $client_id = $client_id[0]->client_id;
        $data = ClientInfo::find( $client_id );
        return view('client.renewLicense')->with('data',$data);
    }

 
    public function rv_view()
    {   
        $client_id = Session::get('client_info');
        $client_id = $client_id[0]->client_id;
        $data = ClientInfo::find( $client_id );
        return view('client.registerVehicle')->with('data',$data);
    }

      public function renewv_view()
    {   
        $client_id = Session::get('client_info');
        $client_id = $client_id[0]->client_id;
        $data = ClientInfo::find( $client_id );
        return view('client.renewVehicle')->with('data',$data);
    }

    
    //store vehivle transaction
    public function rVehicle(Request $request){
        $data = Input::all();
        $rules = array(
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'address' => 'required|string',
            'agency' => 'required|string',
            'fileNumber' => 'required|string',
            'authAgency' => 'required|string',
            'agencyName' => 'required|string',
            'agencyAddress' => 'required|string',
            'TOR' => 'required',
            'MVRRNo' => 'required|string',
            'CHPGNo' => 'required|string',
            'IENo' => 'required|string',
            'ie_name' => 'required|string',
            'ie_address' => 'required|string',
            'insurer' => 'required|string',
            'policyNumber' => 'required|string',
            'kindOfVehicle' => 'required',
            'expiryDate' => 'required|string',
            'COCNo' => 'required|string',
            'ENo' => 'required|string',
            'dateENo' => 'required|string',
            'PL' => 'required|string',
            'TPL' => 'required|string',
            'classification' => 'required',
            'brand' => 'required|string',
            'plateNo' => 'required|string',
            'typeOfFuel' => 'required',
            'motorNo' => 'required|string',
            'serialNo' => 'required|string',
            'series' => 'required|string',
            'typeOfBody' => 'required|string',
            'doorNo' => 'required|string',
            'yearModel' => 'required|string',
            );
        $validation = Validator::make($data, $rules);
        if($validation->passes()) {
            $vehicle = new RegisterVehicle;
            $client_info = Session::get('client_info');
            $vid = $client_info[0]->client_id;
            $vehicle->client_id = $vid;
            $vehicle->transaction_type = 'Vehicle Registration';
            $vehicle->first_name = $data['first_name'];
            $vehicle->last_name = $data['last_name'];
            $vehicle->address = $data['address'];
            $vehicle->date = $data['date'];
            $vehicle->agency = $data['agency'];
            $vehicle->fileNumber = $data['fileNumber'];
            $vehicle->authAgency = $data['authAgency'];
            $vehicle->agencyName = $data['agencyName'];
            $vehicle->agencyAddress = $data['agencyAddress'];
            $vehicle->TOR = $data['TOR'];
            $vehicle->MVRRNo = $data['MVRRNo'];
            $vehicle->CHPGNo = $data['CHPGNo'];
            $vehicle->IENo = $data['IENo'];
            $vehicle->ie_name= $data['ie_name'];
            $vehicle->ie_address = $data['ie_address'];
            $vehicle->insurer = $data['insurer'];
            $vehicle->policyNumber = $data['policyNumber'];
            $vehicle->kindOfVehicle = $data['kindOfVehicle'];
            $vehicle->expiryDate = $data['expiryDate'];
            $vehicle->COCNo = $data['COCNo'];
            $vehicle->ENo = $data['ENo'];
            $vehicle->dateENo = $data['dateENo'];
            $vehicle->PL = $data['PL'];
            $vehicle->TPL = $data['TPL'];
            $vehicle->classification = $data['classification'];
            $vehicle->brand = $data['brand'];
            $vehicle->plateNo = $data['plateNo'];
            $vehicle->typeOfFuel = $data['typeOfFuel']; 
            $vehicle->motorNo = $data['motorNo']; 
            $vehicle->serialNo = $data['serialNo']; 
            $vehicle->series = $data['series']; 
            $vehicle->typeOfBody = $data['typeOfBody']; 
            $vehicle->doorNo = $data['doorNo']; 
            $vehicle->yearModel = $data['yearModel']; 
            $vehicle->save();

            $vehicle_inserted_id = $vehicle->rv_id;
            $vehicle_to_update = RegisterVehicle::find($vehicle_inserted_id);
             //qr code
            $qr_code_filename = $vehicle_to_update->rv_id;
            $qr_code_filename = strtolower($qr_code_filename);
            $qr_code_filename = $qr_code_filename.'_'.uniqid().'.png';
            $qr_code_full_filename = base_path().'/images/vqrcode/'.$qr_code_filename;
            \QrCode::format('png')->size(250)->generate($vehicle_to_update->rv_id, $qr_code_full_filename);
            $vehicle_to_update->vqrcode = $qr_code_full_filename;
            $vehicle_to_update->save();

            return Redirect::to('/RVPDF/?rv_id='. $vehicle_inserted_id );
        }  else 
               {
                   exit();
                   return Redirect::back()->withInput()->withErrors($validation);
               }
    }

     public function renewVehicle(Request $request){
        $data = Input::all();
        $rules = array(
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'address' => 'required|string',
            'agency' => 'required|string',
            'fileNumber' => 'required|string',
            'authAgency' => 'required|string',
            'agencyName' => 'required|string',
            'agencyAddress' => 'required|string',
            'TOR' => 'required',
            'MVRRNo' => 'required|string',
            'CHPGNo' => 'required|string',
            'IENo' => 'required|string',
            'ie_name' => 'required|string',
            'ie_address' => 'required|string',
            'insurer' => 'required|string',
            'policyNumber' => 'required|string',
            'kindOfVehicle' => 'required',
            'expiryDate' => 'required|string',
            'COCNo' => 'required|string',
            'ENo' => 'required|string',
            'dateENo' => 'required|string',
            'PL' => 'required|string',
            'TPL' => 'required|string',
            'classification' => 'required',
            'brand' => 'required|string',
            'plateNo' => 'required|string',
            'typeOfFuel' => 'required',
            'motorNo' => 'required|string',
            'serialNo' => 'required|string',
            'series' => 'required|string',
            'typeOfBody' => 'required|string',
            'doorNo' => 'required|string',
            'yearModel' => 'required|string',
            );
        $validation = Validator::make($data, $rules);
        if($validation->passes()) {
            $rvehicle = new RenewVehicle;
            $client_info = Session::get('client_info');
            $vid = $client_info[0]->client_id;
            $rvehicle->client_id = $vid;
            $rvehicle->transaction_type = 'Vehicle Registration';
            $rvehicle->first_name = $data['first_name'];
            $rvehicle->last_name = $data['last_name'];
            $rvehicle->address = $data['address'];
            $rvehicle->date = $data['date'];
            $rvehicle->agency = $data['agency'];
            $rvehicle->fileNumber = $data['fileNumber'];
            $rvehicle->authAgency = $data['authAgency'];
            $rvehicle->agencyName = $data['agencyName'];
            $rvehicle->agencyAddress = $data['agencyAddress'];
            $rvehicle->TOR = $data['TOR'];
            $rvehicle->MVRRNo = $data['MVRRNo'];
            $rvehicle->CHPGNo = $data['CHPGNo'];
            $rvehicle->IENo = $data['IENo'];
            $rvehicle->ie_name= $data['ie_name'];
            $rvehicle->ie_address = $data['ie_address'];
            $rvehicle->insurer = $data['insurer'];
            $rvehicle->policyNumber = $data['policyNumber'];
            $rvehicle->kindOfVehicle = $data['kindOfVehicle'];
            $rvehicle->expiryDate = $data['expiryDate'];
            $rvehicle->COCNo = $data['COCNo'];
            $rvehicle->ENo = $data['ENo'];
            $rvehicle->dateENo = $data['dateENo'];
            $rvehicle->PL = $data['PL'];
            $rvehicle->TPL = $data['TPL'];
            $rvehicle->classification = $data['classification'];
            $rvehicle->brand = $data['brand'];
            $rvehicle->plateNo = $data['plateNo'];
            $rvehicle->typeOfFuel = $data['typeOfFuel']; 
            $rvehicle->motorNo = $data['motorNo']; 
            $rvehicle->serialNo = $data['serialNo']; 
            $rvehicle->series = $data['series']; 
            $rvehicle->typeOfBody = $data['typeOfBody']; 
            $rvehicle->doorNo = $data['doorNo']; 
            $rvehicle->yearModel = $data['yearModel']; 
            $rvehicle->save();

          $vehicle_inserted_id = $rvehicle->renewvehicle_id;
            $license_to_update = RenewVehicle::find($vehicle_inserted_id);
             //qr code
            $qr_code_filename = $license_to_update->renewvehicle_id;
            $qr_code_filename = strtolower($qr_code_filename);
            $qr_code_filename = $qr_code_filename.'_'.uniqid().'.png';
            $qr_code_full_filename = base_path().'/images/rvqrcode/'.$qr_code_filename;
            \QrCode::format('png')->size(250)->generate($license_to_update->renewvehicle_id, $qr_code_full_filename);
            $license_to_update->rvqrcode = $qr_code_full_filename;
            $license_to_update->save();


            return Redirect::to('/intorenew/?renewvehicle_id='. $vehicle_inserted_id );
        }  else 
               {
                   exit();
                   return Redirect::back()->withInput()->withErrors($validation);
               }
    }

    //store license transaction
    public function rLicense(Request $request){
        $data = Input::all();
        $rules = array(
                'first_name' => 'required|string',
                'last_name' => 'required|string',
                'address' => 'required|string',
                'nationality' => 'required|string',
                'gender' => 'required',
                'birthdate' => 'required|string',
                'height' => 'required|numeric',
                'weight' => 'required|numeric',
                'mobile' => 'required|numeric',
                'TOA' => 'required',
                'TLA' => 'required',
                'DSA' => 'required',
                'EA' => 'required',
                'bloodtype' => 'required|string',
                'donor' => 'required|string',
                'civilstatus' => 'required',
                'hair' => 'required',
                'eyes' => 'required',
                'built' => 'required',
                'complexion' => 'required',
                'birth_place' => 'required|string',
                'fathername' => 'required|string',
                'mothername' => 'required|string',
        );
        $validation = Validator::make($data, $rules);
        if($validation->passes()) {
            $license = new RegisterLicense;
            $client_info = Session::get('client_info');
            $id = $client_info[0]->client_id;
            $license->client_id = $id;
            $license->transaction_type = 'License Registration';
            $license->first_name = $data['first_name'];
            $license->last_name = $data['last_name'];
            $license->address = $data['address'];
            $license->nationality = $data['nationality'];
            $license->gender = $data['gender'];
            $license->birthdate = $data['birthdate'];
            $license->height = $data['height'];
            $license->weight = $data['weight'];
            $license->mobile = $data['mobile'];
            $license->TOA = $data['TOA'];
            $license->TLA = $data['TLA'];
            $license->DSA = $data['DSA'];
            $license->EA = $data['EA'];
            $license->bloodtype = $data['bloodtype'];
            $license->donor = $data['donor'];
            $license->civilstatus = $data['civilstatus'];
            $license->hair = $data['hair'];
            $license->eyes = $data['eyes'];
            $license->built = $data['built'];
            $license->complexion = $data['complexion'];
            $license->date = $data['date'];
            $license->birthplace = $data['birth_place'];
            $license->fathername = $data['fathername'];
            $license->mothername = $data['mothername']; 
            $license->save();

            $license_inserted_id = $license->rl_id;
            $license_to_update = RegisterLicense::find($license_inserted_id);
             //qr code
            $qr_code_filename = $license_to_update->rl_id;
            $qr_code_filename = strtolower($qr_code_filename);
            $qr_code_filename = $qr_code_filename.'_'.uniqid().'.png';
            $qr_code_full_filename = base_path().'/images/qrcode/'.$qr_code_filename;
            \QrCode::format('png')->size(250)->generate($license_to_update->rl_id, $qr_code_full_filename);
            $license_to_update->qrcode = $qr_code_full_filename;
            $license_to_update->save();

            return Redirect::to('/intopdfRL/?rl_id='. $license_inserted_id );
        }
        else 
       {
           exit();
           return Redirect::back()->withInput()->withErrors($validation);
       }
    }

    
    public function renLicense(Request $request){
       $data = Input::all();
        $rules = array(
                'first_name' => 'required|string',
                'last_name' => 'required|string',
                'address' => 'required|string',
                'nationality' => 'required|string',
                'gender' => 'required|string',
                'birthdate' => 'required|string',
                'height' => 'required|numeric',
                'weight' => 'required|numeric',
                'mobile' => 'required|numeric',
                'TOA' => 'required',
                'TLA' => 'required',
                'DSA' => 'required',
                'EA' => 'required',
                'bloodtype' => 'required|string',
                'donor' => 'required|string',
                'civilstatus' => 'required',
                'hair' => 'required',
                'eyes' => 'required',
                'built' => 'required',
                'complexion' => 'required',
                'birth_place' => 'required|string',
                'fathername' => 'required|string',
                'mothername' => 'required|string',
        );
        $validation = Validator::make($data, $rules);
        if($validation->passes()) {
            $rlicense = new RenewLicense;
            $client_info = Session::get('client_info');
            $id = $client_info[0]->client_id;
            $rlicense->client_id = $id;
            $rlicense->transaction_type = 'License Renewal';
            $rlicense->first_name = $data['first_name'];
            $rlicense->last_name = $data['last_name'];
            $rlicense->address = $data['address'];
            $rlicense->nationality = $data['nationality'];
            $rlicense->gender = $data['gender'];
            $rlicense->birthdate = $data['birthdate'];
            $rlicense->height = $data['height'];
            $rlicense->weight = $data['weight'];
            $rlicense->mobile = $data['mobile'];
            $rlicense->TOA = $data['TOA'];
            $rlicense->TLA = $data['TLA'];
            $rlicense->DSA = $data['DSA'];
            $rlicense->EA = $data['EA'];
            $rlicense->bloodtype = $data['bloodtype'];
            $rlicense->donor = $data['donor'];
            $rlicense->civilstatus = $data['civilstatus'];
            $rlicense->hair = $data['hair'];
            $rlicense->eyes = $data['eyes'];
            $rlicense->built = $data['built'];
            $rlicense->complexion = $data['complexion'];
            $rlicense->date = $data['date'];
            $rlicense->birthplace = $data['birth_place'];
            $rlicense->fathername = $data['fathername'];
            $rlicense->mothername = $data['mothername']; 
            $rlicense->save();

            $rlicense_inserted_id = $rlicense->renewlicense_id;
            $rlicense_to_update = RenewLicense::find($rlicense_inserted_id);
             //qr code
            $rqr_code_filename = $rlicense_to_update->renewlicense_id;
            $rqr_code_filename = strtolower($rqr_code_filename);
            $rqr_code_filename = $rqr_code_filename.'_'.uniqid().'.png';
            $rqr_code_full_filename = base_path().'/images/rqrcode/'.$rqr_code_filename;
            \QrCode::format('png')->size(250)->generate($rlicense_to_update->renewlicense_id, $rqr_code_full_filename);
            $rlicense_to_update->rqrcode = $rqr_code_full_filename;
            $rlicense_to_update->save();

            return Redirect::to('/into/?renewlicense_id='. $rlicense_inserted_id );
        }
        else 
       {
           exit();
               return Redirect::back()->withInput()->withErrors($validation);
       }
    }

//convert the form to Pdf
    public function RLtoPDF(){
        
        //get data to generate from url query string
        $id = Input::get('rl_id');
        $data = RegisterLicense::find($id);
     
        $full_name = ucwords($data->first_name.' '.$data->last_name);
        $file_name = 'License Registration - '. $full_name .'.pdf' ;
        
        $pdf = \App::make('dompdf.wrapper');
        $content = '<style type="text/css">
                    .form-style-6{font: 85% Arial, Helvetica, sans-serif;max-width: 800px;margin: 5px auto;padding: 10px;background: #F7F7F7;    
                    }
                    .form-style-6 h1{background: black;padding: 20px 0;font-size: 120%;font-weight: 300;text-align: center; color: #fff;margin: -13px -13px 13px -13px;
                    }   
                    .form-style-6 ul{ padding:0; margin:0;list-style:none;
                    }
                    .form-style-6 ul li{
                        display: block;margin-bottom: 10px;min-height: 35px;
                    }

                    </style>

                    <!DOCTYPE html> 
                    <html>
                    <head>
                    <title>MQues</title>
                    </head>
                    <body>
                    
                    <div class="form-style-6">
                    <h1>LICENSE REGISTRATION FORM</h1>
                    <ul>
                        <li>Name: '.$full_name.' 
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        Present Address: '.$data->address.' </li>

                        <li>Nationality: '.$data->nationality.'
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        Gender: '.$data->gender.'</li>
                          

                        <li>Birthday: '.$data->birthdate.'
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                        Height: '.$data->height.'</li>

                        <li>Weight: '.$data->weight.' 
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;
                        Tel/Cp No: '.$data->mobile.' </li>
                        
                        <br><br><br>
                        <li>Type of Application(TOA): '.$data->TOA.' </li>
                        <li>Type of License Applied for(TLA): '.$data->TLA.'</li>

                        <li>Driving Skill Acquired or Will be Acquired Thru(DSA): '.$data->DSA.' </li>
                           
                        <li>Educational Attainment(EA): '.$data->EA.' </li>
                        
                        <br><br><br>
                        <li>Blood Type: '.$data->bloodtype.'
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        Organ Donor?: '.$data->donor.'</li>

                        <li>Civil Status: '.$data->civilstatus.' 
                           &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        Hair: '.$data->hair.' </li>
                        

                        <li>Eyes: '.$data->eyes.'
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        Built: '.$data->built.' </li>

                        <li>Complexion: '.$data->complexion.' 
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        Birth Place: '.$data->birthplace.' </li>
                        

                        <li>Fathers Name: '.$data->fathername.' 
                        <li>Mothers Name: '.$data->mothername.' 
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <li>Date Filed: '.$data->date.' </li>
                        
                 <li>QR Code:<img src='.$data->qrcode.'></li>
                </body>
                </html>';

        
        

        $pdf->loadHTML($content);
        return $pdf->stream( $file_name, array('Attachment' => false));  


    }

//convert the form to Pdf
    public function RVtoPDF(){
        
        //get data to generate from url query string
        $id = Input::get('rv_id');
        $data = RegisterVehicle::find($id);
     
        $full_name = ucwords($data->first_name.' '.$data->last_name);
        $file_name = 'Vehicle Registration - '. $full_name .'.pdf' ;
        
        $pdf = \App::make('dompdf.wrapper');
        $content = '<style type="text/css">
                    .form-style-6{font: 85% Arial, Helvetica, sans-serif;max-width: 800px;margin: 5px auto;padding: 10px;background: #F7F7F7;    
                    }
                    .form-style-6 h1{background: black;padding: 20px 0;font-size: 120%;font-weight: 300;text-align: center; color: #fff;margin: -13px -13px 13px -13px;
                    }   
                    .form-style-6 ul{ padding:0; margin:0;list-style:none;
                    }
                    .form-style-6 ul li{
                        display: block;margin-bottom: 10px;min-height: 35px;
                    }

                    </style>

                    <!DOCTYPE html> 
                    <html>
                    <head>
                    <title>MQues</title>
                    </head>
                    <body>
                    
                    <div class="form-style-6">
                    <h1>LICENSE REGISTRATION FORM</h1>
                    <ul>
                        <li>Name: '.$full_name.' 
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        Present Address: '.$data->address.' </li>

                        <li>Agency: '.$data->agency.'
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        File Number: '.$data->fileNumber.'</li>
                          

                        <li>Auth Agency: '.$data->authAgency.'
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                        Agency Name: '.$data->agencyName.'</li>

                        <li>Agency Address: '.$data->agencyAddress.' 
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;
                        TOR: '.$data->TOR.' </li>

                        <li>MVRRNo: '.$data->MVRRNo.' 
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;
                        CHPGNo: '.$data->CHPGNo.' </li>

                        <li>IENo: '.$data->IENo.' 
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;
                        IE Name: '.$data->ie_name.' </li>

                        <li>IE Address: '.$data->ie_address.' 
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;
                        Insurer: '.$data->insurer.' </li>

                        <li>Policy Number: '.$data->policyNumber.' 
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;
                        Kind Of Vehicle: '.$data->kindOfVehicle.' </li>
                        
                        <br><br><br>
                        <li>COC Number: '.$data->COCNo.' </li>
                        <li>Expiry Date: '.$data->expiryDate.'</li>

                        <li>EN Number: '.$data->ENo.' </li>
                           
                        <li>Date E Number: '.$data->dateENo.' </li>
                        
                        <br><br><br>
                        <li>PL: '.$data->PL.'
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        TPL: '.$data->TPL.'</li>

                        <li>Classification: '.$data->classification.' 
                           &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        Brand: '.$data->brand.' </li>
                        

                        <li>Plate Number: '.$data->plateNo.'
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        Type Of Fuel: '.$data->typeOfFuel.' </li>

                        <li>Motor Number: '.$data->motorNo.' 
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        Serial Number: '.$data->serialNo.' </li>
                        

                        <li>Series Number: '.$data->series.' 
                        <li>Type Of Body: '.$data->typeOfBody.' 
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <li>Door Number: '.$data->doorNo.' </li>
                        <li>Year Model: '.$data->yearModel.' </li>
                        
                        <li>QR Code:<img src='.$data->vqrcode.'></li>
                </body>
                </html>';

        
        

        $pdf->loadHTML($content);
        return $pdf->stream( $file_name, array('Attachment' => false));  


    }


//PDF the scanned qrcode register license
    public function qrcodeToPDF(){
        //get data to generate from url query string
        $asdid = Input::get('rl_id');
        $data = RegisterLicense::find($asdid);

        //get priority number
        //this is for the 350 limit per operation day
        $last_queue = Queue::orderBy('queue_label', 'DESC')->orderBy('created_at', 'DESC')->first();
        $last_queue_label = $last_queue->queue_label;
        if( $last_queue_label == 50 /* limit per day  */ ){
            //reset to 0 if reached to 350
            $priority_number = 1;
        } else {
            $priority_number = $last_queue_label + 1;
        }

        $queue = new Queue;
        $queue->transactionID_fk = $asdid;
        $queue->processID_fk = 1;
        $queue->counterID_fk = 1;
        $queue->queue_label = $priority_number;             
        $queue->save();

        
        $full_name = ucwords($data->first_name.' '.$data->last_name);
        $file_name = 'License Registration - '. $full_name .'.pdf' ;
        
        $pdf = \App::make('dompdf.wrapper');
        $content = '<style type="text/css">
                    .form-style-6{
                        font: 85% Arial, Helvetica, sans-serif;max-width: 800px;margin: 5px auto;padding: 10px;background: #F7F7F7;    
                    }
                    .form-style-6 h1{
                        background: black;padding: 20px 0;font-size: 120%;font-weight: 300;text-align: center;color: #fff;margin: -13px -13px 13px -13px;
                    }   
                    .form-style-6 ul{padding:0;margin:0;list-style:none;
                    }
                    .form-style-6 ul li{
                        display: block; margin-bottom: 10px;min-height: 35px;
                        }
                    </style>

                    <!DOCTYPE html> 
                    <html>
                    <head>
                    <title>MQues</title>
                    </head>
                    <body>
                    
                    <div class="form-style-6">
                    <h1>License Registration</h1>
                    <ul>
                        <li>Transaction type: License Registration</li>
                        <li>Name: '. $full_name.'</li>
                        <li>Priority Number: '.$priority_number.'<li>
                    </ul>
                    </div>
                    <center>
                    <button>
                        Print
                    </button>
                    
                </body>
                </html>';

        $pdf->loadHTML($content);
        return $pdf->stream( $file_name, array('Attachment' => false));  
    }

//PDF the scanned qrcode register vehicle
    public function vqrcodeToPDF(){
        //get data to generate from url query string
        $rv_id = Input::get('rv_id');
        $data = RegisterVehicle::find($rv_id);

        //get priority number
        //this is for the 350 limit per operation day
        $last_queue = Queue::orderBy('queue_label', 'DESC')->orderBy('created_at', 'DESC')->first();
        $last_queue_label = $last_queue->queue_label;
        if( $last_queue_label == 50 /* limit per day  */ ){
            //reset to 0 if reached to 350
            $priority_number = 1;
        } else {
            $priority_number = $last_queue_label + 1;
        }

        $queue = new Queue;
        $queue->transactionID_fk = $rv_id;
        $queue->processID_fk = 1;
        $queue->counterID_fk = 1;
        $queue->queue_label = $priority_number;             
        $queue->save();

        
        $full_name = ucwords($data->first_name.' '.$data->last_name);
        $file_name = 'Vehicle Registration - '. $full_name .'.pdf' ;
        
        $pdf = \App::make('dompdf.wrapper');
        $content = '<style type="text/css">
                    .form-style-6{
                        font: 85% Arial, Helvetica, sans-serif;max-width: 800px;margin: 5px auto;padding: 10px;background: #F7F7F7;    
                    }
                    .form-style-6 h1{
                        background: black;padding: 20px 0;font-size: 120%;font-weight: 300;text-align: center;color: #fff;margin: -13px -13px 13px -13px;
                    }   
                    .form-style-6 ul{padding:0;margin:0;list-style:none;
                    }
                    .form-style-6 ul li{
                        display: block; margin-bottom: 10px;min-height: 35px;
                        }
                    </style>

                    <!DOCTYPE html> 
                    <html>
                    <head>
                    <title>MQues</title>
                    </head>
                    <body>
                    
                    <div class="form-style-6">
                    <h1>Vehicle Registration</h1>
                    <ul>
                        <li>Transaction type: Vehicle Registration</li>
                        <li>Name: '. $full_name.'</li>
                        <li>Priority Number: '.$priority_number.'<li>
                    </ul>
                    </div>
                    <center>
                    <button>
                        Print
                    </button>
                    
                </body>
                </html>';

        $pdf->loadHTML($content);
        return $pdf->stream( $file_name, array('Attachment' => false));  
    }



    //insert client information
    public function store(Request $request){

        $data = Input::all();

        //validation rule and logic
        $rules = [
            'last_name'=> 'required|string',
            'first_name' => 'required|string',
            'gender'=> 'required|string',
            'birthdate'=> 'required|string',
            'address'=> 'required',
            'mobile'=> 'required|numeric',
            'email' => 'required|email',
            'username'=> 'required|string',
        ];

        $messages = [
            'last_name.required'=> 'Should not be empty',
            'last_name.string' => 'Letters only',
            'first_name.required' => 'Should not be empty',
            'first_name.string'=> 'Letters only',
            'gender.required'=> 'Should not be empty',
            'gender.string'  => 'Letters only',
            'birthdate.required'=> 'Should not be empty',
            'address.required' => 'Should not be empty',
            'mobile.required' => 'Should not be empty',
            'email.required' => 'Should not be empty',
            'email.email' => 'Should be email',
            'username.required'=> 'Should not be empty'
        ];

        $validation = Validator::make($data, $rules, $messages);
        if ($validation->passes()) {

            $client = new ClientInfo;
            $client->first_name= $data['first_name'];
            $client->last_name= $data['last_name'];
            $client->gender= $data['gender'];
            $client->birthdate= $data['birthdate'];
            $client->address = $data['address'];
            $client->mobile  = $data['mobile'];
            $client->email = $data['email'];
            $client->username = $data['username'];
            $client->password = $data['password'];
            $client->confirmpassword = $data['confirmPassword'];
            $client->save();

          return Redirect::to('/client/login');
       } 
       else {
            return Redirect::back()->withInput()->withErrors($validation);
       }
    }
   
}
