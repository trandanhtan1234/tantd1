<table>
    <thead style="background-color: green; color: skyblue; border: 3px solid #ee00ee">
    <tr>
        <th>id</th>
        <th>email</th>
        <th>full</th>
        <th>address</th>
        <th>phone</th>
    </tr>
    </thead>
    <tbody>
    @foreach($customers as $customer)
        <tr>
            <td>{{ $customer->id }}</td>
            <td>{{ $customer->email }}</td>
            <td>{{ $customer->full }}</td>
            <td>{{ $customer->address }}</td>
            <td>{{ $customer->phone }}</td>
        </tr>
    @endforeach
    </tbody>
</table>