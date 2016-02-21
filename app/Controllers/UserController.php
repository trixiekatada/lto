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



class userController extends Controller
{

    //Register Vehicle
    public function vehicleRegisterView()
    {
        return view('pages.registerV');
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
            $vehicleRegister->save();

            return Redirect::to('/intopdf')
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
        $data = Users::find(5);
        
        // dd($data);

        $pdf = \App::make('dompdf.wrapper');
        $content = '<!DOCTYPE html>
                    <html>
                    <head>
                    <title>MQues</title>
                    </head>
                    <body>
                    <table witdh="1500px" border="0.02px">
                    <tr>
                    <td></td>
                    <td > TO: MV INSPECTOR- THIS FORM WILL BE USED AS<BR/> A SOURE DOCUMENT IN COMPUTERIZATION <BR/>FILL UP COMPLETELY AND ACCURATELY IN INK.</td>
                        <TD >MOTOR VEHICLE <BR/> INSPECTION REPORT</TD>
                        <TD > <</TD>
                    </tr>
                <tr ><td></td><td >OWNERSHIP AND DOCUMENTATION</td><td></td><td></td></tr>
                        <tr><td >Owners Complete Name: '.$data->name.' </td>
                        <td > Address: '.$data->address.' </td>
                        <td > Agency: '.$data->agency.' </td>
                        <td > Date: '.$data->date.' </td>
                        </tr></td>  

                    <tr>
                        <td >ACQUIRED FROM
                        <td  >Authorized Agency(For Hire Only):'.$data->authAgency.'</td>
                        <td > File Number: '.$data->fileNumber.' </td>
                        <td></td>
                        <TR>
                            <TD  >Name: '.$data->AcqName.'<br> <br>Address: '.$data->AcqAddress.'</TD>
                            <td >Type Of Registration: 
                            <br>
                            '.$data->registrationType.'
                            </td>
                            <td >MVRR Number(Latest): '.$data->MVRRNo.'</td>
                            <td >CHPG Control Number: '.$data->CHPGNo.'</td>
                        </TR>
                        <tr>
                            <td >INCUMBRANCE
                        <td  >Certificate of payment number (C.P): '.$data->CertPaymentNo.'</td>
                        <td > Informal Entry Number (I.E): '.$data->inEntryNo.' </td>
                        <td></td>
                        </tr>
                        <tr>
                            <TD  >Name: '.$data->enName.'<<br> <br>Address: '.$data->enAddress.'</TD>
                            <td >Insurer: '.$data->insurer.'</td>
                            <td >Policy Number: '.$data->policyNumber.'</td>
                            <td></td>
                        </tr>
                        <TR>
                            <td >Kind Of Vehicle:
                            <br>
                            '.$data->kindOfVehicle.'
                            
                            <td >Expiry Date: '.$data->expiryDate.'</td>
                            <td >Cert. of Cover No.: '.$data->certOfCoverNo.'</td>
                            <td >Endorsement No.: '.$data->endorsementNo.'</td>
                        </TR>
                        <tr>
                            
                                <td >Date of Endorsement: '.$data->dateOfEndorsement.'</td>
                                <td >Amount Of Coverage
                                <td >PL <br>P '.$data->AmountCoveragePL.'</td>
                                <td >TPL <br>P'.$data->AmountCoverageTPL.'</td>
                            
                        </tr>
                        
                
                <tr ><td></td><td >IDENTIFICATION AND INSPECTION</td><td></td><td></td></tr>
                        <tr><td >classification: '.$data->classification.' </td>
                        <td > Make Brand: '.$data->make_brand.' </td>
                        <td > Plate No: '.$data->plateNo.' </td>
                        <td > Fuel Type: '.$data->fuelType.' </td>
                        </tr></td>  

                    <tr>
                        <td >Motor Number: '.$data->motorNo.'</td>
                        <td  >Serial/Chassis No:'.$data->serial_chassisNo.'</td>
                        <td > Series: '.$data->series.' </td>
                        <td>Type of Body: '.$data->typeOfBody.'</td>
                        <TR>
                            <td >Type of Body: '.$data->typeOfBody.'</td>
                            <td >No Of Door: '.$data->noOfDoor.'</td>
                            <td>Year Model: '.$data->yearModel.'</td>
                            <td></td>
                        </TR>
                        <tr>
                                <td>
                                <td >I HEREBY NOTIFY THAT ALL INFORMATION AND STENCIL BELOW ARE TRUE AND CORRECT.
                                <td >INPECTORS PRINTED NAME AND SIGNATURE</td>
                                <TD></TD>
                            
                        </tr>

                        </td>
                    </tr>
                        </td>
                    </tr>
                </table>
                </body>
                </html>';
        $pdf->loadHTML($content);
        return $pdf->stream(); 

    }

