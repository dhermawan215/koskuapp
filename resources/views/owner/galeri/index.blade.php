<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Galeri Foto') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-10">
                <a href="{{ route('dashboard') }}"
                    class="bg-blue-700 hover:bg-blue-600 text-white font-bold  mr-2 py-2 px-4 rounded">
                    < Kembali </a>
                        <a href="{{ route('gallery.create') }}"
                            class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                            + Tambah Foto Kontrakan
                        </a>
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
                                            Name
                                        </th>

                                        <th class="border font-medium text-white px-6 py-4 text-left">
                                            Action
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $no = 1;
                                    @endphp

                                    @forelse ($galery as $item)
                                        {{-- @dd($item->picture_galleries) --}}
                                        <tr>
                                            <td class="font-medium px-6 py-4 text-left">{{ $no++ }}
                                            </td>

                                            <td class="block mx-auto resize ">
                                                <div class="flex items-center mt-5">
                                                    <div class="flex-shrink-0 w-30 h-30">
                                                        <img class="w-10 h-10 rounded-full"
                                                            src="{{ asset('/storage/' . $item->picture_galleries) }}"
                                                            {{-- src="{{ asset('/storage/' . $item->picture_galleries) }}" --}} alt="admin dashboard ui">
                                                    </div>
                                                    <div class="ml-4">
                                                        {{ $item->kontrakan->name }}
                                                    </div>
                                            </td>



                                            <td class="font-medium text-white px-6 py-4 text-center">

                                                <form id="DeleteForm"
                                                    action="{{ route('gallery.destroy', $item->id) }}" method="POST"
                                                    class="inline-block">
                                                    {!! method_field('delete') . csrf_field() !!}
                                                    <button type="submit" id="BtnDelete" " data-toggle=" tooltip"
                                                        class="
                                                        show_confirm rounded bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-3 mx-2">Delete</button>
                                                </form>


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
                {{-- {{ $sewa->links() }} --}}
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
