{{-- now the layouts app file is being extended
here --}}
{{-- these syntaxes are known as blade directives --}}
@extends('layouts.app')

{{-- this will like the margin. if I put any
content inside this section then this 
content will have the layout --}}
@section('content')
    <div class="flex justify-center">
        <div class="w-8/12 bg-white p-6 rounded-lg">
            @auth
                <form action="{{ route('posts') }}" method="post" class="mb-4">
                        @csrf
                        <div class="mb-4">
                            <label for="body" class="sr-only">Body</label>
                            <textarea name="body" id="body" cols="30" rows="4" class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('body') border-red-500 @enderror" placeholder="Post Something!"></textarea>

                            @error('body')
                                <div class="text-red-500 mt-2 text-sm">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div>
                            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded font-medium">Post</button>
                        </div>
                </form>
           @endauth

           @if ($posts->count())
            @foreach ($posts as $post)
                {{-- this is sort of like sending a 
                props --}}
                {{-- just sending the post value whihc 
                is required the blade component --}}
                <x-post :post=$post/>
            @endforeach
            

            {{ $posts->links() }}
           @else
            <p>There are no posts</p>
           @endif
        </div>
    </div>
@endsection