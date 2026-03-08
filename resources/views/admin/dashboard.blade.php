@extends('layouts.app')

@section('title', 'Admin Panel')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold mb-8 text-gray-800">Admin Panel</h1>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Products Card -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-md transition-shadow">
                <div class="p-6">
                    <div class="flex items-center gap-4 mb-4">
                        <div class="w-12 h-12 bg-indigo-100 rounded-lg flex items-center justify-center text-indigo-600">
                            <i class="fas fa-box text-xl"></i>
                        </div>
                        <h2 class="text-xl font-bold text-gray-800">Manage Products</h2>
                    </div>
                    <p class="text-gray-600 mb-6">Create, edit, and remove products from the catalog. Control stock levels and pricing.</p>
                    <a href="{{ route('admin.products') }}" class="inline-flex items-center text-indigo-600 font-semibold hover:text-indigo-800">
                        View Products <i class="fas fa-arrow-right ml-2 text-sm"></i>
                    </a>
                </div>
            </div>

            <!-- Contacts Card -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-md transition-shadow">
                <div class="p-6">
                    <div class="flex items-center gap-4 mb-4">
                        <div class="w-12 h-12 bg-emerald-100 rounded-lg flex items-center justify-center text-emerald-600">
                            <i class="fas fa-envelope text-xl"></i>
                        </div>
                        <h2 class="text-xl font-bold text-gray-800">Contact Messages</h2>
                    </div>
                    <p class="text-gray-600 mb-6">Read messages and inquiries submitted by visitors through the contact form.</p>
                    <a href="{{ route('admin.contacts') }}" class="inline-flex items-center text-emerald-600 font-semibold hover:text-emerald-800">
                        View Messages <i class="fas fa-arrow-right ml-2 text-sm"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
