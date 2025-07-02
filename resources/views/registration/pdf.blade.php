<!DOCTYPE html>
<html>
<head>
    <title>Registration Details</title>
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
        <h1>Registration Details</h1>
        <table>
            <tr>
                <th>ID</th>
                <td>{{ $registration->id }}</td>
            </tr>
            <tr>
                <th>Names</th>
                <td>{{ $registration->names }}</td>
            </tr>
            <tr>
                <th>Email</th>
                <td>{{ $registration->email }}</td>
            </tr>
            <tr>
                <th>Phone</th>
                <td>{{ $registration->phone }}</td>
            </tr>
            <tr>
                <th>ID Number</th>
                <td>{{ $registration->id_number }}</td>
            </tr>
            <tr>
                <th>Department</th>
                <td>{{ $registration->department ? $registration->department->name : 'N/A' }}</td>
            </tr>
            <tr>
                <th>Province</th>
                <td>{{ $registration->province ? $registration->province->name : 'N/A' }}</td>
            </tr>
            <tr>
                <th>District</th>
                <td>{{ $registration->district ? $registration->district->name : 'N/A' }}</td>
            </tr>
            <tr>
                <th>Sector</th>
                <td>{{ $registration->sector ? $registration->sector->name : 'N/A' }}</td>
            </tr>
        </table>
    </div>
</body>
</html>
