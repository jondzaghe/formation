<?php
namespace OCFram;

abstract class SendMail{

	use Hydrator;

	protected $mails = array();

	public function __construct(array $options = []){

	    if (!empty($options)){
	      	$this->hydrate($options);
	    }
  	}


  	/**
  	 * SEND THE MAILS
  	 * @return [type] [description]
  	 */
  	abstract public function sendMail();


  	public function setMails(array $mails){

    foreach ($mails as $mail){
        $this->mails[] = $mail;
    }
  }
}