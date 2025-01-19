<h1>Halaman show data post</h1>
<br>
<a href="{{ route('post.index') }}">Kembali</a>
<br>
<h2>{{ $post->title }}</h2>
<p>{{ $post->description }}</p>
<p>{{ $post->category }}</p>
