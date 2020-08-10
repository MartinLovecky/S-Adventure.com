{{-- 

*************** Reader/Editor ********************************
1) Check permission -> default visit if logged (view,edit,all) 
2) Check if given Url is valid if not 404    
3) Url check /update/allwin/1?action=? (only for edit,all permission)
    *show only chceck permission 
    *update action = de95b43bceeb4b998aed4aed5cef1ae7 -> check if action & $query are same from url 
    *create action = 76ea0bebb3c22822b4f0dd9c9fd021c5
    *delete action = 099af53f601532dbd31e0ea99ffdeb64
4) includes corect files for correct actions  
5) errors messagess  
--}}
@php

    //include(DIR.MENU)
    //include(DIR.Messages)
 
@endphp

@use(\starproject\http\Router)

@if ($member->permission == 'visit' && $selector->queryAction != 'permission')

{{!!  Router::redirect('ultimate/allwin/1?action=permission')  !!}}

@endif

