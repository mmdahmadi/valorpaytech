<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Symfony\Contracts\Service\Attribute\Required;

class PaymentController extends Controller
{
    //Api is used to find the given api id and api key is valid or not
    public function validation(Request $request): bool|string
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://vt.isoaccess.com:4430",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => array(
                'app_id' => $request->app_id, // Mandatory
                'auth_token' => $request->auth_token, // Mandatory
                'auth_key' => $request->auth_key, // Mandatory
                'mtype' => 'validate', // Mandatory
                'epi' => '2002593306' // Optional
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return $response;
    }

    //Authonly transaction performs the authorization by getting the card number and other details, Settlement can be manually done on each transaction
    public function authOnly(Request $request)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://vt.isoaccess.com:4430",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => array(
                'app_id' => '464DA39FCFB44D54F6C1D22CEF9098E5', // Mandatory
                'auth_token' => '8E1DDE8DE369812732E88C583B14D0C4', // Mandatory
                'auth_key' => '15B8BCFDB337428792608354A1444050', // Mandatory
                'mtype' => '0100', // Mandatory
                'amount' => $request->amount, // Mandatory
                'pan' => $request->pan, // Mandatory
                'epi' => $request->epi, // Mandatory
                'cvv' => 998, // Optional
                'expiry_date' => 1225, // Optional
                'tip' => '', // Optional
                'custom_fee' => '1.00', // Optional
                'email' => 'rooban.renio072540@gmail.com', // Optional
                'surchargeIndicator' => '1', // Optional
                'uid' => '1234567890', // Optional
                'zip' => '11106', // Optional
                'address' => '3636 33rd st', // Optional
                'card_holder_name' => 'ABUBACKER N', // Optional
            ),

        ));

        $response = curl_exec($curl);

        curl_close($curl);
        echo $response;
    }

    //An authonly transaction may capture using this capture API
    public function capture(): bool|string
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://vt.isoaccess.com:4430/",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => array(
                'app_id' => '464DA39FCFB44D54F6C1D22CEF9098E5',
                'auth_token' => '8E1DDE8DE369812732E88C583B14D0C4',
                'auth_key' => '15B8BCFDB337428792608354A1444050',
                'mtype' => 'capture',
                'amount' => 12.34,
                'epi' => '2002593306',
                'tran_no' => '',
                'uid' => '1234567890',
                'rrn' => 127209502766,
                'auth_code' => '',
                'pos_entry_mod' => '',
                'stan' => ''
            )

        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return $response;
    }

    //Regular transaction request, charge the cardholder immediately as a part of auto / manual settlement
    public function sale(Request $request): bool|string
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://vt.isoaccess.com:4430",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => array(
                'app_id' => '464DA39FCFB44D54F6C1D22CEF9098E5', // Mandatory
                'auth_token' => '8E1DDE8DE369812732E88C583B14D0C4', // Mandatory
                'auth_key' => '15B8BCFDB337428792608354A1444050', // Mandatory
                'mtype' => '0200', // Mandatory
                'amount' => $request->amount, // Mandatory
                'pan' => $request->pan, // Mandatory
                'epi' => $request->epi, // Mandatory
                'card_holder_name' => 'ABUBACKER N',
                'address' => '3636 33rd st',
                'zip' => '11106',
                'tip' => '',
                'custom_fee' => '1.00',
                'surchargeIndicator' => '1', # 1 for Surcharge and 0 for No Surcharge merchant pricing plan
                'uid' => '1234567890',
            ),

        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return $response;

    }

    //Refund transaction, used to give money back to the cardholder
    public function refund(Request $request): bool|string
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://vt.isoaccess.com:4430",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => array(
                'app_id' => '464DA39FCFB44D54F6C1D22CEF9098E5', // Mandatory
                'auth_token' => '8E1DDE8DE369812732E88C583B14D0C4', // Mandatory
                'auth_key' => '15B8BCFDB337428792608354A1444050', // Mandatory
                'mtype' => 'refund', // Mandatory
                'amount' => $request->amount, // Mandatory
                'pan' => $request->pan, // Mandatory
                'epi' => $request->epi, // Mandatory
                'cvv' => 999,
                'uid' => '1234567890',
                'expirydate' => '1232',
                'cardholdername' => 'ABUBACKER N',
                'address' => '3636 33rd st',
                'token' => '04667314B75744CA6C32D8E83DAA8598E6CB2D38',
                'zip' => '11106',
                'tip' => '',
                'surchargeIndicator' => '1', # 1 for Surcharge and 0 for No Surcharge merchant pricing plan
                'custom_fee' => '1.00',
            ),

        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return $response;
    }

    public function epage()
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://securelinktest.valorpaytech.com:4430/",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => array(
                'app_id' => 'sNRSyL3LVmNv8whAglO0vIeXwWehf20H', // Mandatory
                'auth_token' => '8E1DDE8DE369812732E88C583B14D0C4', // Mandatory
                'auth_key' => 'AxR3Dwe9fqWZXo3hq46Ewi6DDo21lyHP', // Mandatory
                'txn_type' => 'sale',
                'amount' => '140.00',
                'tax' => '0.00',
                'surcharge' => '0.00',
                'epi' => '2017062586',
                'epage' => '1',
                'phone' => '7299554813',
                'email' => 'abu.4000@gmail.com',
                'invoice_no' => '004',
                'product' => 'MY PRODUCT',
                'descriptor' => 'my descriptor',
                'customer_name' => 'ABUBACKER'),

        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return $response;
    }
    public function verify()
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://vt.isoaccess.com:4430/",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => array(
                'app_id' => '464DA39FCFB44D54F6C1D22CEF9098E5',
                'auth_token' => '8E1DDE8DE369812732E88C583B14D0C4',
                'auth_key' => '15B8BCFDB337428792608354A1444050',
                'uid' => '1234567890',
                'mtype' => 'verify',
                'pan' => '4111111111111111',
                'expiry_date' => '1221',
                'epi' => '2002593306',
                'surchargeIndicator' => '1')

        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return $response;
    }


}

