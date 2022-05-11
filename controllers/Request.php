<?php

namespace grading_system_project\controllers\RequestObject;

class Request
{
    private static object $requests;
    /**
     * get json string from clients 
     * @method object readJsonStr()
     *
     * @param string $request
     * @return object
     */
    public static function readJsonObj(array $request_data): object
    {
        if (is_array($request_data)) {

            self::$requests = (!empty($request_data)) ? json_decode(json_encode($request_data)) : (object)[
                'massage' => 'data is null',
                'responses' => 'Client error',
                'status' => 400
            ];

            return self::$requests;
        } else {

            return (object)[
                'massage' => 'data is null',
                'responses' => 'Server error',
                'status' => 500
            ];
        }
    }
    /**
     * @method object is_File()
     *
     * @param array $file
     * @return object
     */
    public static function is_File(array $file): object
    { 
        if (is_array($file)) {
            self::$requests = json_decode(json_encode($file)) ?? null;
            return self::$requests;
        } else {
            return (object)[
                'massage' => 'data is valid!',
                'status' => 500
            ];
        }
    }
}


