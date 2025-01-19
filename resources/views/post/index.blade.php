<h1>Post All data :</h1>

{{-- @dd($post) --}}

@if (session()->has('sukses'))
    <p>{{ session('sukses') }}</p>
@elseif (session()->has('error'))
    <p>{{ session('error') }}</p>
@endif

<a href="{{ route('post.create') }}">Tambah Postingan</a>

{{-- @dd($post) --}}

<table border="1">
    <thead>
        <tr>
            <th>Title</th>
            <th>Description</th>
            {{-- <th>Category</th> --}}
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($post as $postingan)
            <tr>
                <td>{{ $postingan->title }}</td>
                <td>{{ $postingan->description }}</td>
                {{-- <td>{{ $postingan->category }}</td> --}}
                <td>
                    <a href="{{ route('post.show', $postingan->id) }}">Detail</a>
                    <hr>
                    <a href="{{ route('post.edit', $postingan->id) }}">Edit</a>
                    <hr>
                    <form action="{{ route('post.destroy', $postingan->id) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Yakinnnn????')">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
