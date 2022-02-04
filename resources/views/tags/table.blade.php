<x-app-layout>
    <x-slot name="title">{{ $title }}</x-slot>
    <x-slot name="header">{{ $title }}</x-slot>

    <x-table>
        <tr>
            <x-th>#</x-th>
            <x-th>Name</x-th>
            <x-th>Playlist</x-th>
            @can('delete tags')
                <x-th>Action</x-th>
            @endcan
        </tr>
        @foreach ($tags as $tag)
            <tr>
                <x-td>{{ $tags->count() * ($tags->currentPage() - 1) + $loop->iteration }}</x-td>
                <x-td>{{ $tag->name }}</x-td>
                <x-td>{{ $tag->playlists_count }}</x-td>
                @can('delete tags')
                <x-td>
                    <div class="flex items-center">
                        <a class="mr-2 text-blue-500 hover:text-blue-600 font-medium underline uppercase text-xs" 
                        href="{{ route('tags.edit', $tag->slug) }}">
                        Edit
                        </a>
                            <div x-data="{ modalIsOpen: false }">
                                <x-modal state="modalIsOpen" x-show="modalIsOpen" title="Are you sure ?">
                                    <div class="flex items-center">
                                        <form class="mr-2" action="{{ route('tags.delete', $tag->slug) }}" method="post">
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
                @endcan
            </tr>
        @endforeach
    </x-table>

    {{ $tags->links() }}
</x-app-layout>
