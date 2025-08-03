<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-7">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 rounded-lg shadow-md">
                <div class="flex flex-col md:flex-row items-start gap-10">

                    <x-follow-ctr :user="$user">
                        <img src="{{ $user->imageUrl() ?? 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT0QRYY0NF-L2T_4vLoz6tzwRulvR9gQbHdnA&s' }}"
                            alt="{{ $user->username }}"
                            class="w-32 h-32 object-cover rounded-full border-4 border-gray-200 shadow-md mx-auto md:mx-0">
                        <h3 class="mt-4 text-2xl font-semibold">{{ $user->name }}</h3>
                        <p class="text-gray-500 mt-1"> <span x-text="followersCount"></span> followers</p>
                        <p class="text-gray-500 mt-1">{{$user->following->count() }} following</p>
                        <p class="text-gray-600 mt-2">{{ $user->bio }}</p>

                        @if(Auth::user() && Auth::user()->id !== $user->id)
                            <button @click="follow()" x-text="following ? 'Unfollow' : 'Follow'"
                                :class="following ? 'bg-red-600' : 'bg-emerald-600'"
                                class="text-sm px-4 py-2 text-white rounded-full transition">
                            </button>
                        @endif
                    </x-follow-ctr>
                </div>

                <div class="w-full md:w-4/3 flex">
                    @forelse ($posts as $post)
                        <div class="border p-5 rounded-md shadow-sm mb-4">
                            <h3 class="text-xl text-center font-semibold text-gray-800 mb-3">{{ $post->title }}</h3>
                            <img src="{{$post->imageUrl()}}"
                                class="w-full h-85 object-cover border-gray-300 shadow-sm mb-3 cursor-pointer">
                            <p class="text-gray-600 mt-1 leadin-relaxed text-center">
                                {{ Str::limit($post->content, 100) }}
                            </p>

                        </div>
                    @empty
                        <div class="text-center text-gray-400 py-16">
                            No Posts Found
                        </div>
                    @endforelse

                    <div class="mt-6">
                        {{ $posts->links() }}
                    </div>
                </div>

            </div>
        </div>
    </div>
    </div>
</x-app-layout>