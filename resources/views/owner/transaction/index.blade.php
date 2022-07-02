<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Daftar Transaksi') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-10">
                <a href="{{ route('dashboard') }}"
                    class="bg-blue-700 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">
                    < Kembali </a>
            </div>
            <div class="flex flex-col">
                <div class="overflow-x-auto sm:-mx-6 lg:-mx-8 shadow">
                    <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8 ">
                        <div class="overflow-hidden">
                            <table class="min-w-full table-auto ">
                                <thead class="bg-blue-400 border-b">
                                    <tr>
                                        <th class="border font-medium text-white px-6 py-4 text-left w-10">
                                            #
                                        </th>

                                        <th class="border font-medium text-white px-6 py-4 text-left">
                                            No Transaksi
                                        </th>
                                        <th class="border font-medium text-white px-6 py-4 text-left">
                                            Penyewa
                                        </th>
                                        <th class="border font-medium text-white px-6 py-4 text-left">
                                            View
                                        </th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $no = 1;
                                    @endphp
                                    @forelse ($data as $item)
                                        <tr>
                                            <td class="font-medium px-6 py-4 text-left">{{ $no++ }}
                                            </td>

                                            <td class="font-medium px-6 py-4 text-left">
                                                {{ $item->transaction_number }}
                                            </td>
                                            <td class="font-medium px-6 py-4 text-left">
                                                {{ $item->user->name }}
                                            </td>
                                            <td class="font-medium text-white px-6 py-4 text-center">
                                                <a href="{{ route('transaction.show', $item->id) }}"
                                                    class="inline-block bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-3 mx-2 rounded">Detail</a>
                                            </td>

                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="border text-center p-5">
                                                Data Not Found!
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-center mt-5">
                {{ $data->links() }}
            </div>
        </div>
    </div>
    @include('toastr')
    @push('scripts')
        <script type="text/javascript">
            $('.show_confirm').click(function(event) {
                var form = $(this).closest("form");
                var name = $(this).data("name");
                event.preventDefault();
                swal({
                        title: `Apakah anda yakin?`,
                        text: "Data yang terhapus tidak dapat dikembalikan!",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    })
                    .then((willDelete) => {
                        if (willDelete) {
                            form.submit();
                        }
                    });
            });
        </script>
    @endpush
</x-app-layout>
