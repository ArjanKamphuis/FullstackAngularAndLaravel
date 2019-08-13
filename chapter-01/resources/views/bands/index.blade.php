@foreach ($bands as $band)
    <section>
        <h1><a href="/bands/{{ $band->id }}">Band id: {{ $band->id }}</a></h1>
        <h2>Band name: {{ $band->name }}</h2>
        <p>Band description: {{ $band->description }}</p>
    </section>
@endforeach