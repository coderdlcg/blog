<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{

    public function test(Request $request)
    {
//        $test = __('moonshine::ui.blog.self');

        $articles = '';

//        $articles = Article::query()
//            ->with(['categories', 'author'])
//            ->latest()
//            ->paginate(10);
//
//        dd($articles->firstItem());

//        dd(123, $articles);
//        return view('test.index', [
//            'articles' => $articles
//        ]);

        return view('test.blog', [
            'articles' => $articles
        ]);
    }

    public function article(Request $request)
    {
        return view('test.article', []);
    }
}
