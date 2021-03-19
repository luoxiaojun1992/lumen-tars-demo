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

$router->group(['prefix' => '/test'], function () use ($router) {
    $router->get('/http', function () {
        \Illuminate\Support\Facades\Log::info('test lumen tars log');
        return '接入Lumen Router成功啦' .
            ',ping:' . (app('service.demo')->ping()) .
            ',配置:' . json_encode(config('foo')) .
            ',入参:' . json_encode(app('request')->all()) .
            ',Auth:' . (\Illuminate\Support\Facades\Auth::user()->name) .
            ',Memory:' . ((string)memory_get_usage());
    });

    $router->get('/tars', function () {
        try {
            $config = \Lxj\Laravel\Tars\Config::communicatorConfig(config('tars.deploy_cfg'));
            $cservent = new \App\Tars\cservant\PHPTest\LumenTars\tarsObj\TestTafServiceServant($config);
            return $cservent->test();
        } catch (\Throwable $e) {
            return $e->getMessage();
        }
    });
});
