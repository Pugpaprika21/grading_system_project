<?php

use grading_system_project\controllers\ResponseCode\Response;
use grading_system_project\controllers\User\UserControllers;

require_once '../../controllers/User/UserControllers.php';
require_once '../../controllers/Response.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    
    $getGrades = new UserControllers();
    $getGrades->getGradeToSideBar((object)[
        'stu_id' => $_GET['stu_id']
    ]);

} else {
    Response::error();
}
