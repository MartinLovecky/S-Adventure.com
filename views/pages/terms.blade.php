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
                            <h5 class="mb-0"><a data-toggle="collapse" aria-expanded="true" aria-controls="accordion-1 .item-1" href="#accordion-1 .item-1" class="text-primary">1. Základní informace</a></h5>
                        </div>
                        <div role="tabpanel" data-parent="#accordion-1" class="collapse show item-1">
                            <div class="card-body">
                                <p class="card-text">Provozovatelem internetových stránek {{$_SERVER['SERVER_NAME']}} je Sensei(dále jen provozovatel), který je v souladu se zák. č. 121/2000 Sb., o právu autorském, o právech souvisejících s právem autorským a o změně některých zákonů(autorský zákon), v platném znění, oprávněn vykonávat majetková práva k těmto internetovým stránkám. Provozovatel tímto vydává podmínky pro užívání internetových stránek {{$_SERVER['SERVER_NAME']}}(dále jen Podmínky). Tyto Podmínky se vztahují na každou osobu, která má v úmyslu užívat nebo užívá výše uvedené stránky.</p>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div role="tab" class="card-header">
                            <h5 class="mb-0"><a data-toggle="collapse" aria-expanded="false" aria-controls="accordion-1 .item-2" href="#accordion-1 .item-2" class="text-primary">2. Způsob užívání {{$_SERVER['SERVER_NAME']}}</a></h5>
                        </div>
                        <div role="tabpanel" data-parent="#accordion-1" class="collapse item-2">
                            <div class="card-body">
                                <p class="card-text">Přístup na uvedené stránky může být ze strany provozovatele úplně či částečně podmíněn poskytnutím některých osobních údajů Uživatele ve smyslu zák. č. 101/2000 Sb., o ochraně osobních údajů
                                    a o změně některých zákonů, v platném znění. V takovém případě bude provozovatel s těmito údaji nakládat v souladu s právními předpisy a vždy tak, aby zamezil jakékoliv újmě osoby, které se údaje týkají.<br>Je zakázáno jakýmkoliv způsobem zasahovat bez souhlasu provozovatele do technické podstaty či obsahu {{$_SERVER['SERVER_NAME']}}. Pouze provozovatel má právo rozhodovat o změně, odstranění či doplnění jakékoliv součásti těchto
                                    stránek.<br>Provozovatel nenese žádnou odpovědnost za případné škody, které uživatelům mohou vzniknout v souvislosti s užíváním {{$_SERVER['SERVER_NAME']}} Provozovatel také
                                    nenese žádnou odpovědnost za reklamu, popř. jinou formu propagace prováděnou jakýmkoliv třetím subjektem prostřednictvím {{$_SERVER['SERVER_NAME']}}. Provozovatel dále nenese žádnou odpovědnost za obsah www stránek patřících třetím subjektům, které lze navštívit prostřednictvím {{$_SERVER['SERVER_NAME']}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div role="tab" class="card-header">
                            <h5 class="mb-0"><a data-toggle="collapse" aria-expanded="false" aria-controls="accordion-1 .item-3" href="#accordion-1 .item-3" class="text-primary">3. GDRP</a></h5>
                        </div>
                        <div role="tabpanel" data-parent="#accordion-1" class="collapse item-3">
                            <div class="card-body">
                                <p class="card-text"> Uživatel poskytuje svá osobní data dobrovně a s vědomím že provozovatel webu má k těmto informacím přístup a to především k emailové adrese která je nezbytná pro úspěšné používání webových stránek.Provozovatel dále usnanovuje že osobní data se rozlišují níže uvedených skupin.<br>
                                 1. Neregistovaný náštevník stránky nemá přístup k žádným datům ostatních uživatelů.<br>
                                 2. Registrovaný uživatel webu má pouze přístup k následujícím datům ostatních uživatelů [uživetlské jméno,avatar].<br>
                                 3. Osobní údaje jako jméno nebo příjmení nejsou povinné údaje a pokavaď je uživatel vyplní jsou přístupné pouze danému uživateli.<br>  
                                 4. Provozovatel si vyhrazuje právo na získání emailu registrovaného uživatele, email bude použit pro zaslání aktivačního odkazu nebo při resetování hesla, popřípadě na komunikaci mezi provozovatelem a uživatelem.<br>
                                 5. Email nebude použit ke komerčním účelům !!</p>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div role="tab" class="card-header">
                            <h5 class="mb-0"><a data-toggle="collapse" aria-expanded="false" aria-controls="accordion-1 .item-4" href="#accordion-1 .item-4" class="text-primary">4. Závěrečná ustanovení</a></h5>
                        </div>
                        <div role="tabpanel" data-parent="#accordion-1" class="collapse item-4">
                            <div class="card-body">
                                <p class="card-text">Zveřejnění jakýchkoliv údajů či informací na stránkách nemá povahu žádného právního úkonu směřujícího ke vzniku právního vztahu mezi provozovatelem
                                    a Uživatelem, pokud nebude v jednotlivých případech uvedeno jinak.<br>Tyto Podmínky je oprávněn měnit či doplňovat pouze rovozovatel. Podmínky užívání {{$_SERVER['SERVER_NAME']}} jsou účinné dnem jejich zveřejnění.<br>Tyto Podmínky byly zveřejněny dne 1.1.2021.</p>
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