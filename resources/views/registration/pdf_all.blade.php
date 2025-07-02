<!DOCTYPE html>
<html>
<head>
    <title>All Registrations</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .container { width: 90%; margin: 0 auto; }
        h1 { text-align: center; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <div class="container">
        <h1>All Registrations</h1>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Names</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>ID Number</th>
                    <th>Department</th>
                    <th>Province</th>
                    <th>District</th>
                    <th>Sector</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($registrations as $registration)
                    <tr>
                        <td>{{ $registration->id }}</td>
                        <td>{{ $registration->names }}</td>
                        <td>{{ $registration->email }}</td>
                        <td>{{ $registration->phone }}</td>
                        <td>{{ $registration->id_number }}</td>
                        <td>{{ $registration->department ? $registration->department->name : 'N/A' }}</td>
                        <td>{{ $registration->province ? $registration->province->name : 'N/A' }}</td>
                        <td>{{ $registration->district ? $registration->district->name : 'N/A' }}</td>
                        <td>{{ $registration->sector ? $registration->sector->name : 'N/A' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
