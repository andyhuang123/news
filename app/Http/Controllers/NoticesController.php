<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Topic;
use App\Models\Category;

class NoticesController extends Controller
{
    // 公告列表
    public function index(Request $request)
    {
        $notices = Topic::where('type_id',1)->paginate(20);
        $categorys = category::all();
        return view('topics.notices_index', compact('notices','categorys'));
    }
    // 公告详情
    public function show(Topic $topic, Request $request)
    {
         // URL 矫正
         if ( ! empty($topic->slug) && $topic->slug != $request->slug) {
            return redirect($topic->link(), 301);
        }

        $comments = $topic->replies()->where('replies_id', 0)->with('user')->get();
        $replies = $topic->replies()->where('replies_id','!=', 0)->with('user')->get();

        return view('topics.show', compact('topic','comments','replies'));
    }
}
