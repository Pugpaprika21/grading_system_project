<?php

use grading_system_project\controllers\ResponseCode\Response;
use grading_system_project\controllers\Admin\AdminControllers;

require_once '../../controllers/Admin/AdminControllers.php';
require_once '../../controllers/Response.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $insertGrades = new AdminControllers();
    $insertGrades->adminLogin((object)[
       'username' => $_POST['username'],
       'password' => $_POST['password']
    ]);

} else {
    Response::error();
}
