<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Client') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-6 bg-white rounded shadow">
                <h1 class="text-2xl font-bold mb-4">Edit Client</h1>

                @if (session('success'))
                    <div class="p-4 mb-4 text-green-700 bg-green-100 rounded">
                        {{ session('success') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="p-4 mb-4 text-red-700 bg-red-100 rounded">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Edit Client Form -->
                <form action="{{ route('clients.update', $client->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label for="first_name" class="block text-sm font-medium text-gray-700">First Name</label>
                        <input type="text" name="first_name" id="first_name" value="{{ $client->first_name }}"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    </div>

                    <div class="mb-4">
                        <label for="last_name" class="block text-sm font-medium text-gray-700">Last Name</label>
                        <input type="text" name="last_name" id="last_name" value="{{ $client->last_name }}"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    </div>

                    <div class="mb-4">
                        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                        <input type="email" name="email" id="email" value="{{ $client->email }}"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    </div>

                    <div class="mb-4">
                        <label for="phone" class="block text-sm font-medium text-gray-700">Phone</label>
                        <input type="text" name="phone" id="phone" value="{{ $client->phone }}"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    </div>

                    <div class="mb-4">
                        <label for="cash_loan" class="block text-sm font-medium text-gray-700">Cash Loan</label>
                        <select name="cash_loan" id="cash_loan"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            <option value="0" {{ $client->cash_loan === 0 ? 'selected' : '' }}>No</option>
                            <option value="1" {{ $client->cash_loan === 1 ? 'selected' : '' }}>Yes</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label for="home_loan" class="block text-sm font-medium text-gray-700">Home Loan</label>
                        <select name="home_loan" id="home_loan"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            <option value="0" {{ $client->home_loan === 0 ? 'selected' : '' }}>No</option>
                            <option value="1" {{ $client->home_loan === 1 ? 'selected' : '' }}>Yes</option>
                        </select>
                    </div>

                    <div>
                        <button type="submit"
                                class="px-4 py-2 bg-primary text-white font-semibold rounded-md hover:bg-indigo-600">
                            Update Client
                        </button>
                        <a href="{{ route('clients.index') }}"
                           class="px-4 py-2 bg-gray-300 text-black font-semibold rounded-md hover:bg-gray-400 ml-2">
                            Back to clients
                        </a>
                    </div>
                </form>

                <!-- Cash Loan Form -->
                @if ($client->cash_loan)
                    @php
                        // Check if a cash loan exists for the client
                        $cashLoan = $client->loans->where('loanable_type', \App\Models\CashLoan::class)->first();
                    @endphp

                    <h2 class="text-xl font-bold mt-8 mb-4">Cash Loan</h2>
                    <form action="{{ $cashLoan ? route('cash_loans.update', $cashLoan->loanable_id) : route('cash_loans.store') }}" method="POST">
                        @csrf
                        @if ($cashLoan)
                            @method('PUT') <!-- Use PUT for updates -->
                        @endif
                        <input type="hidden" name="client_id" value="{{ $client->id }}">

                        <div class="mb-4">
                            <label for="amount" class="block text-sm font-medium text-gray-700">Loan Amount</label>
                            <input type="number" name="amount" id="amount" value="{{ $cashLoan->loanable->amount ?? '' }}"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                {{ $cashLoan && $cashLoan->user_id !== Auth::id() ? 'disabled' : '' }}>
                        </div>

                        @if (!$cashLoan || $cashLoan->user_id === Auth::id())
                            <button type="submit"
                                    class="px-4 py-2 bg-green-500 text-white font-semibold rounded-md hover:bg-green-600">
                                {{ $cashLoan ? 'Update Cash Loan' : 'Add Cash Loan' }}
                            </button>
                        @endif
                    </form>
                @endif

                <!-- Home Loan Form -->
                @if ($client->home_loan)
                    @php
                        // Check if a home loan exists for the client
                        $homeLoan = $client->loans->where('loanable_type', \App\Models\HomeLoan::class)->first();
                    @endphp

                    <h2 class="text-xl font-bold mt-8 mb-4">Home Loan</h2>
                    <form action="{{ $homeLoan ? route('home_loans.update', $homeLoan->loanable_id) : route('home_loans.store') }}" method="POST">
                        @csrf
                        @if ($homeLoan)
                            @method('PUT') <!-- Use PUT for updates -->
                        @endif
                        <input type="hidden" name="client_id" value="{{ $client->id }}">

                        <div class="mb-4">
                            <label for="property_value" class="block text-sm font-medium text-gray-700">Property Value</label>
                            <input type="number" name="property_value" id="property_value" value="{{ $homeLoan->loanable->property_value ?? '' }}"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                {{ $homeLoan && $homeLoan->user_id !== Auth::id() ? 'disabled' : '' }}>
                        </div>
                        <div class="mb-4">
                            <label for="down_payment" class="block text-sm font-medium text-gray-700">Down Payment</label>
                            <input type="number" name="down_payment" id="down_payment" value="{{ $homeLoan->loanable->down_payment ?? '' }}"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                {{ $homeLoan && $homeLoan->user_id !== Auth::id() ? 'disabled' : '' }}>
                        </div>

                        @if (!$homeLoan || $homeLoan->user_id === Auth::id())
                            <button type="submit"
                                    class="px-4 py-2 bg-green-500 text-white font-semibold rounded-md hover:bg-green-600">
                                {{ $homeLoan ? 'Update Home Loan' : 'Add Home Loan' }}
                            </button>
                        @endif
                    </form>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
