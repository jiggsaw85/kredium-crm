<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add New Client') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-6 bg-white rounded shadow">

                <!-- Error Messages -->
                @if ($errors->any())
                    <div class="p-4 mb-4 text-red-700 bg-red-100 rounded">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <h1 class="text-2xl font-bold mb-4">Add New Client</h1>

                <!-- Add Client Form -->
                <form action="{{ route('clients.store') }}" method="POST">
                    @csrf

                    <div class="mb-4">
                        <label for="first_name" class="block text-sm font-medium text-gray-700">First Name</label>
                        <input type="text" name="first_name" id="first_name" value="{{ old('first_name') }}"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    </div>

                    <div class="mb-4">
                        <label for="last_name" class="block text-sm font-medium text-gray-700">Last Name</label>
                        <input type="text" name="last_name" id="last_name" value="{{ old('last_name') }}"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    </div>

                    <div class="mb-4">
                        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                        <input type="email" name="email" id="email" value="{{ old('email') }}"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    </div>

                    <div class="mb-4">
                        <label for="phone" class="block text-sm font-medium text-gray-700">Phone</label>
                        <input type="text" name="phone" id="phone" value="{{ old('phone') }}"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    </div>

                    <div class="mb-4">
                        <label for="cash_loan" class="block text-sm font-medium text-gray-700">Cash Loan</label>
                        <select name="cash_loan" id="cash_loan"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            <option value="0" {{ old('cash_loan') == '0' ? 'selected' : '' }}>No</option>
                            <option value="1" {{ old('cash_loan') == '1' ? 'selected' : '' }}>Yes</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label for="home_loan" class="block text-sm font-medium text-gray-700">Home Loan</label>
                        <select name="home_loan" id="home_loan"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            <option value="0" {{ old('home_loan') == '0' ? 'selected' : '' }}>No</option>
                            <option value="1" {{ old('home_loan') == '1' ? 'selected' : '' }}>Yes</option>
                        </select>
                    </div>

                    <div>
                        <button type="submit"
                                class="px-4 py-2 bg-primary text-white font-semibold rounded-md hover:bg-green-600">
                            Save Client
                        </button>
                        <a href="{{ route('clients.index') }}"
                           class="px-4 py-2 bg-gray-300 text-black font-semibold rounded-md hover:bg-gray-400 ml-2">
                            Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
