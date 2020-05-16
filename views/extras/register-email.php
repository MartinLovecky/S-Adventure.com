<?php

// for now only simple text  
/*
$body = '
<h1 style="color: #241c15;">Děkuji za registraci: '.$username.'</h1>
<a style="color: #ffffff; display: inline-block; font-size: 16px; text-decoration: none;height:30px;margin-top:15px;margin-bottom:5px;" href="" target="_blank" rel="noopener">Aktivovat účet</a>';
*/

$body = '
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
  <title>Untitled</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/css/bootstrap.min.css">
  <style>
    .photo-card {
        background-color: rgba(255,193,7,0);
        border-radius: 10px;
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.19), 0 6px 6px rgba(0, 0, 0, 0.23);
        display: flex;
        flex-direction: column;
        width: 100%;
        max-width: 700px;
        margin-left: auto;
        margin-right: auto;
        background-image: url(bg-14.jpg);
        background-position: center;
        background-size: cover;
        border-top-left-radius: 10px;
        border-top-right-radius: 10px;
        min-height: 250px;
      }
      @media screen and (min-width: 700px) {
        .photo-card {
          flex-direction: row;
        }
      }
      .photo-background {
        background-image: url(bg-14.jpg);
        background-position: center;
        background-size: cover;
        border-top-left-radius: 10px;
        border-top-right-radius: 10px;
        min-height: 250px;
      }
      @media screen and (min-width: 700px) {
        .photo-background {
          border-top-left-radius: 10px;
          border-top-right-radius: 0;
          border-bottom-left-radius: 10px;
          min-height: none;
          width: 50%;
        }
      }
      .photo-details {
        padding: 2.1875em 5%;
      }
      @media screen and (min-width: 700px) {
        .photo-details {
          width: 50%;
        }
      }
      .photo-details h1, .photo-details h4 {
        color: #fff;
        font-weight: 500;
        margin: 0;
      }
      .photo-details h1 {
        font-size: 125%;
        line-height: 1;
        margin-bottom: 0.35em;
      }
      .photo-tags ul {
        list-style-type: none;
        margin: 0;
        padding: 0;
        display: flex;
        flex-wrap: wrap;
        font-size: 87.5%;
        margin-top: 0.35em;
        text-transform: lowercase;
      }
      .photo-tags li {
        margin: 0 0.35em 0.35em 0;
      }
      .photo-tags a {
        background-color: #000000;
        border-radius: 50px;
        color: #fff;
        display: block;
        padding: 0.3125em 1.25em;
        text-decoration: none;
        transition: color 0.3s ease;
      }
      .photo-tags a:hover, .photo-tags a:focus {
        color: #e37544;
      }
      .photo-details p {
        color: white;
      }
      .container-fluid {
        width: 100%;
        padding-right: 15px;
        padding-left: 15px;
        margin-right: auto;
        margin-left: auto;
      }
      .row {
        display: -ms-flexbox;
        display: flex;
        -ms-flex-wrap: wrap;
        flex-wrap: wrap;
        margin-right: -15px;
        margin-left: -15px;
      }
      @media (min-width:1200px) {
        .offset-xl-1 {
          margin-left: 8.333333%;
        }
      }
      @media (min-width:1200px) {
        .col-xl-10 {
          -ms-flex: 0 0 83.333333%;
          flex: 0 0 83.333333%;
          max-width: 83.333333%;
        }
      }
      .d-table-cell {
        display: table-cell!important;
      }
      .img-fluid {
        max-width: 100%;
        height: auto;
      }
      img {
        vertical-align: middle;
        border-style: none;
      }
      .photo-details p {
        color: white;
      }
      
      .text-left {
        text-align: left!important;
      }
      
      p {
        margin-top: 0;
        margin-bottom: 1rem;
      }
      body {
        margin: 0;
        font-family: -apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,"Noto Sans",sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol","Noto Color Emoji";
        font-size: 1rem;
        font-weight: 400;
        line-height: 1.5;
        color: #212529;
        text-align: left;
        background-color: #fff;
      }
      
      html {
        font-family: sans-serif;
        line-height: 1.15;
        -webkit-text-size-adjust: 100%;
        -webkit-tap-highlight-color: transparent;
      }                              
  </style>
</head>

<body>
  <section>
      <div class="container-fluid">
        <div class="d-block float-none photo-card">
          <div class="d-table-cell photo-details"><img class="img-fluid" src="https://i.imgur.com/eDo7cFM.jpg">
            <h1><br><strong>Děkujeme za vaši registraci !</strong><br><br></h1>
            <p>Pro dokončení registrace klikněte na <strong>Aktivovat</strong><br>*Pokud jste to nebyli vy prosím ignorujte tento email.<br></p>
            <p class="text-left">Uživatel:<span class="text-monospace text-warning" style="margin-left: 10px;">'.$username.'</span></p>
            <p class="text-left" style="margin-bottom: 32px;">Vytvořen dne:<span class="text-monospace text-warning" style="margin-left: 10px;">'.date("Y-m-d").'</span></p>
            <div class="photo-tags"><a herf="http://staradventure.xf.cz/activate?x='.$id.'&y='.$activasion.'" class="btn btn-block btn-lg" role="button">Aktivovat</a></div>
          </div>
        </div>
      </div>
  </section>
</body>';