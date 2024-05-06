<?php

namespace App\Exceptions;

use Throwable;
use Illuminate\Support\Arr;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Auth\AuthenticationException;


class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {

        });

    }
    protected function unauthenticated($request, AuthenticationException $exception)
    {
        $guard = Arr::first($exception->guards());
        // return $this->shouldReturnJson($request, $exception)
        //     ? response()->json(['message' => $exception->getMessage()], 401)
        //     : redirect()->guest($guard === 'etudiant' ? route('etudiant.login') : route('login'));
            if ($this->shouldReturnJson($request, $exception)) {
                return response()->json(['message' => $exception->getMessage()], 401);
            } else {
                if ($guard === 'etudiant') {
                    return redirect()->guest(route('etudiant.login'));
                }
                elseif($guard==="professeur") {
                    return redirect()->guest(route('professeur.login'));
                }
                elseif($guard==="decanat") {
                    return redirect()->guest(route('decanat.login'));
                }
                elseif($guard==="doctrant") {
                    return redirect()->guest(route('doctrant.login'));
                }
                elseif($guard==="fonctionnaire") {
                    return redirect()->guest(route('fonctionnaire.login'));

                }
                elseif($guard==="apogee") {
                    return redirect()->guest(route('apogee.login'));
                }
                else{
                    return redirect()->guest(route('login'));
                }
            }
    }
}
