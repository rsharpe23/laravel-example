<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApiController extends Controller
{
    protected function sendData($data, $status = 200)
    {
        return $this->sendResult(['data' => $data], $status);
    }

    protected function sendSuccess($status = 200)
    {
        return $this->sendResult(['success' => true], $status);
    }

    protected function sendError($message, $errors = [], $status = 404)
    {
        return $this->sendResult(['message' => $message, 'errors' => $errors], $status);
    }

    private function sendResult($result, $status, $headers = [], $options = JSON_UNESCAPED_UNICODE)
    {
        return response()->json($result, $status, $headers, $options);
    }
}
