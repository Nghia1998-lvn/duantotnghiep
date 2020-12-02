<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\News;

class SearchController extends Controller
{
    public function search(Request $request){
        $key = $request->get('key');
        $ketquatimkiem = News::where('title', 'like', '%'.$key.'%')->get();
        return view('client.search', array('key' => $key, 'ketquatimkiem' => $ketquatimkiem));
    }

}
