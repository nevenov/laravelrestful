<?php

namespace App\Exceptions;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpFoundation\Response;

trait ExceptionTrait {

    public function ApiException($request, $ex)
    {
        if ($this->isModel($ex)) {
            return $this->ModelResponse($ex);
        }

        if ($this->isHTTP($ex)) {
            return $this->HttpResponse($ex);
        }

        return parent::render($request, $ex);
    }


    protected function isModel($ex)
    {
        return $ex instanceof ModelNotFoundException;
    }

    protected function isHTTP($ex)
    {
        return $ex instanceof NotFoundHttpException;
    }

    protected function ModelResponse($ex)
    {
        return response()->json(
            [
                'error' => "Product Model Not found"
            ],
            Response::HTTP_NOT_FOUND);
    }

    protected function HttpResponse($ex)
    {
        return response()->json(
            [
                'error' => "Incorrect URL or Route"
            ],
            Response::HTTP_NOT_FOUND);
    }


}