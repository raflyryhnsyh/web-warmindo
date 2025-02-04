<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function get_data()
    {
        $menu =  Menu::with('category')->get();
        return $menu;
    }

    public function add_menu(Request $request)
    {
        $menu = Menu::create([
            'menu_name' => $request->menu_name,
            'price' => $request->price,
            'description' => $request->description,
            'id_category' => $request->id_category,
            'status' => $request->status,
        ]);

        return  redirect()->route('dashboard')->with('success', 'Menu Add Successfully');
    }

    public function edit_menu($id_menu)
    {
        $menu = Menu::find($id_menu); // Ambil data menu berdasarkan ID
        return view('components.pop-up-add-edit-menu', compact('menu'));
    }

    public function delete_menu(Request $request)
    {
        $id_menu = $request->id_delete;
        $menu = Menu::find($id_menu); // Ambil data menu berdasarkan ID
        if ($menu) {
            $menu->delete();
            return redirect()->route('dashboard')->with('success', 'Menu Deleted Successfully');
        }else{
            return redirect()->route('dashboard')->with('failed', 'Menu Deleted Failed');
        }
    }

    public function update_menu(Request $request, $id_menu)
    {
        // Validasi data input (hanya validasi field yang dikirimkan)
        $validatedData = $request->validate([
            'menu_name' => 'nullable|string|max:255',
            'price' => 'nullable|numeric|min:0',
            'description' => 'nullable|string|max:500',
            'category' => 'nullable|string|max:255',
            'status' => 'nullable|string|max:255',
        ]);

        // Mencari menu berdasarkan id_menu
        $menu = Menu::findOrFail($id_menu);

        // Memperbarui data menu hanya jika field terkait diisi
        if ($request->filled('menu_name')) {
            $menu->menu_name = $validatedData['menu_name'];
        }

        if ($request->filled('price')) {
            $menu->price = $validatedData['price'];
        }

        if ($request->filled('description')) {
            $menu->description = $validatedData['description'];
        }

        if ($request->filled('category')) {
            $menu->category = $validatedData['category'];
        }

        if ($request->filled('status')) {
            $menu->status = $validatedData['status'];
        }

        // Simpan perubahan hanya jika ada field yang diupdate
        $menu->save();

        // Kembali ke halaman dashboard atau halaman lain setelah berhasil update
        return redirect()->route('dashboard')->with('success', 'Menu updated successfully');
    }
}
