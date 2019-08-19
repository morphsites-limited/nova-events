<h1>{{ $category->title }}</h1>

<div>
    <ul>
        @foreach ($category->events as $event)
            <li>{{ $event->title }}</li>
        @endforeach
    </ul>
</div>