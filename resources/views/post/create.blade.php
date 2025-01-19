{{-- halaman create data post --}}
<h1>Create Post</h1>

<form action="{{ route('post.store') }}" method="post">
    @csrf

    <label for="title">Title</label>
    <input type="text" name="title" id="title">
    @if ($errors->has('title'))
        <p>{{ $errors->first('title') }}</p>
    @endif

    <label for="description">Description</label>
    <input type="text" name="description" id="description">
    @if ($errors->has('description'))
        <p>{{ $errors->first('description') }}</p>
    @endif

    <label for="category">Category</label>
    <input type="text" name="category" id="category">
    @if ($errors->has('category'))  
        <p>{{ $errors->first('category') }}</p>
    @endif

    <button type="submit">Create</button>
</form>
