<?php

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

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->group(['prefix' => '/Laravel/route'], function () use ($router) {
    $router->get('/index/index', function () {
        \Illuminate\Support\Facades\Log::info('test tars log');
        return app('service.demo')->ping() . ':接入Laravel Router成功啦,配置:' . json_encode(config('foo'));
    });

    $router->get('/server', function() {
        try {
            $config = new \Tars\client\CommunicatorConfig();
            $config->setLocator(config('tars')['tarsregistry']);
            $config->setModuleName("PHPTest.PHPHTTPServer");
            $config->setSocketMode(2);
            $config->setCharsetName("UTF-8");

            $cservent = new \App\Tars\cservant\PHPTest\PHPServer\obj\TestTafServiceServant($config);
            return $cservent->test();
        } catch (\Throwable $e) {
            return $e->getMessage();
        }
    });
});
