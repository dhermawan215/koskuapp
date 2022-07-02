<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <a class="text-blue-500 " href="{{ route('admin-user.index') }}">User Dashboard</a>
            <span>&raquo</span>{{ __('Create User') }}
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
            <form action="{{ route('admin-user.store') }}" method="POST" class="w-full">
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
                        <div class="md:w-1/2 px-3  mb-1 md:mb-0">
                            <label class="uppercase tracking-wide text-black text-xs font-bold mb-2" for="name">
                                User Name*
                            </label>
                            <input value="{{ old('name') }}" name="name"
                                class="w-full bg-gray-200 text-black border border-gray-200 rounded py-3 px-4 mb-3"
                                id="name" type="text" placeholder="User Name">
                        </div>
                        <div class="md:w-1/2 px-3  mb-1 md:mb-0">
                            <label class="uppercase tracking-wide text-black text-xs font-bold mb-2" for="email">
                                Email*
                            </label>
                            <input value="{{ old('email') }}" name="email"
                                class="w-full bg-gray-200 text-black border border-gray-200 rounded py-3 px-4 mb-3"
                                id="email" type="email" placeholder="Email">
                        </div>
                    </div>

                    <div class="-mx-3 md:flex mb-1">
                        <div class="md:w-full px-3">
                            <label class="uppercase tracking-wide text-black text-xs font-bold mb-2" for="password">
                                Password*
                            </label>
                            <input value="{{ old('password') }}" name="password"
                                class="w-full bg-gray-200 text-black border border-gray-200 rounded py-3 px-4 mb-3"
                                id="password" type="password" placeholder="password">
                        </div>

                    </div>
                    <div class="-mx-3 md:flex mb-1">
                        <div class="md:w-full px-3">
                            <label class="uppercase tracking-wide text-black text-xs font-bold mb-2"
                                for="password confirmation">
                                Password Confirmation*
                            </label>
                            <input value="{{ old('password_confirmation') }}" name="password_confirmation"
                                class="w-full bg-gray-200 text-black border border-gray-200 rounded py-3 px-4 mb-3"
                                id="password confirmation" type="password" placeholder="confirm your password">
                        </div>

                    </div>
                    <div class="-mx-3 md:flex mb-1">
                        <div class="md:w-1/2 px-3 mb-6 md:mb-0">
                            <label class="uppercase tracking-wide text-black text-xs font-bold mb-2" for="phone">
                                Phone*
                            </label>
                            <div>
                                <input value="{{ old('phone') }}" name="phone"
                                    class="w-full bg-gray-200 text-black border border-gray-200 rounded py-3 px-4 mb-3"
                                    id="phone" type="text" placeholder="please insert region code ex (6285123...)">
                            </div>
                        </div>
                        <div class="md:w-1/2 px-3 mb-1 md:mb-0">
                            <label class="uppercase tracking-wide text-black text-xs font-bold mb-2" for="roles">
                                Roles
                            </label>
                            <div>
                                <select name="roles"
                                    class="w-full bg-gray-200 border border-gray-200 text-black text-xs py-3 px-4 pr-8 mb-3 rounded"
                                    id="location">
                                    <option selected>select roles</option>
                                    <option value="user">User</option>
                                    <option value="owner">Owner</option>
                                </select>
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
                </div>

            </form>
        </div>
    </div>
</x-app-layout>
