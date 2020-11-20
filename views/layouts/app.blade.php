<!DOCTYPE html>
<html lang="cs">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0 shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@isset($title){{$title}}@endisset</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Cookie">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
    <link rel="stylesheet" href="@asset('css/Login-Form-Dark.css')"> 
    <link rel="stylesheet" href="@asset('css/styles.min.css')">
    <link rel="stylesheet" href="@asset('css/project-horizont.min.css')">
    <script>
        function onSubmit(token) {
          alert('thanks ' + document.getElementById('field').value);
        }
      
        function validate(event) {
          event.preventDefault();
          if (!document.getElementById('field').value) {
            alert("You must add text to the required field");
          } else {
            grecaptcha.execute();
          }
        }
      
        function onload() {
          var element = document.getElementById('submit');
          element.onclick = validate;
        }
      </script>
      <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>

<body>

@yield($selector->viewName())
