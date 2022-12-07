<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-end m-2 p-2">
                <a href="{{route('admin.tables.index') }}" class="px-4  bg-indigo-500 hover:bg-indigo-700 font-medium rounded-lg text-sm w-full sm:w-auto  py-2.5 text-white">Tables</a>
           </div>


           <form action="{{ route('admin.tables.update', $table->id) }}" method="POST">
            @method('PUT')
            @csrf
            <div class="mb-6">
                <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name</label>
                <input type="text"  value="{{ $table->name }}" name="name" id="name" class="@error('name') border-red-400 @enderror bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"  required>
                @error('name')
                    <div class="text-sm text-red-400">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-6">
                <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Guest Number</label>
                <div class="flex flex-row">
                    <input type="number"  value="{{ $table->guest_number }}" name="guest_number" class="@error('guest_number') border-red-400 @enderror bg-grey-lighter text-grey-darker py-2 rounded text-grey-darkest border border-grey-lighter rounded-l-none font-bold">
                </div>
                @error('guest_number')
                    <div class="text-sm text-red-400">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-6">

                <label for="status" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">status</label>
                <select id="status" name="status" class="@error('status') border-red-400 @enderror bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option selected>Choose status</option>
                 <!--app/enums yolundaki dosyada kullanıcının seçmesi istenen değerler yazılmıştır.
                     (value' ya '=' işaretinde sonrası yazılır). (name'e '=' işaretinden öncesi yazılır)-->
                    @foreach (App\Enums\TableStatus::cases() as $status )
                        <option value="{{ $status->value }}"  @selected($table->status->value == $status->value)>{{ $status->name }}</option>
                    @endforeach
                </select>
                @error('status')
                    <div class="text-sm text-red-400">{{ $message }}</div>
                @enderror
             </div>
             <div class="mb-6">

                <label for="location" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">location</label>
                <select id="location" name="location" class="@error('location') border-red-400 @enderror bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <!--app/enums yolundaki dosyada kullanıcının seçmesi istenen değerler yazılmıştır.
                     (value' ya '=' işaretinde sonrası yazılır). (name'e '=' işaretinden öncesi yazılır)-->
                    <option selected>Choose location</option>
                    @foreach (App\Enums\TableLocation::cases() as $location )
                        <option value="{{ $location->value }}" @selected($table->location->value == $location->value)>{{ $location->name }}</option>
                    @endforeach
                </select>
                @error('location')
                    <div class="text-sm text-red-400">{{ $message }}</div>
                @enderror
             </div>

            <button type="submit" class="text-white bg-indigo-500 hover:bg-indigo-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
        </form>

        </div>
    </div>
</x-app-layout>
