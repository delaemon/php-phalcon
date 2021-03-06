<?php

try {

    $loader = new Phalcon\Loader();
    $loader->registerDirs(array(
        '../app/controllers/',
        '../app/models/'
    ))->register();

    $di = new Phalcon\DI\FactoryDefault();

    $di->set('db', function () {
        return new Phalcon\Db\Adapter\Pdo\Mysql(array(
            "host" => "localhost",
            "username" => "test",
            "password" => "test",
            "dbname" => "phalcon_test"
        ));
    });

    $di->set('view', function () {
        $view = new Phalcon\Mvc\View();
        $view->setViewsDir('../app/views/');
        return $view;
    });

    $di->set('url', function () {
        $url = new Phalcon\Mvc\Url();
        $url->setBaseUri('/');
        return $url;
    });

    $application = new Phalcon\Mvc\Application($di);

    echo $application->handle()->getContent();

} catch (\Phalcon\Exception $e) {
     echo "PhalconException: ", $e->getMessage();
}
