<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Http;

use Illuminate\Http\Request;

class smsController extends Controller
{


    function sendsms($device = 0, $schedule = null, $isMMS = false, $attachments = null, $prioritize = 1)
             {
               $url = 'https://al.geeks.com.pk/services/send.php';
               $postData = array(
               'number' => '+923151965317',
               'message' => 'chal chalein',
               'schedule' => $schedule,
               'key' => 'e1607d243a7c89c9b12201c257fc56d2767d7b17',
               'devices' => $device,
               'type' => $isMMS ? "mms" : "sms",
               'attachments' => $attachments,
               'prioritize' => $prioritize ? 1 : 0
                );
           $response = Http::get($url, $postData);
        
        
        if ($response->failed()) {
            throw new \Exception('Error sending SMS: ' . $response->status() . ' ' . $response->body());
        }
        
        $responseData = json_decode($response->body(), true);
        
        if (!isset($responseData['data']['messages'][0])) {
            throw new \Exception('Error sending SMS: invalid response');
        }
        
        return ["success" => true, "message" => $responseData['data']['messages'][0]];        
             }



   
}
