<?php

namespace App\Services;

use Exception;
use Illuminate\Support\Facades\Http;

class OTPSend
{
    private $base_url = 'https://cpaas.messagecentral.com';
    private $auth_token = NULL, $email = "rashadrashad607@gmail.com", $password = "Rashad@1998";

    private $customerId = "C-1D1F95143293479";


    public function __construct()
    {




    }

    public function generateAuthToken()
    {
        $url = $this->base_url . '/auth/v1/authentication/token';
        $params = [
            'country' => 'IN',
            'customerId' => $this->customerId,
            'email' => $this->email,
            'key' => base64_encode($this->password),
            'scope' => 'NEW',
        ];

        $request = $this->createRequest('get', $url, $params, true);

        if ($request->status() == 200) {

            $response = $request->collect();
            $this->auth_token = $response['token'];

        }

    }

    public function sendOTP($dialCode, $mobile)
    {

        if ($this->auth_token == NULL) {

            $this->generateAuthToken();
        }


        $url = $this->base_url . '/verification/v2/verification/send';
        $params = [
            'countryCode' => $dialCode,
            'customerId' => $this->customerId,
            'flowType' => 'SMS',
            'mobileNumber' => $mobile,
        ];

        $request = $this->createRequest('post', $url, $params);

        $response = $request->collect();
        if ($response['responseCode'] == 200) {
            $verificationId = $response['data']['verificationId'];
            session()->forget('otp_session');
            $otp_session = ['verifyId' => $verificationId, 'mobile' => $mobile, 'dial_code' => $dialCode];
            session()->put('otp_session', $otp_session);

            return true;

        }

        return false;


    }

    public function verifyOTP($dialCode, $mobile, $verificationId, $otpCode)
    {


        $flag = 1;
        if ($this->auth_token == NULL) {

            $this->generateAuthToken();
        }


        $url = $this->base_url . '/verification/v2/verification/validateOtp';
        $params = [
            'countryCode' => $dialCode,
            'mobileNumber' => $mobile,
            'verificationId' => $verificationId,
            'customerId' => $this->customerId,
            'code' => $otpCode,
        ];

        $request = $this->createRequest('get', $url, $params);

        $response = $request->collect();



        if ($response['responseCode'] == 200) {


            if ($response['data']['responseCode'] == 200) {
                $flag = 2;
            }
        } elseif ($response['responseCode'] == 703) {
            $flag = 2;



        }
        if ($flag == 2) {
            return true;
        } else {

            return false;
        }
    }

    private function createRequest($method, $url, $params, $tokenG = false)
    {


        $url = $url . '?' . http_build_query($params);

        if ($tokenG == true) {

            $response = Http::$method($url, $params);

        } else {
            $response = Http::withHeaders(['authToken' => $this->auth_token])->$method($url, $params);

        }





        return $response;
    }
}
