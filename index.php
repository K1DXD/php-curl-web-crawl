<?php
    include 'router/router.php';
    include 'crawler-library/parser.php';
    include 'crawler-library/warpper.php';
    include 'mysql/addData.php';
    include 'mysql/conn.php';
    include 'form/logic.php';
    $router = new Router();
    $router->action();