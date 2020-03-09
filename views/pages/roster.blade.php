@extends('layouts.app')
@dump($articles->_showArticles())
<div class="projects-horizontal">
    <div class="container">
        <div class="intro">
            <h2 class="text-center">Seznam příběhů</h2>
            <p class="text-center">Hlavní příběhy</p>
        </div>
        <div class="row projects">
            <div class="col-sm-6 item">
                <div class="row">
                    <div class="col-md-12 col-lg-5"><a href="#"><img src="desk.jpg" class="img-fluid" alt="Isama" /></a></div>
                    <div class="col">
                        <h3 class="name">Isama</h3>
                        <p class="text-left description">Aenean tortor est, vulputate quis leo in, vehicula rhoncus lacus. Praesent aliquam in tellus eu gravida.</p>
                        <a class="btn btn-outline-link" role="button" href="#" style>Button<i class="fa fa-play"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 item">
                <div class="row">
                    <div class="col-md-12 col-lg-5"><a href="#"><img src="building.jpg" class="img-fluid" /></a></div>
                    <div class="col">
                        <h3 class="name">Project Name</h3>
                        <p class="description">Aenean tortor est, vulputate quis leo in, vehicula rhoncus lacus. Praesent aliquam in tellus eu gravida.</p>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 item">
                <div class="row">
                    <div class="col-md-12 col-lg-5"><a href="#"><img src="loft.jpg" class="img-fluid" /></a></div>
                    <div class="col">
                        <h3 class="name">Project Name</h3>
                        <p class="description">Aenean tortor est, vulputate quis leo in, vehicula rhoncus lacus. Praesent aliquam in tellus eu gravida.</p>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 item">
                <div class="row">
                    <div class="col-md-12 col-lg-5"><a href="#"><img src="minibus.jpeg" class="img-fluid" /></a></div>
                    <div class="col">
                        <h3 class="name">Project Name</h3>
                        <p class="description">Aenean tortor est, vulputate quis leo in, vehicula rhoncus lacus. Praesent aliquam in tellus eu gravida.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/js/bootstrap.bundle.min.js"></script>