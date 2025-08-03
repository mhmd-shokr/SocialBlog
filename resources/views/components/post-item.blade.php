<div class=" flex flex-row-reverse bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-white dark:border-gray-300">
                        
    <!-- المحتوى النصي -->
    <div class="p-4 flex flex-col justify-between flex-1">
        
        <!-- العنوان + زر Read more -->
        <div class="flex items-center justify-between mb-2">
            <a href="{{ route('post.show',['username'=>$post->user->username,'post'=>$post->slug]) }}">
                <h5 class="font-bold text-lg text-gray-800 dark:text-black">
                    {{ $post->title }}
                </h5>
            </a>
            

            <!-- زر Read more على يسار العنوان -->
            
            <a href="#">
            <x-primary-button>
            Read more →
            </x-primary-button>
            </a>
            
        </div>

        <!-- المحتوى -->
        <p class="mb-4 font-normal text-gray-800 dark:text-gray-800">
            {{ Str::limit($post->content, 100) }}
        </p>
    </div>

    <!-- الصورة -->
    <a href="{{ route('post.show',['username'=>$post->user->username,'post'=>$post->slug]) }}" class="flex-shrink-0">
        <img class="w-48 h-48 object-cover rounded-r-lg" 
            src="{{asset(Storage::url($post->image))}}" alt="post image" />
    </a>
</div>