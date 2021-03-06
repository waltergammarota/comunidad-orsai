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
    'WebController@ingresar'
)->name('home');

Route::get(
    '/privacidad',
    'WebController@privacidad'
)->name('privacidad');

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
    '/contacto',
    'WebController@contacto'
)->name("contacto");

Route::post(
    '/contacto',
    'WebController@contacto_send'
)->name("contacto-send");


/* ACCESO RESTRINGIDO */
Route::middleware(['verified'])->group(
    function () {
        Route::get(
            '/perfil',
            'AccountController@show_perfil'
        )->name('perfil')->middleware('email_verified');;

        Route::get(
            '/panel',
            'AccountController@show_panel'
        )->name('perfil');

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

        Route::get('dashboard', 'Admin\AdminController@index')->name(
            'dashboard'
        )->middleware('admin_role');

        Route::get('admin/contenidos/tipo/{type}', 'Admin\ContenidoController@index')->name(
            'contenidos'
        )->middleware('admin_role');

        Route::get('admin/contenidos/crear/{type}', 'Admin\ContenidoController@create')->name(
            'noticias'
        )->middleware('admin_role');

        Route::get('admin/contenidos/{id}', 'Admin\ContenidoController@edit')->name(
            'contenidos-edit'
        )->middleware('admin_role');

        Route::post('admin/contenidos/store', 'Admin\ContenidoController@store')->name(
            'contenidos-store'
        )->middleware('admin_role');

        Route::post('admin/contenidos/eliminar', 'Admin\ContenidoController@eliminar')->name(
            'contenidos-eliminar'
        )->middleware('admin_role');

        Route::post('admin/contenidos/update', 'Admin\ContenidoController@update')->name(
            'noticias-update'
        )->middleware('admin_role');

        Route::get(
            'admin/contenidos-json/{type}',
            'Admin\ContenidoController@contenidos_json'
        )->name(
            'noticias-json'
        )->middleware('admin_role');

        Route::get('admin/usuarios', 'Admin\AdminController@usuarios')->name(
            'dashboard'
        )->middleware('admin_role');

        Route::get('admin/usuarios/editar/{id}', 'Admin\AdminController@edit')->name(
            'editar-usuario'
        )->middleware('admin_role');

        Route::get(
            'admin/usuarios-json',
            'Admin\AdminController@usuarios_json'
        )->name(
            'usuarios-json'
        )->middleware('admin_role');

        Route::post(
            'admin/usuarios/bloquear',
            'Admin\AdminController@bloquear'
        )->name(
            'usuarios-bloquear'
        )->middleware('admin_role');

        Route::post(
            'admin/usuarios/eliminar',
            'Admin\AdminController@eliminar'
        )->name(
            'usuarios-eliminar'
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

        Route::get('admin/contest/editar/{id}', 'Contest\ContestController@edit')->name('concurso-editar')->middleware('admin_role');

        Route::post(
            'admin/contest/update',
            'Contest\ContestController@update'
        )->name(
            'concurso-update'
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
            'admin/application/eliminar',
            'PropuestaController@eliminar'
        )->name(
            'concurso-eliminar'
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
        )->name('transacciones')->middleware('email_verified');

        Route::get(
            'perfil-usuario/{id}',
            'AccountController@show_perfil_publico'
        )->name('perfil-publico');

        Route::get(
            '/novedades/{slug}',
            'ContenidoController@index'
        )->name('novedades');


        Route::get(
            '/{slug}',
            'ContenidoController@index'
        )->name("pagina");

    }
);

