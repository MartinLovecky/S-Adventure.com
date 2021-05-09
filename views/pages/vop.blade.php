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

