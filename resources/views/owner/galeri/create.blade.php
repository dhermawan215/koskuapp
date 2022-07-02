<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <a class="text-blue-500 " href="{{ route('gallery.index') }}">Galeri Dashboard</a>
            <span>&raquo</span>{{ __('Tambah Foto') }}
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
            <form action="{{ route('gallery.store') }}" method="POST" class="w-full"
                enctype="multipart/form-data">
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
                        <div class="w-full px-3 mb-1 md:mb-0">
                            <label class="uppercase tracking-wide text-black text-xs font-bold mb-2" for="kontrakan_id">
                                Pilih Kontrakan
                            </label>
                            <div>
                                <select name="kontrakan_id"
                                    class="w-full bg-gray-200 border border-gray-200 text-black text-xs py-3 px-4 pr-8 mb-3 rounded"
                                    id="location">
                                    <option selected>pilih Kontrakan</option>
                                    @foreach ($kontrakanItem as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach


                                </select>
                            </div>
                        </div>

                    </div>

                    <div class="-mx-3 md:flex mb-1">
                        <div class="md:w-full px-3">
                            <label class="uppercase tracking-wide text-black text-xs font-bold mb-2"
                                for="picture_galleries">
                                Foto kontrakan*
                            </label>
                            <input name="picture_galleries"
                                class="w-full bg-gray-200 text-black border border-gray-200 rounded py-3 px-4 mb-3"
                                id="picture_galleries" type="file">
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
