<!DOCTYPE html>
<html>
<head>
    <title>Message</title>
</head>
<body>
    <h2>Hey, One of the person leave a message</h2>
    <table>
        <tr>
            <td>Name: {!! $data->name !!}</td>
        </tr>
        <tr>
            <td>Email: {!! $data->email !!}</td>
        </tr>
        <tr>
            <td>Subject: {!! $data->subject !!}</td>
        </tr>
        <tr>
            <td>Message: {!! $data->message !!}</td>
        </tr>
    </table>
</body>
</html>