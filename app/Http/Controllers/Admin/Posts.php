<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Approval;
use App\Models\Categories;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;


class Posts extends Controller
{

    public function showAll(){

        $posts = Approval::where('user_id', Auth::user()->id)->get();

        return view('admin.posts.index', compact('posts'));
    }

    public function index()
    {
        // categories 
        $categories = Categories::get();
        return view('admin.posts.create-post', compact('categories'));
    }

    public function createPost(Request $request)
    {

        $messages = [
            'category_id.required' => 'Vui lòng chọn thể loại',
            'title.required' => 'Vui lòng nhập thể loại',
            'title.max' => 'Vui lòng ít hơn 80 kí tự',
            'description.required' => 'Vui lòng nhập mô tả ngắn',
            'description.max' => 'Vui lòng nhập nhỏ hơn 255 kí tự',
            'image.required'  => 'Vui lòng chọn hình ảnh',
            'content.required' => 'Vui lòng nhập nội dung chính',
        ];

        $validator = Validator::make($request->all(), [
            'category_id' => 'required',
            'title' => 'required|max:80',
            'description' => 'required|max:255',
            'image' => 'required',
            'content' => 'required',
            'user_id',
            'views_count',
            'status'
        ], $messages);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator);
        }

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $name = time() . '.' . $image->getClientOriginalName();
            $publicPath = public_path('/clients/uploads');
            $image->move($publicPath, $name);
        }

        $approval = Approval::create([
            'user_id'       => Auth::user()->id,
            'category_id'   => $request->category_id,
            'title'         => $request->title,
            'slug'          => Str::slug($request->title),
            'description'   => $request->description,
            'image'         => '/clients/uploads/' . $name,
            'content'       => $request->content,
            'views_count'   => 1,
            'status'        => 0,
        ]);
        $newapproval = $approval->replicate();

        return redirect()->back()->with('message', 'Success');
    }

    public function editPost($id){
        $categories = Categories::all();
        $posts = Approval::find($id);
        return view('admin.posts.edit', compact('posts', 'categories'));
    }

    public function updatePost(Request $request, $id){

        $posts = Approval::findOrFail($id);
    
            $messages = [
                'category_id.required' => 'Vui lòng chọn thể loại',
                'title.required' => 'Vui lòng nhập thể loại',
                'title.max' => 'Vui lòng ít hơn 80 kí tự',
                'description.required' => 'Vui lòng nhập mô tả ngắn',
                'description.max' => 'Vui lòng nhập nhỏ hơn 255 kí tự',
                'image.required'  => 'Vui lòng chọn hình ảnh',
                'content.required' => 'Vui lòng nhập nội dung chính',
            ];
    
            $validator = Validator::make($request->all(), [
                'category_id' => 'required',
                'title' => 'required|max:80',
                'description' => 'required|max:255',
                'image',
                'content' => 'required',
                'views_count',
                'status',
            ], $messages);
    
            if ($validator->fails()) {
                return Redirect::back()->withErrors($validator);
            }
    
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $name = time() . '.' . $image->getClientOriginalName();
                $publicPath = public_path('/clients/uploads');
                $image->move($publicPath, $name);
            }
            else {
                $name = $posts->image;
            }

            if($request->category_id != $posts->category_id && $request->category_id != ""){
                $categoryId = $request->category_id;
            }
            else {
                $categoryId = $posts->category_id;
            }
            if($request->title != $posts->title){
                $categoryTitle = $request->title;
            }
            else {
                $categoryTitle = $posts->title;
            }
            if($request->description != $posts->description && $request->description != ""){
                $categoryDescription = $request->description;
            }
            else {
                $categoryDescription = $posts->description;
            }
            if($request->content != $posts->content && $request->content != ""){
                $categoryContent = $request->content;
            }
            else {
                $categoryContent = $posts->content;
            }
    
           // dd($categoryContent);

           $update =  $posts->update([
                'user_id'       => Auth::user()->id,
                'category_id'   => $categoryId,
                'title'         => $categoryTitle,
                'slug'          => Str::slug($categoryTitle),
                'description'   => $categoryDescription,
                'image'         => '/clients/uploads/' . $name,
                'content'       => $categoryContent,
                'views_count'   => $posts->views_count,
                'status'        => $posts->status,
            ]);

        
    
            if($update){
                return redirect()->back()->with('message', 'Success');
            }
            else {
                return redirect()->back()->with('message', 'Fail');
            }
           
    }
}