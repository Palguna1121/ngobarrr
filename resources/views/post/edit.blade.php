{{-- halaman edit data post --}}
<h1>Edit Post</h1>

@if (session()->has('sukses'))
    <p>{{ session('sukses') }}</p>
@elseif (session()->has('error'))
    <p>{{ session('error') }}</p>
@endif

<form action="{{ route('post.update', $post->id) }}" method="post">
    @csrf
    @method('PUT')

    <label for="title">Title</label>
    <input type="text" name="title" id="title" value="{{ $post->title }}">
    @if ($errors->has('title'))
        <p>{{ $errors->first('title') }}</p>
    @endif

    <label for="description">Description</label>
    <input type="text" name="description" id="description" value="{{ $post->description }}">
    @if ($errors->has('description'))
        <p>{{ $errors->first('description') }}</p>
    @endif

    <label for="category">Category</label>
    <input type="text" name="category" id="category" value="{{ $post->category }}">
    @if ($errors->has('category'))
        <p>{{ $errors->first('category') }}</p>
    @endif

    <button type="submit">Update Data</button>
</form>
