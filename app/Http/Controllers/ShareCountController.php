<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Sagautam5\SocialShareCount\ShareCounter;
class ShareCountController extends Controller
{
    public function shareCount()
    {
//       $url = 'https://www.facebook.com/namru.chaudhary';
//
//       $facebookShares = ShareCounter::getFacebookShares($url);
//       echo $facebookShares;
        return view('welcome');
    }

    function shareCountsPost(Request $request)
    {

        $url = $request->get('url');
//        dd($url);
        $access_token = '3571672523066674|3b3afcb4c2790a4010ee6b4488665712';
        $api_url = 'https://graph.facebook.com/v17.0/?id=' . urlencode($url) . '&fields=engagement&access_token=' . $access_token;

        $fb_connect = curl_init(); // initializing
        curl_setopt($fb_connect, CURLOPT_URL, $api_url);
        curl_setopt($fb_connect, CURLOPT_RETURNTRANSFER, 1); // return the result, do not print
        curl_setopt($fb_connect, CURLOPT_TIMEOUT, 20);
        $json_return = curl_exec($fb_connect); // connect and get json data
        curl_close($fb_connect); // close connection
        $body = json_decode($json_return);
        return intval($body->engagement->share_count);

   }


}
