<?php

namespace starproject\tools;

use \PHPMailer\PHPMailer\SMTP;
use \PHPMailer\PHPMailer\Exception;
use \PHPMailer\PHPMailer\PHPMailer;

class Mailer extends PHPMailer{

    public $_password = 'vayudu48',$_email = 'staradvanture.suport@email.cz';

    public function subject($subject){
      $this->Subject = $subject;
    }
    
    public function body($body){
      $this->Body = $body;
    }
    
    public function send(){
      $this->AltBody = strip_tags(stripslashes($this->Body))."\n\n";
      $this->AltBody = str_replace("&nbsp;", "\n\n", $this->AltBody);
      return parent::send();
    }

    public function template(string $string,array $data){
      $body = include(DIR.'/views/extras/'.$string.'.php');
        return $body;
    }

    public function builder(array $build){
      // all $build need be setup !!!!
      $this->IsSMTP();
      $this->Body = $build['body'];
      $this->Host = 'smtp.seznam.cz';
      $this->SMTPDebug = false;
      $this->CharSet = 'UTF-8';
      $this->SMTPAuth = true;
      $this->Username = $this->_email; 
      $this->Password = $this->_password; 
      $this->SMTPSecure = "ssl";
      $this->Port = 465;
      $this->subject($build['subject']);
      $this->isHTML(true);
      $this->setFrom("staradvanture.suport@email.cz","sadventure.com");
      $this->addAddress($build['to']);
      $this->addAttachment("public/images/attachment/help.png");
        return $this;
    }
}
?>