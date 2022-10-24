<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Store;

class StoreController extends Controller
{
    //

    public function add(Request $request){
        try {
            
            $store = new Store();

            $store->name = $request->name;
            $store->amount = $request->amount;
            $store->price_buy = $request->price_buy;
            $store->price_sell = $request->price_sell;
            $store->save();

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
