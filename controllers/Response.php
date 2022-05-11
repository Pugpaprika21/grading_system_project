<?php

namespace grading_system_project\controllers\ResponseCode;

class Response
{
    /**
     * Undocumented function
     *
     * @param string $massage
     * @return void
     */
    public static function success(string $massage = "OK"): void
    {
        echo json_encode(array(
            "status" => 200, 
            "massage" => $massage,
            "response" => "success")
        );
    }
    /**
     * Undocumented function
     *
     * @param string $massage
     * @return void
     */
    public static function error(string $massage = "ERROR"): void
    {
        echo json_encode(array(
            "status" => 400, 
            "massage" => $massage,
            "response" => "bad")
        );
    }
    /**
     * Undocumented function
     *
     * @param array $data
     * @return void
     */
    public static function render(array $data): void
    {
        if (is_array($data)) {
            echo json_encode($data);
        } else {
            self::error();
        }
    }
}