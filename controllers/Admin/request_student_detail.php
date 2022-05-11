<?php

use grading_system_project\controllers\ResponseCode\Response;
use grading_system_project\controllers\Admin\AdminControllers;

require_once '../../controllers/Admin/AdminControllers.php';
require_once '../../controllers/Response.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    $getStudent_id = new AdminControllers();
    $getStudent_id->getStuDetaliByID((object)[
        'stu_id' => $_GET['stu_id']
    ]);

} else {
    Response::error();
}
