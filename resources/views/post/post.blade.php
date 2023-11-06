@extends('auth.layouts')

@section('content')

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<div class="row justify-content-center mt-5">

    <div class="col-md-8">
        <div class="card">
            <div class="card-header">Posts</div>
            <div class="card-body">
            <button type="button" role="button" class="col-md-12 btn btn-secondary btn-lg btn-block" data-toggle="modal" data-target="#myModal">Add Post</button>
            </div>
         
        </div>
        <div class="col-md-12">
        <table  id="postTable" class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">Title</th>
      <th scope="col">Content</th>
      <th scope="col">Author</th>
    </tr>
  </thead>
  <tbody>
   
  @foreach($posts as $post)
    <tr>
      <td>{{$post['title']}}</td>
      <td>{{$post['content']}}</td>
      <td>{{$post['user']['name']}}</td>
      
    </tr>
    @endforeach
  </tbody>
</table>
</div>

</div>    
</div>
    <!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
       
        <h4 class="modal-title">Create Post</h4>
      </div>
      <div class="modal-body">
      <form action="{{ route('storePost') }}" method="post">
                    @csrf
                    <div class="mb-3 row">
                        <label for="title" class="col-md-4 col-form-label text-md-end text-start">Title</label>
                        <div class="col-md-6">
                          <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title') }}">
                            @if ($errors->has('title'))
                                <span class="text-danger">{{ $errors->first('title') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="content" class="col-md-4 col-form-label text-md-end text-start">content</label>
                        <div class="col-md-6">
                          <input type="text"maxlength = "100" class="form-control @error('content') is-invalid @enderror" id="content" name="content">
                            @if ($errors->has('content'))
                                <span class="text-danger">{{ $errors->first('content') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <input type="submit" class="col-md-3 offset-md-5 btn btn-primary">
                    </div>
                    
                </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

  <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script>
  
<script>
    new DataTable('#postTable');
</script>
@endsection