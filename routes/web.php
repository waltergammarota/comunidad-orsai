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
    }
)->name('registrarse');

Route::post(
    '/registrarse',
    'Registration\RegistrationController@registerWeb'
)->name('registrarse');

Route::get(
    '/activar/{token}',
    'Registration\RegistrationController@activar'
)->name('activar');


Route::get(
    '/restablecer-clave',
    function () {
        return view('restablecer-clave');
    }
)->name('restablecer-clave');

Route::get(
    '/reset-password/{token}',
    'Auth\LoginController@resetpasswordform'
)->name('reset-password');

Route::post(
    '/reset-password',
    'Auth\LoginController@createNewPassword'
)->name('reset-password');

Route::post(
    '/restablecer-clave',
    'Auth\LoginController@resetpassword'
)->name('restablecer-clave');

Route::get(
    '/reenviar-mail',
    function () {
        return view('reenviar-mail-activacion');
    }
)->name('reenviar-mail');

Route::post(
    '/reenviar-mail',
    'Registration\RegistrationController@reenviar'
)->name('reenviar-mail');

Route::get(
    '/terminos',
    function () {
        return view('terminos', ["title" => "Términos y condiciones"]);
    }
)->name('terminos');

Route::get(
    '/concurso-finalizado',
    'WebController@concurso_finalizado'
)->name('concurso-finalizado');


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
            '/postulacion',
            'AccountController@show_postulacion'
        )->name('postulacion');

        Route::post(
            '/postulacion',
            'AccountController@store_publicacion'
        );

        Route::post(
            '/profile/update',
            'AccountController@profile_update'
        );

        Route::post(
            '/profile/image',
            'AccountController@profile_image'
        );

        Route::get(
            '/propuesta/{id}',
            'PropuestaController@show'
        );

        Route::post(
            '/votar',
            'PropuestaController@votar'
        );

        Route::get(
            '/concurso',
            'Contest\ContestController@index'
        )->name("concurso");

        Route::get('dashboard', 'Admin\AdminController@index')->name(
            'dashboard'
        );

        Route::get('admin/usuarios', 'Admin\AdminController@usuarios')->name(
            'dashboard'
        );

        Route::get(
            'admin/usuarios-json',
            'Admin\AdminController@usuarios_json'
        )->name(
            'dashboard'
        );

        Route::get(
            'admin/transacciones',
            'Admin\AdminController@transacciones'
        )->name(
            'dashboard'
        );

        Route::get(
            'admin/transacciones-json',
            'Admin\AdminController@transacciones_json'
        )->name(
            'dashboard'
        );
        Route::get(
            'admin/postulaciones-json',
            'Admin\AdminController@postulaciones_json'
        )->name(
            'dashboard'
        );
        Route::get(
            'admin/postulaciones',
            'Admin\AdminController@postulaciones'
        )->name(
            'dashboard'
        );

        Route::get(
            'admin/concurso-json',
            'Admin\AdminController@contest_json'
        )->name(
            'concurso-admin'
        );
        Route::get('admin/concurso', 'Admin\AdminController@concurso')->name(
            'concurso-admin'
        );

        Route::post(
            'admin/contest/approve',
            'Contest\ContestController@approve'
        )->name(
            'concurso-activar'
        );

        Route::post(
            'admin/application/approve',
            'PropuestaController@approve'
        )->name(
            'concurso-activar'
        );

        Route::post(
            'admin/application/reject',
            'PropuestaController@reject'
        )->name(
            'concurso-activar'
        );

        Route::post(
            'admin/application/winner',
            'PropuestaController@winner'
        )->name(
            'concurso-ganador'
        );

        Route::get(
            '/participantes/{orden?}',
            'WebController@participantes'
        )->name('participantes');

        Route::get(
            '/participantes/{orden?}/{limit}/{offset}',
            'WebController@getMore'
        )->name('participantes');

        Route::get(
            '/transacciones',
            'AccountController@transacciones'
        )->name('transacciones');

        Route::get(
            'perfil-usuario/{id}',
            'AccountController@show_perfil_publico'
        )->name('perfil-publico');
    }
);
