<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BaseController extends Controller
{
    protected static function response($result, $message, $errors = [], $status = 200, $options = [])
    {

        return response()->json(['result' => $result, 'message' => $message, 'errors' => $errors, 'options' => $options], $status);
    }

    protected static function redirectWithResultAndMessage($route, $result, $message, $messageFor = '', $withInput = false)
    {
        $result = ($result == 'error') ? 'danger' : $result;
        return self::redirectWithMessages($route, [
            'result' => $result,
            'message' => $message,
            'message_for' => $messageFor
        ], $withInput);
    }

    protected static function redirectWithMessages($route, $messages = [], $withInput = false)
    {
        
      
    }
}
