<?php

namespace App\Http\Controllers;

use App\Http\Requests\BillRequest;
use App\Models\Bill;
use App\Utils\JwtGenerate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BillController extends Controller
{
    private $bill;

    public function __construct(Bill $bill)
    {
        $this->bill = $bill;
    }

    public function index(Request $request)
    {
        $owner = (new JwtGenerate())->getOwnerToken($request);
        $bills = $this->bill->where('user_id', $owner)->paginate(5);
        return response()->json($bills);
    }

    public function show($id, Request $request)
    {
        $bill = $this->bill->find($id);

        $owner = (new JwtGenerate())->getOwnerToken($request);

        if($bill){
            if($bill->user_id != $owner){
                return response()->json(['ERROR' => ['MESSAGE' => "THIS USER DON'T HAVE PERMISSION TO ACCESS THIS DATA"]], 403);
            }

            return response()->json($bill);

        }else{
            return response()->json(['ERROR' => ['MESSAGE' => "BILL NOT FOUND"]], 404);
        }
    }

    public function create(BillRequest $request)
    {
        $owner = (new JwtGenerate())->getOwnerToken($request);

        if($request->user_id != $owner){
            return response()->json(['ERROR' => ['MESSAGE' => "THIS USER DON'T HAVE PERMISSION TO ACCESS THIS DATA"]], 403);
        }

        $due = date($request->due);
        $now = date('Y-m-d');

        if($request->due >= $now){
            $status = 1;
        }else{
            $status = 2;
        }

        $bill = $this->bill->create(
            [
                'user_id' => $request->user_id,
                'status' => $status,
                'due' => $due,
                'url' => $request->url
            ]
        );

        if($bill){
            return response()->json(['SUCCESS' => ['MESSAGE' => "THE BILL HAS BEEN SUCCESSFULLY SAVED"]], 200);
        }else{
            return response()->json(['ERROR' => ['MESSAGE' => "ERROR SAVING BILL"]], 500);
        }
    }

    public function update($id, Request $request)
    {
        $bill = $this->bill->find($id);
        if($bill){
            $owner = (new JwtGenerate())->getOwnerToken($request);
            if($owner != $bill->user_id){
                return response()->json(['ERROR' => ['MESSAGE' => "BILL DOES NOT BELONG TO THE AUTHENTICATED USER"]], 403);
            }

            if($request->has('user_id')){
                return response()->json(['ERROR' => ['MESSAGE' => "user_id CANNOT BE CHANGED"]], 400);
            }

            if($request->has('status')){
                return response()->json(['ERROR' => ['MESSAGE' => "STATUS CANNOT BE CHANGED DIRECTLY, CHANGE THE DUE OR APPROVE PAYMENT BY THE CORRECT ROUTE"]], 400);
            }

            if($request->has('dt_payment')){
                return response()->json(['ERROR' => ['MESSAGE' => "PAYMENT DATE CANNOT BE CHANGED DIRECTLY, CHANGE THE DUE OR APPROVE PAYMENT BY THE CORRECT ROUTE"]], 400);
            }

            $data = [];

            if($request->has('url')){
                Validator::make($request->all(), [
                    'url' => 'unique:bills'
                ])->validate();
            }

            if($bill->status == 3){
                return response()->json(['ERROR' => ['MESSAGE' => "THIS BILL ALREADY HAS HIS PAYMENT APPROVED. YOUR DATA CANNOT BE CHANGED"]], 400);
            }

            if($request->has('due')){

                $due = date($request->due);
                $now = date('Y-m-d');

                if($due >= $now){
                    $data = ['status' => 1];
                }else{
                    $data = ['status' => 2];
                }
            }

            foreach ($request->all() as $key => $value){
                $data += [$key => $value];
            }

            $action = $bill->update($data);
            if($action){
                return response()->json(['ERROR' => ['MESSAGE' => "BILL UPDATED SUCCESSFULLY"]], 200);
            }else{
                return response()->json(['ERROR' => ['MESSAGE' => "THERE WAS AN ERROR UPDATING THE BILL'"]], 500);
            }
        }else{
            return response()->json(['ERROR' => ['MESSAGE' => "BILL NOT FOUND"]], 404);
        }
    }

    public function remove($id, Request $request)
    {
        $bill = $this->bill->find($id);
        if($bill){
            $owner = (new JwtGenerate())->getOwnerToken($request);
            if($owner != $bill->user_id){
                return response()->json(['ERROR' => ['MESSAGE' => "BILL DOES NOT BELONG TO THE AUTHENTICATED USER"]], 403);
            }
            $action = $bill->delete();
            if($action){
                return response()->json(['SUCCESS' => ['MESSAGE' => "BILL REMOVED SUCCESSFULLY"]], 200);
            }else{
                return response()->json(['ERROR' => ['MESSAGE' => "THERE WAS AN ERROR REMOVING THE BILL'"]], 500);
            }
        }else{
            return response()->json(['ERROR' => ['MESSAGE' => "BILL NOT FOUND"]], 404);
        }
    }

    public function approvePayment($id, Request $request)
    {
        $bill = $this->bill->find($id);
        if($bill){
            $owner = (new JwtGenerate())->getOwnerToken($request);
            if($owner != $bill->user_id){
                return response()->json(['ERROR' => ['MESSAGE' => "BILL DOES NOT BELONG TO THE AUTHENTICATED USER"]], 403);
            }

            if($bill->status != 3){
                $now = date('Y-m-d');
                $action = $bill->update([
                    'status' => 3,
                    'dt_payment' => $now
                ]);
                if($action){
                    return response()->json(['SUCCESS' => ['MESSAGE' => "SUCCESSFULLY APPROVED PAYMENT"]], 200);
                }else{
                    return response()->json(['ERROR' => ['MESSAGE' => "ERROR WHEN APPROVING PAYMENT"]], 500);
                }
            }else{
                return response()->json(['ERROR' => ['MESSAGE' => "THIS BILL HAS ALREADY PAID"]], 403);
            }
        }else{
            return response()->json(['ERROR' => ['MESSAGE' => "BILL NOT FOUND"]], 404);
        }
    }
}
