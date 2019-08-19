<h1>{{ $category->title }}</h1>

<div>
    @foreach ($category->events as $event)
        <a href="{{ route('events.show', [$event->primaryCategory, $event]) }}">
            <h2>{{ $event->title }}</h2>
        </a>
    @endforeach
</div>