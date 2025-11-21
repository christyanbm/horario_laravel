<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = \Auth::user();

        if ($user->hasRole('admin')) {
            return redirect('admin/dashboard');
        } elseif ($user->hasRole('alumno')) {
            return redirect('alumno/dashboard');
        } elseif ($user->hasRole('jefe')) {
            return redirect('jefe/dashboard');
        } elseif ($user->hasRole('maestro')) {
            return redirect('maestro/dashboard');
        } elseif ($user->hasRole('coordinador')) {
            return redirect('coordinador/dashboard');
        }
  return redirect('/');
      //  return view('home');
    }
}
