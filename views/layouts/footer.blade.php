<div class="col-xl-12 offset-xl-0" id="footer">
    <footer id="myFooter">
        <div class="container-fluid">
            <div class="row text-center">
                <div class="col-12 col-sm-6 col-md-3"><img src="@asset('img.icon.jpg')"></div>
                    <div class="col-12 col-sm-6 col-md-2">
                        <h5>Začínáme</h5>
                        <ul>
                            <li><a href="{{$router->url('/')->mobile([])->action()}}">Úvod</a></li>
                            <li><a href="{{$router->url('/register')->mobile([])->action()}}">Registrace</a></li>
                            <li><a href="{{$router->url('/login')->mobile([])->action()}}">Přihlášení</a></li>
                            <li><a href="#">Other Links</a></li>
                        </ul>
                    </div>
                    <div class="col-12 col-sm-6 col-md-2">
                            <h5>Pro vás</h5>
                            <ul>
                                <li><a href="#">Space for you</a></li>
                                <li><a href="#">Space for you</a></li>
                                <li><a href="#">Space for you</a></li>
                                <li><a href="#">Space for you</a></li>
                            </ul>
                        </div>
                        <div class="col-sm-6 col-md-2">
                            <h5>Support</h5>
                            <ul>
                                <li><a href="http://sadventure.com/faq">FAQ</a></li>
                                <li><a href="http://sadventure.com/vop">VOP</a></li>
                                <li><a href="http://sadventure.com/terms">Terms</a></li>
                                <li><a href="#">External Links</a></li>
                            </ul>
                        </div>
                        <div class="col-md-3 social-networks">
                            <div></div><a href="https://www.facebook.com/marthas.lovecky" class="facebook"><i class="fa fa-facebook"></i></a><a href="https://twitter.com/LoveckyMartin" class="twitter"><i class="fa fa-twitter"></i></a><a href="https://plus.google.com/u/0/100826627356661644699" class="google"><i class="fa fa-google-plus"></i></a><a href="https://stackoverflow.com/users/9011597/martin-loveck%C3%BD" class="linkedin"><i class="fa fa-linkedin"></i></a>
                            <a class="btn btn-primary" role="button" href="http://sadventure.com/#" style="font-size: 16px;">Kontakt</a>
                        </div>
                    </div>
                    <div class="row footer-copyright">
                        <div class="col">
                            <p><a href="http://sadventure.com/index">StarAdventure</a>&nbsp;© 2019&nbsp;All Rights Reserved.&nbsp;~ Vytvořil&nbsp;<a href="http://sadventure.com/member/Sensei">Sensei</a></p>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/js/bootstrap.bundle.min.js"></script>
</body>

</html>

