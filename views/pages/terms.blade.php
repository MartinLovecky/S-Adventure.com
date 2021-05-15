@extends('layouts.app')
@include('layouts.menu')
@section('terms')
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
@endsection


    <section class="clean-block features">
        <div class="container">
            <div class="block-heading">
                <h2 class="text-info text-center">Podmínky používání internetových stránek</h2>
                <p class="text-center">Podmínky pro uživatele</p>
            </div>
            <div class="feature-box">
                <h4>1. Základní informace.</h4>
                <p><i class="typcn typcn-media-record"></i>Provozovatelem internetových stránek www.staradventure.xf.cz je Sensei (dále jen provozovatel), který je v souladu se zák. č. 121/2000 Sb., o právu autorském, o právech souvisejících
                    s právem autorským a o změně některých zákonů (autorský zákon), v platném znění, oprávněn vykonávat majetková práva k těmto internetovým stránkám.Provozovatel tímto vydává podmínky pro užívání internetových stránek&nbsp;www.staradventure.xf.cz.
                    (dále jen Podmínky). Tyto Podmínky se vztahují na každou osobu, která má v úmyslu užívat nebo užívá výše uvedené stránky.</p>
            </div>
            <div class="feature-box">
                <h4>2.&nbsp;Způsob užívání staradventure.xf.cz</h4>
                <p><i class="typcn typcn-media-record"></i>Přístup na uvedené stránky může být ze strany provozovatele úplně či částečně podmíněn poskytnutím některých osobních údajů Uživatele ve smyslu zák. č. 101/2000 Sb., o ochraně osobních údajů
                    a o změně některých zákonů, v platném znění. V takovém případě bude provozovatel s těmito údaji nakládat v souladu s právními předpisy a vždy tak, aby zamezil jakékoliv újmě osoby, které se údaje týkají.&nbsp;<br><i class="typcn typcn-media-record"></i>Je
                    zakázáno jakýmkoliv způsobem zasahovat bez souhlasu provozovatele do technické podstaty či obsahu stránek<br>www.staradventure.xf.cz. Pouze provozovatel má právo rozhodovat o změně, odstranění či doplnění jakékoliv součásti těchto
                    stránek.<br><i class="typcn typcn-media-record"></i>Provozovatel nenese žádnou odpovědnost za případné škody, které uživatelům mohou vzniknout v souvislosti s užíváním stránek&nbsp;<br>www.staradventure.xf.cz. Provozovatel také
                    nenese žádnou odpovědnost za reklamu, popř. jinou formu propagace prováděnou jakýmkoliv třetím subjektem prostřednictvím stránek&nbsp;www.staradventure.xf.cz.Provozovatel dále nenese žádnou odpovědnost za obsah www stránek patřících
                    třetím subjektům, které lze navštívit prostřednictvím stránek&nbsp;www.staradventure.xf.cz.</p>
            </div>
            <div class="feature-box">
                <h4>3. GDRP </h4>
                <p><i class="typcn typcn-media-record"></i> Uživatel poskytuje svá osobní data dobrovně a s vědomím že provozovatel webu má k těmto informacím přístup a to především k emailové adrese která je nezbytná pro úspěšné používání webových stránek.Provozovatel dále usnanovuje že osobní data se rozlišují níže uvedených skupin.</p>
                <p><i class="typcn typcn-media-record"></i> 1. Neregistovaný náštevník stránky nemá přístup k žádným datům ostatních uživatelů</p>
                <p><i class="typcn typcn-media-record"></i> 2. Registrovaný uživatel webu má pouze přístup k následujícím datům ostatních uživatelů [uživetlské jméno,avatar]<p>
                <p><i class="typcn typcn-media-record"></i> 3. Osobní údaje jako jméno nebo příjmení nejsou povinné údaje a pokavaď je uživatel vyplní jsou přístupné pouze danému uživateli</p>   
                <p><i class="typcn typcn-media-record"></i> 4. Provozovatel si vyhrazuje právo na získání emailu registrovaného uživatele, email bude použit pro zaslání aktivačního odkazu nebo při resetování hesla, popřípadě na komunikaci mezi provozovatelem a uživatelem</p>
                <p><i class="typcn typcn-media-record"></i> 5. Email nebude použit ke komerčním účelům !!</p>       
            </div>    
            <div class="feature-box">
                <h4>4.&nbsp;Závěrečná ustanovení</h4>
                <p><i class="typcn typcn-media-record"></i>Zveřejnění jakýchkoliv údajů či informací na stránkách provozovaných Komerční bankou,&nbsp;a.&nbsp;s. nemá povahu žádného právního úkonu směřujícího ke vzniku právního vztahu mezi provozovatelem
                    a&nbsp;Uživatelem, pokud nebude v&nbsp;jednotlivých případech uvedeno jinak. <br><i class="typcn typcn-media-record"></i>Tyto Podmínky je oprávněn měnit či doplňovat pouze rovozovatel.Podmínky
                    užívání&nbsp;www.staradventure.xf.cz. jsou účinné dnem jejich zveřejnění. Tyto Podmínky byly zveřejněny dne 1. 1. 2019.</p>
            </div>
        </div>
    </section>
