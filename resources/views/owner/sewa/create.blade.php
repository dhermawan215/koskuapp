<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <a class="text-blue-500 " href="{{ route('sewa.index') }}">Sewa Dashboard</a>
            <span>&raquo</span>{{ __('Create Kontrakan') }}
        </h2>
    </x-slot>

    <div class="py-12 col-auto">
        <div class="bg-gray-100 mx-auto max-w-6xl py-20 px-12 lg:px-24 shadow-xl mb-24">
            @if ($errors->any())
                <div class="mb-5" role="alert">
                    <div class="bg-red-500 text-white font-bold rounded-t px-4 py-2">
                        There's something wrong
                    </div>
                    <div class="border border-t-0 border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-500">
                        <p>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        </p>
                    </div>
                </div>
            @endif
            <form action="{{ route('sewa.store') }}" method="POST" class="w-full" enctype="multipart/form-data">
                @csrf
                <div class="bg-white border shadow-md px-8 pt-6 pb-8 mb-4 flex flex-col h-full">
                    <div class="text-blue-500 hover:text-red-500 text-xl font-bold">
                        <a href="{{ route('admin-kontrakan.index') }}">&laquo Back</a>
                    </div>
                    <div>
                        <span class="text-red-500 text-xs italic">
                            * Please fill out this field. (tanda bintang wajib di isi)
                        </span>
                    </div>
                    <div class="-mx-3 md:flex mb-1">
                        <div class="md:w-full px-3">
                            <label class="uppercase tracking-wide text-black text-xs font-bold mb-2" for="name">
                                Nama kontrakan*
                            </label>
                            <input value="{{ old('name') }}" name="name"
                                class="w-full bg-gray-200 text-black border border-gray-200 rounded py-3 px-4 mb-3"
                                id="name" type="text" placeholder="nama kontrakan" required>
                        </div>
                    </div>
                    <div class="-mx-3 md:flex mb-1">
                        <div class="md:w-full px-3">
                            <label class="uppercase tracking-wide text-black text-xs font-bold mb-2" for="address">
                                Alamat*
                            </label>
                            <input value="{{ old('address') }}" name="address"
                                class="w-full bg-gray-200 text-black border border-gray-200 rounded py-3 px-4 mb-3"
                                id="address" type="text" placeholder="isi alamat usaha">
                        </div>
                    </div>
                    <div class="-mx-3 md:flex mb-1">
                        <div class="md:w-1/2 px-3 mb-6 md:mb-0">
                            <label class="uppercase tracking-wide text-black text-xs font-bold mb-2" for="district">
                                Kabupaten*
                            </label>
                            <input value="{{ old('district') }}" name="district"
                                class="w-full bg-gray-200 text-black border border-gray-200 rounded py-3 px-4 mb-3"
                                id="phone" type="text" placeholder="isi nama kabupaten">

                        </div>
                        <div class="md:w-1/2 px-3 mb-1 md:mb-0">
                            <label class="uppercase tracking-wide text-black text-xs font-bold mb-2" for="regency">
                                Provinsi*
                            </label>
                            <input value="{{ old('regency') }}" name="regency"
                                class="w-full bg-gray-200 text-black border border-gray-200 rounded py-3 px-4 mb-3"
                                id="regency" type="text" placeholder="isi nama provinsi">
                        </div>
                    </div>

                    <div class="-mx-3 md:flex mb-1">
                        <div class="md:w-full px-3">
                            <label class="uppercase tracking-wide text-black text-xs font-bold mb-2" for="facility">
                                Falitas*
                            </label>
                            <textarea cols="20" rows="10" value="{{ old('facility') }}" name="facility"
                                class="w-full bg-gray-200 text-black border border-gray-200 rounded py-3 px-4 mb-3" id="facility" type="text"
                                placeholder="isi fasilitas usaha"></textarea>
                            <span class="text-gray-700 text-xs italic">
                                -pengisian bagian fasilitas dipisahkan dengan koma (,) contoh: (air,listrik 900VA, 3
                                ruang).-
                            </span>
                        </div>

                    </div>
                    <div class="-mx-3 md:flex mb-1">
                        <div class="md:w-full px-3">
                            <label class="uppercase tracking-wide text-black text-xs font-bold mb-2" for="gmap_url">
                                Alamat Google Maps*
                            </label>
                            <input value="{{ old('gmap_url') }}" name="gmap_url"
                                class="w-full bg-gray-200 text-black border border-gray-200 rounded py-3 px-4 mb-3"
                                id="gmap_url" type="url"
                                placeholder="isi alamat usaha anda / link google map usaha anda">
                        </div>
                    </div>
                    <div class="-mx-3 md:flex mb-1">
                        <div class="md:w-full px-3">
                            <label class="uppercase tracking-wide text-black text-xs font-bold mb-2" for="gmap_url">
                                No Ruangan/Kamar Kosong *
                            </label>
                            <input value="{{ old('room') }}" name="room"
                                class="w-full bg-gray-200 text-black border border-gray-200 rounded py-3 px-4 mb-3"
                                id="room" type="text" placeholder="isi no ruangan atau kamar yang kosong">
                        </div>
                    </div>
                    <div class="-mx-3 md:flex mb-1">
                        <div class="md:w-1/2 px-3 mb-6 md:mb-0">
                            <label class="uppercase tracking-wide text-black text-xs font-bold mb-2" for="roles">
                                Pemilik*
                            </label>
                            <div>
                                <select name="users_id"
                                    class="w-full bg-gray-200 border border-gray-200 text-black text-xs py-3 px-4 pr-8 mb-3 rounded"
                                    id="location">
                                    <option selected>pilih pemilik</option>
                                    <option value="{{ Auth::user()->id }}">{{ Auth::user()->name }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="md:w-1/2 px-3 mb-1 md:mb-0">
                            <label class="uppercase tracking-wide text-black text-xs font-bold mb-2" for="status">
                                Status Kontrakan
                            </label>
                            <div>
                                <select name="status"
                                    class="w-full bg-gray-200 border border-gray-200 text-black text-xs py-3 px-4 pr-8 mb-3 rounded"
                                    id="location">
                                    <option selected>pilih status</option>
                                    <option value="Tersedia">Tersedia / Kosong</option>
                                    <option value="Terisi">Terisi / Penuh</option>

                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="-mx-3 md:flex mb-1">
                        <div class="md:w-1/2 px-3 mb-6 md:mb-0">
                            <label class="uppercase tracking-wide text-black text-xs font-bold mb-2" for="price">
                                Harga Sewa*
                            </label>
                            <div>
                                <input value="{{ old('price') }}" name="price"
                                    class="w-full bg-gray-200 text-black border border-gray-200 rounded py-3 px-4 mb-3"
                                    id="price" type="number" placeholder="isi harga sewa">

                            </div>
                        </div>
                        <div class="md:w-1/2 px-3 mb-1 md:mb-0">
                            <label class="uppercase tracking-wide text-black text-xs font-bold mb-2" for="tags">
                                Label Kontrakan*
                            </label>
                            <div>
                                <select name="tags"
                                    class="w-full bg-gray-200 border border-gray-200 text-black text-xs py-3 px-4 pr-8 mb-3 rounded"
                                    id="location">
                                    <option selected>pilih label</option>
                                    <option value="Rekomendasi">Rekomendasi</option>
                                    <option value="Populer">Populer</option>
                                    <option value="Baru">Baru</option>
                                    <option value="Umum">Umum</option>

                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="-mx-3 md:flex mb-1">
                        <div class="md:w-1/2 px-3 mb-6 md:mb-0">
                            <label class="uppercase tracking-wide text-black text-xs font-bold mb-2" for="whatsapp">
                                Nomer Whatsapp*
                            </label>
                            <div>
                                <input value="{{ old('whatsapp_number') }}" name="whatsapp_number"
                                    class="w-full bg-gray-200 text-black border border-gray-200 rounded py-3 px-4 mb-3"
                                    id="whatsapp_number" type="text"
                                    placeholder="pengisian nomer ditambah kode negara misal: 6287666...">
                                <span class="text-gray-700 text-xs italic">
                                    -pengisian whatsaap ditambah kode negera contoh: (62857890....) bukan 085123....-
                                </span>
                            </div>
                        </div>
                        <div class="md:w-1/2 px-3 mb-1 md:mb-0">
                            <label class="uppercase tracking-wide text-black text-xs font-bold mb-2" for="ratings">
                                Rating Kontrakan*
                            </label>
                            <div>
                                <input value="{{ old('ratings') }}" name="ratings" step="0.01" max="5"
                                    class="w-full bg-gray-200 text-black border border-gray-200 rounded py-3 px-4 mb-3"
                                    id="ratings" type="number" placeholder="isi ratings kualitas usaha anda">
                            </div>
                        </div>
                    </div>
                    <div class="-mx-3 md:flex mb-1">
                        <div class="md:w-1/2 px-3 mb-6 md:mb-0">
                            <label class="uppercase tracking-wide text-black text-xs font-bold mb-2" for="latitude">
                                Latitude lokasi*
                            </label>
                            <div>
                                <input value="{{ old('latitude') }}" name="latitude"
                                    class="w-full bg-gray-200 text-black border border-gray-200 rounded py-3 px-4 mb-3"
                                    id="latitude" type="text"
                                    placeholder="pengisian nomer ditambah kode negara misal: 6287666...">
                                <span class="text-gray-700 text-xs italic">
                                    misal 198.124545
                                </span>
                            </div>
                        </div>
                        <div class="md:w-1/2 px-3 mb-1 md:mb-0">
                            <label class="uppercase tracking-wide text-black text-xs font-bold mb-2" for="longtitude">
                                Longtitude lokasi*
                            </label>
                            <div>
                                <input value="{{ old('lontitude') }}" name="longtitude"
                                    class="w-full bg-gray-200 text-black border border-gray-200 rounded py-3 px-4 mb-3"
                                    id="longtitude" type="text" placeholder="isi longtitude">
                            </div>
                            <span class="text-gray-700 text-xs italic">
                                misal 198.124545
                            </span>
                        </div>
                    </div>
                    <div class="-mx-3 md:flex mb-1">
                        <div class="md:w-full px-3">
                            <label class="uppercase tracking-wide text-black text-xs font-bold mb-2" for="picture">
                                Foto kontrakan*
                            </label>
                            <input name="picture"
                                class="w-full bg-gray-200 text-black border border-gray-200 rounded py-3 px-4 mb-3"
                                id="picture" type="file">
                        </div>
                    </div>

                </div>
                <div class="-mx-3 md:flex mt-8">
                    <div class="md:w-full px-3">
                        <button
                            class="md:w-full bg-green-900 hover:bg-green-500 text-white font-bold py-2 px-4 border-b-4 hover:border-b-2 border-gray-400 hover:border-gray-100 rounded-full">
                            Save!
                        </button>
                    </div>
                </div>

            </form>
        </div>
    </div>

</x-app-layout>
