<?php

namespace App\Http\Controllers;


use Exception;
use App\Models\User;

use App\Models\Gallery;

use App\Models\Kontrakan;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use App\Http\Requests\KontrakanRequest;
use Illuminate\Support\Facades\Storage;





class AdminKontrakanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kontrakan = Kontrakan::with(['user'])->paginate(20);
        return \view('admin-kontrakan.index', [
            'kontrakan' => $kontrakan
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $userId = User::select('id', 'name', 'roles')
            ->where('roles', 'owner')->get();

        return \view('admin-kontrakan.create', [
            'user_data' => $userId
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(KontrakanRequest $request)
    {
        $data = $request->all();

        if ($request->file('picture')) {
            $data['picture'] = $request->file('picture')->store('public/kontrakan');
        }

        Kontrakan::create($data);
        return \redirect()->route('admin-kontrakan.index')->with('success', 'data saved!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $kontrakan = Kontrakan::with(['user'])->findOrFail($id);
        $galery = Gallery::Where('kontrakan_id', $id)->get();
        return \view('admin-kontrakan.detail', [
            'item' => $kontrakan,
            'galery' => $galery
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $kontrakan = Kontrakan::with(['user'])->findOrFail($id);
        $userdata = User::select('id', 'name', 'roles')
            ->where('roles', 'owner')->get();

        return \view('admin-kontrakan.edit', [
            'item' => $kontrakan,
            'userData' => $userdata,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(KontrakanRequest $request, $id)
    {
        $kontrakan = Kontrakan::find($id);
        $data = $request->all();
        $oldImage = $request->oldImage;


        $envPath = \config('app.url') . "/storage/";



        if ($request->file('picture')) {
            if ($kontrakan->picture == $envPath) {

                $data['picture'] = $request->file('picture')->store('public/kontrakan');
            } else if ($kontrakan->picture == $oldImage) {
                $path = \parse_url($kontrakan->picture);
                \unlink(\public_path($path['path']));
            }



            $data['picture'] = $request->file('picture')->store('public/kontrakan');
        }
        $kontrakan->update($data);
        return \redirect()->route('admin-kontrakan.index')->with('info', 'data has update!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Kontrakan $kontrakan)
    {

        $kontrakan = Kontrakan::find($id);
        // $image_path = \public_path($kontrakan->picture);

        $path = \parse_url($kontrakan->picture);
        \unlink(\public_path($path['path']));

        $kontrakan->delete();
        // \unlink($image_path);

        return \redirect()->route('admin-kontrakan.index')->with('danger', 'data has deleted!');
    }
}
