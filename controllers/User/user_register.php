<?php

use grading_system_project\controllers\ResponseCode\Response;
use grading_system_project\controllers\User\UserControllers;

require_once '../../controllers/User/UserControllers.php';
require_once '../../controllers/Response.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $userRegister = new UserControllers();
    $userRegister->usersRegister((object)[
        'username' => $_POST['username'],
        'password' => $_POST['password'],
        'fname' => $_POST['fname'],
        'lname' => $_POST['lname'],
        'gender' => $_POST['gender'],
        'b_date' => $_POST['b_date'],
        'branch' => $_POST['branch'],
        'faculty' => $_POST['faculty'],
        'section' => $_POST['section'],
        'phone' => $_POST['phone'],
        'email' => $_POST['email'],
        'p_img' => $_FILES['p_img']['name'],
    ]); 

} else {
    Response::error();
}
