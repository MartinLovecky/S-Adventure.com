<?php
    // Step 0 check if member-rember is set
    if($login && $request['remeber'] == 'yes'){
        if(!$member->remember){
            // Step 1 create key put inside db if chceckbox is checked
            $key = \hash_hmac('sha256',$request['username'].'-'.date('Y-m-d'),'bef5e396e084922a5dc7da12491bd243');
            // paste inside db 
            $stmt = $this->_db->insertInto('members')->values(['remember'=>$key])->where('username',$request['username'])->execute();
            $this->_db->close();
            // create cookie
            $cookie_name = 'user.remember';
            $cookie_time = \time() + (10 * 365 * 24 * 60 * 60);
            \setcookie($cookie_name,$key,$cookie_time,'/');
                Router::redirect('member/'.$request['username'].'?action=logged');
        }
        
        
    }

    if($login && $member->remember){
        $stmt = $this->_db->from('members')->where('username',$request['username']);        
        $memberDBHash = $stmt->fetch('remember');
        $validateHash = hash_equals($memberDBHash,$_COOKIE['user.remember']);
        
        $username = $_SESSION['username'];
        Router::redirect('member/'.$username.'?action=logged'); 
    }
    /*

    1) check if !remember if checked (yes) -> else

    a) frist use of remember (generate key store it and set coockie)
        ? $login = $validate($request) true / false (false->default)
    
    $member->remember = true / false  (false->default)

    
    */