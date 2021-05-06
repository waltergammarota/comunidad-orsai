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
    '/historia',
    'WebController@historia'
)->name('historia');

Route::post(
    '/donar/mercado_pago_webhook',
    'DonarController@mercado_pago_webhook'
)->name('mercado_pago_webhook');

//TRANSPARENCIA
Route::get('transparencia/fichas', 'TransparenciaController@fichas')->name('transparencia.fichas');
Route::get('transparencia/dinero', 'TransparenciaController@dinero')->name('transparencia.dinero');
Route::get(
    'transparencia',
    'TransparenciaController@index'
)
    ->name('transparencia');

Route::get(
    'transparencia-json',
    'TransparenciaController@transparencia_json'
)
    ->name('transparencia-json');

Route::get(
    '/concursos',
    'Contest\ContestController@index'
)->name("concursos");


Route::get(
    '/concursos/{id}/{name}',
    'Contest\ContestController@show'
)->name("concursos-show");

Route::get(
    '/concursos/{id}/{name}/ganador',
    'Contest\ContestController@ganador'
)->name("ganador");

/* ACCESO RESTRINGIDO */
Route::middleware(['verified'])->group(
    function () {
        // COTIZACION
        Route::get(
            'admin/cotizaciones',
            'Admin\CotizacionController@index'
        )->name('cotizacion-form')->middleware('admin_role');

        Route::get(
            'admin/cotizaciones-json',
            'Admin\CotizacionController@cotizaciones_json'
        )->name('cotizacion-json')->middleware('admin_role');

        Route::get(
            'admin/cotizaciones/crear',
            'Admin\CotizacionController@create'
        )->name('cotizacion-crear')->middleware('admin_role');


        Route::post(
            'admin/cotizaciones/store',
            'Admin\CotizacionController@store'
        )->name('cotizacion-store')->middleware('admin_role');

        // END OF COTIZACION
        //Donar

        Route::post(
            'donar/create-compra',
            'DonarController@create_compra'
        )->name('create-compra')->middleware('email_verified');

        Route::post(
            'donar/paypal/capture',
            'DonarController@paypal_capture'
        )->name('paypal-capture-compra')->middleware('email_verified');

        Route::get(
            '/donar',
            'DonarController@index'
        )->name('index')->middleware('email_verified');

        Route::get(
            '/donar/paypal',
            'DonarController@paypal'
        )->name('paypal')->middleware('email_verified');

        Route::get(
            '/donar/checkout',
            'DonarController@checkout'
        )->name('checkout')->middleware('email_verified');

        Route::get(
            '/donar/rejected',
            'DonarController@rejected'
        )->name('rejected')->middleware('email_verified');

        Route::get(
            '/donar/pending',
            'DonarController@pending'
        )->name('pending')->middleware('email_verified');

        Route::get(
            '/donar/paypal/successful',
            'DonarController@paypal_successful'
        )->name('paypal-successful')->middleware('email_verified');

        Route::get(
            '/donar/successful',
            'DonarController@successful'
        )->name('successful')->middleware('email_verified');


        Route::post(
            '/donar/create_compra',
            'DonarController@create'
        )->name('compra-create')->middleware('email_verified');
        // end of donar

        Route::post(
            '/change-password',
            'AccountController@change_password'
        )->name('change-password')->middleware('email_verified');

        // RUTAS SMS
        Route::get(
            'validacion-usuario',
            'SmsController@index'
        )->middleware('email_verified');

        Route::get(
            'editar-telefono',
            'SmsController@edit_phone'
        )->middleware('email_verified');

        Route::get(
            'validacion-codigo',
            'SmsController@validate_code'
        )->middleware('email_verified');

        Route::post(
            'agregar-telefono',
            'SmsController@add_phone'
        )->middleware('email_verified');

        Route::post(
            'verificar-telefono',
            'SmsController@verify_phone'
        )->middleware('email_verified');

        Route::post(
            'reenviar-codigo',
            'SmsController@resend_code'
        )->middleware('email_verified');

        Route::post(
            'verificar-no-usado',
            'SmsController@verify_unique_phone'
        )->middleware('email_verified');


        // FIN RUTAS SMS

        // INICIO CONCURSOS

        Route::get(
            '/postulacion/{id}',
            'PropuestaController@show'
        );

        Route::get(
            '/postulacion-detalle/{id}',
            'PropuestaController@show_detalle'
        );

        Route::post(
            '/votar',
            'PropuestaController@votar'
        );

        Route::get(
            '/postulaciones/{contest_id}/{contest_name}/finalizar/{cap_id}',
            'AccountController@preview'
        )->name('postulacion-preview')->middleware('email_verified');

        Route::post(
            'borrar-capitulo',
            'AccountController@delete_chapter'
        )->name('borrar-capitulo')->middleware('email_verified');

        Route::post(
            'enviar-postulacion',
            'AccountController@sent_cpa'
        )->name('enviar-postulacion')->middleware('email_verified');

        Route::get(
            '/postulaciones/{contest_id}/{contest_name}',
            'AccountController@show_postulacion'
        )->name('postulacion')->middleware('email_verified');

        Route::get(
            '/postulaciones/{contest_id}/{contest_name}/capitulos/{chapter_id}',
            'AccountController@show_postulacion'
        )->name('postulacion')->middleware('email_verified');


        Route::post(
            '/postulaciones',
            'AccountController@store_publicacion'
        );

        Route::post(
            '/capitulos',
            'AccountController@store_chapter'
        );


        Route::get(
            '/concurso-finalizado',
            'WebController@concurso_finalizado'
        )->name('concurso-finalizado');

        Route::get(
            '/postulacion_publica',
            'WebController@postulacion_publica'
        )->name('postulacion_publica');


        Route::get(
            '/ranking',
            'WebController@ranking'
        )->name('ranking');

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

        // CONCURSOS RONDAS

        Route::get(
            'concursos/{contestId}/{name}/ronda/{rondaId}',
            'Contest\ContestController@show_ronda'
        )->name('concurso-ronda');

        // CUENTO COMPLETO
        Route::get(
            'cuentos/{storyId}',
            'Contest\ContestController@show_cuento'
        )->name('concurso-cuento-completo');
        // CONCURSOS RONDAS

        //FIN DE CONCURSOS
        Route::post(
            'reportar',
            'TransparenciaController@reportar'
        )->name('reportar');
        // END OF TRANSPARENCIA

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
        )->name('perfil')->middleware('email_verified');

        Route::get(
            '/panel',
            'AccountController@show_panel'
        )->name('perfil');

        Route::get(
            '/redes-sociales',
            'AccountController@show_redes'
        )->name('perfil')->middleware('email_verified');

        Route::post(
            '/save-twitter',
            'AccountController@saveTwitter'
        )->name('save-twitter')->middleware('email_verified');

        Route::post(
            '/save-facebook',
            'AccountController@saveFacebook'
        )->name('save-facebook')->middleware('email_verified');

        Route::post(
            'twitter-login',
            'AccountController@twitter'
        )->name('twitter-callback')->middleware('email_verified');

        Route::post(
            '/save-instagram',
            'AccountController@saveInstagram'
        )->name('save-instagram')->middleware('email_verified');


        Route::get(
            'seguridad',
            'AccountController@show_seguridad'
        )->name('seguridad')->middleware('email_verified');

        Route::get(
            'formacion-y-experiencia',
            'AccountController@show_formacion'
        )->name('perfil')->middleware('email_verified');


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

        Route::post(
            '/configuracion-privacidad',
            'PreferenciasController@guardar_conf_privacidad'
        )->name('guardar-configuracion-privacidad');

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

        // balance
        Route::get(
            'my-balance',
            'BalanceController@index'
        )->name('my-balance');
        // redes
        Route::post(
            '/profile/update/redes',
            'AccountController@profile_update_redes'
        );
        // formacion
        Route::post(
            '/formacion/update',
            'AccountController@formacion_update'
        );

        Route::post(
            '/profile/image',
            'AccountController@profile_image'
        );

        // HOME EDITABLE
        Route::get('admin/home', 'Admin\HomeEditableController@index')->name(
            'home'
        )->middleware('admin_role');

        Route::post('admin/home/update', 'Admin\HomeEditableController@update')->name(
            'home-update'
        )->middleware('admin_role');

        Route::post('admin/home/store', 'Admin\HomeEditableController@store')->name(
            'home-store'
        )->middleware('admin_role');


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
        )->name('notificaciones-counter')->middleware('email_verified');

        Route::get(
            '/notificaciones',
            'AccountController@notificaciones'
        )->name('notificaciones')->middleware('email_verified');

        Route::post(
            '/notificaciones/mark-as-not-read',
            'AccountController@notificaciones_markAsNotRead'
        )->name('notificaciones-markAsNotRead')->middleware('email_verified');

        Route::post(
            '/notificaciones/mark-as-read',
            'AccountController@notificaciones_markAsRead'
        )->name('notificaciones-markAsRead')->middleware('email_verified');

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
            'admin/usuarios/validar',
            'Admin\AdminController@validar'
        )->name(
            'usuarios-validar'
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
            'admin/gestion-dinero',
            'Admin\MoneyController@index'
        )->name(
            'gestion-dinero'
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
        )->name("contacto-send");

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

        Route::get(
            'admin/gestion-dinero-json',
            'Admin\MoneyController@dinero_json'
        )->name(
            'money-transactions'
        )->middleware('admin_role');

        Route::post(
            'admin/gestion-dinero',
            'Admin\MoneyController@add'
        )->name(
            'add-money-transaction'
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
            'admin/postulaciones-json/{id}',
            'Admin\AdminController@postulaciones_json'
        )->name(
            'postulaciones-json'
        )->middleware('admin_role');

        Route::get(
            'admin/postulaciones/{id}',
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
        Route::get('admin/contest/inputs/{id}', 'Contest\ContestController@inputs')->name('contest.inputs')->middleware('admin_role');

        Route::post(
            'admin/contest/deleteAll',
            'Contest\ContestController@deleteAll'
        )->name(
            'concurso-delete-all'
        )->middleware('admin_role');

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

        // RUTA MIS POSTULACIONES
        Route::get(
            '/mis-postulaciones',
            'AccountController@postulaciones'
        )->name('postulaciones')->middleware('email_verified');
        // FIN RUTA MIS POSTULACIONES
        Route::get(
            '/mis-fichas',
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
            '/estadisticas/{contestId}/{contestName}',
            'Contest\ContestController@show_winner'
        )->name("concurso-ganador");

        // FORMS
        Route::get('admin/forms', 'Admin\FormController@index')->name('forms.index')->middleware('admin_role');
        Route::get('admin/forms/crear', 'Admin\FormController@create')->name('forms.create')->middleware('admin_role');
        Route::post('admin/forms/store', 'Admin\FormController@store')->name('forms.store')->middleware('admin_role');
        Route::get('admin/forms/{id}/editar', 'Admin\FormController@edit')->name('forms.edit')->middleware('admin_role');
        Route::post('admin/forms/update', 'Admin\FormController@update')->name('forms.update')->middleware('admin_role');
        Route::get('admin/forms/{id}/inputs/crear', 'Admin\InputController@create')->name('inputs.create')->middleware('admin_role');

        Route::get('admin/forms/{id}/borrar', 'Admin\FormController@delete')->name('forms.delete')->middleware('admin_role');

        Route::post('admin/inputs/borrar', 'Admin\InputController@delete')->name('inputs.delete')->middleware('admin_role');


        // INPUTS
        Route::get(
            'admin/inputs',
            'Admin\InputController@index'
        )->name('inputs')->middleware('admin_role');

        Route::get(
            'admin/inputs-json',
            'Admin\InputController@inputs_json'
        )->name('inputs-json')->middleware('admin_role');

        // Route::get(
        //     'admin/inputs/crear',
        //     'Admin\InputController@create'
        // )->name('inputs_create')->middleware('admin_role');

        Route::post(
            'admin/inputs/store',
            'Admin\InputController@store'
        )->name('inputs.store')->middleware('admin_role');

        Route::get(
            'admin/inputs/{id}',
            'Admin\InputController@edit'
        )->name('inputs-edit')->middleware('admin_role');

        Route::post(
            'admin/inputs/update',
            'Admin\InputController@update'
        )->name('inputs.update')->middleware('admin_role');

        // END OF INPUTS
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
