@extends('layouts.app')

@section('title','Edit Category')
    
@section('content')

    <form action="{{ route('categories.update',$category->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name" >Name</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" placeholder="" value="{{ $category->name }}">
            @error('name')
                <small id="helpId" class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="form-group">
        <label for="description">Description</label>
            <textarea name="description" class="form-control @error('name') is-invalid @enderror" placeholder="" aria-describedby="helpId" value="{{ $category->description }}" rows="3">{{ $category->description }}</textarea>
            @error('description')
            <small id="helpId" class="text-danger">{{ $message }}</small>
        @enderror  
        </div>
        
        
        <div class="form-group">
        <label for="">Parent Category</label>
        <select class="form-control @error('category_id') is-invalid @enderror" name="category_id" id="">
            <option value="">None</option>
            @foreach ($parentCategories as $parentCategory)
                <option value="{{ $parentCategory->id }}" @if ($parentCategory->id == $category->category_id) selected @endif>{{ $parentCategory->name }}</option>
            @endforeach
     
        </select>
            @error('category_id')
                <small id="helpId" class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="form-group">
                <button type="submit" class="btn btn-primary" style="width: 100%">Submit</button>
        </div>
    </form>
   
@endsection