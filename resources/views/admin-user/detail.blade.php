<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <a class="text-blue-500 " href="{{ route('admin-user.index') }}">User Dashboard</a>
            <span>&raquo {{ $item->name }} &raquo;</span>{{ __('Detail') }}
        </h2>
    </x-slot>


    <div class="py-12 col-auto">
        <div class="bg-gray-100 mx-auto max-w-6xl py-20 px-12 lg:px-24 shadow-xl mb-24">
            <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4 flex flex-col">
                <div class="text-blue-500 hover:text-red-500 text-xl font-bold">
                    <a href="{{ route('admin-user.index') }}">&laquo Back</a>
                </div>
                <div class="-mx-3 md:flex mb-6">
                    <div class="md:w-1/2 px-3 mb-6 md:mb-0">
                        <label class="uppercase tracking-wide text-black text-xs font-bold mb-2" for="name">
                            User Name*
                        </label>
                        <p class="w-full bg-gray-200 text-black border border-gray-200 rounded py-3 px-4 mb-3">
                            {{ $item->name }}</p>
                    </div>
                    <div class="md:w-1/2 px-3">
                        <label class="uppercase tracking-wide text-black text-xs font-bold mb-2" for="email">
                            Email*
                        </label>
                        <p class="w-full bg-gray-200 text-black border border-gray-200 rounded py-3 px-4 mb-3">
                            {{ $item->email }}</p>
                    </div>
                </div>

                <div class="-mx-3 md:flex mb-2">
                    <div class="md:w-1/2 px-3 mb-6 md:mb-0">
                        <label class="uppercase tracking-wide text-black text-xs font-bold mb-2" for="roles">
                            Roles
                        </label>
                        <div>
                            <p class="w-full bg-gray-200 text-black border border-gray-200 rounded py-3 px-4 mb-3">
                                {{ $item->roles }}</p>
                        </div>
                    </div>
                    <div class="md:w-1/2 px-3 mb-6 md:mb-0 h-1">
                        <label class="uppercase tracking-wide text-black text-xs font-bold mb-2" for="phone">
                            Phone*
                        </label>
                        <p class="w-full bg-gray-200 text-black border border-gray-200 rounded py-3 px-4 mb-3">
                            {{ $item->phone }}</p>
                    </div>

                </div>

            </div>

        </div>
    </div>
</x-app-layout>
