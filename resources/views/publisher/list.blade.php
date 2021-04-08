{{-- <ul class="list-group">
    @foreach ($publishers as $publisher)
    <li class="list-group-item list-line">
        <div>
            {{$publisher->title}}
        </div>
        <div class="list-line__buttons">
            <a href="{{route('publisher.edit',[$publisher])}}" class="btn btn-info">EDIT</a>
            <form method="POST" action="{{route('publisher.destroy', [$publisher])}}" data-delete class="pub-delete">
                @csrf
                <button type="submit" class="btn btn-danger">DELETE</button>
            </form>
        </div>
    </li>
    <br>
    @endforeach
</ul> --}}