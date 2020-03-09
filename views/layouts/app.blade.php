<!DOCTYPE html>
<html lang="cs">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Audiowide&amp;subset=latin-ext">
    <link rel="stylesheet" href="@asset('css.Form-Dark.css')"> 
    <link rel="stylesheet" href="@asset('css.styles.css')">
    <link rel="stylesheet" href="@asset('css.project-horizont.css')">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css">
    <script src="https://cdn.ckeditor.com/ckeditor5/12.4.0/classic/ckeditor.js"></script>
    <title>@isset($title){{$title}}@endisset</title>
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



  
