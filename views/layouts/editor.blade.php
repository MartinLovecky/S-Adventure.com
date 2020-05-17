<body>
<div class="col-xl-12 offset-xl-0" id="main">
    <div id="section2">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="http://sadventure.com/index"><span>Domů</span></a></li>
                <li class="breadcrumb-item"><a href="http://sadventure.com/member/"><span>Profil</span></a></li>
                <li class="breadcrumb-item"><a href="http://sadventure.com/create"><span>Create</span></a></li>
                <li class="breadcrumb-item"><a href="http://sadventure.com/update"><span>Update</span></a></li>
                <li class="breadcrumb-item"><a href="http://sadventure.com/delete"><span>Delete</span></a></li>
                <li class="breadcrumb-item"><a href="http://sadventure.com/show/allwin/1"><span>Allwin</span></a></li>
                <li class="breadcrumb-item"><a href="http://sadventure.com/show/samuel/1"><span>Samuel</span></a></li>
                <li class="breadcrumb-item"><a href="http://sadventure.com/show/isama/1"><span>Isama</span></a></li>
                <li class="breadcrumb-item"><a href="http://sadventure.com/show/isamaNH/1"><span>Nový horizont</span></a></li>
                <li class="breadcrumb-item"><a href="http://sadventure.com/show/isamaNW/1"><span>Nový svět</span></a></li>
            </ol>
            {!! $hform->create(['target'=>['app.ArticleHandler',['request'=>$request,'blade'=>$blade]],'method'=>'POST','class'=>'text-center'])->open($blade)!!}
            <textarea name="content" id="editor">
                &lt;p&gt;This is some sample content.&lt;/p&gt;
            </textarea>
            <input type="hidden" name="type" value='register'>   
		    {!! $hform->close() !!}
            <script>
                ClassicEditor
                    .create( document.querySelector( '#editor' ) )
                    .catch( error => {
                        console.error( error );
                    } );
            </script>
                <hr/>
                <button class="btn btn-success btn-block" name="submit" type="submit" value="submit">Odeslat na server</button>
                <p> * Pro vykonání jakékoliv akce je nutné klinout na Odeslat na server nestačí pouze změnit url a dát ENTRER !!!!!</p>
            </form>
        </div>
    </div>
</div>
</body>
</html>   
