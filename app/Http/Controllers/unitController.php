<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\vehicleRegister;
use App\licenseRegister;
use App\Libern\QRCodeReader\QRCodeReader;
use App\Users;
use App\Validator;
use App\Http\Controllers\DB;
use App\Transactions;
use App\ClientInfo;
use Session;
use Input;


class UnitController extends Controller
{
public function viewHome()
{
    return view('pages.scanner');
}
public function viewTransaction()
{
    $id = Input::get('id');
    $transaction = Transactions::find($id);
    return view('pages.transaction',compact('transaction'));
}

public function printData(){

	 $datas = Transactions::find(5)->get();
       
        foreach ($datas as $data_variables)

        $data = $data_variables->getAttributes();

        $pdf = \App::make('dompdf.wrapper');
        $content = '<!DOCTYPE html> 
                    <html>
                    <head>
                    <title>MQues</title>
                    </head>
                    <body>
                    <h1 align="center">OHLAAA</h1>
                    <table>
                    <tr>
                    	<td>NAME: '.$data['name'].' </td>
                   	</tr>
                   	<tr>
                    	<td>ADDRESS: '.$data['address'].' </td>
                   	</tr>
                   	<tr>
                    	<td>DATE: '.$data['date'].' </td>
                   	</tr>
                   	 <tr>
                   	 	<td>TRANSACTION TYPE: '.$data['transactionType'].'</td>
                   	</tr>
                   	<tr>
                    	<td><h3 align="center">PRIORITY NUMBER: 1</h3></td>
                   	</tr>




                    </table>
                    
                    
                </body>
                </html>';

        
        

        $pdf->loadHTML($content);
        return $pdf->stream(); 



}
     
public function QRCodeReader(Request $request){


  //$QRCodeReader = new \Libern\QRCodeReader\QRCodeReader();
  //$qrcode_text = $QRCodeReader->decode(public_path() . "/img/qrcodes/registerLicense/liscense.rheageonzon.png");;
  //echo $qrcode_text;

	$data = $request['data'];
 	$test = explode("," , $data);
	// print_r(explode(' ', $qrcode_text, -1));
 	// return response()->json($test,200);	
 // 	echo $test[1];
 // 	echo $test[3];
 // 	echo $test[5];
 // 	echo $test[7];
 // 	echo $test[9];
 	foreach ($test as $key => $value) {
 		$value = str_replace(' ', '', $value);
 		$key = str_replace(' ', '', $key);
 		$test[$key] = explode(':', $value);
 	}

 	//return response()->json($test,200);

 			$queue = Session::get('queue');

 			if($queue<=150){
				$queue++;
				Session::put('queue',$queue);
 			}
 			else{

 			}

 			//var_dump($test);

 			$transactionID = $test[4][1].'_'.$queue;
 			

            $transaction = new Transaction;
            $transaction->transactionID = $transactionID;
            $transaction->transactionType = $test[4][1];
            $transaction->name = $test[1][1];
            $transaction->address = $test[2][1];
            $transaction->date = $test[3][1];
            $transaction->priorityID = $queue;
            $transaction->id = $test[0][1]; 
       
            $transaction->save();


            return response()->json(['id' => $transaction->id],200);
                
      

	}
 }
