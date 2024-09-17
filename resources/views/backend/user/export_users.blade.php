<table>
    <thead style="background-color: green; color: skyblue; border: 3px solid #ee00ee">
    <tr>
        <th>id</th>
        <th>email</th>
        <th>full</th>
        <th>address</th>
        <th>phone</th>
        <th>level</th>
    </tr>
    </thead>
    <tbody>
    @foreach($users as $user)
        <tr>
            <td>{{ $user->id }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->full }}</td>
            <td>{{ $user->address }}</td>
            <td>{{ $user->phone }}</td>
            <td>{{ $user->level == 1 ? 'Admin' : 'Staff' }}</td>
        </tr>
    @endforeach
    </tbody>
</table>