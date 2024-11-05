<?php

use App\Helpers\RouterOS;
use App\Http\Middleware\SessionMiddleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
 * |--------------------------------------------------------------------------
 * | Web Routes
 * |--------------------------------------------------------------------------
 * |
 * | Here is where you can register web routes for your application. These
 * | routes are loaded by the RouteServiceProvider and all of them will
 * | be assigned to the "web" middleware group. Make something great!
 * |
 */

Route::get('/', function () {
        return redirect('/dashboard');
})->middleware(SessionMiddleware::class);

Route::get('/login', function () {
        return view('login');
});

Route::get('/logout', function () {
        session()->flush();
        return redirect('/login');
});

Route::get('/dashboard', function (Request $request) {
        $data = array('ip' => $request->session()->get('ip'));
        return view('dashboard', $data);
})->middleware(SessionMiddleware::class);

Route::get('/interface', function (Request $request) {
        $data = array('ip' => $request->session()->get('ip'));
        return view('interface', $data);
})->middleware(SessionMiddleware::class);

Route::get('/ipaddress', function (Request $request) {
        $data = array('ip' => $request->session()->get('ip'));
        return view('ipaddress', $data);
})->middleware(SessionMiddleware::class);

Route::post('/api/login-mikrotik', function (Request $request) {
        $ip = $request->input('ip');
        $username = $request->input('username');
        $password = $request->input('password');
        $port = $request->input('port');

        $API = new RouterOS();

        $API->debug = false;

        $data['result'] = false;
        if ($API->connect($ip, $username, $password, $port)) {
                $data['result'] = true;
                session(['ip' => $ip]);
        }
        echo json_encode($data);
});

Route::post('/api/get-interface', function (Request $request) {
        $API = new RouterOS();

        $API->debug = false;

        $ip = $request->input('ip');
        $username = $request->input('username');
        $password = $request->input('password');
        $port = $request->input('port');

        if ($API->connect($ip, $username, $password, $port)) {
                $API->write('/interface/print');

                $READ = $API->read(false);
                $ARRAY = $API->parseResponse($READ);

                echo json_encode($ARRAY);

                $API->disconnect();
        }
})->middleware(SessionMiddleware::class);

Route::post('/api/get-ipaddress', function (Request $request) {
        $API = new RouterOS();

        $API->debug = false;

        $ip = $request->input('ip');
        $username = $request->input('username');
        $password = $request->input('password');
        $port = $request->input('port');

        if ($API->connect($ip, $username, $password, $port)) {
                $API->write('/ip/address/print');

                $READ = $API->read(false);
                $ARRAY = $API->parseResponse($READ);

                echo json_encode($ARRAY);

                $API->disconnect();
        }
})->middleware(SessionMiddleware::class);