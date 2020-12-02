<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Categories;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class CategoryController extends Controller
{

    public function index(){
        $categories = Categories::all();
        return view('admin.manager-category.index', compact('categories'));
    }

    public function create(){
        return view('admin.manager-category.create');
    }

    public function createCategory(Request $request){
        $messages = [
            'category.required' => 'Vui lòng nhập thể loại',
            'category.unique' => 'Thể loại đã tồn tại',
        ];

        $validator = Validator::make($request->all(), [
            'category' => 'required|unique:categories',
        ], $messages);


        $slug = Str::slug($request->category, '-');

        
        if ($validator->fails()) {
            return back()->withErrors($validator);
        }

        $categories = Categories::create([
            'category' => $request->category,
            'slug' => $slug,
        ]);

        if($categories){
            return redirect()->back()->with('message', 'Success');
        }
        else {
            return redirect()->route('category.index')>with('message', 'Fail');
        }
    }

    public function editCategory($id){
        $category = Categories::find($id);
        return view('admin.manager-category.edit', compact('category'));
    }

    public function updateCategory(Request $request,$id){
        $categoryOld = Categories::findOrFail($id);

        $messages = [
            'category.required' => 'Vui lòng nhập thể loại',
        ];

        $validator = Validator::make($request->all(), [
            'category' => 'required',
        ], $messages);


        $slug = Str::slug($request->category, '-');

        
        if ($validator->fails()) {
            return back()->withErrors($validator);
        }

        if($categoryOld->category == $request->category){
            return redirect()->back()->with('message', 'Chưa có gì thay đổi');
        }else{
            
            $categories = $categoryOld->update([
                'category' => $request->category,
                'slug' => $slug,
            ]);

            if($categories){
                return redirect()->back()->with('message', 'Thành công');
            }else{
                return redirect()->back()->with('message', 'Thất bại');
            }
        }  

    }

    public function deleteCategory($id){
        $categoryDelete = Categories::findOrFail($id)->delete();
        
        if($categoryDelete){
            return redirect()->back()->with('message', 'Thành công');
        }else{
            return redirect()->back()->with('message', 'Thất bại');
        }
    }
}
