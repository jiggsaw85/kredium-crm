<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('View all clients') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-6 bg-white rounded shadow">
                <div class="flex items-center justify-between mb-4">
                    <h1 class="text-2xl font-bold">Clients</h1>
                    <a href="{{ route('clients.create') }}"
                       class="px-4 py-2 bg-primary text-white font-semibold rounded-md hover:bg-indigo-600">
                        ADD NEW CLIENT
                    </a>
                </div>

                @if (session('success'))
                    <div class="p-4 mb-4 text-green-700 bg-green-100 rounded">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="p-4 mb-4 text-red-700 bg-red-100 rounded">
                        {{ session('error') }}
                    </div>
                @endif

                <table class="min-w-full bg-white border border-gray-300">
                    <thead>
                    <tr>
                        <th class="py-2 px-4 border-b">First Name</th>
                        <th class="py-2 px-4 border-b">Last Name</th>
                        <th class="py-2 px-4 border-b">Email</th>
                        <th class="py-2 px-4 border-b">Phone</th>
                        <th class="py-2 px-4 border-b">Cash Loan</th>
                        <th class="py-2 px-4 border-b">Home Loan</th>
                        <th class="py-2 px-4 border-b">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($clients as $client)
                        <tr>
                            <td class="py-2 px-4 border-b text-center">{{ $client->first_name }}</td>
                            <td class="py-2 px-4 border-b text-center">{{ $client->last_name }}</td>
                            <td class="py-2 px-4 border-b text-center">{{ $client->email }}</td>
                            <td class="py-2 px-4 border-b text-center">{{ $client->phone }}</td>
                            <td class="py-2 px-4 border-b text-center">{{ $client->cash_loan ? 'Yes' : 'No' }}</td>
                            <td class="py-2 px-4 border-b text-center">{{ $client->home_loan ? 'Yes' : 'No' }}</td>
                            <td class="py-2 px-4 border-b text-center">
                                <a href="{{ route('clients.edit', $client->id) }}"
                                   class="inline-block px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">
                                    Edit
                                </a>
                                <form action="{{ route('clients.destroy', $client->id) }}" method="POST"
                                      style="display: inline-block;"
                                      onsubmit="return confirm('Are you sure you want to delete this client?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="inline-block px-4 py-2 bg-red-500 text-white rounded-md hover:bg-red-600">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
