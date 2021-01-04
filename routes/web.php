<?php

Auth::routes(['verify' => true]);


/* ACCESO PUBLICO */
Route::get(
    '/',
    'ContenidoController@index'
)->name('home');

Route::get(
    '/ingresar',
    'WebController@ingresar'
)->name('ingresar');

// LOGIN CONTROLLER ROUTES

Route::post(
    '/ingresar',
    'Auth\LoginController@authenticate'
)->name('ingresar');

Route::get(
    '/salir',
    'Auth\LoginController@logout'
)->name('salir');

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

// END OF LOGIN CONTROLLER ROUTES
Route::get(
    '/registrarse',
    'Registration\RegistrationController@registrarse'
)->name('registrarse');

Route::post(
    '/registrarse',
    'Registration\RegistrationController@registerWeb'
)->name('registrarse-post');

Route::get(
    '/activar/{token}',
    'Registration\RegistrationController@activar'
)->name('activar');


Route::get(
    '/restablecer-clave',
    'WebController@restablecer_clave'
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
    '/restablecer-clave',
    'WebController@restablecer_clave'
)->name('restablecer-clave');

Route::get(
    'cuenta-desactivada',
    'PreferenciasController@cuenta_desactivada'
)->name('cuenta-desactivada');


Route::get(
    '/bases-concurso',
    'WebController@bases_concurso'
)->name('bases-concurso');

Route::get(
    '/concursos',
    'Contest\ContestController@index'
)->name("concursos");

Route::get(
    '/concursos/{id}/{name}',
    'Contest\ContestController@show'
)->name("concursos-show");


Route::get(
    '/historia',
    'WebController@historia'
)->name('historia');


