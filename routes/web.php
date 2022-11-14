<?php


/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

use Laravel\Lumen\Routing\Router;

$router->get('/', function () use ($router) {
    return $router->app->version();
});

/* Routing standart bawaan lumen

$router->get('/', function () use ($router) {
    return $router->app->version();
});

*/

/* ########################################################################
$router->get('/', function () {
    return 'Hello World';
}); # Routing standart

*/

/* ########################################################################

$router->get('cek/{nama}', function ($nama) {
    return "Hello World .$nama";
}); # Routing standart dengan parameter

*/

#Routing Group  for training ########################################################################

/*
$router->group(
    ['prefix' => 'guest'],

    function () use ($router) {

        $router->get('/greeting/{nama}', ['uses' => 'GuestController@index']);
    }
);
*/

$router->group(
    ['prefix' => 'api-v1/jabatan'],
    function () use ($router) {
        $router->get('/', ['uses' => 'JabatanController@index']);
        $router->post('/addjabatan', ['uses' => 'JabatanController@addJabatan']);
        $router->get('/getjabatan/all', ['uses' => 'JabatanController@getAllJabatan']);
        $router->post('/getby', ['uses' => 'JabatanController@getByJabatan']);
        $router->put('/updatejabatan', ['uses' => 'JabatanController@updateJabatan']);
        $router->delete('/singleremoved_jabatan', ['uses' => 'JabatanController@delJabatan']);
    }
);

$router->group(
    ['prefix' => 'api-v1/akses'],
    function () use ($router) {
        $router->get('/', ['uses' => 'HakAksesController@index']);
        $router->post('/addakses', ['uses' => 'HakAksesController@addAkses']);
        $router->get('/getakses/all', ['uses' => 'HakAksesController@getAllAkses']);
        $router->post('/akses_getby', ['uses' => 'HakAksesController@getByAkses']);
        $router->put('/updateakses', ['uses' => 'HakAksesController@updateAkses']);
        $router->delete('/singleremoved_akses', ['uses' => 'HakAksesController@delAkses']);
    }
);

$router->group(
    ['prefix' => 'api-v1/karyawan'],
    function () use ($router) {
        $router->get('/', ['uses' => 'KaryawanController@index']);
        $router->post('/addkaryawan', ['uses' => 'KaryawanController@addKaryawan']);
        $router->get('/getkaryawan/all', ['uses' => 'KaryawanController@getAllKaryawan']);
        $router->post('/karyawan_getby', ['uses' => 'KaryawanController@getByKaryawan']);
        $router->put('/setaktif', ['uses' => 'KaryawanController@setAktif']);
        $router->delete('/singleremoved_karyawan', ['uses' => 'KaryawanController@delKaryawan']);
    }
);

$router->group(
    ['prefix' => 'api-v1/user'],
    function () use ($router) {
        $router->get('/', ['uses' => 'UserController@index']);
        $router->get('/tester', ['uses' => 'UserController@delWebHook']);
        $router->post('/register', ['uses' => 'UserController@register']);
        $router->post('/login', ['uses' => 'UserController@login']);
    }
);