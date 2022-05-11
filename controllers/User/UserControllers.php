<?php

namespace grading_system_project\controllers\User;

use grading_system_project\controllers\ResponseCode\Response;
use grading_system_project\models\queryBuilder\Query;
use PDOException;

require_once '../../models/QueryBuilder.php';
require_once '../../controllers/Response.php';

class UserControllers extends Query
{
    /**
     * Undocumented function
     *
     * @param object $request
     * @return void
     */
    public function usersRegister(object $request): void
    {
        try {

            $filename = $request->p_img;
            $tmp_name = $_FILES['p_img']['tmp_name'];
            $imageFileType = pathinfo($filename, PATHINFO_EXTENSION);
            $valid_extensions = array("jpg", "jpeg", "png");

            if (in_array($imageFileType, $valid_extensions)) {
                $nameFile = explode(".", $filename);
                $imageFileType = $nameFile[1];
                $microsec = round(microtime(true) * 1000);
                $newFileName = $microsec . "." . $imageFileType;

                $moveTo = "../../resource/upload/user_upload/" . $newFileName;

                $this->store = [
                    'username' => $request->username,
                    'password' => $request->password,
                    'fname' =>  $request->fname,
                    'lname' => $request->lname,
                    'gender' => $request->gender,
                    'b_date' => $request->b_date,
                    'branch' => $request->branch,
                    'faculty' => $request->faculty,
                    'section' => $request->section,
                    'phone' => $request->phone,
                    'email' => $request->email,
                    'p_img' => $newFileName,
                ];

                if (move_uploaded_file($tmp_name, $moveTo)) {
                    chmod("../../resource/upload/user_upload/" . $newFileName, 0777);

                    $this->sql = "";
                    $this->sql .= "INSERT INTO tbl_student(username, password, fname, lname, gender, b_date, branch, faculty, section, phone, email, p_img)";
                    $this->sql .= "VALUES(:username, :password, :fname, :lname, :gender, :b_date, :branch, :faculty, :section, :phone, :email, :p_img)";
                    $this->insert($this->sql, $this->store) ? Response::success() : Response::error();
                } else {
                    Response::error('upload img fall!');
                }
            }
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
    public function userLogin(object $request): void
    {
        try {
            $this->store = ['username' => $request->username, 'password' => $request->password];
            $this->sql = "SELECT stu_id, username, password FROM tbl_student WHERE username=:username AND password=:password";
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
    public function showGradeByID(object $request): void
    {
        try {
            $this->store = ['stu_id' => $request->stu_id];
            $this->sql = "SELECT * FROM tbl_grade_detail WHERE stu_id=:stu_id";
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
    public function getProfileByID(object $request): void
    {
        try {
            $this->store = ['stu_id' => $request->stu_id];
            $this->sql = "SELECT * FROM tbl_student WHERE stu_id=:stu_id";
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
    public function editProfile(object $request): void
    {
        try {

            $filename = $request->p_img;
            $tmp_name = $_FILES['p_img']['tmp_name'];
            $imageFileType = pathinfo($filename, PATHINFO_EXTENSION);
            $valid_extensions = array("jpg", "jpeg", "png");

            if (in_array($imageFileType, $valid_extensions)) {
                $nameFile = explode(".", $filename);
                $imageFileType = $nameFile[1];
                $microsec = round(microtime(true) * 1000);
                $newFileName = $microsec . "." . $imageFileType;

                $moveTo = "../../resource/upload/user_upload/" . $newFileName;

                $this->store = [
                    'username' => $request->username,
                    'password' => $request->password,
                    'fname' =>  $request->fname,
                    'lname' => $request->lname,
                    'gender' => $request->gender,
                    'b_date' => $request->b_date,
                    'branch' => $request->branch,
                    'faculty' => $request->faculty,
                    'section' => $request->section,
                    'phone' => $request->phone,
                    'email' => $request->email,
                    'p_img' => $newFileName,
                    'stu_id' => $request->stu_id
                ];

                if (move_uploaded_file($tmp_name, $moveTo)) {
                    chmod("../../resource/upload/user_upload/" . $newFileName, 0777);

                    $this->sql = "
                        UPDATE tbl_student 
                        SET username=:username,
                            password=:password,
                            fname=:fname,
                            lname=:lname,
                            gender=:gender,
                            b_date=:b_date,
                            branch=:branch,
                            faculty=:faculty,
                            section=:section,
                            phone=:phone,
                            email=:email,
                            p_img=:p_img
                        WHERE stu_id=:stu_id
                    ";

                    $this->update($this->sql, $this->store) ? Response::success() : Response::error();
                } else {
                    Response::error('upload img fall!');
                }
            }
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
    public function getGradeToSideBar(object $request): void
    {
        try {
            $this->store = ['stu_id' => $request->stu_id];
            $this->sql = "SELECT * FROM tbl_grade WHERE stu_id=:stu_id";
            Response::render($this->select($this->sql, $this->store));
        } catch (PDOException $err) {
            Response::error($err->getMessage());
        }
    }
}
