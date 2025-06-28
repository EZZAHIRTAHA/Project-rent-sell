@extends('layouts.myapp')
@section('content')
    <div class="mx-auto max-w-screen-xl bg-white rounded-md p-6 m-8 ">
        <div class="flex justify-between md:flex-row flex-col ">
            {{-- -------------------------------------------- left -------------------------------------------- --}}
            <div class="md:w-2/3  md:border-r border-gray-800 p-2">

                <h2 class=" ms-4 max-w-full font-car md:text-6xl text-4xl">{{ $car->brand }} {{ $car->model }}
                    {{ $car->engine }}
                </h2>
                <div class="mt-6 ms-4">
    <h3 class="text-2xl font-semibold mb-2 text-gray-800">Description</h3>
    <p class="text-gray-600 leading-relaxed">
        {!! nl2br(e($car->description)) !!}
    </p>
</div>

<div class="mt-6 ms-4 grid grid-cols-2 gap-4 text-gray-700">
    <div><strong>Brand:</strong> {{ $car->brand }}</div>
    <div><strong>Model:</strong> {{ $car->model }}</div>
    <div><strong>Engine:</strong> {{ $car->engine }}</div>
    <div><strong>Year:</strong> {{ $car->year }}</div>
    <div><strong>Color:</strong> {{ $car->color }}</div>
    <div><strong>Seats:</strong> {{ $car->seats }}</div>
    <div><strong>Doors:</strong> {{ $car->doors }}</div>
    <div><strong>Mileage:</strong> {{ $car->mileage }} km</div>
    {{-- Add any other fields you have --}}
