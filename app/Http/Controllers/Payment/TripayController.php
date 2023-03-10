<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class TripayController extends Controller
{
    public function getPaymentChannels()
    {
        $apiKey = env('TRIPAY_API_KEY'); 
        $curl = curl_init();
        
        curl_setopt_array($curl, array(
            CURLOPT_FRESH_CONNECT  => true,
            CURLOPT_URL            => env('TRIPAY_URL') . 'merchant/payment-channel',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HEADER         => false,
            CURLOPT_HTTPHEADER     => ['Authorization: Bearer '.$apiKey],
            CURLOPT_FAILONERROR    => false
        ));
        
        $response = curl_exec($curl);
        $error = curl_error($curl);
        
        curl_close($curl);
        
        $response = json_decode($response)->data;
        return $response ? $response : $error;
    }
    

    public function requestTransaction($name, $amount, $quantity, $image, $method, $product_price, $fullname, $email, $phone)
    {
        $apiKey       = env('TRIPAY_API_KEY');
        $privateKey   = env('TRIPAY_PRIVATE_KEY');
        $merchantCode = env('TRIPAY_MERCHANT_CODE');
        $merchantRef  = 'PX-'. time();
        
        $data = [
            'method'         => $method,
            'merchant_ref'   => $merchantRef,
            'amount'         => $amount,
            'customer_name'  => $fullname,
            'customer_email' => $email,
            'customer_phone' => $phone,
            "return_url" => env('APP_URL') . '/success/' . $merchantRef,
            'order_items'    => [
                [
                    'name'        => $name,
                    'price'       => $product_price,
                    'quantity'    => $quantity,
                    'image_url'   => $image,
                ]
            ],
            'expired_time' => (time() + (24 * 60 * 60)), // 24 jam
            'signature'    => hash_hmac('sha256', $merchantCode.$merchantRef.$amount, $privateKey)
            ];
            
            $curl = curl_init();
            
            curl_setopt_array($curl, [
                CURLOPT_FRESH_CONNECT  => true,
                CURLOPT_URL            => env('TRIPAY_URL') . 'transaction/create',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_HEADER         => false,
                CURLOPT_HTTPHEADER     => ['Authorization: Bearer '.$apiKey],
                CURLOPT_FAILONERROR    => false,
                CURLOPT_POST           => true,
                CURLOPT_POSTFIELDS     => http_build_query($data)
            ]);
            
            $response = curl_exec($curl);
            $error = curl_error($curl);
            
            curl_close($curl);
            $response = json_decode($response)->data;
            
            return $response ? $response : $error;
    }

    
    public function detailTransaction($reference)
    {
        $apiKey = env('TRIPAY_API_KEY'); 
        
        $payload = ['reference'	=> $reference];
        
        $curl = curl_init();
        
        curl_setopt_array($curl, [
            CURLOPT_FRESH_CONNECT  => true,
            CURLOPT_URL            => env('TRIPAY_URL') . 'transaction/detail?'.http_build_query($payload),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HEADER         => false,
            CURLOPT_HTTPHEADER     => ['Authorization: Bearer '.$apiKey],
            CURLOPT_FAILONERROR    => false,
        ]);
        
        $response = curl_exec($curl);
        $error = curl_error($curl);
        
        curl_close($curl);
        if(json_decode($response)->success == true) {
            $response = json_decode($response)->data;
        }
        else {
            abort(404);
        }
        return $response ? $response : $error;   
    }
}