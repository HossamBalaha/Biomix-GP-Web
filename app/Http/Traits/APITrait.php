<?php

namespace App\Http\Traits;

trait APITrait
{
    public function encapsulate($isSuccess, $data, $errors)
    {
        return response()->json([
            'success' => $isSuccess,
            'data' => $data,
            'errors' => $errors,
        ]);
    }

    public function encapsulateData($data)
    {
        return $this->encapsulate(true, $data, null);
    }

    public function encapsulateErrors($errors)
    {
        return $this->encapsulate(false, null, $errors);
    }
}
