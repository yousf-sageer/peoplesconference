<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row gap-4  md:items-center justify-between">

            <h2 class="font-semibold text-xl text-white leading-tight">
                {{ __('All Members') }}


            </h2>

            <h1 class="text-white">Members Available: {{$member_count}} </h1>


            @can('is_admin')
                <x-secondary-button>
                    <a href="{{ route('member.create') }}">
                        Create Member
                    </a>
                </x-secondary-button>
            @endcan


        </div>
    </x-slot>



    <div class="py-12 px-4">

        <div class=" mx-auto sm:px-4 ">

            <form action="{{ route('member.index') }}" method="GET">
                <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
                <div class="relative">
                    <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                        </svg>
                    </div>
                    <input type="search"
                           id="default-search"
                           name="query"
                           class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search Members...">
                    <button type="submit"  class="text-white absolute end-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Search</button>
                </div>
            </form>

            <div class=" overflow-hidden  sm:rounded pt-5">
                <div class="  text-white">

                    @if (count($members)>0)


                        <div class="container mx-auto text-white">


                            @if (session('success'))
                                <x-error>
                                    <span class="font-medium">Success::</span>
                                    {{ session('success') }}
                                </x-error>
                            @endif


                            <div class="overflow-x-auto min-h-[400px]">
                                <table class="w-full p-6 text-xs text-left whitespace-nowrap">
                                    <colgroup>
                                        <col class="w-5">
                                        <col>
                                        <col>
                                        <col>
                                        <col>
                                        <col>
                                        <col class="w-5">
                                    </colgroup>
                                    <thead>
                                        <tr class="dark:bg-gray-700">
                                            <th class="p-3">Id</th>
                                            <th class="p-3">Image</th>
                                            <th class="p-3">Name</th>
                                            <th class="p-3">Email</th>
                                            <th class="p-3">Phone</th>
                                            <th class="p-3">Gender</th>
                                            <th class="p-3">Section Name</th>
                                            <th class="p-3">Locality</th>
                                            <th class="p-3">Polling Station</th>
                                            <th class="p-3">Constituency</th>
                                            <th class="p-3">District</th>
                                            @can('is_admin')
                                                <th class="p-3">
                                                    Edit
                                                </th>
                                                <th>
                                                    Delete
                                                </th>
                                            @endcan
                                        </tr>
                                    </thead>

                                    @foreach($members as $member)
                                                        <tbody class="border-b dark:bg-gray-900 dark:border-gray-700 ">
                                                            <tr>

                                                                <td class="px-3 py-2">
                                                                    {{$member->id}}
                                                                </td>

                                                                <td
                                                                    class="px-3 text-2xl font-medium dark:text-gray-400">
                                                                    <img class="w-7 h-7 rounded-full"
                                                                        src="{{ asset('/storage/photos/' . $member->photo) }}"
                                                                        alt="">


                                                                </td>
                                                                <td class="px-3 py-2">
                                                                    <p>{{ $member->name }}</p>
                                                                </td>
                                                                <td class="px-3 py-2">

                                                                    <a href="mailto:{{ $member->email }}"
                                                                        class="dark:text-gray-400">{{ $member->email }}</a>
                                                                </td>
                                                                <td class="px-3 py-2">
                                                                    <a
                                                                        href="tel:{{ $member->phone }}">{{ $member->phone }}</a>
                                                                </td>
                                                                <td class="px-3 py-2">
                                                                    <p>{{ $member->gender }}</p>
                                                                </td>
                                                                <td class="px-3 py-2">

                                                                    <p class="dark:text-gray-400">
                                                                        {{$member->sectionname->name}}
                                                                    </p>

                                                                </td>
                                                                <td class="px-3 py-2">


                                                                    <p class="dark:text-gray-400">
                                                                        {{$member->sectionname->pollingstation->locality}}

                                                                    </p>
                                                                </td>
                                                                <td class="px-3 py-2">


                                                                    <p class="dark:text-gray-400">
{{--                                                                        {{ $pollingstation->polling_area }}</p>--}}
                                                                    {{$member->sectionname->pollingstation->polling_area}}
                                                                </td>
                                                                <td class="px-3 py-2">


                                                                    <p class="dark:text-gray-400">
                                                                        {{$member->sectionname->pollingstation->constituency->name}}
                                                                    </p>

                                                                </td>
                                                                <td class="px-3 py-2">

                                                                    <p class="dark:text-gray-400">

                                                                        {{$member->sectionname->pollingstation->constituency->district->name}}

                                                                    </p>

                                                                </td>
                                                                @can('is_admin')
                                                                    <td>
                                                                        <a
                                                                            href="{{ route('member.edit', [$member->id]) }}">
                                                                            <i class="fa-solid fa-pen-to-square"></i>
                                                                        </a>
                                                                    </td>
                                                                    <td>
                                                                        <form
                                                                            action="{{ route('member.destroy', [$member->id]) }}"
                                                                            onsubmit="return confirm('Warning: Are You Sure You Want To Delete This Data? Your Data Will Be Lost');"
                                                                        method="POST">
                                                                            @csrf
                                                                            @method('DELETE')
                                                                            <button type="submit">
                                                                                <i class="fa fa-trash"></i>
                                                                            </button>
                                                                        </form>
                                                                    </td>
                                                                @endcan
                                                            </tr>

                                                        </tbody>
                                    @endforeach





                                </table>
                            </div>
                            {{ $members->links() }}
                        </div>
                    @else
                        <h1 class="text-3xl text-center">No Members Available</h1>
                    @endif

                </div>
            </div>
        </div>
    </div>
    </div>
</x-app-layout>
