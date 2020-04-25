<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Business\ProductService;
use App\Services\Utility\MyLogger2;



class ProductController extends Controller
{

    // Method gets the all the Product data in the database and returns it to the admin page so administrators can manage Products
    public function index()
    {
        MyLogger2::info("Entering ProductController.index()");
        try {
            
            // Creates new instance of the appropriate service
            $service = new ProductService();

            // Stores the results of the respective data access object's query
            $results = $service->getAllProducts();

            // Stores the results in an associative array to be passed on to the admin view
            $data = [
                'results' => $results
            ];

            

            return view('products')->with($data);
        } catch (\Exception $e) {
           
            $data = ['error_message' => $e->getMessage()];
            return view('error')->with($data);
        }
        
        MyLogger2::info("Exit ProductController.index()");
    }

   
    
   

    // Contains the rules for validating form input for editing Products
    private function validateEdit(Request $request)
    {
        $rules = [
            'name' => 'Required | Between:1,20',
            'price' => 'Required | Between:1,500',
            'quantity' => 'Required | Between:1,200',
            'description' => 'Required | Between:1,45 | Alpha'
        ];

        $this->validate($request, $rules);
    }

  
}
