<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Business\SecurityService;
use App\Services\Utility\MyLogger2;
use App\Models\UserModel;

class LoginController extends Controller
{
    
    // Function recieves user login input, then authenticates user input against database entries
    public function index(Request $request)
    {
        MyLogger2::info("Entering LoginController.index()");
        
        // Validates the user's input against pre-defined rules
        $this->validateForm($request);
        
        try {
            
            // Get user form input from request
            $user = new UserModel(NULL, $request->input('username'), $request->input('password'), NULL, NULL, NULL, NULL, NULL);
            
            // Creates an instance of the security service class
            $securityService = new SecurityService();
            
            // Stores the results from the database query for logging in
            $results = $securityService->login($user);
            
            // Stores all of the necessary information from the login in the session in the event of a successful login
            if ($results['result'] && $results['user']['STATUS']) {
                session([
                    'ID' => $results['user']['IDUSERS']
                ]);
                session([
                    'USERNAME' => $results['user']['USERNAME']
                ]);
                session([
                    'NAME' => [
                        'FIRSTNAME' => $results['user']['FIRSTNAME'],
                        'LASTNAME' => $results['user']['LASTNAME']]]);
                session(['ROLE' => $results['user']['ROLE']]);
            }
            
            // Stores result from attempted login
            $data = [
                'result' => $results['result'],
                'status' => $results['user']['STATUS']
            ];
            
          
            
            return view('loginResult')->with($data);
        } catch (\Exception $e) {
           
            $data = ['error_message' => $e->getMessage()];
            return view('error')->with($data);
        }
        MyLogger2::info("Exit LoginController.index()");
    }
    
    
    // Contains the validation rules for the user's login input
    private function validateForm(Request $request)
    {
        $rules = [
            'username' => 'Required | Between:4,10 | Alpha',
            'password' => 'Required | Between:4,10'];
        
        $this->validate($request, $rules);
    }
}