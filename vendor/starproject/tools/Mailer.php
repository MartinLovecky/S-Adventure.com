<?php

namespace starproject\tools;

use \PHPMailer\PHPMailer\SMTP;
use \PHPMailer\PHPMailer\Exception;
use \PHPMailer\PHPMailer\PHPMailer;

class Mailer extends PHPMailer{

  public $_email = 'staradvanture.suport@email.cz';

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
   
    public function builder($body,$sendInfo){
      $this->IsSMTP();
      $this->body($body);
      $this->Host = 'smtp.seznam.cz';
      $this->SMTPDebug = true;
      $this->CharSet = 'UTF-8';
      $this->SMTPAuth = true;
      $this->Username = $this->_email; //change
      $this->Password = file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/test/notShared.php');
      $this->SMTPSecure = "ssl";
      $this->Port = 465;
      $this->subject($sendInfo['subject']);
      $this->isHTML(true);
      $this->setFrom("staradvanture.suport@email.cz","sadventure.com");
      $this->addAddress($sendInfo['to']); // aka 'to'
      $this->addAttachment("public/images/attachment/help.png");
        return parent::send();
    }
}
?>