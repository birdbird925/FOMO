<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CmsController extends Controller
{
    public function page($slug)
    {
        $page = DB::select('select * from cms_page where page_slug = ? LIMIT 1', [$slug]);
        if(sizeof($page) == 0) {
            abort(404);
        }
        else {
            $page = $page[0];
            return view('page', compact('page'));
        }
    }

}
