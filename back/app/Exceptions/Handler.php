<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $e)
    {
            // Define the response
            $response = [
                'errors' => 'Sorry, something went wrong.'
            ];
    
            // If the app is in debug mode
            if (config('app.debug')) {
                // Add the exception class name, message and stack trace to response
                $response['exception'] = get_class($e); // Reflection might be better here
                if(strpos($e, 'SQL') !== false){
                    if(strpos($e, '1062') !== false){
                        if(strpos($e, 'cedula') !== false) {
                            $response['msg'] = "El número de cédula ingresado ya existe";
                        } else if (strpos($e, 'correo') !== false) {
                            $response['msg'] = "El correo ingresado ya existe";
                        } else {
                            $response['msg'] = $e;
                        }                    
                    } else {
                        $response['msg'] = $e;
                    }                    
                } else {
                    $response['msg'] = "Falló la operación, verifique los datosAAAAAAA";
                }
                $response['message'] = $e->getMessage();
                $response['trace'] = $e->getTrace();
            }
    
            // Default response of 400
            $status = 400;
    
            // If this exception is an instance of HttpException
            if ($this->isHttpException($e)) {
                // Grab the HTTP status code from the Exception
                $status = $e->getStatusCode();
            }
    
            // Return a JSON response with the response array and status code
            return response()->json($response, $status);
        // Default to the parent class' implementation of handler
        return parent::render($request, $e);
    }
}