</div>

                <div class=" flex items-end mt-8 ms-4">
                    <h3 class="font-car text-gray-500 text-2xl">Price:</h3>
                    <p>
                        <span
                            class=" text-3xl font-bold text-pr-400 ms-3 me-1 border border-pr-400 p-2 rounded-md">{{ $car->prix_vente }}
                            $</span>
                        <span
                            class="text-lg font-medium text-red-500 line-through">{{ intval(($car->price_per_day * 100) / (100 - $car->reduce)) }}
                            $
                        </span>
                    </p>
                </div>

                <div class=" flex items-center justify-around mt-10 me-10">
                    <div class="w-1/5 md:w-1/3 h-[0.25px] bg-gray-500 "> </div>
                    <p>Order Informations</p>
                    <div class="w-1/5 md:w-1/3 h-[0.25px] bg-gray-500 "> </div>

                </div>

                <div class="px-6 md:me-8">
                    <form id="reservation_form" action="{{ route('car.buyStore', ['car' => $car->id]) }}"
                        method="POST">
                        @csrf
                        <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">

                            {{-- <input type="text" hidden name="user" value="{{ Auth::user()->id }}"> --}}

                            <div class="sm:col-span-3">
                                <label for="full-name" class="block text-sm font-medium leading-6 text-gray-900">Full
                                    Name</label>
                                <div class="mt-2">
                                    <input type="text" name="full-name" id="full-name" value="{{ $user->name }}"
                                        class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-pr-400 sm:text-sm sm:leading-6">
                                </div>
                                @error('name')
                                    <span class="text-red-500">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="sm:col-span-3">
                                <label for="email"
                                    class="block text-sm font-medium leading-6 text-gray-900">Email</label>
                                <div class="mt-2">
                                    <input type="text" name="email" id="email" value="{{ $user->email }}"
                                        class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-pr-400 sm:text-sm sm:leading-6">
                                </div>
                                @error('email')
                                    <span class="text-red-500">{{ $message }}</span>
                                @enderror
                            </div>



                            {{-- Quantity Livewire Component --}}
                            <div class="sm:col-span-3">
                                <label class="block text-sm font-medium leading-6 text-gray-900">Quantity</label>
                                <div class="mt-2">
                                    @livewire('quantity', ['initialQuantity' => 1])
                                </div>
                            </div>

                            {{-- Coupons Input --}}
                            <div class="sm:col-span-3">
                                <label for="coupon_code" class="block text-sm font-medium leading-6 text-gray-900">Coupon Code</label>
                                <div class="mt-2 flex">
                                    <input type="text" name="coupon_code" id="coupon_code" 
                                        class="block w-full rounded-l-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-pr-400 sm:text-sm sm:leading-6"
                                        placeholder="Enter coupon code">
                                    <button type="button" id="apply_coupon"
                                        class="px-4 py-1.5 bg-pr-400 text-white rounded-r-md hover:bg-pr-500 focus:ring-2 focus:ring-pr-400 text-sm font-medium">
                                        Apply
                                    </button>
                                </div>
                                @error('coupon_code')
                                    <span class="text-red-500">{{ $message }}</span>
                                @enderror
                                <div id="coupon_message" class="mt-1 text-sm"></div>
                            </div>
                        </div>
                        <div class="mt-12 md:block hidden  ">
                            <button type="submit"
                                class="text-white bg-pr-400 p-3 w-full rounded-lg font-bold hover:bg-black shadow-xl hover:shadow-none ">Order
                                Now</button>
                        </div>
                    </form>
                </div>

            </div>

            {{-- -------------------------------------------- right -------------------------------------------- --}}

            <div class="md:w-1/3 flex flex-col justify-start items-center">
                <div class="relative mx-3 mt-3 flex h-[200px] w-3/4   overflow-hidden rounded-xl shadow-lg">
                    <img loading="lazy" class="h-full w-full object-cover" src="{{ $car->image }}" alt="product image" />
                    <span
                        class="absolute w-24 h-8 py-1 top-0 left-0 m-2 rounded-full bg-pr-400 px-2 text-center text-sm font-medium text-white">{{ $car->reduce }}
                        %
                        OFF</span>
                </div>
                <p class=" ms-4 max-w-full font-car text-xl mt-3 md:block hidden">{{ $car->brand }} {{ $car->model }}
                    {{ $car->engine }}
                </p>
                <div class="mt-3 ms-4 md:block hidden">
                    <div class="flex items-center">
                        @for ($i = 0; $i < $car->stars; $i++)
                            <svg aria-hidden="true" class="h-4 w-4 text-pr-300" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                </path>
                            </svg>
                        @endfor
                        <span
                            class="mr-2 ml-3 rounded bg-pr-300 px-2.5 py-0.5 text-sm font-semibold">{{ $car->stars }}.0</span>
                    </div>
                </div>

                {{-- <div class=" w-full   mt-8 ms-8">
                    <p id="duration" class="font-car text-gray-600 text-lg ms-2">Estimated Duration: <span
                            class="mx-2 font-car text-md font-medium text-gray-700 border border-pr-400 p-2 rounded-md "> --
                            days</span>
                    </p>
                </div> --}}

                <div class=" w-full   mt-8 ms-8">
                    <p id="total-price" class="font-car text-gray-600 text-lg ms-2">Final Price: <span
                            class="mx-2 font-car text-md font-medium text-gray-700 border border-pr-400 p-2 rounded-md "> --
                            $</span>
                    </p>
                </div>

                <div class=" w-full   mt-4 ms-8">
                    <p id="discount-amount" class="font-car text-green-600 text-lg ms-2 hidden">Discount: <span
                            class="mx-2 font-car text-md font-medium text-green-700 border border-green-400 p-2 rounded-md "> --
                            $</span>
                    </p>
                </div>

                <div class=" w-full   mt-4 ms-8">
                    <p id="final-price" class="font-car text-gray-800 text-xl font-bold ms-2 hidden">Final Price: <span
                            class="mx-2 font-car text-lg font-bold text-pr-400 border border-pr-400 p-2 rounded-md "> --
                            $</span>
                    </p>
                </div>

                <div id="mobile_submit_button" class="mt-12 w-full md:hidden  ">
                    <button type="submit"
                        class="text-white bg-pr-400 p-3 w-full rounded-lg font-bold hover:bg-black shadow-xl hover:shadow-none ">Order
                        Now</button>
                </div>
            </div>
        </div>

        @if (session('error'))
            <script>
                const Toast = Swal.mixin({
                    toast: true,
                    position: "top-end",
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.onmouseenter = Swal.stopTimer;
                        toast.onmouseleave = Swal.resumeTimer;
                    }
                });
                Toast.fire({
                    icon: "error",
                    title: "{{ session('error') }}"
                });
            </script>
        @endif

    </div>

    <script>
    $(document).ready(function () {
        var currentQuantity = 1;
        var currentDiscount = 0;
        var appliedCoupon = null;
        var unitPrice = {{ $car->prix_vente }};

        function updatePricing() {
            var basePrice = unitPrice * currentQuantity;
            var discountAmount = basePrice * (currentDiscount / 100);
            var finalPrice = basePrice - discountAmount;

            $('#total-price span').text(basePrice.toFixed(2) + ' $');

            if (currentDiscount > 0) {
                $('#discount-amount span').text('-' + discountAmount.toFixed(2) + ' $');
                $('#final-price span').text(finalPrice.toFixed(2) + ' $');
                $('#discount-amount, #final-price').removeClass('hidden');
            } else {
                $('#discount-amount, #final-price').addClass('hidden');
            }
        }

        // Listen for Livewire quantity changes
        window.addEventListener('quantity-updated', event => {
            currentQuantity = event.detail.quantity;
            updatePricing();
        });

        // Coupon functionality
        $('#apply_coupon').click(function () {
            var couponCode = $('#coupon_code').val().trim();
            var messageDiv = $('#coupon_message');

            if (!couponCode) {
                messageDiv.html('<span class="text-red-500">Please enter a coupon code</span>');
                return;
            }

            $.ajax({
                url: '{{ route("coupon.validate") }}',
                method: 'POST',
                data: {
                    coupon_code: couponCode,
                    _token: '{{ csrf_token() }}'
                },
                success: function (response) {
                    if (response.valid) {
                        currentDiscount = response.discount_percentage;
                        appliedCoupon = couponCode;

                        messageDiv.html('<span class="text-green-500">Coupon applied! ' + response.discount_percentage + '% discount</span>');
                        $('#coupon_code').prop('disabled', true);
                        $('#apply_coupon').text('Applied').prop('disabled', true);

                        if (!$('#applied_coupon').length) {
                            $('#reservation_form').append('<input type="hidden" id="applied_coupon" name="applied_coupon" value="' + couponCode + '">');
                        }

                        updatePricing();
                    } else {
                        messageDiv.html('<span class="text-red-500">' + response.message + '</span>');
                    }
                },
                error: function () {
                    messageDiv.html('<span class="text-red-500">Error validating coupon</span>');
                }
            });
        });

        $(document).on('click', '#remove_coupon', function () {
            currentDiscount = 0;
            appliedCoupon = null;
            $('#coupon_code').val('').prop('disabled', false);
            $('#apply_coupon').text('Apply').prop('disabled', false);
            $('#coupon_message').empty();
            $('#applied_coupon').remove();
            updatePricing();
        });

        document.getElementById("mobile_submit_button").addEventListener("click", function () {
            document.getElementById("reservation_form").submit();
        });

        // Initial pricing
        updatePricing();
    });
</script>

@endsection