<!DOCTYPE html>
<html lang="cs">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0 shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="Description" content="Author: M.L. Author, Příběh SCI - FI">
    <meta name="theme-color" content="#ffff">
    <title>{{$selector->title()}}</title>
    <link rel="stylesheet" href="@asset('css/bootstrap.min.css')">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Cookie">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Aldrich">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
    <link rel="stylesheet" href="@asset('css/Login-Form-Dark.css')"> 
    <link rel="stylesheet" href="@asset('css/styles.min.css')">
    <link rel="stylesheet" href="@asset('css/project-horizont.min.css')">
    <link rel="apple-touch-icon" sizes="180x180" href="@asset('images/apple-touch-icon.png')">
    <link rel="icon" type="image/png" href="@asset('images/apple-touch-icon.png')" sizes="32x32">
    <link rel="icon" type="image/png" href="@asset('images/apple-touch-icon.png')" sizes="16x16">
    <link rel="manifest" href="@asset('images/manifest.json')">
    <link rel="mask-icon" href="@asset('images/safari-pinned-tab.svg')" color="#5bbad5">
    <script src="/ckeditor/ckeditor.js"></script>
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
