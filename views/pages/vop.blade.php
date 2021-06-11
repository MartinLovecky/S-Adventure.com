@include('layouts.app')
@include('layouts.menu')

<div class="article-list">
    <div class="container-fluid features-boxed">
        <div class="row" style="padding-top: 16px;">
            <div class="col-xl-10 offset-xl-1">
                {{-- foreach($item as $header => $text)  item number --}} 
                <div class="block-heading">
                    <h2 class="text-info text-center">Ochrana osobních údajů</h2>
                </div>
                <div role="tablist" class="text-muted" id="accordion-1">
                    <div class="card">
                        <div role="tab" class="card-header">
                            <h5 class="mb-0"><a data-toggle="collapse" aria-expanded="true" aria-controls="accordion-1 .item-1" href="#accordion-1 .item-x_$item" class="text-primary">1. Ochrana hesla.</a></h5>
                        </div>
                        <div role="tabpanel" data-parent="#accordion-1" class="collapse show item-x_$item">
                            <div class="card-body">
                                <p class="card-text">Při zadávání vašeho hesla při registraci je heslo zašifrováno pomocí algoritmu sha256.</p>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div role="tab" class="card-header">
                            <h5 class="mb-0"><a data-toggle="collapse" aria-expanded="false" aria-controls="accordion-1 .item-2" href="#accordion-1 .item-2" class="text-primary">2. Uživatelské jméno a osobní údaje v profilu</a></h5>
                        </div>
                        <div role="tabpanel" data-parent="#accordion-1" class="collapse item-2">
                            <div class="card-body">
                                <p class="card-text">Pro vaše uživatelské jméno si můžete zvolit co se vám líbí jen bych prosil aby to bylo slušné a srozumitelné ps: účty typu apfap nebo hovno budou smazány! Jakýkoliv typ SPAMU bude potrestán IP - BANEM !<br/>
                                Berte na vědomí že do vašeho profilu nemusíte zadávat žádné informace o vás pokud nechcete! Je to dobrovolné. Pokud se rozhodnete zadat informace o vás tak nebudou nijak zneužity jelikož přísup na váš profil máte pouze vy! Jediné co může být použito na webových stránkách je avatar a vaše uživatelské jméno!</p>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div role="tab" class="card-header">
                            <h5 class="mb-0"><a data-toggle="collapse" aria-expanded="false" aria-controls="accordion-1 .item-3" href="#accordion-1 .item-3" class="text-primary">3. Emailová adresa</a></h5>
                        </div>
                        <div role="tabpanel" data-parent="#accordion-1" class="collapse item-3">
                            <div class="card-body">
                                <p class="card-text">Pro úspěšnou registraci emailová adresa musí existovat příjde vám aktivačí odkaz. Neměl by vám přijít do SPAMU. (možné je však vše :-D)<br/>
                                    <b>Důležité !!</b> Občas se stává že místo otevření aktivačního odkazu se otevře <b>https://email.seznam.cz/{{$_SERVER['SERVER_NAME']}}/activate?x=x&y=y</b> což je samozřejmě <b>špatně !!</b> pro vaší aktivaci zkopírujte <b>{{$_SERVER['SERVER_NAME']}}/activate.php?x=x&y=y</b> vložte to do okna. Pokud by někdo nevěděl co stím na email vám příde obrázek, který vám to vysvětlí.</br>
                                    Vaše emailová adresa bude použita pouze v případě když mě bude kotaktovat skzre {{$_SERVER['SERVER_NAME']}}/kontakt</p>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div role="tab" class="card-header">
                            <h5 class="mb-0"><a data-toggle="collapse" aria-expanded="false" aria-controls="accordion-1 .item-4" href="#accordion-1 .item-4" class="text-primary">4. Permission (práva)</a></h5>
                        </div>
                        <div role="tabpanel" data-parent="#accordion-1" class="collapse item-4">
                            <div class="card-body">
                                <p class="card-text"><strong>Náštevník:</strong> Neregistrovaný náštevník stránky - limitován <br>
                                <strong>Uživatel:</strong> Muže prohlížet veškeré příspěvky, avšak je nemuže měnit<br>
                                <strong>Editor:</strong> Může upravovat/přidávat příspěvky, nemůže je smazat<br>
                                <strong>ADMIN:</strong>Existuje pouze jeden administrátor a to je <strong>Sensei</strong><br>
                                 Mužete se stát editorem ? možná záleží jak se semnou domluvíte :-P</p>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div role="tab" class="card-header">
                            <h5 class="mb-0"><a data-toggle="collapse" aria-expanded="false" aria-controls="accordion-1 .item-5" href="#accordion-1 .item-5" class="text-primary">5. Poděkování</a></h5>
                        </div>
                        <div role="tabpanel" data-parent="#accordion-1" class="collapse item-5">
                            <div class="card-body">
                                <p class="card-text">Děkuji všem co si udělali čas a přečetli si tyto informace pokud máte nějaký dotaz nebojte se mě kontaktovat rád vám odpovím.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('layouts.footer')
