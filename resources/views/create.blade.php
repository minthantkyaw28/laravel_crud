@extends('master')

@section('content')
    <div class="container">
        <div class="row mt-5">

            <div class="col-5">
                <div class="p-4">

                    @if (session('insertSuccess'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>{{ session('insertSuccess') }}</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @if (session('updateSuccess'))
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <strong>{{ session('updateSuccess') }}</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif


                    <form action="{{ route('post#create') }}" method="POST">

                        @csrf

                        <div class="text-group mb-3">
                            <label for="">Post Title</label>
                            <input name="postTitle" type="text"
                                class="form-control @error('postTitle')
                                is-invalid
                            @enderror"
                                value="{{ old('postTitle') }}" placeholder="Enter Post Title">
                            @error('postTitle')
                                {{-- <small class="text-danger">You Donkey</small> --}}
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>

                        <div class="text-group mb-3">
                            <label for="">Post Description</label>
                            <textarea name="postDescription" cols="30" rows="10"
                                class="form-control @error('postTitle')
                                is-invalid
                            @enderror"
                                value="{{ old('postDescription') }}" placeholder="Enter Post Description"></textarea>
                            @error('postDescription')
                                {{-- <small class="text-danger">You Donkey</small> --}}
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>

                        <div class="mb-3">
                            <input type="submit" value="Create" class="btn btn-danger">
                        </div>

                    </form>
                </div>
            </div>

            <div class="col-7">
                <h3 class="mb-3">
                    Total - {{ $posts->total() }}
                </h3>
                <div class="data-container">

                    @foreach ($posts as $item)
                        <div class="post p-3 shadow mb-3">
                            <h5>{{ $item['title'] }}</h5>
                            <br>
                            <p>{{ $item['created_at'] }} | {{ $item['id'] }}</p>
                            <br>
                            <p class="text-muted">{{ Str::words($item['description'], 50, '...') }}
                            </p>
                            <div class="text-end">

                                <a href="{{ route('post#UpdatePage', $item['id']) }}">
                                    <button class="btn btn-sm btn-success"><i
                                            class="fa-solid fa-circle-info">Detail</i></button>
                                </a>

                                {{-- <a href="{{ route('post#delete', $item['id']) }}">
                                    <button class="btn btn-sm btn-danger"><i class="fa-solid fa-trash">Delete</i></button>
                                </a> --}}

                                <form action="{{ route('post#delete', $item['id']) }}" method="POST">
                                    @csrf
                                    @method('delete')
                                    <button class="btn btn-sm btn-danger"><i class="fa-solid fa-trash">Delete</i></button>
                                </form>
                            </div>
                        </div>
                    @endforeach

                </div>
                {{ $posts->links() }}
            </div>

        </div>
    </div>
@endsection
