<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\Search;
use Artisan;
use Cache;

class AdminController extends Controller
{
    public function admin_dashboard(Request $request)
    {
        $root_categories = Category::where('parent_id', 0)->get();
        return view('backend.dashboard', compact('root_categories'));
    }

    function clearCache(Request $request)
    {
        Artisan::call('cache:clear');
        flash(trans('messages.cache_cleared_successfully'))->success();
        return back();
    }
}
