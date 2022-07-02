<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <a class="text-blue-500 " href="{{ route('transaction.index') }}">Transaction Dashboard</a>
            <span>&raquo {{ $item->transaction_number }} &raquo;</span>{{ __('Detail') }}
        </h2>
    </x-slot>


    <div class="py-12 col-auto">
        <div class="bg-gray-100 mx-auto max-w-6xl py-10 px-12 lg:px-24 shadow-xl mb-24">
            <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4 flex flex-col justify-center">
                <div class="text-blue-500 hover:text-red-500 text-xl font-bold">
                    <a href="{{ route('transaction.index') }}">&laquo Back</a>
                </div>
                <div class="flex flex-col">
                    <h3 class="text-gray-900 text-l font-bold mb-2">{{ $item->transaction_number }}</h3>
                </div>
                <div class="flex flex-col md:flex-row md:max-w-xl rounded-lg bg-white mt-2">
                    <div class="p-6 flex flex-col justify-start">
                        <p class="font-bold text-l">No Transaksi : {{ $item->transaction_number }}</p>
                        <p class="font-bold text-l">Penyewa : {{ $item->user->name }}</p>
                        <div class="flex flex-wrap mb-3">
                            <h4 class="text-gray-700 text-base mb-2">
                                <p>No Telpon Penyewa: {{ $item->user->phone }}</p>
                            </h4>
                        </div>
                        <div class="flex flex-wrap mb-3">
                            <div class="w-full">
                                <p>Total Bayar: <span
                                        class="font-semibold">Rp.{{ number_format($item->total) }}</span>
                                </p>
                                <p>Metode Pembayaran: <span class="font-semibold">{{ $item->payment_method }}</span>
                                </p>
                                <p>Status: <span class="font-bold text-green-700">{{ $item->status }}</span> </p>
                                <p>Tanggal Pesan: <span>{{ $item->created_at }}</span> </p>
                            </div>

                        </div>

                        <div class="flex flex-wrap mb-3">
                            <div class="text-gray-900 mb-1 font-bold text-lg">
                                Ubah Status Pembayaran
                            </div>
                            <a href="{{ route('transaction.changeStatus', ['id' => $item->id, 'status' => 'SUCCESS']) }}"
                                class="bg-green-500 hover:bg-green-700 text-white font-semibold px-2 py-2 mt-1 rounded block text-center w-full">Success</a>
                            <a href="{{ route('transaction.changeStatus', ['id' => $item->id, 'status' => 'PENDING']) }}"
                                class="bg-orange-500 hover:bg-orange-700 text-white font-semibold px-2 py-2 mt-1 rounded block text-center w-full">Pending</a>
                            <a href="{{ route('transaction.changeStatus', ['id' => $item->id, 'status' => 'CANCELLED']) }}"
                                class="bg-blue-500 hover:bg-blue-700 text-white font-semibold px-2 py-2 mt-1 rounded block text-center w-full">Cancelled</a>
                            <a href="{{ route('transaction.changeStatus', ['id' => $item->id, 'status' => 'FAILED']) }}"
                                class="bg-red-500 hover:bg-red-700 text-white font-semibold px-2 py-2 mt-1 rounded block text-center w-full">Failed</a>
                        </div>
                    </div>


                    <div class="p-6 flex flex-col justify-start ">
                        <h3 class="text-gray-900 text-lg font-bold mb-2">Foto Pembayaran <span
                                class="text-sm text-orange-500">*</span></h3>
                        <div class="flex flex-col  m-1 md:-m-2">
                            <div class="w-full px-5 py-2">
                                <a href="{{ asset($item->payment_picture) }}" target="_blank"
                                    rel="noopener noreferrer">
                                    <img id="myImg" alt="gallery" class="p-1 rounded h-auto "
                                        src="{{ asset($item->payment_picture) }}">
                                </a>
                            </div>
                        </div>
                    </div>

                </div>

                <p class="text-md text-orange-600">NB: * klik gambar untuk preview</p>
            </div>

        </div>
        <!-- Modal -->


    </div>

    @include('toastr')
</x-app-layout>
