<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(): View
    {
        $user = Auth::user(); // ngambil data user yang sedang login

        if ($user->role === 'admin') { // cek kalo rolenya admin tampilin dashboard admin
            $menu = new MenuController();
            $data = $menu->get_data();
            return view('admin/dashboard-admin', compact('data'));
        }

        return view('customer/dashboard');
    }
}
