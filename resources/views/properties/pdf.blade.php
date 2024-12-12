<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Property Information</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <style>
        /* General Styles */
        body {
            font-family: Arial, sans-serif;
            font-size: 16px; /* Increased base font size for better readability */
            margin: 0;
            padding: 0;
        }

        /* Card Size - 2.5 inches height and 3.8 inches width */
        .card-container {
            width: 3.8in; /* 3.8 inches for width */
            height: 2.5in; /* 2.5 inches for height */
            border: 0.1px solid black;
            box-sizing: border-box;
            overflow: hidden; /* Prevent content from overflowing */
        }

        /* Table Styles */
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 0; /* Removed margin to maximize space */
        }

        table th, table td {
            border: 2px solid black;
            text-align: left;
            font-size: 15px; /* Increased font size for better readability */
        }

        table th {
            background-color: #f2f2f2;
        }

        /* Header Section (Logo, Title, QR Code) */
        .logo, .title, .qr-code {
            text-align: center;
        }

        .logo img, .qr-code img {
            max-height: 60px; /* Increased size for visibility */
            max-width: 100%;
            height: auto;
        }

        .title h4, .title h3 {
            font-size: 16px; /* Larger font for better visibility */
            margin: 0;
        }

       

    </style>
</head>
<body>
    <!-- Card Container -->
    <div class="card-container">
        <!-- Header Section (Logo | Title | QR Code) -->
        <table>
            <tr>
                <!-- Logo -->
                <th class="logo">
                    <img src="{{ public_path('assets/images/municipal-logo.png') }}" alt="Logo">
                </th>

                <!-- Title -->
                <th class="title">
                    <h4>Municipality of</h4>
                    <h3>QUEZON, BUKIDNON</h3>
                </th>

                <!-- QR Code -->
                <th class="qr-code">
                    <img src="data:image/png;base64,{{ base64_encode(QrCode::format('png')->size(150)->generate($property->property_number)) }}" alt="QR Code">
                </th>
            </tr>
        </table>

        <!-- Property Details Table -->
        <table>
            <tr>
                <th>PROPERTY NUMBER</th>
                <td>{{ $property->property_number }}</td>
            </tr>
            <tr>
                <th colspan="2">
                    NOTE: DO NOT REMOVE (Unauthorized removal or tampering will be subject to disciplinary action.)
                </th>
            </tr>
            <tr>
                <th>DESCRIPTION</th>
                <td>{{ $property->description }}</td>
            </tr>
            <tr>
                <th>SERIAL NO. IF ANY</th>
                <td>{{ $property->serial_number }}</td>
            </tr>
            <tr>
                <th>INVENTORY COMMITTEE REMARKS</th>
                <td>{{ $property->inventory_remarks }}</td>
            </tr>
        </table>

    </div>
</body>
</html>
