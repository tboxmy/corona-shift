<div class="card">
    <div class="card-header">User List</div>
        <div class="card-body">
<table id="userListTable" class="table border-collapse table-auto w-full text-sm">
    <thead>
        <tr>
        <th>id</th>
        <th>Name</th>
        <th>Email</th>
        <th>Department</th>
        <th>Hourly rate</th>
        <th>Timezone</th>
        <th>Created at</th>
        <th>Admin</th>
        </tr>
    </thead>
    <tbody>
        @foreach($data['data'] as $key => $user)
        <tr>
            <td>{{$user->id}}</td>
            <td><a href="{{ url('/user?prev=/admin/users',$user) }}">{{$user->name}}</a></td>
            <td>{{$user->email}}</td>
            <td>{{$user->departments->last()->name??''}}</td>
            <td>{{$user->userProfile->currency}} {{number_format(($user->userProfile->hourly_rate)/100,2)}}</td>
            <td>{{$user->userProfile->timezone}}</td>
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
