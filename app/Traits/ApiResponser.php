<?php

namespace App\Traits;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

trait ApiResponser
{
    private function successResponse($data, $code)
    {
        return response()->json($data, $code);
    }

    protected function successMessage($message, $code)
    {
        return response()->json(['message' => $message, 'code' => $code,'status'=>true,'data'=>array()], $code);
    }

    protected function errorResponse($message, $code)
    {
        return response()->json(['message' => $message,'status'=>false,'data'=>(object)[]], $code);
    }


    protected function showAll(Collection $collection, $code=200,$message='')
    {
        return $this->successResponse(['data' => $collection,'status'=>true,'message' => $message], $code);
    }


    protected function showOne(Model $model, $code=200,$message)
    {
        return $this->successResponse(['data' => $model,'status'=>true,'message' => $message], $code);
    }
}
