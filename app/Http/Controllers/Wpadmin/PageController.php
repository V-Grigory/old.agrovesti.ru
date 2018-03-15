<?php

namespace App\Http\Controllers\Wpadmin;

use App\Page;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PageController extends Controller
{
    public function index(Request $request)
    {
        return view('wpadmin.page.index', [
            'page'   => Page::where('name_en', $request->page)->first(),
            'params' => $request
        ]);
    }
}
