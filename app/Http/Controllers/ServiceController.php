<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ServiceController extends Controller
{
    public function index()
    {
        return view('service.index', [
            'services' => Service::all(),
        ]);
    }

    public function create()
    {
        return view('service.create');
    }

    public function store(Request $request)
    {
        $service = new Service();
        $service->room = Auth::user()->name;
        $service->service = $request->service;

        $service->save();

        return redirect()->route('dashboard.service.index')->with('success', 'Permintaan berhasil dibuat');
    }

    public function clear($id)
    {
        DB::table('services')->where('id', $id)->update(['status' => '1']);

        return redirect()->route('dashboard.service.index')->with('success', 'Service selesai');
    }
}
