<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Shipper Parties</title>

    <style>
        body{
            font-family: DejaVu Sans, sans-serif;
            font-size:12px;
        }

        table{
            width:100%;
            border-collapse:collapse;
        }

        th,td{
            border:1px solid #000;
            padding:6px;
            text-align:left;
        }

        th{
            background:#efefef;
        }

        h3{
            text-align:center;
            margin-bottom:20px;
        }
    </style>

</head>

<body>

<h3>
Shipper
</h3>

<table>

<thead>

<tr>
    <th>S.No</th>
    <th>Party Name</th>
    <th>Telephone</th>
    <th>Email</th>
</tr>

</thead>

<tbody>

@foreach($exportParties as $index=>$party)

<tr>
<td>{{ $index+1 }}</td>
<td>{{ $party->party_name }}</td>
<td>{{ $party->tel_no }}</td>
<td>{{ $party->email }}</td>

</tr>

@endforeach

</tbody>

</table>

</body>
</html>