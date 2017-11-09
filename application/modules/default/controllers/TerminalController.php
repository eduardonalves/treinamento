<?php

class TerminalController extends Zend_Controller_Action
{
	protected $_terninal;
	public function init( )
	{
		$this->_terninal = new Application_Model_DbTable_Ligacao();
		$messages = $this->_helper->flashMessenger->getMessages();
		if(!empty($messages))
		$this->_helper->layout->getView()->message = $messages[0];
	}
	
	public function addAction()
	{
		$flashMessenger = $this->_helper->getHelper('FlashMessenger');
		$this->view->flashmsgs = $flashMessenger->getMessages(); 
		
		$this->_helper->layout->setLayout( 'default' );
		
		$formAddTerminal = new Application_Form_Ligacao();
		
		$formAddTerminal->setAction( 'salvar' )->setMethod( 'post' )->setName( '$formAddTerminal' );
	//	$formAddTerminal->setElementDecorators( array( 'ViewHelper', array( 'Label', array( 'requiredSuffix'=>'*','tag'=>'dt' ) ) ) );
		$formAddTerminal->setDecorators( array( array( 'viewScript', array( 'viewScript' => '/terminal/templates/tplAddTerminal.phtml' ) ) ) );
		$this->view->formAddTerminal =  $formAddTerminal; 
		//$this->view->headTitle('Hello World');
	}
	public function salvarAction()
	{
		$params = $this->_request->getParams();
		
		$data = array(
			'terminal' => $params['terminal'],
			'data_inicio'=> $params['data_inicio'],
			'data_fim'=> $params['data_fim']
		);
		
		if($this->_terninal->save($data))
		{
			$this->_helper->flashMessenger('Login is success');
			$this->redirect('/default/terminal/add/');	
		}
		
		
	}

}