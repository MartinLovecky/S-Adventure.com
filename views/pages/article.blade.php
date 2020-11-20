@include('layouts.app')
<div class="container-fluid" id="text">
<div class="row">
<div class="col-lg-10 col-lg-offset-1 col-md-12">
<div class="text">
    {{-- !permission check -> redirect with msg --}}
    {{-- if($articleController[$selector->article] == $selector->allowedArticle) --}}
    {{-- foreach($articleController->all as $article) ! dont use --}}
    {{-- isset($articleController['MainNadpis']) h3 --}}
      
    {{-- 'Isama' => $selector-article, '1'=> $selector->page --}} 
    {!!  $articlesController->Articles[ucfirst($selector->article)][$selector->page]['body']   !!}  
<nav class="d-xl-flex justify-content-xl-center align-items-xl-center" id="wp_pagnation">
    <ul class="pagination">
        {!!  $wrapper->prev_page()   !!}
        {!!  $wrapper->main_pagnation()  !!}
        {!!  $wrapper->next_page()  !!}
    </ul>
</nav>
</div>
<div class="clearfix"></div>
</div>
</div>
</div>