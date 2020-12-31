<?php

namespace starproject\tools;

use \PHPMailer\PHPMailer\PHPMailer;
use \PHPMailer\PHPMailer\Exception;
use \PHPMailer\PHPMailer\SMTP;

class Mailer extends PHPMailer{

    public $_password = 'e48cf3bac0900b695dd25e3c64ab417b',$_email = 'sadventure534@gmail.com';

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
      //!DONT FORGET insert $data inside template 
      if($string === 'register-email'){
        require(DIR.'/views/extras/'.$string.'.php');
          return $body;
      }
      if($string === 'pwd-reset-email'){
        require(DIR.'/views/extras/'.$string.'.php'); 
          return $body;
      }
    }

    public function builder(array $build){
      // all $build need be setup !!!!
      $this->IsSMTP();
      $this->Body = $build['body'];
      $this->Host = 'smtp.gmail.com';
      $this->SMTPDebug = 2;
      $this->CharSet = 'UTF-8';
      $this->SMTPAuth = true;
      $this->Username = $this->_email; 
      $this->Password = $this->_password; 
      $this->SMTPSecure = "tls";
      $this->Port = 587;
      $this->subject($build['subject']);
      $this->isHTML(true);
      $this->setFrom("noreply@sadventure.com","sadventure.com");
      $this->addAddress($build['to']);
      $this->addAttachment("public/images/attachment/help.png");
        return $this;
    }
}
?>