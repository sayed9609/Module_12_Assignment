<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Booking Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">


                    <form class="max-w-sm mx-auto" method="POST"
                        action="{{ route('bus.buy-ticket', ['busCode' => $busCode]) }}">
                        @csrf
                        <div class="mb-5">
                            <label for="countries" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Bus Code: {{ $busCode }}
                            </label>

                        </div>
                        <div class="mb-5">
                            <label for="countries" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Paribahan Name: {{ $paribahanName }}
                            </label>

                        </div>
                        <div class="mb-5">
                            <label for="countries" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                <h1>Available Seats: {{ $availableSeats }}</h1>
                            </label>
                        </div>
                        <div class="mb-5">
                            <label for="email"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Customer
                                Name</label>
                            <input type="text" id="name" name="name"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="enter your name">
                        </div>
                        <div class="mb-5">
                            <label for="email"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                            <input type="email" id="email" name="email"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="name@email.com">
                        </div>
                        <div class="mb-5">
                            <label for="text"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Phone
                                Number</label>
                            <input type="text" id="text" name="phone"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="+880">
                        </div>

                        <div class="mb-5">
                            <label for="seat_numbers"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Available Seat
                                Numbers</label>

                            <table>
                                @for ($row = 'A'; $row <= 'I' ; $row++) <tr>
                                    @for ($col = 1; $col <= 4; $col++)
                                        @php
                                            $seat = $row . $col;
                                        @endphp

                                        <td>
                                            @if (!in_array($seat, $seatNumbers))
                                                <label class="inline-flex items-center mx-2">
                                                    <input type="checkbox" name="seat_numbers[]"
                                                        value="{{ $seat }}"
                                                        class="form-checkbox text-blue-500 focus:ring-blue-500 focus:border-blue-500 dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                                    <span class="ml-2">{{ $seat }}</span>
                                                </label>
                                            @endif
                                        </td>
                                    @endfor
                                    </tr>
                                    @endfor
                            </table>
                        </div>

                        <button type="submit"
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Purchase</button>
                    </form>


                </div>
            </div>
        </div>
    </div>
</x-app-layout>
