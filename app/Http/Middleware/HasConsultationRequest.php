<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class HasConsultationRequest
{
    public function handle(Request $request, Closure $next)
    {
        $user = auth()->user();

        if (!$user || !$user->consultationRequests()->exists()) {
            return redirect()
                ->route('student.dashboard')
                ->with('error', 'Please submit a counseling request first.');
        }

        return $next($request);
    }
}