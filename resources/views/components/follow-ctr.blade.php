@props(['user'])
<div {{ $attributes }} x-data="{
    following: {{ $user->isFollowedBy(Auth::user()) ? 'true' : 'false' }},
    followersCount: {{ $user->followers()->count() }},
    follow() {
        this.following = !this.following;
        axios.post('/follow/{{ $user->username }}')
            .then(res => {
                console.log(res.data);
                this.followersCount = res.data.followersCount;
            })
            .catch(err => {
                console.log(err);
            });
    }
}" class=" w-full md:w-1/3 text-center md:text-left p-5">

{{ $slot }}
</div>