<?php

namespace App\Http\Controllers;


use App\Models\Gallery;
use App\Models\Kontrakan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\GalleryRequest;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()

    {

        $id = Auth::user()->id;
        $galeri = Gallery::whereRelation('kontrakan', 'users_id', $id)->paginate(10);

        return \view('owner.galeri.index', [
            'galery' => $galeri
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $authId = Auth::user()->id;
        $kontrakan = Kontrakan::with('user')->where('users_id', $authId)->get();
        return \view('owner.galeri.create', [
            'kontrakanItem' => $kontrakan
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GalleryRequest $request)
    {
        $data = $request->all();
        if ($request->file('picture_galleries')) {
            // $data['picture_galleries'] = $request->file('picture_galleries')->store('gallery');
            $data['picture_galleries'] = $request->file('picture_galleries')->store('galeri', 'public');
        }
        Gallery::create($data);
        return \redirect()->route('gallery.index')->with('success', 'data saved!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Gallery $galeri)
    {
        $galeri = Gallery::find($id);
        // \dd($galeri);

        // \ddd($galeri->picture_galleries);

        // try {

        //     return \true;
        // } catch (\Throwable $th) {
        //     return $th;
        // }
        Storage::disk('public')->delete($galeri->picture_galleries);
        // Storage::delete($galeri->picture_galleries);
        $galeri->delete();

        // $image_path = \public_path($galeri->picture_galleries);
        // $galeri->delete();
        // \unlink($image_path);

        return \redirect()->route('gallery.index')->with('danger', 'data has deleted!');
    }
}
