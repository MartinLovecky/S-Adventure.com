<div class="container-fluid" id="text">
<div class="row">
<div class="col-lg-10 col-lg-offset-1 col-md-12">
<div class="text">
    {{-- !permission check -> redirect with msg --}}
    {{-- if($articleController[$selector->article] == $selector->allowedArticle) --}}
    {{-- foreach($articleController->all as $article) ! dont use --}}
    {{-- isset($articleController['MainNadpis']) h3 --}}  
<h3 style="text-align: center;"><em>Pomsta</em></h3>
    {{-- 'Isama' => $selector-article, '1'=> $selector->page --}} 
    {!!  $articlesController->Articles[ucfirst($selector->article)][$selector->page]['body']   !!}  
</div>
<div class="clearfix"></div>
</div>
</div>
</div>