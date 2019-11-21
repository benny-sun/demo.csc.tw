<?php

use Illuminate\Routing\Router;

Admin::registerAuthRoutes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
], function (Router $router) {

    $router->get('/', 'HomeController@index');
    
    $router->resources([

        'official/header'                   => HeaderController::class,
        'official/welcome'                  => WelcomeController::class,
        'official/honor'                    => HonorController::class,
        'official/about'                    => AboutController::class,
        'official/about-background'         => AboutBackgroundController::class,
        'official/partners'                 => PartnerController::class,
        'official/contact'                  => ContactController::class,
        'official/mails'                    => MaildataController::class,

        'albums/top-bottom'                 => AlbumHeaderController::class,
        'albums/covers'                     => AlbumCoverController::class,
        'albums/management'                 => CatelogController::class,
        'albums/flyer'                      => FlyerController::class,

    ]);
});
