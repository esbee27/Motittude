@extends('layouts.navbar')

@section('title', 'Video Carousel')

@section('content')
<div class="quiz_container">
    <h2>Video Carousel</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($videos->count() > 0)
        <div id="videoCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">

                @foreach($videos as $key => $video)
                    <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                        <h4 class="text-center">{{ $video->title }}</h4>
                        <div class="d-flex justify-content-center">
                            <video width="600" controls preload="metadata">
                                <source src="{{ asset('storage/' . $video->path) }}" type="video/mp4">
                                Your browser does not support the video tag.
                            </video>
                        </div>
                    </div>
                @endforeach

            </div>

            <!-- Controls -->
            <button class="carousel-control-prev" type="button" data-bs-target="#videoCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#videoCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    @else
        <p>No videos uploaded yet.</p>
    @endif
</div>

{{-- Script to handle autoplay/pause --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const carousel = document.getElementById('videoCarousel');

        // Pause all videos
        function pauseAll() {
            const videos = carousel.querySelectorAll('video');
            videos.forEach(v => {
                v.pause();
                v.currentTime = 0; // rewind to start if you want
            });
        }

        // On slide event
        carousel.addEventListener('slid.bs.carousel', function () {
            pauseAll();

            // Find active video
            const activeVideo = carousel.querySelector('.carousel-item.active video');
            if (activeVideo) {
                activeVideo.play();
            }
        });

        // Autoplay the first video on load
        const firstVideo = carousel.querySelector('.carousel-item.active video');
        if (firstVideo) {
            firstVideo.play();
        }
    });
</script>
@endsection
