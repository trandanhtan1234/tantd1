<div>
    <input wire:keydown.enter="search" type="text" placeholder="Search users..."/>
    <ul>
        @foreach($users as $user)
            <li>{{ $user->email }}</li>
        @endforeach
    </ul>
</div>
