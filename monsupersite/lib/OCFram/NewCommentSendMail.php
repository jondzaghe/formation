<?php
namespace OCFram;

class NewCommentSendMail extends SendMail{

	protected $contenu;


	public function sendMail(){

		foreach($this->mails AS $mail){
			//mail($mail, 'New Comment', $contenu);
			echo "Envoie du mail à ". $mail;
			exit;
		}
	}


	public function setContenu($contenu){
		$this->contenu = $contenu;
	}


}
  