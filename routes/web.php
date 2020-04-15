<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes(['verify' => true]);

/* ACCESO PUBLICO */
Route::get(
    '/',
    'Webcontroller@index'
)->name('home');

Route::get(
    '/fundacion-orsai',
    'Webcontroller@fundacion'
)->name('fundacion-orsai');

Route::get(
    '/concurso-logo',
    'Webcontroller@concurso_logo'
)->name('concurso-logo');


Route::get(
    '/donar',
    'Webcontroller@donar'
)->name('donar');

Route::get(
    '/ingresar',
    function () {
        return view('ingresar');
    }
)->name('ingresar');


Route::post(
    '/ingresar',
    'Auth\LoginController@authenticate'
)->name('ingresar');


Route::get(
    '/salir',
    'Auth\LoginController@logout'
)->name('salir');

Route::get(
    '/registrarse',
    function () {
        return view('registrarse', ['title' => 'Registro de Usuario']);
    },
)->name('registrarse');

Route::post(
    '/registrarse',
    'Registration\RegistrationController@registerWeb'
)->name('registrarse');


Route::get(
    '/restablecer-clave',
    function () {
        return view('restablecer-clave');
    }
)->name('restablecer-clave');

Route::get(
    '/terminos',
    function () {
        return view('terminos', ["title" => "Términos y condiciones"]);
    }
)->name('terminos');

Route::get(
    '/participantes',
    'WebController@participantes'
)->name('participantes');


/* ACCESO RESTRINGIDO */
Route::middleware(['verified'])->group(
    function () {
        Route::get(
            '/perfil',
            'AccountController@show_perfil'
        )->name('perfil');

        Route::get(
            '/panel',
            'AccountController@show_panel'
        )->name('perfil');

        Route::get(
            '/postulacion/{id?}',
            'AccountController@show_postulacion'
        )->name('postulacion');

        Route::post(
            '/postulacion',
            'AccountController@store_publicacion'
        );
    }
);
