<div>
    <h3>Event Categories</h3>
    <ul>
        @foreach ($categories as $cat)
            <a href="{{ route('events.list', [$cat]) }}">{{ $cat->title }}</a>
        @endforeach
    </ul>
</div>