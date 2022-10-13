@extends('layouts.app')

@section('title','Edit Role')
    
@section('content')
<form action="{{ route('roles.update',$role->id) }}" method="post">
    @csrf
    @method('PUT')
    <div class="row m-2">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <label for="">Name</label>
                <input type="text"
                class="form-control" name="name" id="" aria-describedby="helpId" placeholder="Role Name" value="{{ $role->name }}">
                @error('name')
                    <small id="helpId" class="form-text text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Permission:</strong>
                <br/>
                @foreach($permission as $value)
                    <div class="form-check">
                      <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" name="permission[]" id="" value="{{$value->name}}" {{ in_array($value->id, $rolePermissions) ? 'checked': ''}}>
                       {{ $value->name }}
                      </label>
                    </div>
                <br/>
                @endforeach
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </div>
</form>

@endsection