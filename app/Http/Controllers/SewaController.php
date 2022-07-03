<?php

namespace App\Http\Controllers;

use app\Models\Galerry;
use App\Models\Kontrakan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use App\Http\Requests\KontrakanRequest;
use Illuminate\Support\Facades\Storage;


class SewaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $id_user = $user->id;

        $daftarSewa = Kontrakan::with('user')->where('users_id', $id_user)->paginate(5);

        return \view('owner.sewa.index', [
            'sewa' => $daftarSewa
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return \view('owner.sewa.create');
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
            $data['picture'] = $request->file('picture')->store('kontrakan');
        }

        Kontrakan::create($data);
        return \redirect()->route('sewa.index')->with('success', 'data saved!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Kontrakan $kontrakan, $id)
    {
        // $kontrakan = Kontrakan::with('user')->find($id);
        $kontrakan = Kontrakan::with('user', 'galerries')->findOrFail($id);
        $galery = Galerry::Where('kontrakan_id', $id)->get();
        // \ddd($galery);
        return \view('owner.sewa.detail', [
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
        return \view('owner.sewa.edit', [
            'item' => $kontrakan,
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


        if ($kontrakan->picture == "/storage/") {
            $data['picture'] = $request->file('picture')->store('kontrakan');
        } else if ($kontrakan->picture == $oldImage) {
            $path = \parse_url($kontrakan->picture);
            \unlink(\public_path($path['path']));
        } else {
        }

        if ($request->file('picture')) {

            $data['picture'] = $request->file('picture')->store('kontrakan');
        }

        $kontrakan->update($data);
        return \redirect()->route('sewa.index')->with('info', 'data has update!');
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

        // Storage::delete($kontrakan->picture);


        return \redirect()->route('sewa.index')->with('danger', 'data has deleted!');
    }
}
