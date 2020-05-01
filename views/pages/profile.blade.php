@include('layouts.app')
<div class="col-xl-12 offset-xl-0" id="main">
    <div class="container">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a><span>Permition: </span></a></li>
            <li class="breadcrumb-item"><a><span><a href="#">Záložka</a></span></a></li>
            <li class="breadcrumb-item"><a><span><a href="#?action=edituser">Upravit účet</a></span></a></li>
            <li class="breadcrumb-item"><a><span><a href="/logout">Odhlášení</a></span></a></li>
        </ol>
        @include('extras.messages',['requestController'=>$requestController,'selector'=>$selector,'message'=>$message])
    </div>
</div>
<div class="col-xl-6 text-center">
    <h3>YourName</h3><img src="#" class="img-fluid" />
</div>
@if(isset($_GET['action']) && $_GET['action'] == 'edituser')

@endif
<div class="col-xl-6 offset-xl-0 text-left">
    <h3>Informace o vás</h3>
    <p>Jméno:#</p>
    <p>Příjmení:#</p>
    <p>Datum narození:#</p>
    <p>Město:#</p>
    <p>Viditelný: public/private</p>
</div>

<div class="col" style="margin-bottom: 100px;"></div>
@can('update', Model::class)
    
@endcan