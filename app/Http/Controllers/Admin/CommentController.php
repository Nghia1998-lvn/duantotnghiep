<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Comments;

class CommentController extends Controller
{
    public function index(){
        $comments = Comments::all();
        return view('admin.manager-comment.index', compact('comments'));
    }
    public function deleteComment($id){
        $commentDelete = Comments::findOrFail($id)->delete();

        if($commentDelete){
            return back()->with('success', 'Xóa thành công');
        }else{
            return back()->with('danger', 'Xóa thành công');
        }
    }
}
