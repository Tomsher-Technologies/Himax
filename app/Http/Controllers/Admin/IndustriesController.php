<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Industries;
use Illuminate\Support\Str;
use DB;

class IndustriesController extends Controller
{
    function __construct()
    {
        $this->middleware('auth');
       
        $this->middleware('permission:website_setup', ['only' => ['index','create','store','edit','update','destroy']]);
    }

    public function index(Request $request)
    {
        $sort_search = null;
        $industries = Industries::orderBy('sort_order', 'asc');
        if ($request->has('search')) {
            $sort_search = $request->search;
            $industries = $industries->where('name', 'like', '%' . $sort_search . '%');
        }
        $industries = $industries->paginate(15);
        return view('backend.industries.index', compact('industries', 'sort_search'));
    }

    public function create()
    {
        return view('backend.industries.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'image' => 'required',
        ]);
    
        $industry               = new Industries;
        $industry->name         = $request->name ?? NULL;
        $industry->image        = $request->image ?? NULL;
        $industry->title        = $request->title ?? NULL;
        $industry->content      = $request->content ?? NULL;
        $industry->status       = $request->status;
        $industry->sort_order   = $request->sort_order;
        $industry->save();

        flash('Industry '.trans('messages.created_msg'))->success();
        return redirect()->route('industries.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $lang   = $request->lang;
        $industry  = Industries::findOrFail($id);
        return view('backend.industries.edit', compact('industry', 'lang'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'image' => 'required',
        ]);

        $industry               = Industries::findOrFail($id);
        $industry->name         = $request->name ?? NULL;
        $industry->image        = $request->image ?? NULL;
        $industry->title        = $request->title ?? NULL;
        $industry->content      = $request->content ?? NULL;
        $industry->status       = $request->status;
        $industry->sort_order   = $request->sort_order;
        $industry->save();

        flash('Industry '.trans('messages.updated_msg'))->success();
        return redirect()->route('industries.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Industries::destroy($id);

        flash('Industry '.trans('messages.deleted_msg'))->success();
        return redirect()->route('industries.index');
    }

    public function updateStatus(Request $request)
    {
        $industry = Industries::findOrFail($request->id);
        $industry->status = $request->status;
        $industry->save();
       
        return 1;
    }
}
