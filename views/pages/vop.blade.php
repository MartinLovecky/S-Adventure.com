@include('layouts.app')
@include('layouts.menu')

<div class="article-list">
    <div class="container-fluid features-boxed">
        <div class="row" style="padding-top: 16px;">
            <div class="col-xl-10 offset-xl-1">
                {{-- foreach($item as $header => $text)  item number --}} 
                <div role="tablist" class="text-muted" id="accordion-1">
                    <div class="card">
                        <div role="tab" class="card-header">
                            <h5 class="mb-0"><a data-toggle="collapse" aria-expanded="true" aria-controls="accordion-1 .item-1" href="#accordion-1 .item-x_$item" class="text-primary">Accordion Item <-- header</a></h5>
                        </div>
                        <div role="tabpanel" data-parent="#accordion-1" class="collapse show item-x_$item">
                            <div class="card-body">
                                <p class="card-text">Dummy text</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('layouts.footer')


    <section class="clean-block features">
        <div class="container">
            <div class="block-heading">
                <h2 class="text-info text-center">Ochrana osobních údajů</h2>
                <p class="text-center">Informace pro uživatele</p>
            </div>
            <div class="feature-box">
                <h4>1.Ochrana hesla.</h4>
                <p><i class="typcn typcn-media-record">Při zadávání vašeho hesla při registraci je heslo zašifrováno pomocí algoritmu sha256. Takže v databázi vaše hoslo následně vypadá asi nějak takhle:&nbsp;254379edf710548da69a3b1f896f67b3119d336a2c985a9133a0eb7acef20f58. Tento hash je pouze příklad :)</i></p>
            </div>
            <div class="feature-box">
                <h4>2.Uživatelské jméno a osobní údaje v profilu</h4>
                <p><i class="typcn typcn-media-record"></i>Pro vaše uživatelské jméno si můžete zvolit co se vám líbí jen bych prosil aby to bylo slušné a srozumitelné ps: účty typu apfap nebo hovno budou smazány! Jakýkoliv typ SPAMU bude potrestán IP - BANEM !<br/>
                   <i class="typcn typcn-media-record"></i>Berte na vědomí že do vašeho profilu nemusíte zadávat žádné informace o vás pokud nechcete! Je to dobrovolné. Pokud se rozhodnete zadat informace o vás tak nebudou nijak zneužity jelikož přísup na váš profil máte pouze vy! Jediné co může být použito na webových stránkách je avatar a vaše uživatelské jméno!</p>
            </div>
            <div class="feature-box">
                <h4>3.Emailová adresa</h4>
                <p><i class="typcn typcn-media-record"></i>Pro úspěšnou registraci emailová adresa musí existovat příjde vám aktivačí odkaz. Neměl by vám přijít do SPAMU. (možné je však vše :-D)<br/>
                   <b>Důležité !!</b> Občas se stává že místo otevření aktivačního odkazu se otevře <b>https://email.seznam.cz/staradvanture.xf.cz/activate.php?x=1&y=153s</b> což je samozřejmě <b>špatně !!</b> pro vaší aktivaci zkopírujte staradvanture.xf.cz/activate.php?x=1&y=153s vložte to do okna. Pokud by někdo nevěděl co stím na email vám příde obrázek, který vám to vysvětlí.</br>
                   <i class="typcn typcn-media-record"></i>Vaše emailová adresa bude použita pouze v případě když mě bude kotaktovat skzre http://staradvanture.xf.cz/kontakt</p>
            </div>
            <div class="feature-box">
                <h4>4.Permititions (práva)</h4>
                <p><i class="typcn typcn-media-record"><strong>Náštevník:</strong> Neregistrovaný náštevník stránky - limitován </i></p>
                <p><i class="typcn typcn-media-record"><strong>Uživatel:</strong> Muže prohlížet veškeré příspěvky, avšak je nemuže měnit</i></p>
                <p><i class="typcn typcn-media-record"><strong>Editor:</strong> Může upravovat/přidávat příspěvky, nemůže je smazat</i></p>
                <p><i class="typcn typcn-media-record"><strong>ADMIN:</strong>Existuje pouze jeden administrátor a to je <strong>Sensei</strong></i></p> 
                <p><i class="typcn typcn-media-record"> Mužete se stát editorem ? možná záleží jak se semnou domluvíte :-P</i></p>    
            </div>
            <div class="feature-box">
                <h4>5.Poděkování</h4>
                <p><i class="typcn typcn-media-record"></i>Děkuji všem co si udělali čas a přečetli si tyto informace pokud máte nějaký dotaz nebojte se mě kontaktovat rád vám odpovím.</p>
            </div>
        </div>
    </section>
