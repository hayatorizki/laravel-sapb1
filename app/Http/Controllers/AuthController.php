<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Cookie;
use GuzzleHttp\Psr7;
use GuzzleHttp\Exception;
use Session;
class AuthController extends Controller
{
   
    public function index()
    {
        if(!empty(session()->get('cookies'))){
            return redirect('/');
        }else{
            return view('login');
        }
        
    }

    public function login(Request $request)
    {
        // End point
        $ep = 'Login';
        // Request
        $obj = [ 'json' => [
            'CompanyDB' => env('SL_DB'),
            'Password' => $request->password,
            'UserName' => $request->username
            ]
        ];
        $client = new Client();
        try {
            
            $res = $client->post(env('SL_URL').env('SL_PATH').$ep,$obj);
            if($res){
                $stream = $res->getBody();
                $contents = json_decode($stream->getContents());
                // dd($contents);
                if(!empty($contents->error->code)){
                    $request->session()->flash('message', 'Wrong Credential');
                   
                    return redirect()->guest('login');
                }else{
                    $headers = $res->getHeaders();
                    
                    $sessionId = $contents->SessionId;
            
                    $cookie = $headers["Set-Cookie"];
                    $routeId = substr($cookie[1],8,6);
            
                    $cookies = "B1SESSION=" . $sessionId . "; ROUTEID=" . $routeId . ";";
                    $request->session()->flush();
                    $request->session()->put(
                                                [
                                                    'cookies' => $cookies,
                                                    'UserName' => $obj['json']['UserName'],
                                                    'CompanyDB' => $obj['json']['CompanyDB']
                                                ]
                                            );
                    return redirect('/');
                }
            }
            
            
        } catch (Exception\ConnectException $e) {
            
            $error['error'] = $e->getMessage();
            $request->session()->flash('message', 'Connection Failure');
            return redirect()->guest('login');
        }
       
    }
    public function logout(Request $request)
    {
        $ep = 'Logout';
        echo session()->get('cookies');
        $client = new Client();
        try{
            $res = $client->post(env('SL_URL').env('SL_PATH').$ep,['headers' => ['cookie' => session('cookies')]]);
            $stream = $res->getBody();
            $contents = json_decode($stream->getContents());
            $request->session()->flush();
            return redirect('/login');
            
        }catch(Exception\ConnectException $e){
            $error['error'] = $e->getMessage();
            dump($error['error']);
        }
        
    }

}
