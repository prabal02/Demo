@extends('auth.layouts')

@section('content')

<div class="row justify-content-center mt-5">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">Dashboard</div>
            <div class="card-body">
                @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        {{ $message }}
                    </div>
                @else
                    <div class="alert alert-success">
                        You are logged in!
                    </div>   
                      
                @endif                
            </div>
            <a href="{{ route('create') }}" role="button" class="btn btn-secondary btn-lg btn-block">Create Post</a>
        
        </div>
    </div>    
</div>
    
@endsection