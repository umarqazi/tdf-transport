<!DOCTYPE html>
<html>
<head>
    <title>Réinitialisation de votre mot de passe</title>
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
    <Strong>Bonjour,</Strong>
    <br>
    <br>
    	<span>Merci de <a href="{{route('change.Password', [$data['token']])}}">cliquez ici</a> pour changer votre mot de passe </span>
    <br>
    <br>
    <span>
        Bien cordialement,
        <br>
        L'équipe TDF Transport
        <br>
        <br>
        <div class="logo">
            <img src="http://34.213.180.141/assets/images/logoTDF.png" class="img-responsive">
            <br>
            <br>
            <strong>20 rue de Moreau - 75012 PARIS</strong>
        </div>


    </span>
</body>
</html>
