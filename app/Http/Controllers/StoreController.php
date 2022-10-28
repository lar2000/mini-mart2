<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Store;

class StoreController extends Controller
{
    //

    public function index(){
        ///$store = Store::orderBy('created_at','asc')->select('id', 'name', 'price_buy', 'price_sell')->get();
        
        //$store = Store::orderBy('created_at','asc')->get();
        //return $store;
        $search = \Request::get('s');
        $store = Store::orderBy('created_at','asc')
        ->where('name','LIKE',"%{$search}%")
        ->paginate(5)
        ->toArray();
        return array_reverse($store);
    }

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

    public function edit($id){
        $store = Store::find($id);
        return response()->json($store);
    }

    public function update($id,Request $request){

        try {
       
            $store = Store::find($id);
            $store->update([
                'name' => $request->name,
                'amount' => $request->amount,
                'price_buy' => $request->price_buy,
                'price_sell' => $request->price_sell,
            ]);

            $success = true;
            $message = "ອັບເດດຂໍ້ມູນ ສຳເລັດ";

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
    public function delete($id){

        try {
       
            $store = Store::find($id);
            $store->delete();

            $success = true;
            $message = "ລຶບຂໍ້ມູນ ສຳເລັດ";

           // $success = false;
           // $message = "ບໍ່ສຳເລັດ";

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
