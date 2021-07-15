<div>
    <input wire:model="search" type="text" placeholder="Search users..."/>
    <ul>
        @foreach($usersLW as $userw)
            <li>{{ $userw->name }}</li>
        @endforeach
    </ul>
    <h1>Admin Search</h1>
</div>