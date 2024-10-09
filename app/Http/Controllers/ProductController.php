<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Stock;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\Encoders\AutoEncoder;
use Intervention\Image\Encoders\WebpEncoder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    
    public function AllProduct()
    {
        $product = Product::get();
        return view('products.all-product', compact('product'));
    }

    public function DeleteProduct($id)
    {
         $product = Product::find($id);
         if($product){
            if(!empty($product->product_image) && file_exists(public_path($product->product_image))){
                unlink(public_path($product->product_image));
            }
            
            $category->delete();
            return redirect()->back()->with('success_msg', 'Product deleted successfully');
         }
         return redirect()->back()->with('error_msg', 'Product not found');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function AddProduct(Request $request, $id = null)
    {
        //
        if($id == ""){
            $title = "Add Product";
            $product = new Product();
            $message = "Product added successfully";
            // Retrieve the latest product inserted into the database
        }else{
            $title = "Update Product";
            $product = Product::find($id);
            $message = "Product updated successfully";
        }
        if($request->isMethod('post')){
            $data = $request->all();
            // echo '<pre>';print_r($data);exit;
            $rules = [
                'category_id'       => 'required', 
                'product_name'      => 'required|string|max:255|unique:products,product_name,' . $id,  // Handles updating products while ensuring unique names
                'stock_quantity'    => 'required|integer',  // Ensures stock_quantity is an integer
                'product_price'     => 'required|numeric',  // Ensures the price is numeric
                'product_url'       => 'required|string|max:255',
                // Conditional image validation: required when creating, nullable when updating
                'product_image'     => $id ? 'nullable|image|mimes:jpeg,jpg,png,webp|max:2048' : 'required|image|mimes:jpeg,jpg,png,webp|max:2048',
                'meta_title'        => 'nullable|string|max:255',      
                'meta_description'  => 'nullable|string|max:1000', 
                'meta_keyword'      => 'nullable|string|max:1000',   
                'short_description' => 'required|string|max:255',   
                'is_sold'           => 'required',  // Validates if the value is either "no" or "yes"
                'gender'            => 'required',  // Ensures gender is either Male or Female
            ];
            $customMessages = [
                'category_id.required'          => 'The category name is required.',
                'product_name.unique'           => 'The Product name already exists. Please choose a different name.',
                'product_url.required'          => 'The Product URL is required.',
                'product_image.required'        => 'The Product image is required.',
                'product_price.required'        => 'The Product Price is required.',
                // Fix the meta and description messages
                'meta_title.max'                => 'The meta title must not exceed 255 characters.',
                'meta_description.max'          => 'The meta description must not exceed 1000 characters.',
                'meta_keyword.max'              => 'The meta keyword must not exceed 1000 characters.',
                   // Fix the Product description messages
                'stock_quantity.required'       => 'The stock quantity is required.',
                'stock_quantity.integer'        => 'The stock quantity must be an integer value.',
                'short_description.required'    => 'The short description is required.',  // Assuming there is a 'short_description' in your form
                'gender.required'               => 'The gender field is required.',
                // Image-related validation messages
                'product_image.image'           => 'The file must be an image.',
                'product_image.mimes'           => 'The image must be a file of type: jpeg, jpg, png, webp.',
                'product_image.max'             => 'The image size must not exceed 2MB.',  // Adjusted to 2MB as per your rule
            ];
            $validator = Validator::make($request->all(), $rules, $customMessages);
            if($validator->fails()){
                return redirect()->back()->withErrors($validator)->withInput();
            }
           
            if($request->hasFile('product_image')) {
                $manager = new ImageManager(new Driver());
                $path = 'assets/images/product/';
                if (!is_dir($path)) {
                    mkdir($path, 0755, true);
                }
                $uploadedImage = $request->file('product_image');
                $image = $manager->read($uploadedImage);
                $image->resize(600, 600);
                $image->encode(new WebpEncoder(quality: 65));
                $filename = uniqid() . '.' .'webp';
                $image->save($path.$filename);
                $data['product_image'] = $path.$filename;
            }
            if ($id == "") {
                $lastProduct = Product::latest()->first();
                // If no product exists, start with 1, otherwise increment the last product ID by 1
                $nextProductId = $lastProduct ? $lastProduct->id + 1 : 1;
                // Pad the product ID to ensure it's at least 4 digits (e.g., 0001, 0002, etc.)
                $nextProductIdPadded = str_pad($nextProductId, 4, '0', STR_PAD_LEFT);
                // Generate the SKU
                $data['product_sku'] = 'PARV-' . $nextProductIdPadded;
                // Create the product
                $insert =  Product::create($data);
                $stock = [
                    'product_id'    => $insert->id,  // Insert the newly created product's ID
                    'stock_remain'  => '0',
                    'stock_add'     => '0',
                    'stock_final'   => $data['stock_quantity'],
                    'old_price'     => '0',
                    'new_price'     => $data['product_price'],            // Make sure this is a number, not a string
                ];
                // Create the stock entry with the correct product ID
                Stock::create($stock);

            } else {
                $product->update($data);
            }
            return redirect()->back()->with('success_msg', $message);
        }

        $category = Category::get();
        return view('products.add-product', compact('title', 'product', 'category' ));
    }

   
}
