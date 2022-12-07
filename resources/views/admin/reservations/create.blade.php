<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-end m-2 p-2">
                <a href="{{route('admin.reservations.index') }}" class="px-4  bg-indigo-500 hover:bg-indigo-700 font-medium rounded-lg text-sm w-full sm:w-auto  py-2.5 text-white ">Reservations</a>
           </div>


           <form action="{{ route('admin.reservations.store') }}" method="POST">
            @csrf
            <div class="mb-6">
                <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">first name</label>
                <input type="text"  value="{{ old('first_name') }}" name="first_name" id="first_name" class="@error('first_name') border-red-400 @enderror bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"  required>
                @error('first_name')
                    <div class="text-sm text-red-400">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-6">
                <label for="last_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">last name</label>
                <input type="text"  value="{{ old('last_name') }}" name="last_name" id="last_name" class="@error('last_name') border-red-400 @enderror bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"  required>
                @error('last_name')
                    <div class="text-sm text-red-400">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-6">
                <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                <input placeholder="orngmail.com"type="email"  value="{{ old('email') }}" name="email" id="email" class="@error('email') border-red-400 @enderror bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"  required>
                @error('email')
                    <div class="text-sm text-red-400">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-6">
                <label for="tel_number" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tel Number</label>
                <input type="tel_number"  value="{{ old('tel_number') }}" name="tel_number" id="tel_number" class="@error('tel_number') border-red-400 @enderror bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"  required>
                @error('tel_number')
                    <div class="text-sm text-red-400">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-6">
                <label for="res_date" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Reservation Date</label>
                <div class="flex flex-row">
                    <input type="datetime-local"  value="{{ old('res_date') }}" name="res_date" class="@error('res_date') border-red-400 @enderror bg-grey-lighter text-grey-darker py-2 rounded text-grey-darkest border border-grey-lighter rounded-l-none font-bold">
                </div>
                @error('res_date')
                    <div class="text-sm text-red-400">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-6">
                <label for="guest_number" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Guest Number</label>
                <div class="flex flex-row">
                    <input type="number"  value="{{ old('guest_number') }}" name="guest_number" class="@error('guest_number') border-red-400 @enderror bg-grey-lighter text-grey-darker py-2 rounded text-grey-darkest border border-grey-lighter rounded-l-none font-bold">
                </div>
                @error('guest_number')
                    <div class="text-sm text-red-400">{{ $message }}</div>
                @enderror
            </div>

             <div class="mb-6">

                <label for="table_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">table_id</label>
                <select id="table_id" name="table_id" class="@error('table_id') border-red-400 @enderror bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option selected>Choose Table</option>
                    @foreach ($tables as $table )
                        <option value="{{ $table->id }}" >{{ $table->name }} ({{ $table->guest_number }} Guest)</option>
                    @endforeach
                </select>
                @error('table_id')
                    <div class="text-sm text-red-400">{{ $message }}</div>
                @enderror
             </div>

            <button type="submit" class="text-white bg-indigo-500 hover:bg-indigo-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
        </form>

        </div>
    </div>
</x-app-layout>
