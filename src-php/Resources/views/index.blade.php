<div>
    @foreach($events as $event)
        <div>
            <h2>{{ $event->title }}</h2>
            <h3>Info</h3>
            <p>{{ $event->long_desc ?? $event->short_desc ?? 'No description.' }}</p>
            <div>
                <h3>When?</h3>
                <p>From: {{ $event->start_date->format('d/m/Y') }}</p>
                <p>To: {{ $event->end_date->format('d/m/Y') }}</p>
            </div>
            <div>
                <h3>Where?</h3>
                <p>{{ $event->location->title }}</p>
            </div>
        </div>

    @endforeach
</div>