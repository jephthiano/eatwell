<?php
class paystack{
    private $init_url = "https://api.paystack.co/transaction/initialize";
    private $veri_url = "https://api.paystack.co/transaction/verify/";
    private $key = "sk_test_cff7519e0491bd39f8878c8c124b12e1f3330a1c";
    private $ch;
    private $result;
    private $err = false;
    
    public $reference;
    public $data;
    
    public function __construct($conn = ''){
        //OPEN CONNECTION
        $this->ch = curl_init();
    }
    
    public function __destruct(){
    	//CLOSES ALL CONNECTION
        if(is_resource($this->ch)){
            curl_close($this->ch); // close connection
        }
        
    }
    
    public function initialize_payment(){
		//SET THE URL,NUMBER OF POST VARS, POST DATA
		curl_setopt($this->ch,CURLOPT_URL, $this->init_url);
		curl_setopt($this->ch,CURLOPT_POST, true);
		//curl_setopt($ch,CURLOPT_SSL_VERIFYHOST, false);
		//curl_setopt($ch,CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($this->ch,CURLOPT_POSTFIELDS, $this->data);
		curl_setopt($this->ch, CURLOPT_HTTPHEADER, array("content-type: application/json","Authorization: Bearer {$this->key}","Cache-Control: no-cache",));
		curl_setopt($this->ch,CURLOPT_RETURNTRANSFER, true);// SO THAT CURL_EXEC RETURNS THE CONTENTS OF THE CURL; RATHER THAN ECHOING IT
		$this->result = curl_exec($this->ch); //EXECURE POST
		$this->err = curl_error($this->ch); // FOR CURL ERROR
        if($this->err){
            return false;
        }else{
            return $this->result;
        }
    }
    
    public function verify_payment(){
        //SET THE URL,NUMBER OF POST VARS, POST DATA
        curl_setopt_array($this->ch, array(
            CURLOPT_URL => $this->veri_url.$this->reference,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array("Authorization: Bearer {$this->key}","Cache-Control: no-cache",),
        ));
        $this->result = curl_exec($this->ch); //GETTING THE RSPONSE AND EXECUTING CURL
        $this->err = curl_error($this->ch); //CHECK FOR ERROR
        if($this->err){
            return false;
        }else{
            return $this->result;
        }
    }
}
?>