<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <a class="text-blue-500 " href="{{ route('dashboard') }}">Admin Dashboard</a>
            <span>&raquo</span>{{ __('User') }}
        </h2>
    </x-slot>

    {{-- @include('alert') --}}

    <div class="py-12 col-auto">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-10">
                <a href="{{ route('admin-user.create') }}"
                    class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                    + Create Users
                </a>
            </div>
            <div class="bg-white overflow-auto rounded-md shadow md:block">
                <table class="table-auto w-full border-b-2">
                    <thead class="bg-blue-400 text-white">
                        <tr>
                            <th class="border px-6 py-6">No</th>
                            <th class="border px-6 py-6">Name</th>
                            <th class="border px-6 py-6">Roles</th>
                            <th class="border px-6 py-6">Action</th>
                            <th class="border px-6 py-6">View</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        @php
                            $no = 1;
                        @endphp
                        @forelse ($user as $item)
                            <tr>
                                <td class="border px-3 py-3 w-10">{{ $no++ }}</td>
                                <td class="border px-3 py-3">{{ $item->name }}</td>
                                <td class="border px-3 py-3">{{ $item->roles }}</td>
                                <td class="border px-3 py-3 text-center">
                                    <a href="{{ route('admin-user.edit', $item->id) }}"
                                        class="inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-3 mx-2 rounded">Edit</a>
                                    <form action="{{ route('admin-user.destroy', $item->id) }}" method="POST"
                                        class="inline-block">
                                        {!! method_field('delete') . csrf_field() !!}
                                        <button type="submit" data-toggle="tooltip"
                                            class="show_confirm rounded bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-3 mx-2">Delete</button>
                                    </form>
                                </td>
                                <td class="border px-3 py-3 text-center">
                                    <a href="{{ route('admin-user.show', $item->id) }}"
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
            <div class="text-center mt-5">
                {{ $user->links() }}
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
