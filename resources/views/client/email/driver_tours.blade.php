<!DOCTYPE html>
<html>
<head>
    <title>Tour Plan</title>
</head>
<body>
    <Strong>Hi</Strong>
    <br>
    <br>
    	<span>You have a new Delivery Request in your Account. Your Delivery Detail are giving below</span>
    <br>
    <br>
    <table>
        <tr>
            <td><strong>Customer Name:</strong> </td> <td>{{$data['first_name']}} {{$data['first_name']}}</td>
        </tr>
        <tr>
            <td><strong>Phone Number:</strong> </td> <td>{{$data['mobile_number']}}</td>
        </tr>
        <tr>
            <td><strong>Landline:</strong> </td> <td>{{$data['landline']}}</td>
        </tr>
        <tr>
            <td><strong>Address:</strong> </td> <td>{{$data['address']}} {{$data['city']}}</td>
        </tr>
        <tr>
            <td><strong>Postal Code:</strong> </td> <td>{{$data['postal_code']}}</td>
        </tr>
        <tr>
            <td><strong>Service:</strong> </td> <td>{{$data['service']}}</td>
        </tr>
        <tr>
            <td><strong>Delivery Date:</strong> </td> <td>{{$data['datetime']}}</td>
        </tr>
    </table>
    <br>
    <br>
    <span>
        Regards
        <br>
        TDF Transport

    </span>
</body>
</html>
