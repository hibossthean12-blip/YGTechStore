@extends('layouts.app')

@section('title', 'Add New Product')

@section('styles')
<style>
    .page-header { background: #fff; border-bottom: 1px solid #edf2f7; padding: 28px 0; }
    .page-title { font-size: 1.8rem; font-weight: 800; color: #1a1a2e; letter-spacing: -.5px; margin-bottom: 8px; }
    .breadcrumb { display: flex; align-items: center; gap: 8px; font-size: .825rem; color: #6b7280; }
    .breadcrumb a { color: #6c3fff; }
    .breadcrumb a:hover { text-decoration: underline; }
    
    .form-container { max-width: 800px; margin: 40px auto; background: #fff; border: 1px solid #edf2f7; border-radius: 16px; padding: 32px; box-shadow: 0 4px 12px rgba(0,0,0,.02); }
    .form-title { font-size: 1.25rem; font-weight: 700; color: #1a1a2e; margin-bottom: 24px; padding-bottom: 16px; border-bottom: 1px solid #edf2f7; }
    
    .form-group { margin-bottom: 20px; }
    .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }
    @media(max-width: 640px) { .form-row { grid-template-columns: 1fr; } }
    
    .form-label { display: block; font-size: .875rem; font-weight: 600; color: #374151; margin-bottom: 8px; }
    .form-label .required { color: #ef4444; }
    
    .form-input { width: 100%; padding: 12px 14px; border: 1.5px solid #e2e8f0; border-radius: 10px; font-size: .875rem; color: #1a1a2e; background: #fff; outline: none; transition: all .2s; }
    .form-input:focus { border-color: #6c3fff; box-shadow: 0 0 0 3px rgba(108,63,255,.1); }
    select.form-input { appearance: none; background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%236b7280'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M19 9l-7 7-7-7'%3E%3C/path%3E%3C/svg%3E"); background-repeat: no-repeat; background-position: right 12px center; background-size: 16px; padding-right: 40px; }
    textarea.form-input { resize: vertical; min-height: 120px; line-height: 1.5; }
    
    .form-file { padding: 10px; border: 1.5px dashed #cbd5e1; background: #f8fafc; text-align: center; cursor: pointer; }
    .form-file:hover { border-color: #6c3fff; background: #f0ecff; }
    
    .form-checkbox { display: flex; align-items: center; gap: 8px; cursor: pointer; }
    .form-checkbox input { width: 18px; height: 18px; border-radius: 4px; accent-color: #6c3fff; cursor: pointer; }
    .form-checkbox label { font-size: .875rem; color: #4a5568; cursor: pointer; user-select: none; }
    
    .btn-submit { width: 100%; padding: 14px; background: #1a1a2e; color: #fff; border-radius: 10px; font-size: 1rem; font-weight: 700; display: inline-flex; align-items: center; justify-content: center; gap: 8px; transition: all .2s; border: none; cursor: pointer; margin-top: 12px; }
    .btn-submit:hover { background: #6c3fff; transform: translateY(-1px); box-shadow: 0 6px 20px rgba(108,63,255,.3); }
    
    .error-msg { color: #ef4444; font-size: .775rem; margin-top: 6px; display: block; }
</style>
@endsection

@section('content')

<div class="page-header">
    <div class="container">
        <h1 class="page-title">Add New Product</h1>
        <nav class="breadcrumb">
            <a href="{{ route('home') }}">Home</a>
            <span>/</span>
            <a href="{{ route('products.index') }}">Products</a>
            <span>/</span>
            <span style="color:#1a1a2e;">Add New</span>
        </nav>
    </div>
</div>

<div class="container">
    <div class="form-container">
        <h2 class="form-title"><i class="fas fa-box-open" style="color:#6c3fff;margin-right:8px;"></i> Product Details</h2>
        
        <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="form-row">
                <div class="form-group">
                    <label class="form-label" for="name">Product Name <span class="required">*</span></label>
                    <input type="text" id="name" name="name" class="form-input" value="{{ old('name') }}" placeholder="e.g. Wireless Noise Cancelling Headphones" required>
                    @error('name')<span class="error-msg">{{ $message }}</span>@enderror
                </div>
                
                <div class="form-group">
                    <label class="form-label" for="category_id">Category <span class="required">*</span></label>
                    <select id="category_id" name="category_id" class="form-input" required>
                        <option value="" disabled selected>Select a category</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id')<span class="error-msg">{{ $message }}</span>@enderror
                </div>
            </div>
            
            <div class="form-group">
                <label class="form-label" for="description">Description <span class="required">*</span></label>
                <textarea id="description" name="description" class="form-input" placeholder="Detailed product description..." required>{{ old('description') }}</textarea>
                @error('description')<span class="error-msg">{{ $message }}</span>@enderror
            </div>
            
            <div class="form-row">
                <div class="form-group">
                    <label class="form-label" for="price">Price ($) <span class="required">*</span></label>
                    <input type="number" step="0.01" min="0" id="price" name="price" class="form-input" value="{{ old('price') }}" placeholder="0.00" required>
                    @error('price')<span class="error-msg">{{ $message }}</span>@enderror
                </div>
                
                <div class="form-group">
                    <label class="form-label" for="stock">Stock Quantity <span class="required">*</span></label>
                    <input type="number" min="0" id="stock" name="stock" class="form-input" value="{{ old('stock', 0) }}" required>
                    @error('stock')<span class="error-msg">{{ $message }}</span>@enderror
                </div>
            </div>
            
            <div class="form-group">
                <label class="form-label" for="image">Product Image <span style="font-size:0.75rem;color:#6b7280;font-weight:normal;">(JPG, PNG. Max 2MB)</span></label>
                <input type="file" id="image" name="image" class="form-input form-file" accept="image/jpeg,image/png,image/gif">
                @error('image')<span class="error-msg">{{ $message }}</span>@enderror
            </div>
            
            <div class="form-group">
                <label class="form-checkbox">
                    <input type="checkbox" name="is_featured" value="1" {{ old('is_featured') ? 'checked' : '' }}>
                    <span style="font-weight:600;">Feature this product</span> (Displays on the homepage)
                </label>
                @error('is_featured')<span class="error-msg">{{ $message }}</span>@enderror
            </div>
            
            <button type="submit" class="btn-submit">
                <i class="fas fa-plus-circle"></i> Create Product
            </button>
        </form>
    </div>
</div>

@endsection
