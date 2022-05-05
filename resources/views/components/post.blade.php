@props(['post' => $post])

<div class="mb-4">
    {{-- $post->created us gives us a carbon instance --}}
    {{-- carbon is a third party date manipulation object --}}
    <a href="{{ route('users.posts', $post->user) }}" class="font-bold">{{ $post->user->name }}</a> <span class="text-gray-600 text-sm">{{ $post->created_at->diffForHUmans() }}</span>

    <p class="mb-2">{{ $post->body }}</p>
    {{-- @if ($post->ownedBy(auth()->user())) --}}
    @can('delete', $post)
        <form action="{{ route('posts.destroy', $post) }}" method="post">
            @csrf
            @method('DELETE')
            <button type="submit" class="text-blue-500">Delete</button>
        </form>
    @endcan

    {{-- @endif --}}

    <div class="flex items-center">
        @auth
            @if (!$post->likedBy(auth()->user()))
                <form action="{{ route('posts.likes', $post) }}" method="post" class="mr-1">
                    @csrf
                    <button type="submit" class="text-blue-500">Like</button>
                </form>
            @else
                <form action="{{ route('posts.likes', $post) }}" method="post" class="mr-1">
                    @csrf
                    {{-- it's method spoofing --}}
                    @method('DELETE')
                    <button type="submit" class="text-blue-500">Unlike</button>
                </form>
            @endif

            

        @endauth
        {{-- this str plural will be used to get plural when count is more --}}
        <span>{{ $post->likes->count() }} 
            {{ Str::plural('like', $post->likes->count()) }}
        </span>
    </div>
</div>