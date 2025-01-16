<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Reports') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-6 bg-white rounded shadow">
                <h1 class="text-2xl font-bold mb-4">Loan Report</h1>

                <table class="min-w-full bg-white border border-gray-300">
                    <thead>
                    <tr>
                        <th class="py-2 px-4 border-b text-left">Product Type</th>
                        <th class="py-2 px-4 border-b text-left">Product Value</th>
                        <th class="py-2 px-4 border-b text-left">Creation Date</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse ($loans as $loan)
                        <tr>
                            <td class="py-2 px-4 border-b text-left">
                                {{ class_basename($loan->loanable_type) === 'CashLoan' ? 'Cash Loan' : 'Home Loan' }}
                            </td>

                            <td class="py-2 px-4 border-b text-left">
                                @if (class_basename($loan->loanable_type) === 'CashLoan')
                                    {{ $loan->loanable->amount ?? 'N/A' }}
                                @else
                                    {{ $loan->loanable->property_value ?? 'N/A' }} - {{ $loan->loanable->down_payment ?? 'N/A' }}
                                @endif
                            </td>

                            <td class="py-2 px-4 border-b text-left">
                                {{ $loan->created_at->format('Y-m-d H:i:s') }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="py-2 px-4 text-center border-b">
                                No loans found.
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
