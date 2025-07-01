@extends('layouts.myapp')
@section('content')
    <div class="mx-auto max-w-screen-xl">
        <div class="">
            <div class="my-6 py-6 px-4 bg-white rounded-md flex justify-start items-center flex-wrap md:flex-nowrap gap-y-4 md:gap-y-0">
                <div class="flex justify-center w-1/2 md:w-1/4">
                    <img loading="lazy" class="w-44 h-44 rounded-full border-2 border-pr-400 shadow-lg shadow-pr-400/50"
                        src="{{ Auth::user()->avatar }}" alt="{{ Auth::user()->name }}">
                </div>
                <div class="w-1/2 md:w-1/4">
                    <h2 class="font-medium text-slate-600 text-5xl">{{ Auth::user()->name }}</h2>
                    <h2 class="text-lg font-medium text-gray-900">{{ Auth::user()->email }}</h2>
                </div>
                <div class="w-full grid grid-cols-2 gap-4 md:w-1/2">
                    <div
                        class="bg-blue-300 p-4 rounded-md border-2 border-blue-700 flex flex-col justify-center items-center">
                        <p class="text-lg font-car font-normal text-gray-500">Total Reservations </p>
                        <h2 class="font-medium text-blue-600 text-3xl">{{ Auth::user()->reservations->count() }}</h2>
                    </div>

                    <div
                        class="bg-green-300 p-4 rounded-md border-2 border-green-700 flex flex-col justify-center items-center">
                        <p class="text-lg font-car font-normal text-gray-500">Active Reservations </p>
                        <h2 class="font-medium text-green-600 text-3xl">
                            {{ Auth::user()->reservations->where('status', 'Active')->count() }}</h2>
                    </div>

                    <div
                        class="bg-pr-300 p-4 rounded-md border-2 border-pr-700 flex flex-col justify-center items-center">
                        <p class="text-lg font-car font-normal text-gray-500">Pending Reservations </p>
                        <h2 class="font-medium text-pr-600 text-3xl">
                            {{ Auth::user()->reservations->where('status', 'Pending')->count() }}</h2>
                    </div>

                    <div
                        class="bg-red-300 p-4 rounded-md border-2 border-red-700 flex flex-col justify-center items-center">
                        <p class="text-lg font-car font-normal text-gray-500">Ventes</p>
                        <h2 class="font-medium text-red-600 text-3xl">
                            {{ Auth::user()->ventes->count() }}</h2>
                    </div>
                </div>
            </div>

            <!-- Add this to your main blade file -->
<div class="bg-white p-4 rounded-md my-12">
    <!-- Tabs Navigation -->
    <div class="border-b border-gray-200 mb-6">
        <nav class="-mb-px flex space-x-8">
            <button onclick="showTab('reservations')" id="reservations-tab" class="tab-button active border-b-2 border-pr-400 text-pr-600 py-4 px-1 text-sm font-medium">
                Reservations
            </button>
            <button onclick="showTab('ventes')" id="ventes-tab" class="tab-button border-b-2 border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 py-4 px-1 text-sm font-medium">
                Sales
            </button>
        </nav>
    </div>

    <!-- Reservations Tab Content -->
    <div id="reservations-content" class="tab-content">
        <h2 class="text-3xl font-car font-medium text-gray-500 text-center mb-4">Reservations</h2>
        @forelse ($reservations as $reservation)
            <div class="flex justify-center w-full mb-4 rounded-lg bg-gray-200">
                <div class="md:w-1/3 w-full h-[250px]  overflow-hidden p-1 hidden md:block  m-3 rounded-md">
                    <img loading="lazy" class="w-full h-full object-cover overflow-hidden rounded-md"
                        src="{{ $reservation->car->image }}" alt="">
                </div>
                <div class="m-3 p-1 md:w-2/3 w-full">
                    <h2 class="mt-2 font-car text-gray-800 text-2xl font-medium">{{ $reservation->car->brand }}
                        {{ $reservation->car->model }} {{ $reservation->car->engine }}</h2>
                    <div class="mt-4 flex md:flex-row flex-col justify-start md:gap-10 gap-5">
                        <div class="flex gap-2 items-center">
                            <p class="text-lg font-medium">From: </p>
                            <p class="text-pr-600 font-semibold text-lg">
                                {{ Carbon\Carbon::parse($reservation->start_date)->format('y-m-d') }}</p>
                        </div>
