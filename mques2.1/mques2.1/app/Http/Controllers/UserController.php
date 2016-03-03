<?php

namespace App\Http\Controllers;

use Redirect;
use DB;
use Validator;
use App\Users;
use App\vehicleRegister;
use App\licenseRegister;
use Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Session;
use Auth;


class userController extends Controller
{

    // public function showLogin()
    // {
    //  return view('auth.login');
    // }

    // public function doLogin()
    // {
    //     $data = Request::all();
    //     $user = array(
    //         'email' =>  $data['email'],
    //         'password' => $data['password']
    //     );
            
    //     if (Auth::attempt($user)) {

    //        $session =  Session::put('key', $data['email']); 
    //         return Redirect::to('/home')
    //                 ->with('flash_error', 'Welcome!')
    //                 ->with('flash_color', '#27ae60');
    //     }
            
    //     return Redirect::back()
    //             ->with('flash_error', 'Your email/password combination was incorrect.')
    //             ->with('flash_color', '#c0392b');
    // }

    //  public function doSession()
    // {
    //     $data = Request::all();

    //     Session::put('key', $data['email']);
    // }

    // public function getSession()
    // {

    //     $value = Session::get('key');
    //     //$data = Users::where('email','=', $value)->get();
    //    $id = Auth::id();
       
    //     echo $value;

    // }


    //Register Vehicle
    public function vehicleRegisterView()
    {
       
        $id = Auth::id();
        $data = Users::where('id','=', $id)->get();


        return view('pages.registerV')->with('data',$data);
    }

    public function registerVehicle(Request $request)
    {

        $data = Request::all();

        $rules = array(
                'name' => 'required|alpha|regex:/^[A-Za-z ]+$/',
                'address' => 'required|alpha',
                'date' => 'required',
                'agency' => 'required|alpha',
                'authAgency' => 'required|alpha',
                'fileNumber' => 'required|numeric',
                'AcqName' => 'required|alpha',
                'AcqAddress' => 'required|alpha',
                'registrationType' => 'required|alpha',
                'MVRRNo' => 'required|numeric',
                'CHPGNo' => 'required|numeric',
                'CertPaymentNo' => 'required|alpha',
                'inEntryNo' => 'required|numeric',
                'enName' => 'required|alpha',
                'enAddress' => 'required|alpha',
                'insurer' => 'required|alpha',
                'policyNumber' => 'required|numeric',
                'kindOfVehicle' => 'required',
                'expiryDate' => 'required',
                'certOfCoverNo' => 'required|alpha',
                'endorsementNo' => 'required|numeric',
                'dateOfEndorsement' => 'required',
                'AmountCoveragePL' => 'required|numeric',
                'AmountCoverageTPL' => 'required|numeric',
                'classification' => 'required',
                'make_brand' => 'required|alpha',
                'plateNo' => 'required|alpha',
                'fuelType' => 'required',
                'motorNo' => 'required|alpha',
                'serial_chassisNo' => 'required|alpha',
                'series' => 'required|alpha',
                'typeOfBody' => 'required|alpha',
                'noOfDoor' => 'required|alpha',
        );


        $validation = Validator::make($data, $rules);

        if($validation->passes()) {
            $vehicleRegister = new vehicleRegister;
            $id = Auth::id();
            $vehicleRegister->id = $id;
            $vehicleRegister->name = $data['name'];
            $vehicleRegister->address = $data['address'];
            $vehicleRegister->date = $data['date'];
            $vehicleRegister->agency = $data['agency'];
            $vehicleRegister->authAgency = $data['authAgency'];
            $vehicleRegister->fileNumber = $data['fileNumber'];
            $vehicleRegister->AcqName = $data['AcqName'];
            $vehicleRegister->AcqAddress = $data['AcqAddress'];
            $vehicleRegister->registrationType = $data['registrationType'];
            $vehicleRegister->MVRRNo = $data['MVRRNo'];
            $vehicleRegister->CHPGNo = $data['CHPGNo'];
            $vehicleRegister->CertPaymentNo = $data['CertPaymentNo'];
            $vehicleRegister->inEntryNo = $data['inEntryNo'];
            $vehicleRegister->enName = $data['enName'];
            $vehicleRegister->enAddress = $data['enAddress'];
            $vehicleRegister->insurer = $data['insurer'];
            $vehicleRegister->policyNumber = $data['policyNumber'];
            $vehicleRegister->kindOfVehicle = $data['kindOfVehicle'];
            $vehicleRegister->expiryDate = $data['expiryDate'];
            $vehicleRegister->certOfCoverNo = $data['certOfCoverNo'];
            $vehicleRegister->endorsementNo = $data['endorsementNo'];
            $vehicleRegister->dateOfEndorsement = $data['dateOfEndorsement'];
            $vehicleRegister->AmountCoveragePL = $data['AmountCoveragePL'];
            $vehicleRegister->AmountCoverageTPL = $data['AmountCoverageTPL'];
            $vehicleRegister->classification = $data['classification'];
            $vehicleRegister->make_brand = $data['make_brand'];
            $vehicleRegister->plateNo = $data['plateNo'];
            $vehicleRegister->fuelType = $data['fuelType'];
            $vehicleRegister->motorNo = $data['motorNo'];
            $vehicleRegister->serial_chassisNo = $data['serial_chassisNo'];
            $vehicleRegister->series = $data['series'];
            $vehicleRegister->typeOfBody = $data['typeOfBody'];
            $vehicleRegister->noOfDoor = $data['noOfDoor'];
            $vehicleRegister->yearModel = $data['yearModel'];
            \QrCode::format('png')->size(250)->generate("Name: ".$data['name']." Address: ".$data['address']." Date: ".$data['date']." Transaction: Register Vehicle", 'C:\Users\user\Desktop\QRcodes/registerVehicle/vehicle.'.$data['name'].'.png');
            $vehicleRegister->qrcode = 'C:\Users\user\Desktop\QRcodes/registerVehicle/vehicle.'.$data['name'].'.png';
            $vehicleRegister->save();

            return Redirect::to('/intopdfRV')
                ->with('flash_error', 'Successful')
                ->with('flash_color', '#0A819C');
        }
        else 
        {
            return Redirect::back()
                ->withErrors($validation)
                ->with('flash_error', 'Validation Errors!');
        }
    }

