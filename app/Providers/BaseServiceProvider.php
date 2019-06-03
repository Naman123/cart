<?php

namespace App\Providers;
use Illuminate\Support\ServiceProvider;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Log;

class BaseServiceProvider extends ServiceProvider
{
    /**
     * Description : For all successful response.
     * @param type $message
     * @param type $data
     * @return array
     */
    public static function responseSuccess($message = '', $data = array(), $statusCode = Response::HTTP_OK) {
       $response = array(
            'status' => true,
            'status_code' => $statusCode,
            'message' => $message,
            'result' => $data,
        );

        return $response;
    }

    /**
     * Description : For all error response.
     * @param type $message
     * @param type $data
     * @return array
     */
    public static function responseError($message = '', $data = array(),$statusCode = Response::HTTP_INTERNAL_SERVER_ERROR) {
        $response = array(
            'status' => false,
            'status_code' => $statusCode,
            'message' => $message,
            'result' => (object) $data,
        );
        
        return $response;
    }
    
    public static function responseNotFound($message = '', $data = array(),$statusCode = Response::HTTP_NOT_FOUND) {
        $response = array(
            'status' => false,
            'status_code' => $statusCode,
            'message' => $message,
            'result' => (object) $data,
        );
        return $response;
    }
    
    public static function responseBadRequest($message = '', $data = array(),$statusCode = Response::HTTP_BAD_REQUEST) {
        $response = array(
            'status' => false,
            'status_code' => $statusCode,
            'message' => $message,
            'result' => array(
                "status" => 0,
                "message" => $message,
                "errors"=> $data,
                "data" => []
            ),
        );
        return $response;
    }
    
    public static function responseUnAuthorized($message = '', $data = array(),$statusCode = Response::HTTP_FORBIDDEN) {
        $response = array(
            'status' => false,
            'status_code' => $statusCode,
            'message' => $message,
            'result' => (object) $data,
        );
        return $response;
    }

    public static function customResponse($message = '', $statusCode = '') {
        $response = array(
            'status' => false,
            'status_code' => $statusCode,
            'message' => $message,
            'result' => null
        );
        return $response;
    }
    
    public static function responseException($exception){
        self::setExceptionError($exception);
        if(env('APP_DEBUG')){
            $message = "There is some exception in " . $exception->getFile() . " on line no: " . $exception->getLine() . " Message: " . $exception->getMessage();
        }else{
            $message = "Something went wrong. Please try again later";
        }
        $response = array(
            'status' => false,
            'status_code' => Response::HTTP_INTERNAL_SERVER_ERROR,
            'message' => $message,
            'result' => null
        );
        return $response;
    }

    /**
     * Description : For Log all error response.
     * @param type Exception
     * */
    public static function setExceptionError(\Exception $e) {
        Log::error("There is some exception in " . $e->getFile() . " on line no: " . $e->getLine() . " Message: " . $e->getMessage());
    }
    
    public static function getCompanyResponse($data,$message ="",$status = 1, $errors = []){
        $tempArray = array(
            "status" => $status,
            "message" => $message,
            "errors" => $errors,
            "data"=>$data
        );
        return $tempArray;
    }
}
