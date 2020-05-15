<?php

namespace starproject\tools;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

class Mailer extends PHPMailer{

    private $_paswword = "!",$_email = "/";

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
      //
      //require(DIR.'/public/templates/'.$string.'.php');
    }

    public function builder(array $build){
      // all need be setup !!!!
      $this->Body = $build['body'];
      $this->Host = 'smtp.gmail.com';
      $this->SMTPDebug = 2;
      $this->CharSet = 'UTF-8';
      $this->SMTPAuth = true;
      $this->Username = $this->_email; 
      $this->Password = $this->_paswword; 
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