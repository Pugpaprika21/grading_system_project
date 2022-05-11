<?php

use grading_system_project\controllers\Admin\dashBoard\AdminDashBoard;
use grading_system_project\controllers\ResponseCode\Response;

require_once '../../controllers/Admin/AdminDashBoard.php';
require_once '../../controllers/Response.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    $dsb = new AdminDashBoard();
    $dsb->displayStaticGrade();
   
} else {
    Response::error('REQUEST -> method get');
}
