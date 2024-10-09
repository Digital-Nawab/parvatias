<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\Encoders\AutoEncoder;
use Intervention\Image\Encoders\WebpEncoder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class TagController extends Controller
{
    
    public function AllTag()
    {
        return view('tags.add-tag');
    }

   
    public function AddTag(Request $request, $id = null)
    {
        if($id== ""){
            $title = "Add Tag";
            $tag = new Tag();
            $message = "Tag added successfully";
        }else{
            $title = "Update Tag";
            $tag = Tag::find($id);
            $message = "Tag updated successfully";
        }
        if ($request->isMethod('post')) {
            $data = $request->all();

            $rules = [
                'tab_name' => 'required|max:255',
                'tab_url' => 'required|max:255',
                'tab_image' => $id? 'nullable|image|mimes:jpeg,jpg,png,webp|max:2048' :'required|image|mimes:jpeg,jpg,png,webp|max:2048',
                'tab_banner' => $id? 'nullable|image|mimes:jpeg,jpg,png,webp|max:2048' :'required|image|mimes:jpeg,jpg,png,webp|max:2048',
                'tab_title' => 'nullable|max:255',
                'tab_description' => 'nullable|max:1000',
                'tab_keyword' => 'nullable|max:1000',
            ];
            $customMessage = [
                'tab_name.required' => 'Tab name is required.',
                'tab_url.required' => 'Tab URL is required.',
                'tab_image.required' => 'Tab image is required.',
                'tab_banner.required' => 'Tab banner is required.',
                'tab_name.max' => 'Tab name should not exceed 255 characters.',
                'tab_url.max' => 'Tab URL should not exceed 255 characters.',
                'tab_image.image' => 'Tab image should be an image.',
                'tab_banner.image' => 'Tab banner should be an image.',
                'tab_image.mimes' => 'Tab image should be in jpeg, jpg, png or webp format.',
                'tab_banner.mimes' => 'Tab banner should be in jpeg, jpg, png or webp format.',
            ];
            $validate = Validator::make($data, $rules, $customMessage);

            if ($validate->fails()) {
                return redirect()->back()->withErrors($validate)->withInput();
            }

            if($request->hasFile('tab_image')) {
                $manager = new ImageManager(new Driver());
                $path = 'assets/images/tags/';
                if (!is_dir($path)) {
                    mkdir($path, 0755, true);
                }
                $uploadedImage = $request->file('tab_image');
                $image = $manager->make($uploadedImage);
                $image->resize(432, 432);
                $image->encode(new WebpEncoder(quality: 65));
                $imageName = time().'-'.$uploadedImage->getClientOriginalName();
                $image->save($path.$imageName);
                $data['tab_image'] = $imageName;
            }
            if($request->hasFile('tab_banner')) {
                $manager = new ImageManager(new Driver());
                $path = 'assets/images/tags/';
                if (!is_dir($path)) {
                    mkdir($path, 0755, true);
                }
                $uploadedImage = $request->file('tab_banner');
                $image = $manager->make($uploadedImage);
                $image->resize(1920, 720);
                $image->encode(new WebpEncoder(quality: 65));
                $imageName = time().'-'.$uploadedImage->getClientOriginalName();
                $image->save($path.$imageName);
                $data['tab_banner'] = $imageName;
            }
            if($id == ""){
                Tag::create($data);
            }else{
                $tag->update($data);
            }
            return redirect()->back()->with('success_msg', $message);
        }
        return view('tags.add-tag', compact('title', 'tag'));
    }
}
