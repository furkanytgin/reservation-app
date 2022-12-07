<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-end m-2 p-2">
                <a href="{{route('admin.menus.index') }}" class="px-4  bg-indigo-500 hover:bg-indigo-700 font-medium rounded-lg text-sm w-full sm:w-auto  py-2.5 text-white">Menus</a>
           </div>


           <form action="{{ route('admin.menus.update', $menu->id) }}" enctype="multipart/form-data" method="POST">
            @method('PUT')
            @csrf
            <div class="mb-6">
                <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name</label>
                <input type="text" name="name" value="{{ $menu->name }}" id="name" class="@error('name') border-red-400 @enderror bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"  required>
                @error('name')
                    <div class="text-sm text-red-400">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-6">
                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300 mt-3" for="file_input">Upload file</label>
                @if($menu->image)
                <div>
                    <img class="w-32 h-32 mt-2 mb-4" src="{{ Storage::url($menu->image) }}">
                </div>
                @endif
                <input name="image" class="@error('image') border-red-400 @enderror block w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 cursor-pointer dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" id="file_input" type="file">
                @error('image')
                    <div class="text-sm text-red-400">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-6">
                <label for="price" class="mt-4 mb-1 uppercase text-grey-darker text-xs font-bold">Price</label>
                <div class="flex flex-row">
                    <span class="flex items-center bg-grey-lighter rounded rounded-r-none px-3 font-bold text-grey-darker">$</span>
                    <input type="number" value="{{ $menu->price }}"  name="price" class="@error('price') border-red-400 @enderror bg-grey-lighter text-grey-darker py-2 rounded text-grey-darkest border border-grey-lighter rounded-l-none font-bold">
                </div>
                @error('price')
                    <div class="text-sm text-red-400">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-6">
                <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white mt-6">Description</label>
                <textarea id="description" name="description" rows="4" class="@error('description') border-red-400 @enderror block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Leave a comment...">{{ $menu->description }} </textarea>
                @error('description')
                    <div class="text-sm text-red-400">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-6">

                <label for="categories" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Categories</label>
                <select multiple id="categories" name="categories[]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <!-- constains(eğer categorilerden bir ve daha fazlası menu ile ilişkili olan categorieste bulunuyorsa selected olur ) -->
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" @selected($menu->categories->contains($category))>
                            {{ $category->name }}</option>
                    @endforeach
                </select>
             </div>

            <button type="submit" class="text-white bg-indigo-500 hover:bg-indigo-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
        </form>

        </div>
    </div>
</x-app-layout>
