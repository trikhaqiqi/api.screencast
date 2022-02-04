@csrf

<div class="mb-4 w-full lg:w-1/2">
    <x-label for="name">Name</x-label>
    <x-input type="text" name="name" id="name" value="{{ old('name') ?? $tag->name }}" class="mt-2 w-full" placeholder="Laravel"/>
    @error('name')
        <div class="text-red-500 mt-2">{{ $message }}</div>
    @enderror
</div>

<x-button>{{ $submit }}</x-button>