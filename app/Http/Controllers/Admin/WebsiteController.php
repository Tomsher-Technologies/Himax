<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Occasion;
use Cache;
use Illuminate\Http\Request;

class WebsiteController extends Controller
{
	public function header(Request $request)
	{
		$categories = Category::where('is_active',1)->with('childrenCategories')->get();
		$brands = Brand::where('is_active',1)->orderBy('name', 'asc')->get();
		$occasions = [];
		return view('backend.website_settings.header', compact('categories','brands','occasions'));
	}
	public function footer(Request $request)
	{
		$lang = $request->lang;
		return view('backend.website_settings.footer', compact('lang'));
	}
	public function pages(Request $request)
	{
		return view('backend.website_settings.pages.index');
	}
	public function appearance(Request $request)
	{
		return view('backend.website_settings.appearance');
	}
	public function menu(Request $request)
	{
		return view('backend.website_settings.menu');
	}

	
}
