@extends('layouts.app')
@section('content')
    <link rel="stylesheet" href="{{ asset('css/gallery.css') }}">
    <div class="gallery">
        @foreach ($product->media as $media)
            @foreach (json_decode($media->list_media, true) as $mediaItem)
                <img src="{{ asset($mediaItem) }}" alt="a house on a mountain">
            @endforeach
        @endforeach
    </div>
@endsection
