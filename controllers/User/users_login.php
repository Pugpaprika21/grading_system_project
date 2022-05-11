<?php

use grading_system_project\controllers\ResponseCode\Response;
use grading_system_project\controllers\User\UserControllers;

require_once '../../controllers/User/UserControllers.php';
require_once '../../controllers/Response.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $userRegister = new UserControllers();
    $userRegister->userLogin((object)[
        'username' => $_POST['username'],
        'password' => $_POST['password']
    ]);

} else {
    Response::error();
}
