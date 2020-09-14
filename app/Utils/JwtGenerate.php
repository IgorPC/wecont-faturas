<?php

namespace App\Utils;

use Illuminate\Http\Request;
use Lcobucci\JWT\Builder;
use Lcobucci\JWT\Signer\Hmac\Sha256;
use Lcobucci\JWT\Signer\Key;
use function GuzzleHttp\json_decode;

class JwtGenerate
{
    public function generate($id)
    {
        $signer = new Sha256();
        $time = time();

        $token = (new Builder())
            ->withClaim('uid', $id)
            ->expiresAt($time + 3600)
            ->getToken($signer, new Key(env('JWT_SECRET')));
        return (string) $token;
    }

    public function getOwnerToken(Request $request)
    {
        $header = explode(' ', $request->header('Authorization'));
        $token = explode('.', $header[1]);
        $payload = $token[1];
        $payload = base64_decode($payload);
        $payload = json_decode($payload);
        return $payload->uid;
    }
}
