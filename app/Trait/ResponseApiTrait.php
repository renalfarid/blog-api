<?php

namespace App\Trait;

trait ResponseApiTrait
{
    /**
     * Core of response
     * 
     * @param   string          $message
     * @param   array|object    $data
     * @param   integer         $statusCode  
     * @param   boolean         $isSuccess
     */
    public function coreResponse($message, $data = null, $statusCode, $isSuccess = true)
    {
        // Check the params
        if(!$message) return response()->json(['message' => 'Message is required'], 500);

        // Send the response
        if($isSuccess) {
            return response()->json([
                'message' => $message,
                'success' => true,
                'code' => $statusCode,
                'results' => $data
            ], $statusCode);
        } else {
            return response()->json([
                'message' => $message,
                'success' => false,
                'code' => $statusCode,
            ], $statusCode);
        }
    }

    /**
     * Send any success response
     * 
     * @param   string          $message
     * @param   array|object    $data
     * @param   integer         $statusCode
     */
    public function success($message, $data, $statusCode = 200)
    {
        return $this->coreResponse($message, $data, $statusCode);
    }

    /**
     * Send any error response
     * 
     * @param   string          $message
     * @param   integer         $statusCode    
     */
    public function error($message, $statusCode = 500)
    {
        return $this->coreResponse($message, null, $statusCode, false);
    }

}
