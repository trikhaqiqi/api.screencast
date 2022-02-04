@props(['disabled' => false])

{{-- <input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'rounded-md shadow-sm border-gray-300 focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50']) !!}> --}}
<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'h-10 border border-gray-300 focus:border-blue-500 focus:outline-none rounded-lg px-3 focus:ring focus:ring-blue-200 transition duration-200']) !!}>
