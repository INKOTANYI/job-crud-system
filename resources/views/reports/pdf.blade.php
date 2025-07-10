<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>JobSmart Dashboard Report</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; color: #333; }
        h1 { color: #38b2ac; text-align: center; }
        h2 { color: #2d3748; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #dee2e6; padding: 8px; text-align: left; }
        th { background: #38b2ac; color: #fff; }
        .summary { margin-bottom: 20px; }
        .summary p { font-size: 16px; }
    </style>
</head>
<body>
    <h1>JobSmart Dashboard Report</h1>
    <div class="summary">
        <p><strong>Total New Registrations:</strong> {{ $newRegistrationCount }}</p>
        <p><strong>Total Contact Messages:</strong> {{ $contactCount }}</p>
    </div>

    <h2>Registrations by District</h2>
    <table>
        <thead>
            <tr>
                <th>District</th>
                <th>Count</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($applicationByDistrict as $district)
                <tr>
                    <td>{{ $district->district->name ?? 'Unknown' }}</td>
                    <td>{{ $district->count }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h2>Registrations by Department</h2>
    <table>
        <thead>
            <tr>
                <th>Department</th>
                <th>Count</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($applicationByDepartment as $department)
                <tr>
                    <td>{{ $department->department->name ?? 'Unknown' }}</td>
                    <td>{{ $department->count }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
