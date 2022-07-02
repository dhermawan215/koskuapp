<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <a class="text-blue-500 " href="{{ route('sewa.index') }}">Kontrakan Dashboard</a>
            <span>&raquo {{ $item->name }} &raquo;</span>{{ __('Detail') }}
        </h2>
    </x-slot>


    <div class="py-12 col-auto">
        <div class="bg-gray-100 mx-auto max-w-6xl py-20 px-12 lg:px-24 shadow-xl mb-24">
            <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4 flex flex-col justify-center">
                <div class="text-blue-500 hover:text-red-500 text-xl font-bold">
                    <a href="{{ route('sewa.index') }}">&laquo Back</a>
                </div>
                <h3 class="text-gray-900 text-xl font-bold mb-2">{{ $item->name }}</h3>
                <div class="flex flex-col md:flex-row md:max-w-xl rounded-lg bg-white mt-2">
                    <div class="w-full md:w-5/6">
                        @if ($item->picture)
                            <img src="{{ asset($item->picture) }}" alt=""
                                class=" w-full h-96 md:h-auto object-cover md:w-48 rounded-t-lg md:rounded-none md:rounded-l-lg">
                        @elseif ($item->picture == '/storage/')
                            <img src="{{ asset('storage/kontrakan/image.jpg') }}" alt=""
                                class=" w-full h-96 md:h-auto object-cover md:w-48 rounded-t-lg md:rounded-none md:rounded-l-lg">
                        @else
                            <img src="{{ asset('storage/kontrakan/image.jpg') }}" alt=""
                                class=" w-full h-96 md:h-auto object-cover md:w-48 rounded-t-lg md:rounded-none md:rounded-l-lg">
                        @endif

                    </div>
                    <div class="p-6 flex flex-col justify-start">
                        <p class="font-bold text-l">Pemilik : {{ $item->user->name }}</p>
                        <div class="flex flex-wrap mb-3">
                            <h4 class="text-gray-700 text-base mb-2">
                                <span class="text-blue-700 font-semibold">Fasilitas :</span>
                                <p>{{ $item->facility }}</p>
                            </h4>
                            <h4 class="text-gray-700 text-base mb-2">
                                <span class="text-blue-700 font-semibold">Alamat :</span>
                                <p>{{ $item->address }}</p>
                                <hr class="bg-grey-200 mt-2">
                                <p>Kabupaten/Kota : {{ $item->district }}</p>
                                <p>Provinsi : {{ $item->regency }} </p>
                            </h4>

                        </div>
                        <div class="flex flex-wrap mb-3">
                            <div class="w-4/6">
                                <p>Price: <span class="font-semibold">Rp.{{ number_format($item->price) }}</span>
                                </p>
                                <p>Tags: <span class="text-orange-700">{{ $item->tags }}</span> </p>
                            </div>

                            <div class="w-1/6">
                                <p>Status: <span class="text-green-700">{{ $item->status }}</span> </p>
                                <p>Rating: <span class="text-yellow-700">{{ $item->ratings }}</span> </p>
                            </div>
                            <div class="5/6 md:inline-block lg:inline-block sm:block mt-2">
                                <a href="https://wa.me/{{ $item->whatsapp_number }}" target="_blank" title="whatsapp"
                                    class="sm:mt-2 bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-3 mx-2 rounded"><i
                                        class="bi bi-whatsapp"></i>
                                </a>
                                <a href="{{ $item->gmap_url }}" target="_blank" title="maps"
                                    class="sm:mt-2 bg-blue-700 hover:bg-blue-500 text-white font-bold py-2 px-3 mx-2 rounded"><i
                                        class="bi bi-geo-alt"></i>
                                </a>
                                <a href="tel:+{{ $item->whatsapp_number }}" target="_blank" title="call"
                                    class=" bg-sky-700 hover:bg-sky-500 text-white font-bold py-2 px-3 mx-2 rounded"><i
                                        class="bi bi-telephone"></i>
                                </a>

                            </div>
                        </div>
                    </div>
                </div>

                <section class="overflow-hidden text-gray-700 text-center ">
                    <h3 class="text-gray-700 text-xl font-bold mb-2">Galeri Foto</h3>
                    <div class="container px-5 py-2 mx-auto lg:pt-12 lg:px-32">
                        <div class="flex flex-wrap -m-1 md:-m-2">

                            @foreach ($galery as $gallery)
                                <div class="flex flex-wrap w-1/3">
                                    <div class="w-full p-1 md:p-2">
                                        <img alt="gallery"
                                            class="block object-cover object-center w-full h-full rounded-lg"
                                            src="{{ Storage::url($gallery->picture_galleries) }}">
                                    </div>
                                </div>
                            @endforeach

                        </div>
                    </div>
                </section>


            </div>
        </div>
</x-app-layout>
