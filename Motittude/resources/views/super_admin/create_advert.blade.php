<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Advert</title>
</head>
<body>
    <div class="media-gallery" style="display: flex; flex-wrap: wrap; gap: 20px;">
    @foreach ($media as $item)
        <div class="media-item" style="width: 300px;">
            <h4>{{ $item->title }}</h4>

            @if ($item->type === 'image')
                <img src="{{ asset('storage/' . $item->file_path) }}" alt="Ad/Event Image" style="width: 100%; border-radius: 8px;">
            @elseif ($item->type === 'video')
                <video controls style="width: 100%; border-radius: 8px;">
                    <source src="{{ asset('storage/' . $item->file_path) }}" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
            @endif

            <p style="font-size: 0.9em; color: gray;">Posted: {{ $item->created_at->diffForHumans() }}</p>
        </div>
    @endforeach
</div>

</body>
</html>