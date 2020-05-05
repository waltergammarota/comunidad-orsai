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
    'WebController@index'
)->name('home');

Route::get(
    '/fundacion-orsai',
    'WebController@fundacion'
)->name('fundacion-orsai');

Route::get(
    '/plan',
    'WebController@plan'
)->name('plan');

Route::get(
    '/consejo',
    'WebController@consejo'
)->name('consejo');

Route::get(
    '/areas',
    'WebController@areas'
)->name('areas');

Route::get(
    '/areas',
    'WebController@areas'
)->name('consejo');

Route::get(
    '/donaciones',
    'WebController@donaciones'
)->name('donaciones');

Route::get(
    '/historia',
    'WebController@historia'
)->name('historia');

Route::get(
    '/concurso-logo',
    'WebController@concurso'
)->name('concurso-logo');

Route::get(
    '/bases-concurso',
    'WebController@bases_concurso'
)->name('bases-concurso');

Route::get(
    '/noticias/{slug?}',
    'ContenidoController@index'
)->name('noticias');

Route::get(
    '/privacidad',
    'WebController@privacidad'
)->name('privacidad');

Route::get(
    '/logo',
    'WebController@logo'
)->name('logo');


Route::get(
    '/ingresar',
    'WebController@ingresar'
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
    'Registration\RegistrationController@registrarse'
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
    'WebController@restablecer_clave'
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
    'WebController@reenviar_mail_activacion'
)->name('reenviar-mail');

Route::post(
    '/reenviar-mail',
    'Registration\RegistrationController@reenviar'
)->name('reenviar-mail');

Route::get(
    '/terminos',
    'WebController@terminos'
)->name('terminos');

Route::get(
    '/concurso-finalizado',
    'WebController@concurso_finalizado'
)->name('concurso-finalizado');

Route::get(
    '/participantes/{orden?}',
    'WebController@participantes'
)->name('participantes');

Route::get(
    '/participantes/{orden?}/{limit}/{offset}',
    'WebController@getMore'
)->name('participantes-more');

Route::get(
    '/concurso',
    'Contest\ContestController@index'
)->name("concurso");

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

        Route::get(
            '/gracias',
            'AccountController@gracias'
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



        Route::get('dashboard', 'Admin\AdminController@index')->name(
            'dashboard'
        )->middleware('admin_role');

        Route::get('admin/noticias', 'Admin\ContenidoController@index')->name(
            'noticias'
        )->middleware('admin_role');;

        Route::get('admin/noticias/crear', 'Admin\ContenidoController@create')->name(
            'noticias'
        )->middleware('admin_role');

        Route::get('admin/noticias/{id}', 'Admin\ContenidoController@edit')->name(
            'noticias-edit'
        )->middleware('admin_role');



        Route::post('admin/noticias/store', 'Admin\ContenidoController@store')->name(
            'noticias-store'
        )->middleware('admin_role');
        Route::post('admin/noticias/update', 'Admin\ContenidoController@update')->name(
            'noticias-update'
        )->middleware('admin_role');

        Route::get(
            'admin/noticias-json',
            'Admin\ContenidoController@noticias_json'
        )->name(
            'noticias-json'
        )->middleware('admin_role');

        Route::get('admin/usuarios', 'Admin\AdminController@usuarios')->name(
            'dashboard'
        )->middleware('admin_role');;

        Route::get(
            'admin/usuarios-json',
            'Admin\AdminController@usuarios_json'
        )->name(
            'usuarios-json'
        )->middleware('admin_role');

        Route::get(
            'admin/transacciones',
            'Admin\AdminController@transacciones'
        )->name(
            'transacciones'
        )->middleware('admin_role');

        Route::get(
            'admin/transacciones-json',
            'Admin\AdminController@transacciones_json'
        )->name(
            'transacciones-json'
        )->middleware('admin_role');

        Route::get(
            'admin/postulaciones-json',
            'Admin\AdminController@postulaciones_json'
        )->name(
            'postulaciones-json'
        )->middleware('admin_role');

        Route::get(
            'admin/postulaciones',
            'Admin\AdminController@postulaciones'
        )->name(
            'postulaciones'
        )->middleware('admin_role');

        Route::get(
            'admin/concurso-json',
            'Admin\AdminController@contest_json'
        )->name(
            'concurso-admin'
        )->middleware('admin_role');

        Route::get('admin/concurso', 'Admin\AdminController@concurso')->name(
            'concurso-admin'
        )->middleware('admin_role');

        Route::post(
            'admin/contest/approve',
            'Contest\ContestController@approve'
        )->name(
            'concurso-activar'
        )->middleware('admin_role');

        Route::post(
            'admin/application/approve',
            'PropuestaController@approve'
        )->name(
            'concurso-activar'
        )->middleware('admin_role');

        Route::post(
            'admin/application/reject',
            'PropuestaController@reject'
        )->name(
            'concurso-activar'
        )->middleware('admin_role');

        Route::post(
            'admin/application/winner',
            'PropuestaController@winner'
        )->name(
            'concurso-ganador'
        )->middleware('admin_role');


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
