<x-app-layout>
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-5 lg:px-6">
            <div class="bg-white shadow-md rounded-2xl p-4 max-w-xl mx-auto">

                <h1 class="text-2xl font-extrabold text-center text-gray-800 mb-3 leading-snug">
                    {{ $post->title }}
                </h1>

                <div class="flex items-center gap-3 mb-3">
                    <img src="{{ $post->user->image ? $post->user->imageUrl() : 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT0QRYY0NF-L2T_4vLoz6tzwRulvR9gQbHdnA&s' }}"
                        alt="{{ $post->user->username }}"
                        class="w-14 h-14 rounded-full object-cover border border-gray-300 shadow-sm mb-3 cursor-pointer"
                        onclick="showImageModal(this.src)">


                    <div>

                        <x-follow-ctr :user="$post->user " class="flex items-center gap-2">
                            <a href="{{ route('profile.show', $post->user) }}"
                                class="text-lg font-semibold text-gray-800 mb-4  hover:text-green-500 transition">
                                {{ '@' . $post->user->username }}
                            </a>
                            @if(Auth::user() && Auth::user()->id !== $post->user->id)
                                <button class="mb-4" x-text="following ? 'Unfollow' : 'Follow'"
                                    :class="following ? 'text-red-600' : 'text-emerald-600'" @click="follow()">
                                </button>
                            @endif
                        </x-follow-ctr>

                        <div class="text-sm text-gray-500">
                            {{ $post->created_at->format('F j, Y') }} • {{ $post->readTime() }} min read
                        </div>
                    </div>
                </div>
                {{-- claps --}}
                @auth

                    <div x-data="{
                                hasClaped: {{ auth()->user()->hasClaped($post) ? 'true' : 'false' }},
                                count: {{ $post->claps()->count() }},
                                clap() {
                                axios.post('/clap/{{ $post->id }}')
                                    .then(response => {
                                        this.count = response.data.clapsCount;
                                        this.hasClaped = response.data.status === 'clapped';
                                    })
                                    .catch(error => {
                                        console.log(error);
                                    });
                            }

                            }" class="mb-3">
                        <button @click="clap()" :class="hasClaped ? 'text-green-600' : 'text-gray-600 hover:text-green-500'"
                            class="transition flex gap-2 items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M6.633 10.25c.806 0 1.533-.446 2.031-1.08a9.041 9.041 0 0 1 2.861-2.4c.723-.384 1.35-.956 1.653-1.715a4.498 4.498 0 0 0 .322-1.672V2.75a.75.75 0 0 1 .75-.75 2.25 2.25 0 0 1 2.25 2.25c0 1.152-.26 2.243-.723 3.218-.266.558.107 1.282.725 1.282m0 0h3.126c1.026 0 1.945.694 2.054 1.715.045.422.068.85.068 1.285a11.95 11.95 0 0 1-2.649 7.521c-.388.482-.987.729-1.605.729H13.48c-.483 0-.964-.078-1.423-.23l-3.114-1.04a4.501 4.501 0 0 0-1.423-.23H5.904m10.598-9.75H14.25M5.904 18.5c.083.205.173.405.27.602.197.4-.078.898-.523.898h-.908c-.889 0-1.713-.518-1.972-1.368a12 12 0 0 1-.521-3.507c0-1.553.295-3.036.831-4.398C3.387 9.953 4.167 9.5 5 9.5h1.053c.472 0 .745.556.5.96a8.958 8.958 0 0 0-1.302 4.665c0 1.194.232 2.333.654 3.375Z" />
                            </svg>
                            <span x-text="count"></span>
                        </button>
                    </div>

                @endauth

                <div class="mb-3">
                    <img src="{{ $post->imageUrl() }}" alt="{{ $post->title }}"
                        class="w-full rounded-lg shadow-md max-h-[500px] object-cover">
                </div>

                <div class="text-gray-800 leading-relaxed whitespace-pre-line mb-1">
                    {!! nl2br(e($post->content)) !!}
                </div>
                
                <div class="mb-3">
                    <span class="px-4 py-2 bg-gray-300 rounded-xl ">
                        {!! nl2br(e($post->category->name)) !!}
                    </span>
                </div>
                @auth

                <div class="mb-5 px-3 mt-5">
                    <button @click="clap()" :class="hasClaped ? 'text-green-600' : 'text-gray-600 hover:text-green-500'"
                            class="transition flex gap-2 items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M6.633 10.25c.806 0 1.533-.446 2.031-1.08a9.041 9.041 0 0 1 2.861-2.4c.723-.384 1.35-.956 1.653-1.715a4.498 4.498 0 0 0 .322-1.672V2.75a.75.75 0 0 1 .75-.75 2.25 2.25 0 0 1 2.25 2.25c0 1.152-.26 2.243-.723 3.218-.266.558.107 1.282.725 1.282m0 0h3.126c1.026 0 1.945.694 2.054 1.715.045.422.068.85.068 1.285a11.95 11.95 0 0 1-2.649 7.521c-.388.482-.987.729-1.605.729H13.48c-.483 0-.964-.078-1.423-.23l-3.114-1.04a4.501 4.501 0 0 0-1.423-.23H5.904m10.598-9.75H14.25M5.904 18.5c.083.205.173.405.27.602.197.4-.078.898-.523.898h-.908c-.889 0-1.713-.518-1.972-1.368a12 12 0 0 1-.521-3.507c0-1.553.295-3.036.831-4.398C3.387 9.953 4.167 9.5 5 9.5h1.053c.472 0 .745.556.5.96a8.958 8.958 0 0 0-1.302 4.665c0 1.194.232 2.333.654 3.375Z" />
                            </svg>
                            <span x-text="count"></span>
                        </button>
                </div>
                @endauth
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div id="imageModal" class="fixed inset-0 bg-black bg-opacity-75 flex items-center justify-center z-50 hidden"
        onclick="closeImageModal()">
        <img id="modalImage" src="" class="max-w-3xl max-h-[90vh] rounded-xl shadow-lg border-4 border-white" />
    </div>
</x-app-layout>

<script>
    function showImageModal(src) {
        document.getElementById('modalImage').src = src;
        document.getElementById('imageModal').classList.remove('hidden');
    }

    function closeImageModal() {
        document.getElementById('imageModal').classList.add('hidden');
    }
</script>
</body>