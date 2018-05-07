<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Client Feedback</title>
    <style>
        .logo{
            width:30%;
            float:left;
        }
        .logo img{
            width:100%;
            float:left;
        }
    </style>
</head>
<body>
<div style="width:100%; text-align:center;">
    <div style="display: inline-block; margin:0 auto; width:600px; text-align:left; padding:20px; font-family: Verdana,Geneva,sans-serif; ">
        <div>
            <p>Cher(e) {{$data['first_name']}} {{$data['last_name']}},</p>
            <p>Vous avez été livrés récemment par nos équipes et nous espérons que cette expérience a été à la hauteur de vos espérances.</p>
            <p>Pour nous aider à mieux répondre à vos attentes et à améliorer notre service, nous souhaiterions connaitre votre avis sur cette expérience. Votre participation est précieuse!</p>
            <p>Avez vous été satisfait de votre livraison?</p>
        </div>
        <div style="text-align:center; padding:20px 0;">
            <label for="test1">
                <a href="{{route('client.feedback',['id' =>$data['id'] ,'value' => 1])}}"><img src="{{asset('assets/images')}}/smile-green.png" /></a>
                <input class="select_control" id="test1" type="radio" name="satisfy" value="1" style="display:none"/>
            </label>
            <label for="test2">
                <a href="{{route('client.feedback',['id' =>$data['id'] ,'value' => 2])}}"><img src="{{asset('assets/images')}}/smile-yellow.png" /></a>
                <input class="select_control" id="test2" type="radio" name="satisfy" value="2" style="display:none"/>
            </label>
            <label for="test3">
                <a href="{{route('client.feedback',['id' =>$data['id'] ,'value' => 3])}}"><img src="{{asset('assets/images')}}/smile-red.png" /></a>
                <input class="select_control" id="test3" type="radio" name="satisfy" value="3" style="display:none" />
            </label>
        </div>
        <br><br>
        <p>Nous vous remercions de votre participation. </p>
        <div class="logo">
            <img src="{{asset('assets/images')}}/logoTDF.png" class="img-responsive">
        </div>
    </div>
</div>
</body>
</html>
