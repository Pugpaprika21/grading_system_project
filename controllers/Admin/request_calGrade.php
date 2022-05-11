<?php

use grading_system_project\controllers\ResponseCode\Response;
use grading_system_project\controllers\Admin\AdminControllers;
use grading_system_project\controllers\RequestObject\Request;

require_once '../../controllers/Admin/AdminControllers.php';
require_once '../../controllers/Response.php';
require_once '../../controllers/Request.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $calGrades = new AdminControllers();
    $calGrades->calAvgGrade((object)[
        'stu_id' => $_GET['stu_id']
    ]);
} else {
    Response::error();
}
