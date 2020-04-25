<?php



namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Services\Business\UserService;
use App\Services\Utility\MyLogger2;

use App\Models\UserModel;

class UserAdminController extends Controller
{

    // Method gets the all the user data in the database and returns it to the admin page so administrators can manage users
    public function index()
    {
        MyLogger2::info("Entering UserAdminController.index()");
        
        try {
           

            // Creates new instance of the appropriate service
            $service = new UserService();

            // Stores the results of the respective data access object's query
            $results = $service->getAllUsers();

            // Stores the results in an associative array to be passed on to the admin view
            $data = [
                'results' => $results
            ];

          

            return view('userAdmin')->with($data);
        } catch (\Exception $e) {
           
            $data = ['error_message' => $e->getMessage()];
            return view('error')->with($data);
        }
        MyLogger2::info("Ecit UserAdminController.index()");
    }

    // Method takes form input from the previous form and attempts to update the database entry for the corresponding user
    public function editUser(Request $request)
    {
        MyLogger2::info("Entering UserAminController.editUser()");
       

        // Validates form input against pre-defined rules
        $this->validateEdit($request);
        
        try {

            // Creates a new user Model using the information gotten from the form input
            $user = new UserModel($request->input('id'), $request->input('username'), $request->input('password'), $request->input('email'), $request->input('firstname'), $request->input('lastname'), $request->input('status'), $request->input('role'));

            // Creates a new instance of the appropriate business service
            $service = new UserService();

            // Stores the results of the appropriate query
            $results = $service->editUser($user);

           

            if ($results) {
                return view('userAdmin')->with(['results' => $service->getAllUsers()]);
            }
        } catch (\Exception $e) {
           
            $data = ['error_message' => $e->getMessage()];
            return view('error')->with($data);
        }
        MyLogger2::info("Exit UserAminController.editUser()");
    }

    // Contains the rules for validating form input for editing users
    private function validateEdit(Request $request)
    {
        $rules = [
            'username' => 'Required | Between:4,10',
            'password' => 'Required | Between:4,10',
            'email' => 'Required | email',
            'firstname' => 'Required | Between:4,10 | Alpha',
            'lastname' => 'Required | Between:4,10 | Alpha'
        ];

        $this->validate($request, $rules);
    }

    // Method takes an ID from the form that submitted the request and attempts to delete the user of the corresponding ID
    public function removeUser(Request $request)
    {
        MyLogger2::info("Entering UserAdminController.removeUser()");

        try {

            // Get's the user's ID from the previous form
            $id = $request->input('id');

            // Creates an instance of the appropriate business service
            $service = new UserService();

            // Stores the result of the attempted removal of the user
            $results = $service->removeUser($id);

          

            if ($results) {
                return view('userAdmin')->with(['results' => $service->getAllUsers()]);
            }
        } catch (\Exception $e) {
          
            $data = ['error_message' => $e->getMessage()];
            return view('error')->with($data);
        }
        MyLogger2::info("Exit UserAdminController.removeUser()");
    }
}
