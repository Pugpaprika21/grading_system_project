<?php

namespace grading_system_project\controllers\Admin;

use DateTime;
use grading_system_project\controllers\ResponseCode\Response;
use grading_system_project\models\queryBuilder\Query;
use PDOException;

require_once '../../models/QueryBuilder.php';
require_once '../../controllers/Response.php';
require_once '../../controllers/Request.php';

class AdminControllers extends Query
{
    /**
     * admin_login
     *
     * @param object $request
     * @return void
     */
    public function adminLogin(object $request): void
    {
        try {

            $this->store = ['username' => $request->username, 'password' => $request->password];
            $this->sql = "SELECT admin_id, username, password FROM tbl_admin WHERE username=:username AND password=:password";
            Response::render($this->select($this->sql, $this->store));
        } catch (PDOException $err) {
            Response::error($err->getMessage());
        }
    }
    /**
     * Undocumented function
     *
     * @return void
     */
    public function showStudentIDToOption(): void
    {
        try {
            $this->sql = "SELECT stu_id FROM tbl_student";
            Response::render($this->select($this->sql));
        } catch (PDOException $err) {
            Response::error($err->getMessage());
        }
    }
    /**
     * Undocumented function
     *
     * @param object $request
     * @return void
     */
    public function getStuDetaliByID(object $request): void
    {
        try {
            $this->sql = "SELECT * FROM tbl_student WHERE stu_id=:stu_id";
            $this->store = ['stu_id' => $request->stu_id];
            Response::render($this->select($this->sql, $this->store));
        } catch (PDOException $err) {
            Response::error($err->getMessage());
        }
    }
    /**
     * add grade information
     *
     * @param object $request
     * @return void
     */
    public function insertGrade(object $request): void
    {
        try {

            $this->store = [
                'admin_id' => $request->admin_id,
                'stu_id' => $request->stu_id,
                'term' => $request->term,
                'sec' => $request->sec,
                'course_code' => $request->course_code,
                'course_name' => $request->course_name,
                'credit' => $request->credit,
                'grade' => $this->getGrade($request->grade),
                'group_sec' => $request->group_sec,
                'grade_date' => $request->grade_date,
            ];

            foreach ($this->store as $key => $values) {
                if ($values != null) {
                    $this->sql = "";
                    $this->sql .= "INSERT INTO tbl_grade_detail(admin_id, stu_id, term, sec, course_code, course_name, credit, grade, group_sec, grade_date)";
                    $this->sql .= "VALUES(:admin_id, :stu_id, :term, :sec, :course_code, :course_name, :credit, :grade, :group_sec, :grade_date)";
                    $this->insert($this->sql, $this->store) ? Response::success() : Response::error();
                    break;
                }
            }
        } catch (PDOException $err) {
            Response::error($err->getMessage());
        }
    }
    /**
     * @method float getGrade()
     * @param string $grade
     * @return float
     */
    public function getGrade(string $grade): float
    {
        try {

            return match ($grade) {
                'A' => 4.00,
                'B+' => 3.50,
                'B' => 3.00,
                'C+' => 2.50,
                'C' => 2.00,
                'D+' => 1.50,
                'D' => 1.00,
                default => 0.00
            };
        } catch (PDOException $err) {
            Response::error($err->getMessage());
        }
    }
    /**
     * @method object calGrade()
     * @param object $request
     * @return void
     */
    public function calAvgGrade(object $request): void
    {
        try {
            
            $getCreditAsGrade = new Query();
            $this->store = ['stu_id' => $request->stu_id];
            $this->sql = "SELECT credit, grade FROM tbl_grade_detail WHERE stu_id=:stu_id";
            $credit_as_grade = $getCreditAsGrade->select($this->sql, $this->store);
            //
            $checkGrade_total = new Query();
            $this->store = ['stu_id' => $request->stu_id];
            $this->sql = "SELECT grade_total FROM tbl_grade WHERE stu_id=:stu_id";
            $duplicate = $checkGrade_total->select($this->sql, $this->store);
            
            if (count($duplicate) == 0) { 
                $this->addGradeTotal((int)$request->stu_id, $this->gradeResult($credit_as_grade));
            } else {
                $this->updateGrade((int)$request->stu_id, $this->gradeResult($credit_as_grade));
            }
            
        } catch (PDOException $err) {
            Response::error($err->getMessage());
        }
    }
    /**
     * Undocumented function
     *
     * @param array $credit_as_grade
     * @return object
     */
    public function gradeResult(array $credit_as_grade): object
    {
        try {

            $credit_arr = [];
            $grade_arr = [];
            $store_grade = [];
            //
            for ($i = 0; $i < count($credit_as_grade); $i++) 
            {
                $credit_arr[$i] = $credit_as_grade[$i]->credit;
                $grade_arr[$i] = $credit_as_grade[$i]->grade;
                //
                for ($j = 0; $j < count($credit_arr); $j++) 
                {
                    for ($k = 0; $k < count($grade_arr); $k++) 
                    {
                        $store_grade[$i] = ($credit_arr[$i] * $grade_arr[$i]);
                    }
                }
            }
            //
            $credit_result = array_sum($credit_arr);
            $total_grade = (array_sum($store_grade) / $credit_result);
            $grade_result = number_format($total_grade, 2);
            //
            return (object)[
                'credit_result' => $credit_result,
                'grade_result' => $grade_result
            ];

        } catch (PDOException $err) {
            Response::error($err->getMessage());
        }
    }
    /**
     * Undocumented function
     *
     * @param integer $stu_id
     * @param object $calGrade
     * @return void
     */
    public function addGradeTotal(int $stu_id, object $calGrade): void
    {
        try {

            $dataTime = new DateTime();
            $this->sql = "";
            $this->sql .= "INSERT INTO tbl_grade(stu_id, grade_total, credit_total, date_add_grade)";
            $this->sql .= "VALUES(:stu_id, :grade_total, :credit_total, :date_add_grade)";
            //
            $this->store = [
                'stu_id' => $stu_id,
                'grade_total' => $calGrade->grade_result,
                'credit_total' => $calGrade->credit_result,
                'date_add_grade' => $dataTime->format('Y-m-d H:i:s')
            ];

            if ($this->insert($this->sql, $this->store)) {
                Response::render([
                    'grade_tolal' => $calGrade->credit_result,
                    'credit_total' => $calGrade->grade_result,
                ]);
            } else {
                Response::error('add grade error!');
            }
        } catch (PDOException $err) {
            Response::error($err->getMessage());
        }
    }
    /**
     * Undocumented function
     *
     * @param integer $stu_id
     * @param object $calGrade
     * @return void
     */
    public function updateGrade(int $stu_id, object $calGrade): void
    {
        try {
            
            $this->sql = "UPDATE tbl_grade 
                SET grade_total=:grade_total, 
                    credit_total=:credit_total, 
                    date_add_grade=:date_add_grade 
                WHERE stu_id=:stu_id";

            $dataTime = new DateTime();
            $this->store = [
                'grade_total' => $calGrade->grade_result,
                'credit_total' => $calGrade->credit_result,
                'date_add_grade' => $dataTime->format('Y-m-d H:i:s'),
                'stu_id' => $stu_id,
            ];

            if ($this->update($this->sql, $this->store)) {
                Response::render([
                    'stu_id' => $stu_id,
                    'massage' => 'update', 
                    'grade_total' => $calGrade->grade_result
                ]);
            } else {
                Response::error();
            }

        } catch (PDOException $err) {
            Response::error($err->getMessage());
        }
    }
    /**
     * display student data to Table admin
     *
     * @return void
     */
    public function displayToTable(): void
    {
        try {
            $this->sql = "SELECT * FROM tbl_student";
            Response::render($this->select($this->sql));
        } catch (PDOException $err) {
            Response::error($err->getMessage());
        }
    }
    /**
     * Undocumented function
     *
     * @param object $request
     * @return void
     */
    public function getGradeDetail(object $request): void
    {
        try {
            $this->sql = "SELECT * FROM tbl_grade_detail WHERE stu_id=:stu_id";
            $this->store = ['stu_id' => $request->stu_id];
            Response::render($this->select($this->sql, $this->store));
        } catch (PDOException $err) {
            Response::error($err->getMessage());
        }
    }
    /**
     * Undocumented function
     *
     * @param object $request
     * @return void
     */
    public function deleteMutipleCourse(object $request): void
    {
        try {
            $gradedt_id = implode(', ', $request->gradedt_id);
            $this->sql = "DELETE FROM tbl_grade_detail WHERE gradedt_id IN ($gradedt_id)";
            $this->delete($this->sql) ? Response::success() : Response::error();
        } catch (PDOException $err) {
            Response::error($err->getMessage());
        }
    }
    /**
     * Undocumented function
     *
     * @param object $request
     * @return void
     */
    public function delStud(object $request): void
    {
        try {
            $this->store = ['stu_id' => $request->stu_id];
            $this->sql = "DELETE FROM tbl_grade_detail WHERE stu_id=:stu_id";
            $this->delete($this->sql, $this->store) ? Response::success() : Response::error();
        } catch (PDOException $err) {
            Response::error($err->getMessage());
        }
    }
}
