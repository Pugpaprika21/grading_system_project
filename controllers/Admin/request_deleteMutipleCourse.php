<?php

use grading_system_project\controllers\ResponseCode\Response;
use grading_system_project\controllers\Admin\AdminControllers;

require_once '../../controllers/Admin/AdminControllers.php';
require_once '../../controllers/Response.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $deleteMutiples = new AdminControllers();
    $deleteMutiples->deleteMutipleCourse((object)[
        'gradedt_id' => $_POST['gradedt_id']
    ]);

} else {
    Response::error();
}
