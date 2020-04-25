<?php


namespace App\Http\Controllers;


use App\Services\Utility\MyLogger2;
use Illuminate\Support\Facades\Session;

class SignOutController extends Controller
{

    // Doesn't take any information from a previous form or anything simply logs actions flushes the session and returns to home
    public function index()
    {
        MyLogger2::info("Entering SignOutController.index()");
        try {
           
            // Flushing session variables will effectively log the user out of the website
            Session::flush();


            return view('home');
        } catch (\Exception $e){
            
        }
        MyLogger2::info("Exit RegistrationController.index()");
    }
}