    public function userlist(){
        $data = Users::all();
        return View('pages.registerV')->with('data',$data);
    }

    public function RVtoPDF(){
        $id = Auth::id();
        
        $data = vehicleRegister::where('id','=', $id)->get();
        foreach ($data as $data)

        $pdf = \App::make('dompdf.wrapper');
        $content = '<style type="text/css">
                    .form-style-6{
                        font: 85% Arial, Helvetica, sans-serif;
                        max-width: 800px;
                        margin: 5px auto;
                        padding: 10px;
                        background: #F7F7F7;    
                    }
                    .form-style-6 h1{
                        background: #43D1AF;
                        padding: 20px 0;
                        font-size: 120%;
                        font-weight: 300;
                        text-align: center;
                        color: #fff;
                        margin: -13px -13px 13px -13px;
                    }   
                    .form-style-6 ul{
                        padding:0;
                        margin:0;
                        list-style:none;
                    }
                    .form-style-6 ul li{
                        display: block;
                        margin-bottom: 10px;
                        min-height: 35px;
                        }

                    </style>


                    <!DOCTYPE html>
                    <html>
                    <head>
                    <title>MQues</title>
                    </head>
                    <body>
                    <div class="form-style-6">
                    <h1>Registration of Vehicle</h1>
                    <h4 align="center">OWNERSHIP AND DOCUMENTATION</h4>
                    <ul>

                    <li> Owners Complete Name: '.$data->name.'
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    Address: '.$data->address.'</li>
                    <li>Agency: '.$data->agency.'
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    Date: '.$data->date.'</li>
                    <h4 align="center">ACQUIRED FROM</h4>   

                    <li>Authorized Agency(For Hire Only):'.$data->authAgency.'
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                    File Number: '.$data->fileNumber.'</li>
                    <li>Name: '.$data->AcqName.'
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    Address: '.$data->AcqAddress.'</li>
                    <li>Type Of Registration:'.$data->registrationType.'
                    <li>MVRR Number(Latest): '.$data->MVRRNo.'
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    CHPG Control Number: '.$data->CHPGNo.'</li>
                        
                     <h4 align="center">INCUMBRANCE</h4>
                    <li>Certificate of payment number (C.P): '.$data->CertPaymentNo.'
                        &nbsp;&nbsp;&nbsp;&nbsp;
                    Informal Entry Number (I.E): '.$data->inEntryNo.'
                      
                    <li>Name:'.$data->enName.'
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    Address: '.$data->enAddress.' </li>
                    <li>Insurer: '.$data->insurer.'
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    Policy Number: '.$data->policyNumber.'</li>
                        
                    <li>Kind Of Vehicle:'.$data->kindOfVehicle.'
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    Expiry Date: '.$data->expiryDate.'</li>
                    <li>Cert. of Cover No.: '.$data->certOfCoverNo.'
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    Endorsement No.: '.$data->endorsementNo.'</li>
                            
                    <li>Date of Endorsement: '.$data->dateOfEndorsement.'
                    <li><align="center">Amount Of Coverage</li>
                    <li>PL P '.$data->AmountCoveragePL.'
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;  
                    TPL P'.$data->AmountCoverageTPL.'</li>
                            
                    <h4 align="center">IDENTIFICATION AND INSPECTION</h4>
                    <li>Classification: '.$data->classification.'
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    Make Brand: '.$data->make_brand.'
                    <li>Plate No: '.$data->plateNo.' 
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;
                    Fuel Type: '.$data->fuelType.'

                    <li>Motor Number: '.$data->motorNo.'
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    Serial/Chassis No:'.$data->serial_chassisNo.'
                    <li>Series: '.$data->series.'
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;
                    Type of Body: '.$data->typeOfBody.'
                        
                    <li>No Of Door: '.$data->noOfDoor.'
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    Year Model: '.$data->yearModel.'</li></ul>
                <center> Your QR Code:<img src='.$data->qrcode.'>
                </body>
                </html>';
        $pdf->loadHTML($content);
        return $pdf->stream(); 

    }

