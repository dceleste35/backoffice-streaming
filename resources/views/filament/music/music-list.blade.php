<div class="bg-blue-500">
    @foreach ($playlist->music as $music)
        <div>
            <img src="{{ $music->image_url }}" class="h-24 w-24" />
            <h3 class="text-red-600">{{ $music->title }}</h3>
            <p>{{ $music->artists->first() }}</p>
        </div>
    @endforeach
</div>
