@extends('layouts.app')

@section('title', 'Contact Messages')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-gray-800">Contact Messages</h1>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-50 border-b border-gray-200">
                            <th class="p-4 font-semibold text-gray-600 w-1/4">Name & Email</th>
                            <th class="p-4 font-semibold text-gray-600 w-1/4">Subject & Date</th>
                            <th class="p-4 font-semibold text-gray-600 w-2/4">Message</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($contacts as $contact)
                            <tr class="border-b border-gray-100 hover:bg-gray-50">
                                <td class="p-4 align-top">
                                    <div class="font-medium text-gray-800">{{ $contact->first_name }} {{ $contact->last_name }}</div>
                                    <div class="text-sm text-gray-500 mt-1">
                                        <a href="mailto:{{ $contact->email }}" class="hover:text-indigo-600">{{ $contact->email }}</a>
                                    </div>
                                    @if($contact->phone)
                                        <div class="text-sm text-gray-500">{{ $contact->phone }}</div>
                                    @endif
                                </td>
                                <td class="p-4 align-top">
                                    <div class="font-medium text-gray-800">{{ $contact->subject }}</div>
                                    <div class="text-sm text-gray-500 mt-1" title="{{ $contact->created_at }}">
                                        {{ $contact->created_at->diffForHumans() }}
                                    </div>
                                </td>
                                <td class="p-4 align-top">
                                    <div class="text-gray-700 whitespace-pre-line text-sm bg-gray-50 p-3 rounded-lg border border-gray-100">
                                        {{ $contact->message }}
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="p-8 text-center text-gray-500">
                                    No contact messages yet.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>
@endsection