    // Register License

    public function licenseRegisterView()
    {
        return view('pages.registerL');
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
            $licenseRegister->birthPlace = $data['birthPlace'];
            $licenseRegister->fatherName = $data['fatherName'];
            $licenseRegister->motherName = $data['motherName'];
            $licenseRegister->save();

            return Redirect::to('/intopdfRL')
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
        $data = Users::find(5);
        
        // dd($data);

        $pdf = \App::make('dompdf.wrapper');
        $content = '<!DOCTYPE html>
                    <html>
                    <head>
                    <title>MQues</title>
                    </head>
                    <body>
                    <table witdh="1500px" border="0.02px">
                    <tr>
                    <td></td>
                    <td > INSTRUCTIONS</br>1.Accomplish the form correctly<BR/> 2.Print data legibly in capital letters <BR/>3.Submit this form to CSR/EVALATOR together with the required supporting documents</td>
                        <TD >APPLICATION FOR <BR/> DRIVER'."'".'S LICENSE</TD>
                        <TD > </TD>
                    </tr>
                        <tr><td > Name: '.$data->name.' </td>
                        <td >Present Address: '.$data->address.' </td>
                        <td >Nationality: '.$data->nationality.' </td>
                        <td >Gender: '.$data->gender.' </td>
                        </tr></td>  

                        <tr><td > Birthday: '.$data->birth.' </td>
                        <td >Height: '.$data->height.' </td>
                        <td >Weight: '.$data->weight.' </td>
                        <td >Tel/Cp No: '.$data->telNo.' </td>
                        </tr></td>

                        <tr><td > Type of Application(TOA): '.$data->TOA.' </td>
                        <td >Type of License Applied for(TLA): '.$data->TLA.' </td>
                        <td >Driving Skill Acquired or Will be Acquired Thru(DSA): '.$data->DSA.' </td>
                        <td >Educational Attainment(EA): '.$data->EA.' </td>
                        </tr></td>

                        <tr><td >Blood Type: '.$data->bloodType.' </td>
                        <td >Organ Donor?: '.$data->donorBoolean.' </td>
                        <td >Civil Status: '.$data->civilStatus.' </td>
                        <td >Hair: '.$data->hair.' </td>
                        </tr></td>

                        <tr><td >Eyes: '.$data->eyes.' </td>
                        <td >Built: '.$data->built.' </td>
                        <td >Complexion: '.$data->complexion.' </td>
                        <td >Birt Place: '.$data->birthPlace.' </td>
                        </tr></td>

                        <tr><td > Fathers Name: '.$data->fatherName.' </td>
                        <td >Mothers Name: '.$data->motherName.' </td>
                        <td >THIS IS TO CERTIFY THAT THE INFORMATION ABOVE I GIVEN IS TRUE AND CORRECT</td>
                        <td ></td>
                        </tr></td>
                        </td>
                    </tr>
                </table>
                </body>
                </html>';
        $pdf->loadHTML($content);
        return $pdf->stream(); 

    }


    public function generateQR(){
       // \QrCode::generate('Sample ', '../public/images/qrcodes/qrcode.svg');
        \QrCode::format('png')->size(250)->generate("https://facebook.com/rheageonzon", '../public/images/qrcodes/sample.png');

   }

   public function doSession()
    {
        $data = Request::all();

        Session::put('key', $data['email']);
    }

    public function getSession()
    {

        $value = Session::get('key');
        //$data = Users::where('email','=', $value)->get();


       echo $value;
       // echo $data;
    }



}