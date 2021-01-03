@empty($selector->queryAction)
	{!! '<h3 class="text-center">'.ucfirst($selector->viewname()).'</h3>' !!}
@endempty
@if (!empty($selector->queryAction))
	{!!	 $message->_getAction($selector->queryAction)	!!}
@endif
{{-- validation msg --}}
@isset($selector->message)
	{!!	$selector->message	!!}
@endisset