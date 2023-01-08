@extends('master')

@section('content')
    <div class="container">
        <div class="row mt-5">
            <div class="col-6 offset-3">
                <div class="my-3">
                    <a href="{{ route('post#UpdatePage', $post['id']) }}" class="text-decoration-none text-black">
                        <i class="fa-solid fa-arrow-left"></i> Back
                    </a>
                </div>

                <form action="{{ route('post#update') }}" method="post">
                    @csrf
                    <label for=""> {{ $post['title'] }}</label>

                    <input type="hidden" name="postId" value="{{ $post['id'] }}">


                    <input class="form-control my-3" type="text" name="updateName" id=""
                        value="{{ old('postTitle', $post['title']) }}" placeholder="Enter post title">
                    <label for="">Post Description</label>
                    <textarea class="form-control my-3" name="updateDescription" id="" cols="30" rows="10"
                        placeholder="Enter post description">
                        {{ old('postDescription', $post['description']) }}
                    </textarea>

                    <input type="submit" value="Update" class="btn bg-dark text-white my-3 float-end">
                </form>

            </div>
        </div>

    </div>
@endsection
