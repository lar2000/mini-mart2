<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Transection;
use App\Models\Store;

class TransectionController extends Controller
{
    //

    public function index(Request $request){

        $monthtype = $request->monthtype;
        $date = $request->dmy;

        if($request->dmy==''){
                    $tran = Transection::orderBy('created_at', 'desc')
                    ->paginate(10)
                    ->toArray();
                    return array_reverse($tran);
        } else {
            $m = explode('-',$date)[1];
            $y = explode('-',$date)[0];
    
                if($monthtype=='m'){
                    $tran = Transection::whereYear('created_at', '=', $y)->whereMonth('created_at', '=', $m)->orderBy('created_at', 'desc')
                    ->paginate(10)
                    ->toArray();
                    return array_reverse($tran);
                }else if($monthtype=='y'){
                    $tran = Transection::whereYear('created_at', '=', $y)->orderBy('created_at', 'desc')
                    ->paginate(10)
                    ->toArray();
                    return array_reverse($tran);
                }
            }
    }

    public function add(Request $request){
        try {

            foreach($request->listorder as $item){
               // echo $item['name']." - ";
                
               $number = 1;

               $tran = Transection::all()->sortByDesc('id')->take(1)->toArray();
               foreach($tran as $new){
                    $number = $new['tran_id'];
               }

               if($number!=''){
                    $number1 = str_replace("INC","",$number);
                    $number2 = str_replace("EXP","",$number1);
                    $number = (int)$number2+1;
                    $length = 5;
                    $number = substr(str_repeat(0, $length).$number, - $length);
               }

               if($request->acc_type == 'income'){ $tnum = "INC"; }
               elseif($request->acc_type == 'expense'){ $tnum = "EXP"; }

               $transection = new Transection();
               $transection->tran_id = $tnum.$number;
               $transection->product_id = $item['id'];
               $transection->tran_type = $request->acc_type;
               $transection->tran_detail = $item['name'];
               $transection->amount = $item['order_amount'];
               $transection->price = $item['order_amount']*$item['price_sell'];
               $transection->save();

               // ທຳການຕັດສະຕ໋ອກ
               $store = Store::find($item['id']);
               $store_update = Store::where('id',$item['id']);
               $store_update->update([
                'amount' => $store->amount - $item['order_amount']
               ]);



            }

  

            $success = true;
            $message = "ບັນທຶກຂໍ້ມູນ ສຳເລັດ";

        } catch (\Illuminate\Database\QueryException $ex) {
            $success = false;
            $message = $ex->getMessage();
        }

        $response = [
            "success" => $success,
            "message" => $message
        ];

        return response()->json($response);
    }
}
