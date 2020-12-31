<div id="main" class="article-list">
    <div class="container">
        <div class="row">
            <div class="col-md-12 index_crossLine">
                <h1 class="text-center">Rozcestník</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 col-xl-7 offset-xl-0 index_list">
                <h4>Všechny příběhy</h4>
                <ul class="index_list-style">
                    @foreach ($articlesController->Articles as $article)
                    <li><a href="{{$article['url']}}">{{$article[0]}}</a>&nbsp;→&nbsp; {{$article['description']}}.</li>
                    @endforeach
                </ul>
                <h4>Vysvětlivky</h4>
                <ul class="index_list-style">
                    <li>"Text"&nbsp;→&nbsp;Jedná se o myšlenky postav.</li>
                    <li>???? →&nbsp;Jedná se o myšlenky postav.</li>
                    <li><span style="color: #d81e05;">Text</span>&nbsp;→&nbsp;Důležitá informace/událost.</li>
                    <li>'Text' → označuje přibližný popis př. Budova vypadala jako 'klášter'.</li>
                </ul>
            </div>
            <div class="col-md-6 col-xl-5 index_list">
                <p style="color: #eef4f7;">Vítám Vás na stránkách StarAdventure,</p>
                <p style="color: #eef4f7;">Pro prohlížení webu je nutné se registrovat a veškerý obsah je chráněn autorským zákonem děkuji za pochopení.</p>
                <p style="color: #eef4f7;">Na webu StarAdventure naleznete příběh odehrávající se v roce 2030, kdy hlavní hrdina&nbsp;<a href="/show/isama/1">Isama</a>&nbsp;zjistí, že žije v mnohem záhadnějším a úžasnějším světě o kterém donedávna neměl tušení že existuje.</p>
                <div class="d-flex d-xl-flex flex-column align-items-xl-end index-log-reg"><a href="/login" class="btn btn-primary btn-block btn-lg btn-default" role="button">Přihlášení</a><a href="/register" class="btn btn-primary btn-block btn-lg btn-default" role="button">Registrace</a></div>
            </div>
        </div>
    </div>
</div>

