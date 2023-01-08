<div class="card">
    <div class="card-header">User List</div>
        <div class="card-body">
<table id="userListTable" class="table border-collapse table-auto w-full text-sm table-striped">
    <thead>
        <tr>
        <th>id</th>
        <th>Name</th>
        <th>Code</th>
        <th>Description</th>
        <th>Region</th>
        <th>Shift</th>
        <th>Manager</th>
        
        </tr>
    </thead>
    <tbody>
        @foreach($data['data'] as $key => $item)
        <tr>
            <td>{{$item->id}}</td>
            <td><a href="{{ url('/department?prev=/admin/departments',$item) }}">{{$item->name}}</a></td>
            <td>{{$item->code}}</td>
            <td>{{$item->description}}</td>
            <td>{{$item->region}}</td>
            <td>
                @if($item->is_shift)
                YES @else NO
                @endif
            </td>
            <td>@if($item->managedBy)
                <a href="{{ url('/user?prev=/admin/departments',$item->managedBy) }}">{{$item->managedBy->name}} ({{$item->managedBy->email}})</a>
                @endif
            </td>
            
        </tr>
        @endforeach
    </tbody>
</table>
Users Total = {{$data['recordsTotal']}}

    </div>
</div>
