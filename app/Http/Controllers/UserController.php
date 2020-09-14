<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\Bill;
use App\Models\User;
use App\Utils\JwtGenerate;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function index(Request $request)
    {
        $owner = (new JwtGenerate())->getOwnerToken($request);
        $user = $this->user->find($owner);
        if($user){
                return response()->json(['User' => $user->makeHidden(['id', 'password'])], 200);
        }else{
            return response()->json(['ERROR' => ['MESSAGE' => 'USER NOT FOUND']], 404);
        }
    }

    public function create(UserRequest $request)
    {

        $owner = (new JwtGenerate())->getOwnerToken($request);

        $adm = $this->user->where('email', 'adm@adm.com')->first();

        if($owner != $adm->id){
            return response()->json(['ERROR' => ['MESSAGE' => 'ONLY THE ADMINISTRATOR CAN REGISTER NEW USERS']], 403);
        }

        $user = $this->user->create($request->all());
        if($user){
            return response()->json(['SUCCESS' => ['MESSAGE' => "THE USER WAS CREATED SUCCESSFULLY"]], 200);
        }else{
            return response()->json(['SUCCESS' => ['MESSAGE' => "ERROR WHEN REGISTERING USER"]], 500);
        }
    }

    public function remove($id, Request $request)
    {
        $owner = (new JwtGenerate())->getOwnerToken($request);

        if($id != $owner){
            return response()->json(['ERROR' => ['MESSAGE' => "THIS USER DON'T HAVE PERMISSION TO ACCESS THIS DATA"]], 403);
        }
        $adm = $this->user->where('email', 'adm@adm.com')->first();
        if($id == $adm->id){
            return response()->json(['ERROR' => ['MESSAGE' => "THE ADMINISTRATOR USER CANNOT BE REMOVED"]], 400);
        }

        $user = $this->user->find($id);

        if($user){
            $bills = Bill::where('user_id', $user->id)->get();
            foreach ($bills as $bill){
                $bill->delete();
            }
            $action = $user->delete();
            if($action){
                return response()->json(['SUCCESS' => ['MESSAGE' => "SUCCESSFULLY REMOVED USER"]], 200);
            }else{
                return response()->json(['ERROR' => ['MESSAGE' => "ERROR WHEN REMOVING THE USER"]], 500);
            }
        }else{
            return response()->json(['ERROR' => ['MESSAGE' => "USER NOT FOUND"]], 404);
        }
    }

    public function update($id, Request $request)
    {

        $owner = (new JwtGenerate())->getOwnerToken($request);

        if($id != $owner){
            return response()->json(['ERROR' => ['MESSAGE' => "THIS USER DON'T HAVE PERMISSION TO ACCESS THIS DATA"]], 403);
        }

        if($id == 1){
            return response()->json(['ERROR' => ['MESSAGE' => "THE ADMINISTRATOR USER CANNOT BE UPDATED"]], 400);
        }

        if($request->email){
            return response()->json(['ERROR' => ['MESSAGE' => "EMAIL CAN'T BE CHANGE"]], 400);
        }

        $user = $this->user->find($id);
        if($user){
            $action = $user->update($request->all());
            if($action){
                return response()->json(['SUCCESS' => ['MESSAGE' => "SUCCESSFULLY UPDATED USER"]], 200);
            }else{
                return response()->json(['ERROR' => ['MESSAGE' => "ERROR UPDATING USER"]], 500);
            }
        }else{
            return response()->json(['ERROR' => ['MESSAGE' => "USER NOT FOUND"]], 404);
        }
    }

    public function generateAdmUser()
    {
        $user = $this->user->where('email', 'adm@adm.com')->first();
        if($user){
            return response()->json(['ERROR' => ['MESSAGE' => "THE ADMINISTRATOR USER IS ALREADY REGISTERED"]], 400);
        }else{
            $action = $this->user->create([
                'email' => 'adm@adm.com',
                'name' => 'ADMINISTRATOR',
                'password' => '123456'
            ]);

            if($action){
                return response()->json(['ERROR' => ['MESSAGE' => "THE ADMINISTRATOR USER HAS BEEN SUCCESSFULLY REGISTERED"]], 200);
            }else{
                return response()->json(['ERROR' => ['MESSAGE' => "ERROR WHEN REGISTERING THE ADMINISTRATOR"]], 500);
            }
        }
    }
}
