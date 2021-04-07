@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit Author</div>
                <div class="card-body">
                    <form method="POST" action="{{route('author.update', $author)}}" enctype="multipart/form-data">
                        <div class="form-group">
                            <label>Name:</label>
                            <input type="text" class="form-control" name="author_name" value="{{old('author_name', $author->name)}}">
                            <small class="form-text text-muted">Please enter author name</small>
                        </div>

                        <div class="form-group">
                            <label>Surname:</label>
                            <input type="text" class="form-control" name="author_surname" value="{{old('author_surname', $author->surname)}}">
                            <small class="form-text text-muted">Please enter author surname</small>
                        </div>

                        <div class="form-group">
                            <label style="display:block;">Portrait:</label>
                            <span style="padding:5px; margin:5px; dislpay:inline-block;">
                                <img style="width:100px; height:150px;" src="{{$author->portret}}" onerror="this.src='{{asset('img/default-img.png')}}'">
                            </span>
                            <input type="file" class="form-control" name="author_portret">
                            <small class="form-text text-muted">Please upload author portrait</small>
                        </div>
                        @csrf
                        <button type="submit" class="btn btn-primary">EDIT</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    window.addEventListener('DOMContentLoaded', (event) => {
        $('#summernote').summernote();
    });

</script>
@endsection
