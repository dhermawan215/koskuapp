<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use App\Models\Galerry;
use App\Models\Kontrakan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Helpers\ResponseFormatter;


class KontrakanRestController extends Controller
{

    public function all(Request $request)
    {
        $id = $request->input('id');
        $limit = $request->input('limit');
        $name = $request->input('name');
        $address = $request->input('address');
        $district = $request->input('district');
        $regency = $request->input('regency');
        $tags = $request->input('tags');

        $price_from = $request->input('price_from');
        $price_to = $request->input('price_to');

        //filter by id
        if ($id) {
            $kontrakanData = Kontrakan::with('galerries', 'user')->find($id);
            //jika id ada
            if ($kontrakanData) {
                return ResponseFormatter::success(
                    $kontrakanData,
                    'Data Kontrakan Berhasil Diambil'
                );
            } else {
                return ResponseFormatter::error(
                    'null',
                    'Data Kosong',
                    404
                );
            } //jika id kosong
        }

        $kontrakanData = Kontrakan::with('galerries', 'user');

        if ($name) {
            $kontrakanData->where('name', 'like', '%' . $name . '%');
        }

        if ($address) {
            $kontrakanData->where('address', 'like', '%' . $address . '%');
        }

        if ($district) {
            $kontrakanData->where('district', 'like', '%' . $district . '%');
        }

        if ($regency) {
            $kontrakanData->where('regency', 'like', '%' . $regency . '%');
        }

        if ($tags) {
            $kontrakanData->where('tags', 'like', '%' . $tags . '%');
        }

        if ($price_from) {
            $kontrakanData->where('price', '>=', $price_from);
        }

        if ($price_to) {
            $kontrakanData->where('price', '<=', $price_to);
        }

        return ResponseFormatter::success(
            $kontrakanData->paginate($limit),
            'Data Kontrakan Berhasil Diambil'
        );
    }
}