    // Register License

    public function licenseRegisterView()
    {

        $id = Auth::id();
        $data = Users::where('id','=', $id)->get();


        return view('pages.registerL')->with('data',$data);
    }

    public function registerLicense(Request $request)
    {

        $data = Request::all();

        $rules = array(
                'name' => 'required|alpha|regex:/^[A-Za-z ]+$/',
                'address' => 'required|alpha',
                'nationality' => 'required|alpha',
                'gender' => 'required',
                'birth' => 'required',
                'height' => 'required',
                'weight' => 'required',
                'telNo' => 'required|numeric',
                'TOA' => 'required',
                'TLA' => 'required',
                'DSA' => 'required',
                'EA' => 'required',
                'bloodType' => 'required|alpha',
                'donorBoolean' => 'required',
                'civilStatus' => 'required',
                'hair' => 'required',
                'eyes' => 'required',
                'built' => 'required',
                'complexion' => 'required',
                'birthPlace' => 'required|alpha',
                'fatherName' => 'required|alpha',
                'motherName' => 'required|alpha',
                
        );


        $validation = Validator::make($data, $rules);

        if($validation->passes()) {
            $licenseRegister = new licenseRegister;
            $id = Auth::id();
            $licenseRegister->id = $id;
            $licenseRegister->name = $data['name'];
            $licenseRegister->address = $data['address'];
            $licenseRegister->nationality = $data['nationality'];
            $licenseRegister->gender = $data['gender'];
            $licenseRegister->birth = $data['birth'];
            $licenseRegister->height = $data['height'];
            $licenseRegister->weight = $data['weight'];
            $licenseRegister->telNo = $data['telNo'];
            $licenseRegister->TOA = $data['TOA'];
            $licenseRegister->TLA = $data['TLA'];
            $licenseRegister->DSA = $data['DSA'];
            $licenseRegister->EA = $data['EA'];
            $licenseRegister->bloodType = $data['bloodType'];
            $licenseRegister->donorBoolean = $data['donorBoolean'];
            $licenseRegister->civilStatus = $data['civilStatus'];
            $licenseRegister->hair = $data['hair'];
            $licenseRegister->eyes = $data['eyes'];
            $licenseRegister->built = $data['built'];
            $licenseRegister->complexion = $data['complexion'];
            $licenseRegister->date = $data['date'];
            $licenseRegister->birthPlace = $data['birthPlace'];
            $licenseRegister->fatherName = $data['fatherName'];
            $licenseRegister->motherName = $data['motherName']; 
            \QrCode::format('png')->size(250)->generate("Name: ".$data['name']." Address: ".$data['address']." Date: ".$data['date']." Transaction: Register License", 'C:\qrcodes/registerLicense.'.$data['name'].'.png');
            $licenseRegister->qrcode = 'C:\qrcodes/registerlicense.'.$data['name'].'.png';
            $licenseRegister->save();


            return Redirect::to('/  ')
                ->with('flash_error', 'Successful')
                ->with('flash_color', '#0A819C');
        }
        else 

        {
            return Redirect::back()
                ->withErrors($validation)
                ->with('flash_error', 'Validation Errors!');
        }
    }

