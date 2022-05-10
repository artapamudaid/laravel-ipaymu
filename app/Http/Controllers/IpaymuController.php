<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class IpaymuController extends Controller
{
    public function singleProduct()
    {

        $product = Product::first();

        $payment_channel = "va|bri";

        $payment = explode("|", $payment_channel);

        $name   = 'Arta';
        $email  = 'ar.pamuda@gmail.com';
        $phone  = '083851378225';
        $paymentMethod = $payment[0];
        $paymentChannel = $payment[1];

        $va           = '0000003851378225'; //get on iPaymu dashboard
        $secret       = 'SANDBOXE38739E0-C35F-4E62-AA36-DF18A2DD9356-20220509140520'; //get on iPaymu dashboard


        $url          = 'https://sandbox.ipaymu.com/api/v2/payment/direct'; //url
        $method       = 'POST'; //method

        //Request Body//
        $body['name']    = $name;
        $body['email']   = $email;
        $body['phone']   = $phone;
        $body['amount']  = $product->price;
        $body['notifyUrl']   =  'https://mywebsite.com';
        $body['expired']   = '24';
        $body['expiredType']   = 'hours';
        $body['comments']   = 'Tagihan';
        $body['referenceId']   = '1';
        $body['paymentMethod']  = $paymentMethod;
        $body['paymentChannel']   = $paymentChannel;
        $body['description']   = 'Tagihan Pembayaran';
        //End Request Body//

        //Generate Signature
        // *Don't change this
        $jsonBody     = json_encode($body, JSON_UNESCAPED_SLASHES);
        // echo '<br>'. $jsonBody;
        $requestBody  = strtolower(hash('sha256', $jsonBody));
        $stringToSign = strtoupper($method) . ':' . $va . ':' . $requestBody . ':' . $secret;
        $signature    = hash_hmac('sha256', $stringToSign, $secret);
        $timestamp    = Date('YmdHis');
        //End Generate Signature


        $ch = curl_init($url);

        $headers = array(
            'Accept: application/json',
            'Content-Type: application/json',
            'va: ' . $va,
            'signature: ' . $signature,
            'timestamp: ' . $timestamp
        );

        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        curl_setopt($ch, CURLOPT_POST, count($body));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonBody);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        $err = curl_error($ch);
        $ret = curl_exec($ch);
        curl_close($ch);

        if ($err) {
            echo $err;
        } else {

            //Response
            $data = json_decode($ret);
            if ($data->Status == 200) {
                var_dump($data);
            } else {
                echo $ret;
            }
            //End Response
        }
    }
}