/* ACCESO RESTRINGIDO */
Route::middleware(['verified'])->group(
    function () {

        // CONCURSOS


        Route::get(
            '/propuesta/{id}',
            'PropuestaController@show'
        );

        Route::post(
            '/votar',
            'PropuestaController@votar'
        );

        Route::get(
            '/postulacion',
            'AccountController@show_postulacion'
        )->name('postulacion')->middleware('email_verified');

        Route::post(
            '/postulacion',
            'AccountController@store_publicacion'
        );

        Route::get(
            '/concurso-finalizado',
            'WebController@concurso_finalizado'
        )->name('concurso-finalizado');

        Route::get(
            '/concursos/{id}/{name}/{orden?}',
            'Contest\ContestController@show'
        )->name('participantes');

        Route::get(
            '/participantes/pagina/{page?}/{orden?}/',
            'WebController@participantes'
        )->name('participantes-pagina');

        Route::get(
            '/participantes/{orden?}/{limit}/{offset}',
            'WebController@getMore'
        )->name('participantes-more');

        //CONCURSOS


        Route::get(
            '/fundacion',
            'WebController@fundacion'
        )->name('fundacion');

        Route::get(
            '/fundacion/plan',
            'WebController@plan'
        )->name('plan');

        Route::get(
            '/fundacion/consejo',
            'WebController@consejo'
        )->name('consejo');

        Route::get(
            '/fundacion/areas',
            'WebController@areas'
        )->name('areas');

        Route::get(
            '/fundacion/donaciones',
            'WebController@donaciones'
        )->name('donaciones');

        Route::get(
            '/perfil',
            'AccountController@show_perfil'
        )->name('perfil')->middleware('email_verified');;

        Route::get(
            '/panel',
            'AccountController@show_panel'
        )->name('perfil');

        Route::post(
            '/guardar-configuracion-preferencias',
            'PreferenciasController@guardar_configuracion_preferencias'
        )->name('guardar-configuracion-preferencias');

        Route::post(
            '/guardar-configuracion-notificaciones',
            'NotificacionesController@guardar_configuracion_notificaciones'
        )->name('guardar-configuracion-notificaciones');

        Route::post(
            '/confirmar-desactivar-cuenta',
            'PreferenciasController@borrar_cuenta'
        )->name('confirmar-desactivar-cuenta');

        Route::get(
            '/confirmar-desactivar-cuenta',
            'PreferenciasController@confirmar_desactivar_cuenta'
        )->name('confirmar-desactivar-cuenta');

        Route::get(
            '/desactivar-cuenta',
            'PreferenciasController@desactivar_cuenta'
        )->name('desactivar-cuenta');

        Route::get(
            '/configuracion-preferencias-generales',
            'PreferenciasController@configurar_preferencias'
        )->name('configurar-preferencias');

        Route::get(
            '/configuracion-privacidad',
            'PreferenciasController@configurar_privacidad'
        )->name('configuracion-privacidad');

        Route::get(
            '/configuracion-notificaciones',
            'NotificacionesController@configurar_notificaciones'
        )->name('configuracion-notificaciones');

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

        // NOTIFICACIONES
        Route::get('admin/notificaciones', 'Admin\NotificacionesController@index')->name(
            'notificaciones'
        )->middleware('admin_role');

        Route::get('admin/notificaciones/crear', 'Admin\NotificacionesController@create')->name(
            'notificaciones-crear'
        )->middleware('admin_role');

        Route::get('admin/notificaciones/{id}', 'Admin\NotificacionesController@edit')->name(
            'notificaciones-edit'
        )->middleware('admin_role');

        Route::post('admin/notificaciones/store', 'Admin\NotificacionesController@store')->name(
            'notificaciones-store'
        )->middleware('admin_role');

        Route::post('admin/notificaciones/eliminar', 'Admin\NotificacionesController@eliminar')->name(
            'notificaciones-eliminar'
        )->middleware('admin_role');

        Route::post('admin/notificaciones/update', 'Admin\NotificacionesController@update')->name(
            'notificaciones-update'
        )->middleware('admin_role');

        Route::get(
            'admin/notificaciones-json',
            'Admin\NotificacionesController@notificaciones_json'
        )->name(
            'notificaciones-json'
        )->middleware('admin_role');

        Route::get(
            'notificaciones-json',
            'AccountController@notificaciones_json'
        )->name(
            'user-notificaciones-json'
        );

        Route::get(
            '/notificaciones/counter',
            'AccountController@notificaciones_counter'
        )->name('notificaciones')->middleware('email_verified');

        Route::get(
            '/notificaciones',
            'AccountController@notificaciones'
        )->name('notificaciones')->middleware('email_verified');

        Route::post(
            '/notificaciones/mark-as-not-read',
            'AccountController@notificaciones_markAsNotRead'
        )->name('notificaciones')->middleware('email_verified');

        Route::post(
            '/notificaciones/mark-as-read',
            'AccountController@notificaciones_markAsRead'
        )->name('notificaciones')->middleware('email_verified');

        Route::post(
            '/notificaciones/markallasreaded',
            'AccountController@markAllAsReaded'
        )->name('mark-all-as-readed')->middleware('email_verified');

        Route::post(
            '/notificaciones/delete',
            'AccountController@delete_notifications'
        )->name('delete-notificaciones')->middleware('email_verified');

        Route::get(
            '/notificacion/{id}',
            'AccountController@notificacion'
        )->name('notificacion')->middleware('email_verified');

        // END OF NOTIFICACIONES


        Route::get('dashboard', 'Admin\AdminController@index')->name(
            'dashboard'
        )->middleware('admin_role');

        Route::get('admin/contenidos/tipo/{type}', 'Admin\ContenidoController@index')->name(
            'contenidos'
        )->middleware('admin_role');

        Route::post('admin/contenidos/deleteImage', 'Admin\ContenidoController@deleteImage')->name(
            'deleteImage'
        )->middleware('admin_role');


        Route::get('admin/contenidos/crear/{type}', 'Admin\ContenidoController@create')->name(
            'noticias'
        )->middleware('admin_role');

        Route::get('admin/contenidos/{id}', 'Admin\ContenidoController@edit')->name(
            'contenidos-edit'
        )->middleware('admin_role');

        Route::post('admin/contenidos/createPageByPost', 'Admin\ContenidoController@createPageByPost')->name(
            'contenidos-createPage'
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
            'admin/usuarios/ascender',
            'Admin\AdminController@ascender'
        )->name(
            'usuarios-ascender'
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

        // GESTION DE FICHAS
        Route::get(
            'admin/gestion-fichas',
            'Admin\FichasController@index'
        )->name(
            'gestion-fichas'
        )->middleware('admin_role');

        Route::get(
            'admin/search-paises',
            'Admin\FichasController@search_paises'
        )->name(
            'search-paises'
        )->middleware('admin_role');

        Route::get(
            'admin/search-provincias',
            'Admin\FichasController@search_provincias'
        )->name(
            'search-provincias'
        )->middleware('admin_role');

        Route::get(
            'admin/search-ciudades',
            'Admin\FichasController@search_ciudades'
        )->name(
            'search-ciudades'
        )->middleware('admin_role');

        Route::get(
            'admin/search-users',
            'Admin\FichasController@search_users'
        )->name(
            'gestion-fichas'
        )->middleware('admin_role');

        // CONTACTO
        Route::get(
            '/contacto',
            'WebController@contacto'
        )->name("contacto");

        Route::post(
            '/contacto',
            'WebController@contacto_send'
        )->name("contacto");

        //END OF CONTACTO
        Route::get(
            '/admin/show-logs',
            'Admin\FichasController@show_logs'
        )->name("fichas-logs");

        Route::post(
            'admin/gestion-fichas',
            'Admin\FichasController@send'
        )->name(
            'send-fichas'
        )->middleware('admin_role');

        // END OF GESTION DE FICHAS

        Route::get(
            'admin/transacciones/{userId}/json',
            'Admin\AdminController@transaccionesPorUsuario'
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

        Route::get('admin/concursos', 'Admin\AdminController@concurso')->name(
            'concurso-admin'
        )->middleware('admin_role');

        Route::get('admin/concursos/crear', 'Contest\ContestController@create')->name('concurso-crear')->middleware('admin_role');

        Route::get('admin/contest/editar/{id}', 'Contest\ContestController@edit')->name('concurso-editar')->middleware('admin_role');

        Route::post(
            'admin/contest/deleteImage',
            'Contest\ContestController@deleteImage'
        )->name(
            'concurso-delete-image'
        )->middleware('admin_role');

        Route::post(
            'admin/contest/store',
            'Contest\ContestController@store'
        )->name(
            'concurso-store'
        )->middleware('admin_role');

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
            '/postulaciones',
            'AccountController@postulaciones'
        )->name('postulaciones')->middleware('email_verified');

        Route::get(
            '/transacciones',
            'AccountController@transacciones'
        )->name('transacciones')->middleware('email_verified');


        Route::get(
            'perfil-usuario/{id}',
            'AccountController@show_perfil_publico'
        )->name('perfil-publico');

        Route::get(
            '/{slug}',
            'ContenidoController@index'
        )->name("pagina");

        // CONTEST WINNER ROUTE
        Route::get(
            '/concurso/ganador/{contest_id}',
            'Contest\ContestController@show_winner'
        )->name("concurso-ganador");

        // PRODUCTOS
        Route::get(
            'admin/productos',
            'Admin\ProductoController@index'
        )->name('productos')->middleware('admin_role');

        Route::get(
            'admin/productos-json',
            'Admin\ProductoController@productos_json'
        )->name('productos-json')->middleware('admin_role');

        Route::get(
            'admin/productos/crear',
            'Admin\ProductoController@create'
        )->name('productos-create')->middleware('admin_role');

        Route::post(
            'admin/productos/store',
            'Admin\ProductoController@store'
        )->name('productos-store')->middleware('admin_role');

        Route::get(
            'admin/productos/{id}',
            'Admin\ProductoController@edit'
        )->name('productos-edit')->middleware('admin_role');

        Route::post(
            'admin/productos/update',
            'Admin\ProductoController@update'
        )->name('productos-update')->middleware('admin_role');

        Route::get(
            'admin/{slug}',
            function () {
                abort(404);
            }
        )->middleware('admin_role');

    }
);

Route::get(
    '/novedades/{slug}',
    'ContenidoController@index'
)->name('novedades');


Route::get(
    '/{slug}',
    'ContenidoController@index'
)->name("pagina");
