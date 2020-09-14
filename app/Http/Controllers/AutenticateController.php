<?php

namespace App\Http\Controllers;

use App\Http\Requests\AutenticateRequest;
use App\Models\User;
use Illuminate\Http\Request;
use App\Utils\JwtGenerate;

class AutenticateController extends Controller
{
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function login(AutenticateRequest $request)
    {
        $user = $this->user->where('email', $request->email)->where('password', $request->password)->first();
        if($user){
            $token = (new JwtGenerate())->generate($user->id);
            return response()->json(['Token' => $token], 200);
        }else{
            return response()->json(['ERROR' => ['MESSAGE' => 'INVALID EMAIL OR PASSWORD']], 403);
        }
    }
}
