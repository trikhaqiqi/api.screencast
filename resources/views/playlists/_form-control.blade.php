@csrf
<div class="mb-6">
    <input type="file" name="thumbnail" id="thumbnail">
    @error('thumbnail')
    <div class="text-red-500 mt-2">{{ $message }}</div>
    @enderror
</div>

<!-- Email Address -->
<div class="mb-6">
    <x-label for="name" :value="__('Name')" />
    <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name') ?? $playlist->name" required autofocus />
    @error('name')
        <div class="text-red-500 mt-2">{{ $message }}</div>
    @enderror
</div>

<div class="mb-6">
    <x-label for="price" :value="__('Price')" />
    <x-input id="price" class="block mt-1 w-full" type="text" name="price" :value="old('price') ?? $playlist->price" required />
    @error('price')
    <div class="text-red-500 mt-2">{{ $message }}</div>
    @enderror
</div>

<div class="mb-6">
    <x-label for="description" :value="__('Description')" />
    <x-textarea id="description" name="description" required>{{ old('description') ?? $playlist->description}}</x-textarea>
    @error('description')
    <div class="text-red-500 mt-2">{{ $message }}</div>
    @enderror
</div>

<div class="mb-6">
    <x-label for="tags" value="Tags" />
    <select multiple name="tags[]" id="tags" class=" w-full mt-2 border border-gray-300 focus:border-blue-500 focus:outline-none rounded-lg px-3 focus:ring focus:ring-blue-200 transition duration-200">
        @foreach ($tags as $tag)
            <option {{ $playlist->tags()->find($tag->id) ? 'selected' : '' }} value="{{ $tag->id }}">{{ $tag->name }}</option>
        @endforeach
    </select>
</div>

<x-button>{{ $submit }}</x-button>