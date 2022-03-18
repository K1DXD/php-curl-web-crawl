<?php
    require_once 'vendor/autoload.php';
    use App\Router\Router as Router;
    use App\Form\Logic as Logic;

    $router = new Router(new Logic());
    $router->action();