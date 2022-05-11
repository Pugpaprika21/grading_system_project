<?php

namespace grading_system_project\controllers\Admin\dashBoard;

use grading_system_project\controllers\Admin\AdminControllers;
use grading_system_project\controllers\ResponseCode\Response;
use PDOException;

require_once '../../models/QueryBuilder.php';
require_once '../../controllers/Admin/AdminControllers.php';
require_once '../../controllers/Response.php';

class AdminDashBoard extends AdminControllers
{
    /**
     * Undocumented function 
     *
     * @return void
     */
    public function displayStaticGrade(): void
    {
        try {

            $a_n = $b_p = $b_n = $c_p = $c_n = $d_p = $d_n = $f_n = 0;
            
            $getGrade = $this->select("SELECT grade FROM tbl_grade_detail");
            for ($i = 0; $i < count($getGrade); $i++) {
                if ($getGrade[$i]->grade == 4.00) {
                    $a_n++;
                } else if ($getGrade[$i]->grade == 3.50) {
                    $b_p++;
                } else if ($getGrade[$i]->grade == 3.00) {
                    $b_n++;
                } else if ($getGrade[$i]->grade == 2.50) {
                    $c_p++;
                } else if ($getGrade[$i]->grade == 2.00) {
                    $c_n++;
                } else if ($getGrade[$i]->grade == 1.50) {
                    $d_p++;
                } else if ($getGrade[$i]->grade == 1.00) {
                    $d_n++;
                } else {
                    $f_n++;
                }
            }

            $str_grade = [];
            array_push($str_grade, [$a_n, $b_p, $b_n, $c_p, $c_n, $d_p, $d_n, $f_n]);
            Response::render($str_grade);

        } catch (PDOException $err) {
            Response::error($err->getMessage());
        }
    }
}
