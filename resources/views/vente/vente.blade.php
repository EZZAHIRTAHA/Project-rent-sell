@extends('layouts.myapp')

@section('content')
<div class="bg-gray-200 mx-auto max-w-screen-xl mt-10 p-3 rounded-md shadow-xl">
    <form action="{{ route('carSearch') }}">
        <div class="flex flex-col md:flex-row md:gap-28 gap-4 justify-center">
            <div class="flex flex-col md:flex-row md:gap-16 gap-2">
                <input type="text" name="brand" placeholder="Brand"
                    class="block rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-pr-400 sm:text-sm sm:leading-6">

                <input type="text" name="model" placeholder="Model"
                    class="block rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-pr-400 sm:text-sm sm:leading-6">

                <input type="number" name="min_price" placeholder="$ Minimum price"
                    class="block rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-pr-400 sm:text-sm sm:leading-6">

                <input type="number" name="max_price" placeholder="$ Maximum price"
                    class="block rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-pr-400 sm:text-sm sm:leading-6">
            </div>
            <button type="submit"
                class="bg-pr-400 hover:bg-pr-500 text-white font-medium p-2 w-20 rounded-md">Search</button>
        </div>
    </form>
</div>

<div class="mt-6 mb-2 grid md:grid-cols-3 gap-4 justify-center items-center mx-auto max-w-screen-xl">
    @foreach ($cars as $car)
      <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-200 w-full max-w-xs mx-auto">
    <div class="relative">
        <a href="{{ route('car.reservation', ['car' => $car->id]) }}">
            <img class="w-full h-48 object-cover rounded-t-xl" src="{{ $car->image }}" alt="{{ $car->brand }}">
            @if($car->reduce)
                <span class="absolute top-2 left-2 bg-orange-500 text-white text-xs font-bold px-2 py-1 rounded">
                    {{ $car->reduce }}% OFF
                </span>
            @endif
        </a>
    </div>

    <div class="p-4">
        <h3 class="text-lg font-bold text-gray-800">{{ $car->brand }} {{ $car->model }} {{ $car->engine }}</h3>

        <div class="mt-2">
            <p class="text-2xl font-extrabold text-gray-900">{{ number_format($car->prix_vente, 2) }} <span class="text-base font-semibold">DH</span></p>
            <p class="text-sm text-gray-500 line-through">
                {{ number_format(($car->prix_vente * 100) / (100 - $car->reduce), 0) }} DH
            </p>
        </div>

        <div class="flex items-center justify-between mt-3">
            <div class="flex items-center">
                @for ($i = 0; $i < $car->stars; $i++)
                    <svg class="w-4 h-4 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9.049 2.927c.3-.921 1.603-.921 
                        1.902 0l1.07 3.292a1 1 0 
                        00.95.69h3.462c.969 0 1.371 1.24.588 
                        1.81l-2.8 2.034a1 1 0 
                        00-.364 1.118l1.07 
                        3.292c.3.921-.755 1.688-1.54 
                        1.118l-2.8-2.034a1 1 0 
                        00-1.175 0l-2.8 
                        2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 
                        1 0 00-.364-1.118L2.98 
                        8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 
                        1 0 00.951-.69l1.07-3.292z" />
                    </svg>
                @endfor
            </div>
            <span class="text-sm bg-yellow-300 text-yellow-900 px-2 py-0.5 rounded font-semibold">{{ $car->stars }}.0</span>
        </div>

        <p class="mt-2 text-sm text-gray-700"><strong>Available:</strong> {{ $car->quantity }} cars</p>

        <a href="{{ route('car.reservation', ['car' => $car->id]) }}"
            class="mt-4 inline-flex items-center justify-center w-full bg-slate-900 text-white py-2 px-4 rounded-lg hover:bg-pr-400 transition">
            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 512 512">
                <path
                    d="M184 24c0-13.3-10.7-24-24-24s-24 
                    10.7-24 24V64H96c-35.3 0-64 28.7-64 
                    64v16 48V448c0 35.3 28.7 64 
                    64 64H416c35.3 0 64-28.7 
                    64-64V192 144 128c0-35.3-28.7-64-64-64H376V24c0-13.3-10.7-24-24-24s-24 
                    10.7-24 24V64H184V24zM80 
                    192H432V448c0 8.8-7.2 16-16 
                    16H96c-8.8 0-16-7.2-16-16V192zm176 
                    40c-13.3 0-24 10.7-24 
                    24v48H184c-13.3 0-24 10.7-24 
                    24s10.7 24 24 24h48v48c0 
                    13.3 10.7 24 24 
                    24s24-10.7 24-24V352h48c13.3 
                    0 24-10.7 24-24s-10.7-24-24-24H280V256c0-13.3-10.7-24-24-24z" />
            </svg>
            Buy
        </a>
    </div>
</div>

    @endforeach
</div>
@endsection
