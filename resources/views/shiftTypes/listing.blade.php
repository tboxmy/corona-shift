<div class="card">
    <div class="card-header">Shift types</div>
        <div class="card-body">
<table id="shiftTypesListTable" class="border-collapse table-auto w-full text-sm">
    <thead>
        <tr>
        <th>id</th>
        <th>Name</th>
        <th>Description</th>
        <th>Duration</th>
        <th>Breaks</th>
        <th>Created at</th>
        </tr>
    </thead>
    <tbody>
        @foreach($data['data'] as $key => $user)
        <tr>
            <td>{{$user->id}}</td>
            <td>{{$user->name}}</td>
            <td>{{$user->description}}</td>
            <td>{{$user->duration}}</td>
            <td>{{$user->breaks}}</td>
            <td>{{$user->created_at}}
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
Total = {{$data['recordsTotal']}}

    </div>
</div>
