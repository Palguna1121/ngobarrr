<h1>Post All data :</h1>

@if (session()->has('success'))
    <p>{{ session('success') }}</p>
@elseif (session()->has('error'))
    <p>{{ session('error') }}</p>
@endif

@foreach ($posts as $post)
    <p>{{ $post->title }}</p>
    <p>{{ $post->description }}</p>
    <p>{{ $post->category }}</p>
@endforeach
