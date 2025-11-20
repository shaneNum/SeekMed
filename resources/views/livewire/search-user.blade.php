<div>
    <input type="text" wire:model.live.debounce.300ms.throttle.150ms="query" placeholder="Search user..">
    <ul>
        @forelse ($results as $user)
            <li>{{$user->username}}</li>
        @empty
            <li>No users found!</li>
        @endforelse
    </ul>
</div>
