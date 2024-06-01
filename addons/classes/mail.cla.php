<?php
class mail{
    public $p_receiver;
    public $p_subject;
    public $p_message;
    public $p_header; 
    
    public function send_mail(){
        return mail($this->p_receiver,$this->p_subject,$this->p_message,$this->p_header);
    }//end of send mail
}
?>