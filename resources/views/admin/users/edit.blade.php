@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit User {{ $user->name }}</div>

                <div class="card-body">
                    
                <form action="{{ route('users.update', $user) }}" method="POST">
                    {{ method_field('PUT') }}
                    @csrf
                    @foreach ($roles as $role)
                        

                        <div class="form-check">
                            <input class="form-check-input" name="roles[]" type="checkbox" value="{{ $role->id }}" >
                            <label class="form-check-label">
                                {{ $role->name }}
                            </label>
                          </div>

                    @endforeach
                        <button type="submit" class="btn btn-primary">Update</button>
                </form>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection