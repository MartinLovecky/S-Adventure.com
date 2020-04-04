<?php

namespace starproject\tools;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

class Mailer extends PHPMailer{

    public $_paswword = "!",$_email = "respect9888@gmail.com";

    public function subject($subject)
    {
      $this->Subject = $subject;
    }
    
    public function body($body)
    {
      $this->Body = $body;
    }
    
    public function send()
    {
      $this->AltBody = strip_tags(stripslashes($this->Body))."\n\n";
      $this->AltBody = str_replace("&nbsp;", "\n\n", $this->AltBody);
      return parent::send();
    }

}
?>