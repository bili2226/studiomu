<?php

namespace App\Http\Middleware;

  use Closure;
  use Illuminate\Http\Request;
  use Symfony\Component\HttpFoundation\Response;
  use Illuminate\Support\Facades\Auth;

  class RoleMiddleware
  {
      /**
       * Handle an incoming request.
       *
       * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
       */
      public function handle(Request $request, Closure $next, string $role): Response
      {
          if (!Auth::check()) {
              return redirect('/login');
          }

          $user = Auth::user();
          if ($user->role !== $role) {
              // Redirect based on user's actual role if they try to access a restricted area
              if ($user->role === 'admin') {
                  return redirect('/admin/dashboard');
              } elseif ($user->role === 'photographer') {
                  return redirect('/photographer/jadwal');
              } else {
                  return redirect('/menu-utama');
              }
          }

          return $next($request);
      }
  }
