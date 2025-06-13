<x-app-layout>
    <div class="bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 py-10">
            <nav class="mb-6 text-sm text-gray-500 flex items-center space-x-2">
                <a href="{{ route('dashboard') }}" class="hover:underline text-secondary">Home</a>
                <span>/</span>
                <span class="text-gray-700 font-semibold">My Feedback</span>
            </nav>

            <div class="bg-white rounded-xl shadow-sm p-6">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-bold text-gray-900">My Feedback</h2>
                    <a href="{{ route('feedback.create') }}" class="inline-flex items-center px-4 py-2 bg-[#FFC403] text-white rounded-md hover:bg-[#E6B000] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#FFC403]">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        New Feedback
                    </a>
                </div>

                @if($feedback->isEmpty())
                <div class="text-center py-12">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                    </svg>
                    <h3 class="mt-2 text-sm font-medium text-gray-900">No feedback submitted</h3>
                    <p class="mt-1 text-sm text-gray-500">Get started by submitting your first feedback.</p>
                    <div class="mt-6">
                        <a href="{{ route('feedback.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-[#FFC403] hover:bg-[#E6B000] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#FFC403]">
                            <svg class="-ml-1 mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                            </svg>
                            New Feedback
                        </a>
                    </div>
                </div>
                @else
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Subject</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($feedback as $item)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">{{ $item->subject }}</div>
                                    <div class="text-sm text-gray-500">{{ Str::limit($item->message, 50) }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                                @if($item->type === 'bug') bg-red-100 text-red-800
                                                @elseif($item->type === 'feature') bg-blue-100 text-blue-800
                                                @elseif($item->type === 'complaint') bg-yellow-100 text-yellow-800
                                                @elseif($item->type === 'suggestion') bg-green-100 text-green-800
                                                @else bg-gray-100 text-gray-800
                                                @endif">
                                        {{ ucfirst($item->type) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                                @if($item->status === 'pending') bg-yellow-100 text-yellow-800
                                                @elseif($item->status === 'in_progress') bg-blue-100 text-blue-800
                                                @elseif($item->status === 'resolved') bg-green-100 text-green-800
                                                @else bg-gray-100 text-gray-800
                                                @endif">
                                        {{ str_replace('_', ' ', ucfirst($item->status)) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $item->created_at->format('M d, Y') }}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="mt-6">
                    {{ $feedback->links() }}
                </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>