<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\DonaturResource;
use App\Models\Donatur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DonaturController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $donaturs = Donatur::latest()->paginate(5);

        return new DonaturResource(true, 'List Data donaturs', $donaturs);
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'     => 'required',
            'age'   => 'required',
            'address'   => 'required',
            'nik'   => 'required|min:16|max:16',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $donatur = Donatur::create([
            'name'     => $request->name,
            'age'   => $request->age,
            'address'   => $request->address,
            'nik'   => $request->nik,
        ]);

        return new DonaturResource(true, 'Data donatur Berhasil Ditambahkan!', $donatur);
    }


    public function show(Donatur $donatur)
    {
        return new DonaturResource(true, 'Data donatur Ditemukan!', $donatur);
    }


    public function update(Request $request, Donatur $donatur)
    {
        $validator = Validator::make($request->all(), [
            'name'     => 'required',
            'age'   => 'required',
            'address'   => 'required',
            'nik'   => 'required',
            'darah'   => 'required',
            'total'   => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $donatur->update([
            'name'     => $request->name,
            'age'   => $request->age,
            'address'   => $request->address,
            'nik'   => $request->nik,
            'darah'   => $request->darah,
            'total'   => $request->total,
        ]);

        return new DonaturResource(true, 'Data donatur Berhasil Diubah!', $donatur);
    }


    public function destroy(Donatur $donatur)
    {
        $donatur->delete();
        return new DonaturResource(true, 'Data Post Berhasil Dihapus!', null);
    }
}
