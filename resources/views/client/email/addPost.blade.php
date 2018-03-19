<!DOCTYPE html>
<html>
<head>
    <title>Post </title>
</head>
<body>
    <h2>Hey, One of the {!! $data->category !!} waiting for your approval</h2>
    <table>
        <tr>
            <td>Title: {!! $data->ad_title !!}</td>
        </tr>
        <tr>
            <td>Description: {!! $data->ad_description !!}</td>
        </tr>
        <tr>
            <td>Address: {!! $data->address !!}</td>
        </tr>
        <tr>
            <td>Bedrooms: {!! $data->bedrooms !!}</td>
        </tr>
        <tr>
            <td>Bathrooms: {!! $data->bathrooms !!}</td>
        </tr>
        <tr>
            <td>Floor: {!! $data->floor_level !!}</td>
        </tr>
        <tr>
            <td>Price: {!! $data->price !!}</td>
        </tr>
        <tr>
            <td>Category: {!! $data->category !!}</td>
        </tr>
        <tr>
            <td>Area: {!! $data->area !!}</td>
        </tr>
        <tr>
            <td>Customer Name: {!! $data->name !!}</td>
        </tr>
        <tr>
            <td>Phone Number: {!! $data->phone_number !!}</td>
        </tr>

    </table>
</body>
</html>