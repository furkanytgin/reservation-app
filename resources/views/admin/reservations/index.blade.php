<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-end m-2 p-2">
                <a href="{{route('admin.reservations.create') }}" class="px-4 ру-2 bg-indigo-500 hover:bg-indigo-700 font-medium rounded-lg text-sm w-full sm:w-auto  py-2.5 text-white">Create Reservation</a>
           </div>

            <div class="overflow-x-auto relative shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="py-3 px-6">
                                Name
                            </th>
                            <th scope="col" class="py-3 px-6">
                                Email
                            </th>
                            <th scope="col" class="py-3 px-6">
                                Date
                            </th>
                            <th scope="col" class="py-3 px-6">
                                Table
                            </th>
                            <th scope="col" class="py-3 px-6">
                                Guest
                            </th>
                            <th scope="col" class="py-3 px-6">
                                Actions
                            </th>

                        </tr>
                    </thead>
                    <tbody>
                       @foreach ($reservations as $reservation)
                       <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $reservation->first_name }} {{ $reservation->last_name }}
                            </th>


                            <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $reservation->email }}
                            </th>

                            <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $reservation->res_date }}
                            </th>

                            <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                 {{ $reservation->table->name ?? 'None' }}

                            </th>


                            <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $reservation->guest_number}}
                            </th>

                            <th class="py-4 px-6 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                <div class="flex space-x-2">
                                    <a href="{{ route( 'admin.reservations.edit', $reservation->id) }}" class="px-4 ру-2 bg-green-500 Ihover:bg-green-700 rounded-lg text-white">Edit</a>
                                    <form class="px-4 ру-2 bg-red-500 hover:bg-red-700 rounded-lg text-white"
                                        method="POST"
                                        action="{{ route('admin.reservations.destroy', $reservation->id) }}"
                                        onsubmit=" return confirm( 'Are you sure?');">
                                        @csrf
                                         @method('DELETE')
                                        <button type="submit">Delete</button>
                                    </form>
                                </div>
                            </th>
                        </tr>
                       @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
