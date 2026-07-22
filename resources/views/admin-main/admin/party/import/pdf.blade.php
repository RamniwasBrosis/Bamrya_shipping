<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Import Parties</title>

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
    @if($partyType == 1)
        Consignee
    @elseif($partyType == 3)
        CHA
    @elseif($partyType == 10)
        Billing Party
    @elseif($partyType == 4)
        Agent Name
    @elseif($partyType == 5)
        Empty Yard
    @elseif($partyType == 6)
        Notify Party
    @elseif($partyType == 7)
        CFS Yard
    @elseif($partyType == 8)
        Shipping Line/Air Line
    @elseif($partyType == 9)
        Sales Person
    @elseif($partyType == 11)
        PIC
    @elseif($partyType == 15)
        IATA Agent
    @elseif($partyType == 19)
        Co-loader
    @elseif($partyType == 21)
        Surveyor
    @elseif($partyType == 22)
        Delivery Agent Name
    @else
        #
    @endif
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

@foreach($importParties as $index=>$party)

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