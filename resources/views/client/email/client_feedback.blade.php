<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Client Feedback</title>
</head>
    <body>
        <div style="width:100%; text-align:center;">
            <div style="display: inline-block; margin:0 auto; width:600px; text-align:left; padding:20px; font-family: Verdana,Geneva,sans-serif; ">
                <div>
                    <p>Cher(e) {{$data['first_name']}},</p>
                    <p>Vous avez ete livres recemment par nos equipes et nous esperons que cette experience a ete a la hauteur de vos esperances.</p>
                    <p>Pour nous aider a mieux repondre a vos attentes et a ameliorer notre service, nous souhaiterions connaitre votre avis sur cette experience. Votre participation est precieuse!</p>
                    <p>Avez vous ete satisfait de votre livraison?</p>
                </div>
                {!! Form::model(null, [ 'url' => URL::route('client.feedback'), "enctype"=>"multipart/form-data", 'id'=>'createForm'] )  !!}
                <div style="text-align:center; padding:20px 0;">
                    <input type="radio" name="satisfy" value="1" checked="checked"> très bien
                    <input type="radio" name="satisfy" value="2"> bien
                    <input type="radio" name="satisfy" value="3"> pas bon
                </div>
                <div >
                    <textarea name="feedback" style="width:100%; resize:none; border:2px solid #000; padding:20px" placeholder="Commentaire">Commentaire</textarea>
                    <input type="submit" style="cursor: point; background-color: #337ab7; border:none; border-radius:5px; color: white; padding:10px 10px" value="Submit Feedback">
                </div>
                {!! Form::hidden('id', $data['id'], ['id'=>'recordId']) !!}
                {!! Form::close() !!}
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Laborum, suscipit.</p>
                <br><br>
                <img src="{{asset('assets/images')}}/logoTDF.png">
            </div>
        </div>
    </body>
</html>
