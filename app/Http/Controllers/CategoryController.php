<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\Encoders\AutoEncoder;
use Intervention\Image\Encoders\WebpEncoder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    
    public function AddCategory(Request $request, $id = null)
    {
        if($id == ""){
            $title = "Add Category";
            $category = new Category();
            $message = "Category added successfully";
        }else{
            $title = "Update Category";
            $category = Category::find($id);
            $message = "Category updated successfully";
        }
        if($request->isMethod('post')){
            $data = $request->all();
            $rules = [
                'category_name' => 'required|string|max:255|unique:categories,category_name,' . $id,
                'category_url' => 'required|string|max:255',
                'category_image' => $id ? 'nullable|image|mimes:jpeg,jpg,png,webp|max:2048' : 'required|image|mimes:jpeg,jpg,png,webp|max:2048', 
                'category_banner' => 'nullable|image|mimes:jpeg,jpg,png,webp|max:1024', 
                'meta_title' => 'nullable|string|max:255',      
                'meta_description' => 'nullable|string|max:1000', 
                'meta_keyword' => 'nullable|string|max:1000',   
                'is_front' => 'required|in:no,yes',             
                'menu_type' => 'required|in:none,single,multi', 
            ];
            $customMessages = [
                'category_name.required' => 'The category name is required.',
                'category_name.unique' => 'The category name already exists. Please choose a different name.',
                'category_url.required' => 'The category URL is required.',
                'category_image.required' => 'The category image is required.',
                'category_image.image' => 'The file must be an image.',
                'category_image.mimes' => 'The image must be a file of type: jpeg, jpg, png, webp.',
                'category_image.max' => 'The image size must not exceed 1MB.',
                'category_banner.image' => 'The category banner must be an image.',
                'category_banner.mimes' => 'The category banner must be a file of type: jpeg, jpg, png, webp.',
                'category_banner.max' => 'The category banner size must not exceed 1MB.',
                'is_front.in' => 'The is_front value must be either "no" or "yes".',
                'menu_type.in' => 'The menu_type must be "none", "single", or "multi".',
            ];
            $validator = Validator::make($data, $rules, $customMessages);

            if($validator->fails()){
                return redirect()->back()->withErrors($validator)->withInput();
            }

            if($request->hasFile('category_image')) {
                $manager = new ImageManager(new Driver());
                $path = 'assets/images/category/';
                if (!is_dir($path)) {
                    mkdir($path, 0755, true);
                }
                $uploadedImage = $request->file('category_image');
                $image = $manager->read($uploadedImage);
                $image->resize(252, 252);
                $image->encode(new WebpEncoder(quality: 65));
                $filename = uniqid() . '.' .'webp';
                $image->save($path.$filename);
                $data['category_image'] = $path.$filename;
            }
            if($request->hasFile('category_banner')) {
                $manager = new ImageManager(new Driver());
                $path = 'assets/images/category/';
                if (!is_dir($path)) {
                    mkdir($path, 0755, true);
                }
                $uploadedImage = $request->file('category_banner');
                $image = $manager->read($uploadedImage);
                $image->resize(1920, 300);
                $image->encode(new WebpEncoder(quality: 65));
                $filename = uniqid() . '.' .'webp';
                $image->save($path.$filename);
                $data['category_banner'] = $path.$filename;
            }
            if ($id == "") {
               Category::create($data);
            } else {
                $category->update($data);
            }
            return redirect()->back()->with('success_msg', $message);
        }
        return view('category.add-category', compact('title', 'category'));
    }

    public function AllCategory()
    {
        $category = Category::get();
        return view('category.all-category', compact('category'));
    }

    public function DeleteCategory($id)
    {
         $category = Category::find($id);
         if($category){
            if(!empty($category->category_image) && file_exists(public_path($category->category_image))){
                unlink(public_path($category->category_image));
            }
            if(!empty($category->category_banner) && file_exists(public_path($category->category_banner))){
                unlink(public_path($category->category_banner));
            }
            $category->delete();
            return redirect()->back()->with('success_msg', 'Category deleted successfully');
         }
         return redirect()->back()->with('error_msg', 'Category not found');
    }
}
