<div class="card">
    <div class="card-header">User List</div>
        <div class="card-body">
<table class="border-collapse table-auto w-full text-sm">
    <thead>
        <tr>
        <th>id</th>
        <th>Name</th>
        <th>Email</th>
        <th>Created at</th>
        <th>Admin</th>
        </tr>
    </thead>
    <tbody>
        @foreach($data['data'] as $key => $user)
        <tr>
            <td>{{$user->id}}</td>
            <td>{{$user->name}}</td>
            <td>{{$user->email}}</td>
            <td>{{$user->created_at}}</td>
            <td>@if($user->is_admin)
                YES
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
Users Total = {{$data['recordsTotal']}}

    </div>
</div>
