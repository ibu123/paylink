<?php
use Twilio\Rest\Client;

if (!function_exists('sendOTP')) {
    function sendOTP($phone_no)
    {

        try {
               $twilio = new Client(
                env('TWILIO_API_LIVE_KEY'),
                env('TWILIO_API_LIVE_TOKEN')
            );

            $verification = $twilio->verify->v2->services(env('TWILIO_SERVICE_ID'))
                                    ->verifications
                                    ->create(
                                        $phone_no,
                                        "sms"
                                    );

            if (!empty($verification->status) && $verification->status == "pending") {
                return true;
            }
            return false;
        } catch (Exception $e) {
            return false;
        }
    }
}


if (!function_exists('verifyOTP')) {
    function verifyOTP($otp, $phone_no)
    {
        try {
            $twilio = new Client(
                env('TWILIO_API_LIVE_KEY'),
                env('TWILIO_API_LIVE_TOKEN')
            );


            $verification_check = $twilio->verify->v2->services(
                env('TWILIO_SERVICE_ID')
            )
            ->verificationChecks
            ->create(
                [
                    "code" => $otp,
                    "to" => $phone_no
                ]
            );

            if ($verification_check->status == "approved") {
                return true;
            } else {
                return false; // invalid otp
            }
        } catch (Exception $e) {
            return false;
        }
    }
}