    public function RLtoPDF(){

        $id = Auth::id();
        
        $data = licenseRegister::where('id','=', $id)->get();
        foreach ($data as $data)



        $pdf = \App::make('dompdf.wrapper');
        $content = '<style type="text/css">
                    .form-style-6{
                        font: 85% Arial, Helvetica, sans-serif;
                        max-width: 800px;
                        margin: 5px auto;
                        padding: 10px;
                        background: #F7F7F7;    
                    }
                    .form-style-6 h1{
                        background: #43D1AF;
                        padding: 20px 0;
                        font-size: 120%;
                        font-weight: 300;
                        text-align: center;
                        color: #fff;
                        margin: -13px -13px 13px -13px;
                    }   
                    .form-style-6 ul{
                        padding:0;
                        margin:0;
                        list-style:none;
                    }
                    .form-style-6 ul li{
                        display: block;
                        margin-bottom: 10px;
                        min-height: 35px;
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
                        <li>Name: '.$data->name.' 
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;
                        Present Address: '.$data->address.' </li>

                        <li>Nationality: '.$data->nationality.'
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;
                        Gender: '.$data->gender.'</li>
                          

                        <li>Birthday: '.$data->birth.'
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        Height: '.$data->height.'</li>

                        <li>Weight: '.$data->weight.' 
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        Tel/Cp No: '.$data->telNo.' </li>
                        

                        <li>Type of Application(TOA): '.$data->TOA.' 
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        Type of License Applied for(TLA): '.$data->TLA.'</li>

                        <li>Driving Skill Acquired or Will be Acquired Thru(DSA): '.$data->DSA.' 
                           
                        <li>Educational Attainment(EA): '.$data->EA.' </li>
                        

                        <li>Blood Type: '.$data->bloodType.'
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        Organ Donor?: '.$data->donorBoolean.'</li>

                        <li>Civil Status: '.$data->civilStatus.' 
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;
                        Hair: '.$data->hair.' </li>
                        

                        <li>Eyes: '.$data->eyes.'
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        Built: '.$data->built.' </li>

                        <li>Complexion: '.$data->complexion.' 
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;
                        Birt Place: '.$data->birthPlace.' </li>
                        

                        <li>Fathers Name: '.$data->fatherName.' 
                        <li>Mothers Name: '.$data->motherName.' 
                        <li>Date Filed: '.$data->date.'
                        
                 <center><h3>Your QR Code:</h3><img src='.$data->qrcode.'>
                </body>
                </html>';

        
        

        $pdf->loadHTML($content);
        return $pdf->stream();  


    }

  


}