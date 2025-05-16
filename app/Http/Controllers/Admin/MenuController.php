<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use App\Models\Menu;
use DB;

class MenuController extends Controller
{
    public function manage()
    {
        $menus = Menu::with('subMenus')->orderBy('sort_order')->get();
        return view('backend.menus.index', compact('menus'));
    }

    public function store(Request $request)
    {
        DB::beginTransaction();

        try {
            $menuIds = [];

            foreach ($request->menus as $menuIndex => $menuData) {
                $menu = Menu::updateOrCreate(
                    ['id' => $menuData['id'] ?? null],
                    ['title' => $menuData['title'], 'sort_order' => $menuIndex]
                );

                $menuIds[] = $menu->id;

                // Delete existing submenus if updating
                $menu->subMenus()->delete();

                foreach ($menuData['sub_menus'] ?? [] as $subIndex => $sub) {
                    $menu->subMenus()->create([
                        'title' => $sub['title'],
                        'link' => $sub['link'],
                        'sort_order' => $subIndex,
                    ]);
                }
            }

            // Optionally delete menus that were removed from UI
            Menu::whereNotIn('id', $menuIds)->delete();

            DB::commit();
            Cache::forget('header_menu');
            flash('Menus updated successfully!')->success();
            return redirect()->back()->with('success', 'Menus updated successfully!');
        } catch (\Exception $e) {
            DB::rollback();
            flash('Something went wrong!')->error();
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

}

