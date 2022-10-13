@extends('layouts.app')

@section('title','Edit the Article')

@push('links')
    <link rel="stylesheet" href="{{ asset('/css/summernote.min.css') }}">    
@endpush

@section('content')
    <form action="{{ route('articles.update',$article->id) }}" enctype="multipart/form-data" method="POST">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-8">
                <div class="form-group">
                    <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" id="inputName" placeholder="Title" value="{{ $article->title }}">
                    @error('title')
                        <small id="helpId" class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <textarea id="summernote" name="body" class="@error('body') is-invalid @enderror">
                        {{ $article->body }}
                      </textarea>
                    @error('body')
                      <small id="helpId" class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>
            <div class="col-4">
                <div class="card border-primary">
                  <img class="card-img-top" src="holder.js/100px180/" alt="">
                  <div class="card-body">
                    <h4 class="card-title">Categories</h4>
                    <p class="card-text">
                        @foreach ($categories as $category)
                            <div class="form-check">
                                <label class="form-check-label">
                                    
                                    <input type="checkbox" class="form-check-input " name="category_id[]" id="" value="{{ $category->id}}" @if (in_array($category->id,$cate,TRUE))
                                        checked
                                    @endif >
                                    {{ $category->name }}
                                </label>
                            </div>
                        @endforeach
                        @error('category_id')
                            <small id="helpId" class="text-danger">{{ $message }}</small>
                        @enderror
                    </p>
                  </div>
                </div>
                <div class="card border-primary">
                    @if ($article->image)
                        <img  src="{{ url('/storage/articles/'.auth()->user()->id.'/'.$article->image) }}" class="rounded d-block" alt="" >
                    @endif
                    <div class="card-body">
                      <h4 class="card-title">Feature Image</h4>
                      <p class="card-text">
                        <div class="form-group">
                          <input type="file" class="form-control-file" name="image" id="" placeholder="" aria-describedby="fileHelpId">
                            @error('image')
                                <small id="helpId" class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                      </p>
                    </div>
                  </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
        
    </form>
@endsection


@push('scripts')
    <script src="{{ asset('js/summernote-bs4.min.js') }}"></script>

    <script>
        $(function () {
            $('#summernote').summernote({
                height: 200
            });
        });
    </script>
@endpush