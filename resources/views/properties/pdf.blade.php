<!DOCTYPE html>
<html>
<head>
    <title>Property Information</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .logo {
            width: 100px;
            height: auto;
            margin-bottom: 10px;
        }
        .qr-code {
            text-align: center;
            margin-top: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid black;
            padding: 10px;
            text-align: left;
        }
        .note {
            font-size: 12px;
            margin-top: 10px;
            font-style: italic;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="header">
        <img src="{{ public_path('assets/images/municipal-logo.png') }}" class="logo" alt="Municipal Logo">
        <h2>Municipality of Quezon, Bukidnon</h2>
        <div class="qr-code">
            <p>Property Number QR Code</p>
            <img src="data:image/png;base64,{{ base64_encode(QrCode::format('png')->size(100)->generate($property->property_number)) }}" alt="QR Code">
        </div>
    </div>

    <div class="note">
        NOTE: DO NOT REMOVE (Unauthorized removal or tampering will be subject to disciplinary action).
    </div>

    <table>
        <tr>
            <th>Property Number</th>
            <td>{{ $property->property_number }}</td>
        </tr>
        <tr>
            <th>Description</th>
            <td>{{ $property->description }}</td>
        </tr>

        <tr>
            <th>Office</th>
            <td>{{ $property->office->office_name }}</td>
        </tr>
        <tr>
            <th>Date Purchased</th>
            <td>{{ \Carbon\Carbon::parse($property->date_purchase)->format('F d, Y') }}</td>
        </tr>
        <tr>
            <th>Accountable</th>
            <td>{{ $property->employee->employee_name }}</td>
        </tr>
        <tr>
            <th>Acquisition Cost</th>
            <td>Php {{ number_format($property->acquisition_cost, 2) }}</td>
        </tr>
        <tr>
            <th>Status</th>
            <td>{{ $property->status->status_name }}</td>
        </tr>
        <tr>
            <th>Inventory Remarks</th>
            <td>{{ $property->inventory_remarks }}</td>
        </tr>
    </table>

    
</body>
</html>
