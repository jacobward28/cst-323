<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Business\ProductService;
use App\Services\Utility\MyLogger2;
use App\Models\ProductModel;

class ProductAdminController extends Controller
{

    // Method gets the all the Product data in the database and returns it to the admin page so administrators can manage Products
    public function index()
    {
        MyLogger2::info("Entering ProductAdminController.index()");
        
        try {
            
            // Creates new instance of the appropriate service
            $service = new ProductService();

            // Stores the results of the respective data access object's query
            $results = $service->getAllProducts();

            // Stores the results in an associative array to be passed on to the admin view
            $data = [
                'results' => $results
            ];

            

            return view('productAdmin')->with($data);
        } catch (\Exception $e) {
           
            $data = ['error_message' => $e->getMessage()];
            return view('error')->with($data);
        }
        MyLogger2::info("Exit ProductAdminController.index()");
    }

    // Method takes form input from the previous form and attempts to update the database entry for the corresponding Product
    public function editProduct(Request $request)
    {
        MyLogger2::info("Entering ProductAdminController.editProduct()");

        // Validates form input against pre-defined rules
        $this->validateEdit($request);
        
        try {

            // Creates a new Product Model using the information gotten from the form input
            $Product = new ProductModel($request->input('id'), $request->input('name'), $request->input('price'), $request->input('quantity'), $request->input('description'));

            // Creates a new instance of the appropriate business service
            $service = new ProductService();

            // Stores the results of the appropriate query
            $results = $service->editProduct($Product);

            

            if ($results) {
                return view('ProductAdmin')->with(['results' => $service->getAllProducts()]);
            }
        } catch (\Exception $e) {
           
            $data = ['error_message' => $e->getMessage()];
            return view('error')->with($data);
        }
        MyLogger2::info("Exit ProductAdminController.index()");
    }
    
    public function createProduct(Request $request)
    {
        
        MyLogger2::info("Entering ProductAdminController.createProduct()");
        // Validates the user's input against pre-defined rules
        $this->validateEdit($request);
        
        try {
            
            // Takes user input from register form and uses it to make a new productmodel object with an id of 0
            $product = new ProductModel(0, $request->input('name'), $request->input('price'), $request->input('quantity'), $request->input('description'));
            
            // Creates instance of product service
            $productService = new ProductService();
            
            // Stores the result of the function call
            $result = $productService->newProduct($product);
            
            
            
            //Returns the user to the product admin page
            return view('productAdmin')->with(['results' => $productService->getAllproducts()]);
        } catch (\Exception $e) {
           
            $data = ['error_message' => $e->getMessage()];
            return view('error')->with($data);
        }
        MyLogger2::info("Exit ProductAdminController.index()");
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

    // Method takes an ID from the form that submitted the request and attempts to delete the Product of the corresponding ID
    public function removeProduct(Request $request)
    {
        MyLogger2::info("Entering ProductAdminController.removeProduct()");
        
        try {
           

            // Get's the Product's ID from the previous form
            $id = $request->input('id');

            // Creates an instance of the appropriate business service
            $service = new ProductService();

            // Stores the result of the attempted removal of the Product
            $results = $service->removeProduct($id);

           

            if ($results) {
                return view('ProductAdmin')->with(['results' => $service->getAllProducts()]);
            }
        } catch (\Exception $e) {
           
            $data = ['error_message' => $e->getMessage()];
            return view('error')->with($data);
        }
        MyLogger2::info("Exit ProductAdminController.removeProduct()");
    }
}
