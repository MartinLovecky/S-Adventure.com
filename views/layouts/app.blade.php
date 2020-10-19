<!DOCTYPE html>
<html lang="cs">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Audiowide&amp;subset=latin-ext">
    <link rel="stylesheet" href="@asset('css/Login-Form-Dark.css')"> 
    <link rel="stylesheet" href="@asset('css/styles.min.css')">
    <link rel="stylesheet" href="@asset('css/project-horizont.min.css')">
    <link rel="stylesheet" href="@asset('css/bootstrap.min.css')">
  
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

<?php
if(!isset($selector)){
  require(DIR . '/core/init.php'); ?>
    @yield($selector->viewName())<?php
}else{?>
     @yield($selector->viewName())<?php
    }
?>



  