<<<<<<< HEAD
                        <div class="flex gap-2 items-center">
                            <p class="text-lg font-medium">To: </p>
                            <p class="text-pr-600 font-semibold text-lg">
                                {{ Carbon\Carbon::parse($reservation->end_date)->format('y-m-d') }}</p>
                        </div>
                        <div class="flex gap-2 items-center">
                            <p class="text-lg font-medium">Price: </p>
                            <p class="text-pr-600 font-semibold text-lg">{{ $reservation->total_price }} <span
                                    class="text-black">$</span> </p>
=======
                        <div class="m-3 p-1 md:w-2/3 w-full">
                            <h2 class="mt-2 font-car text-gray-800 text-2xl font-medium">{{ $reservation->car->brand }}
                                {{ $reservation->car->model }} {{ $reservation->car->engine }}</h2>
                            <div class="mt-4 flex md:flex-row flex-col justify-start md:gap-10 gap-5">
                                <div class="flex gap-2 items-center">
                                    <p class="text-lg font-medium">From: </p>
                                    <p class="text-pr-600 font-semibold text-lg">
                                        {{ Carbon\Carbon::parse($reservation->start_date)->format('y-m-d') }}</p>
                                </div>
                                <div class="flex gap-2 items-center">
                                    <p class="text-lg font-medium">To: </p>
                                    <p class="text-pr-600 font-semibold text-lg">
                                        {{ Carbon\Carbon::parse($reservation->end_date)->format('y-m-d') }}</p>
                                </div>
                                <div class="flex gap-2 items-center">
                                    <p class="text-lg font-medium">Price: </p>
                                    <p class="text-pr-600 font-semibold text-lg">{{ $reservation->total_price }} <span
                                            class="text-black">$</span> </p>
                                </div>



                            </div>
                            <div class="mt-8 flex justify-start md:gap-16 gap-6">

                                <div class="flex md:gap-2 items-center">
                                    <p class="text-lg font-medium">Payment: </p>
                                    <div class="px-4 py-3 text-sm ">
                                        @if ($reservation->payment_status == 'Pending')
                                            <span
                                                class="p-2 text-white rounded-md bg-pr-300 ">{{ $reservation->payment_status }}</span>
                                        @elseif ($reservation->payment_status == 'Canceled')
                                            <span
                                                class="p-2 text-white rounded-md bg-red-500 ">{{ $reservation->payment_status }}</span>
                                        @elseif ($reservation->payment_status == 'Paid')
                                            <span
                                                class="p-2 text-white rounded-md bg-green-500 px-5">{{ $reservation->payment_status }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="flex gap-2 items-center">
                                    <p class="text-lg font-medium">Reservation: </p>
                                    <div class="px-4 py-3 text-sm ">
                                        @if ($reservation->status == 'Pending')
                                            <span
                                                class="p-2 text-white rounded-md bg-pr-300 ">{{ $reservation->status }}</span>
                                        @elseif ($reservation->status == 'Ended')
                                            <span
                                                class="p-2 text-white rounded-md bg-black ">{{ $reservation->status }}</span>
                                        @elseif ($reservation->status == 'Active')
                                            <span
                                                class="p-2 text-white rounded-md bg-green-500 px-4">{{ $reservation->status }}</span>
                                        @elseif ($reservation->status == 'Canceled')
                                            <span
                                                class="p-2 text-white rounded-md bg-red-500 ">{{ $reservation->status }}</span>
                                        @endif
                                    </div>
                                </div>

                            </div>

                            <div class="w-[350px] h-[250px]  overflow-hidden p-1  md:hidden  mx-auto mt-3 rounded-md">
                                <img loading="lazy" class="w-full h-full object-cover overflow-hidden rounded-md"
                                    src="{{ $reservation->car->image }}" alt="">
                            </div>

                            <div class="mt-8 text-center w-full px-2">
                                <a href="{{ route('invoice', ['reservation' => $reservation->id]) }}" target="_blank">
                                    <button class="bg-pr-400 p-3 text-white font-bold hover:bg-black w-full rounded-md ">
                                        Get Reservation Invoice</button>
                                </a>
                            </div>

>>>>>>> 1b832dfcb1f31004c9dd3e025082e66ddb1695ec
                        </div>
                    </div>
                    <div class="mt-8 flex justify-start md:gap-16 gap-6">
                        <div class="flex md:gap-2 items-center">
                            <p class="text-lg font-medium">Payment: </p>
                            <div class="px-4 py-3 text-sm ">
                                @if ($reservation->payment_status == 'Pending')
                                    <span class="p-2 text-white rounded-md bg-yellow-300 ">{{ $reservation->payment_status }}</span>
                                @elseif ($reservation->payment_status == 'Canceled')
                                    <span class="p-2 text-white rounded-md bg-red-500 ">{{ $reservation->payment_status }}</span>
                                @elseif ($reservation->payment_status == 'Paid')
                                    <span class="p-2 text-white rounded-md bg-green-500 px-5">{{ $reservation->payment_status }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="flex gap-2 items-center">
                            <p class="text-lg font-medium">Reservation: </p>
                            <div class="px-4 py-3 text-sm ">
                                @if ($reservation->status == 'Pending')
                                    <span class="p-2 text-white rounded-md bg-yellow-300 ">{{ $reservation->status }}</span>
                                @elseif ($reservation->status == 'Ended')
                                    <span class="p-2 text-white rounded-md bg-black ">{{ $reservation->status }}</span>
                                @elseif ($reservation->status == 'Active')
                                    <span class="p-2 text-white rounded-md bg-green-500 px-4">{{ $reservation->status }}</span>
                                @elseif ($reservation->status == 'Canceled')
                                    <span class="p-2 text-white rounded-md bg-red-500 ">{{ $reservation->status }}</span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="w-[350px] h-[250px]  overflow-hidden p-1  md:hidden  mx-auto mt-3 rounded-md">
                        <img loading="lazy" class="w-full h-full object-cover overflow-hidden rounded-md"
                            src="{{ $reservation->car->image }}" alt="">
                    </div>

                    <div class="mt-8 text-center w-full px-2">
                        <a href="{{ route('invoice', ['reservation' => $reservation->id]) }}" target="_blank">
                            <button class="bg-pr-400 p-3 text-white font-bold hover:bg-black w-full rounded-md ">
                                Get Reservation Invoice</button>
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <div class="h-full w-full flex justify-center items-center">
                <h2 class="font-medium text-2xl ">There no reservations yet</h2>
            </div>
        @endforelse
    </div>

    <!-- Sales Tab Content -->
    <div id="ventes-content" class="tab-content hidden">
        <h2 class="text-3xl font-car font-medium text-gray-500 text-center mb-4">Sales</h2>
        @forelse ($ventes as $vente)
            <div class="flex justify-center w-full mb-4 rounded-lg bg-gradient-to-r from-blue-50 to-indigo-50 border border-blue-100 hover:shadow-lg transition-all duration-300">
                <div class="md:w-1/3 w-full h-[250px] overflow-hidden p-1 hidden md:block m-3 rounded-md">
                    <img loading="lazy" class="w-full h-full object-cover overflow-hidden rounded-md hover:scale-105 transition-transform duration-300"
                        src="{{ $vente->car->image }}" alt="">
                </div>
                <div class="m-3 p-1 md:w-2/3 w-full">
                    <h2 class="mt-2 font-car text-gray-800 text-2xl font-medium">{{ $vente->car->brand }}
                        {{ $vente->car->model }} {{ $vente->car->engine ?? '' }}</h2>
                    
                    <div class="mt-4 flex md:flex-row flex-col justify-start md:gap-10 gap-5">
                        <div class="flex gap-2 items-center">
                            <p class="text-lg font-medium">Sale Date: </p>
                            <p class="text-blue-600 font-semibold text-lg">
                                {{ Carbon\Carbon::parse($vente->sale_date ?? $vente->created_at)->format('y-m-d') }}</p>
                        </div>
                        <div class="flex gap-2 items-center">
                            <p class="text-lg font-medium">Sale Price: </p>
                            <p class="text-green-600 font-bold text-xl">{{ $vente->sale_price ?? $vente->total_price ?? 0 }} <span
                                    class="text-black">$</span> </p>
                        </div>
                        @if(isset($vente->buyer_name))
                        <div class="flex gap-2 items-center">
                            <p class="text-lg font-medium">Buyer: </p>
                            <p class="text-purple-600 font-semibold text-lg">{{ $vente->buyer_name }}</p>
                        </div>
                        @endif
                    </div>

                    <div class="mt-8 flex justify-start md:gap-16 gap-6">
                        <div class="flex md:gap-2 items-center">
                            <p class="text-lg font-medium">Payment: </p>
                            <div class="px-4 py-3 text-sm">
                                @if (($vente->payment_status ?? 'Paid') == 'Pending')
                                    <span class="p-2 text-white rounded-md bg-yellow-400">{{ $vente->payment_status ?? 'Pending' }}</span>
                                @elseif (($vente->payment_status ?? 'Paid') == 'Failed')
                                    <span class="p-2 text-white rounded-md bg-red-500">{{ $vente->payment_status ?? 'Failed' }}</span>
                                @else
                                    <span class="p-2 text-white rounded-md bg-green-500 px-5">{{ $vente->payment_status ?? 'Paid' }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="flex gap-2 items-center">
                            <p class="text-lg font-medium">Sale Status: </p>
                            <div class="px-4 py-3 text-sm">
                                @if (($vente->status ?? 'Completed') == 'Pending')
                                    <span class="p-2 text-white rounded-md bg-yellow-400">{{ $vente->status ?? 'Pending' }}</span>
                                @elseif (($vente->status ?? 'Completed') == 'Canceled')
                                    <span class="p-2 text-white rounded-md bg-red-500">{{ $vente->status ?? 'Canceled' }}</span>
                                @else
                                    <span class="p-2 text-white rounded-md bg-blue-500 px-4">{{ $vente->status ?? 'Completed' }}</span>
                                @endif
                            </div>
                        </div>
                    </div>

                    @if(isset($vente->payment_method))
                    <div class="mt-4 flex gap-2 items-center">
                        <p class="text-lg font-medium">Payment Method: </p>
                        <p class="text-indigo-600 font-semibold text-lg">{{ $vente->payment_method }}</p>
                    </div>
                    @endif

                    <div class="w-[350px] h-[250px] overflow-hidden p-1 md:hidden mx-auto mt-3 rounded-md">
                        <img loading="lazy" class="w-full h-full object-cover overflow-hidden rounded-md"
                            src="{{ $vente->car->image }}" alt="">
                    </div>

                    <div class="mt-8 text-center w-full px-2 flex gap-2">
                        <a href="{{ route('invoiceVente', ['vente' => $vente->id]) ?? '#' }}" target="_blank" class="flex-1">
                            <button class="bg-blue-500 p-3 text-white font-bold hover:bg-blue-600 w-full rounded-md transition-colors duration-200">
                                Sale Invoice
                            </button>
                        </a>
                        <button class="bg-green-500 p-3 text-white font-bold hover:bg-green-600 flex-1 rounded-md transition-colors duration-200">
                            View Details
                        </button>
                    </div>
                </div>
            </div>
        @empty
            <div class="h-full w-full flex justify-center items-center py-16">
                <div class="text-center">
                    <div class="w-24 h-24 mx-auto mb-4 bg-gray-100 rounded-full flex items-center justify-center">
                        <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2 2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-4.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 009.586 13H7"></path>
                        </svg>
                    </div>
                    <h2 class="font-medium text-2xl text-gray-600 mb-2">No sales yet</h2>
                    <p class="text-gray-500">Your vehicle sales will appear here</p>
                </div>
            </div>
        @endforelse
    </div>
</div>

<!-- Add this JavaScript at the bottom of your page or in a separate JS file -->
<script>
function showTab(tabName) {
    // Hide all tab contents
    const tabContents = document.querySelectorAll('.tab-content');
    tabContents.forEach(content => {
        content.classList.add('hidden');
    });
    
    // Remove active class from all tab buttons
    const tabButtons = document.querySelectorAll('.tab-button');
    tabButtons.forEach(button => {
        button.classList.remove('active', 'border-pr-400', 'text-pr-600');
        button.classList.add('border-transparent', 'text-gray-500');
    });
    
    // Show selected tab content
    document.getElementById(tabName + '-content').classList.remove('hidden');
    
    // Add active class to selected tab button
    const activeButton = document.getElementById(tabName + '-tab');
    activeButton.classList.add('active', 'border-pr-400', 'text-pr-600');
    activeButton.classList.remove('border-transparent', 'text-gray-500');
}

// Set default active tab on page load
document.addEventListener('DOMContentLoaded', function() {
    showTab('reservations');
});
</script>

<style>
.tab-button {
    transition: all 0.2s ease-in-out;
}

.tab-button:hover {
    color: #374151;
    border-color: #d1d5db;
}

.tab-button.active {
    color: #dc2626; /* Adjust this to match your pr-600 color */
    border-color: #dc2626; /* Adjust this to match your pr-400 color */
}

.tab-content {
    animation: fadeIn 0.3s ease-in-out;
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(10px); }
    to { opacity: 1; transform: translateY(0); }
}
</style>

        </div>
    </div>
@endsection
