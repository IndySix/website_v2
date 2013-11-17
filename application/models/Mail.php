<?php if (!defined('__SITE_PATH')) exit('No direct script access allowed');

class Model_Mail extends Core_Model{

        function register($email, $username, $validateToken){
                $this->load->library('Mail');
                $message = "Hello!\n\n";
                $message .= "Your Beat the King account has been created. Your username is $username.\n\n";
                $message .= "To verify your email address please click this link below.\n";
                $message .= baseUrl("user/validateEmail/".$validateToken)."\n\n";
                $message .= "If you lost your password! reset your password with this link (Only works if you validate your email).\n";
                $message .= baseUrl("user/passwordReset/".$email)."\n\n";
                $message .= "If you did not initiate this request, you may safely ignore this message.";
                
                $this->LibMail->addTo($email);
                $this->LibMail->setSubject('Account created');
                $this->LibMail->setMessage($message);
                $this->LibMail->send();
        }

        function emailValidate($email, $validateToken) {
                $this->load->library('Mail');
                $message = "Hello!\n\n";
                $message .= "This email was sent to validate your email address on your Beat the King account.\n\n";
                $message .= "To verify your email address please click this link below.\n";
                $message .= baseUrl("user/validateEmail/".$validateToken)."\n\n";
                $message .= "If you did not initiate this request, you may safely ignore this message.";

                $this->LibMail->addTo($email);
                $this->LibMail->setSubject('Email validation');
                $this->LibMail->setMessage($message);
                $this->LibMail->send();
        }
}