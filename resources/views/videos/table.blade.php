<x-app-layout>
    <x-slot name='title'> 
        {{ $title }}
    </x-slot>

    <x-slot name="header">
        {{ $title }}
    </x-slot>

    <x-table>
        <tr>
            <x-th>#</x-th>
            <x-th>Title</x-th>
            <x-th>Intro</x-th>
            <x-th>Action</x-th>
        </tr>
        @foreach ($videos as $item)
            <tr>
                <x-td>{{ $videos->count() * ($videos->currentPage() - 1) + $loop->iteration }}</x-td>
                <x-td>{{ $item->title }}</x-td>
                <x-td>
                    <span class="uppercase font-semibold text-xs">{{ $item->intro ? 'Yes' : 'No' }}</span>
                </x-td>
                <x-td>
                    <div class="flex items-center">
                        <a class="mr-2 text-blue-500 hover:text-blue-600 font-medium underline uppercase text-xs" href="{{ route('videos.edit', [$playlist, $item->unique_video_id]) }}">Edit</a>
                        <div x-data="{ modalIsOpen: false }">
                            <x-modal state="modalIsOpen" x-show="modalIsOpen" title="Are you sure ?">
                                <div class="mb-5">
                                    <h4 class="text-lg capitalize">{{ $item->title }}</h4>
                                    <span class="text-xs uppercase text-gray-600">Episode {{ $item->runtime }}
                                    - 
                                    Runtime: {{ $item->runtime }}</span>
                                </div>
                                <div class="flex items-center">
                                    <form class="mr-2" action="{{ route('videos.delete', [$playlist->slug, $item->unique_video_id]) }}" method="post">
                                        @csrf
                                        @method('delete')
                                        <x-button>
                                            Yes
                                        </x-button>
                                    </form>
                                    <x-button type="button" @click="modalIsOpen = false">
                                        Cancel
                                    </x-button>
                                </div>
                            </x-modal>
                                
                            <button @click="modalIsOpen = true"  class="focus:outline-none text-red-500 hover:text-red-600 font-medium underline uppercase text-xs">
                                Delete
                            </button>
                        </div>
                    </div>
                </x-td>
            </tr>
        @endforeach
    </x-table>

    {{ $videos->links() }}
</x-app-layout>
