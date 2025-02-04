<?php

namespace App\Http\Controllers;

use App\Models\Meja;
use Illuminate\Container\Attributes\Log;
use Illuminate\Http\Request;

class TabelController extends Controller
{
    public function index()
    {
        $tabel = $this->get_tabel();
        return view('admin.tabel', compact('tabel'));
    }

    public function get_tabel()
    {
        $tabel = Meja::all();
        return $tabel;
    }

    public function add_tabel(Request $request)
    {
        $tabel = Meja::create([
            'tabel_number' => $request->tabel_number,
            'status' => $request->status,
        ]);

        return  redirect()->route('tabel')->with('success', 'Tabel Add Successfully');
    }

    public function delete_tabel(Request $request)
    {
        $id_tabel = $request->id_delete;
        $tabel = Meja::find($id_tabel);
        if ($tabel) {
            $tabel->delete();
            return redirect()->route('tabel')->with('success', 'Tabel Deleted Successfully');
        } else {
            return redirect()->route('tabel')->with('failed', 'Tabel Deleted Failed');
        }
    }

    public function edit_tabel()
    {
        $tabel = Meja::all();
        return view('components.pop-up-add-update-tabel', compact('tabel'));
    }

    public function update_tabel(Request $request)
    {
        $id_tabel = $request->input('id_tabel'); 
        $status = $request->input('status');

        $tabel = Meja::find($id_tabel);
        if ($tabel) {
            $tabel->status = $status;
            $tabel->save();
        }

        return redirect()->route('tabel')->with('success', 'Tabel Updated Successfully!');
    }
}
