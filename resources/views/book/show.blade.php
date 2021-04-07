@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Book {{$book->title}}</div>
                <div class="card-body">
                    {!!$book->about!!}
                    <a href="{{route('book.edit',[$book])}}" class="btn btn-info">BOOK EDIT</a>
                    <a href="{{route('author.edit',[$book->bookAuthor])}}" class="btn btn-info">AUTHOR EDIT</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
