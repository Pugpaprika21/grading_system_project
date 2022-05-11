<?php

use grading_system_project\controllers\ResponseCode\Response;
use grading_system_project\controllers\Admin\AdminControllers;

require_once '../../controllers/Admin/AdminControllers.php';
require_once '../../controllers/Response.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $insertGrades = new AdminControllers();
    $insertGrades->insertGrade((object)[
        'admin_id' => $_POST['admin_id'],
        'stu_id' => $_POST['stu_id'],
        'term' => $_POST['term'],
        'sec' => $_POST['sec'],
        'course_code' => $_POST['course_code'],
        'course_name' => $_POST['course_name'],
        'credit' => $_POST['credit'],
        'grade' => $_POST['grade'],
        'group_sec' => $_POST['group_sec'],
        'grade_date' => $_POST['grade_date']
    ]);

} else {
    Response::error();
}
