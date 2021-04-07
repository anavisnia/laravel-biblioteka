@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit Book</div>
                <div class="card-body">
                    <form method="POST" action="{{route('book.update', $book)}}">
                        <div class="form-group">
                            <label>Title:</label>
                            <input type="text" class="form-control" name="book_title" value="{{old('book_title', $book->title)}}">
                            <small class="form-text text-muted">Please enter book title</small>
                        </div>
                        <div class="form-group">
                            <label>ISBN:</label>
                            <input type="text" class="form-control" name="book_isbn" value="{{old('book_isbn', $book->isbn)}}">
                            <small class="form-text text-muted">Please enter book ISBN</small>
                        </div>
                        <div class="form-group">
                            <label>Pages:</label>
                            <input type="text" class="form-control" name="book_pages" value="{{old('book_pages', $book->pages)}}">
                            <small class="form-text text-muted">Please enter book pages</small>
                        </div>

                        <div class="form-group">
                            <label>About:</label>
                            <textarea name="book_about" id="summernote">{{old('book_about', $book->about)}}</textarea>
                            <small class="form-text text-muted">About this book</small>
                        </div>

                        <div class="form-group">
                            <label>Author:</label>
                            <select name="author_id">
                                @foreach ($authors as $author)
                                <option value="{{$author->id}}" @if($author->id == $book->author_id) selected @endif>
                                    {{$author->name}} {{$author->surname}}
                                </option>
                                @endforeach
                            </select>
                            <small class="form-text text-muted">Please enter new author name</small>
                        </div>

                        <div class="form-group">
                            <label>Publisher:</label>
                            <select name="publisher_id">
                                @foreach ($publishers as $publisher)
                                <option value="{{$publisher->id}}" @if($publisher->id == $book->publisher_id) selected @endif>
                                    {{$publisher->title}}
                                </option>
                                @endforeach
                            </select>
                            <small class="form-text text-muted">Please enter new publisher name</small>
                        </div>

                        @csrf
                        <button type="submit" class="btn btn-primary">Edit</button>
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
