<?php

class TerminalController extends Zend_Controller_Action
{
	protected $_terninal;
	protected $_uf;
	public function init( )
	{
		$this->_terninal = new Application_Model_DbTable_Ligacao();
		$this->_uf = new Application_Model_DbTable_Uf();
		$messages = $this->_helper->flashMessenger->getMessages();
		if(!empty($messages))
		$this->_helper->layout->getView()->message = $messages[0];
	}
	public function indexAction(){
		$this->_helper->layout->setLayout( 'nolayout' );
		ini_set('display_errors', 1);
		ini_set('display_startup_errors', 1);
		error_reporting(E_ALL);
		
		
		$params = array();
		$params = $this->_request->getParams();
		
		if(!isset($params['page'])){
			$params['page']= 1;	
		}
		$this->view->paginator =  $this->_terninal->getList($params);
	}
	public function addAction()
	{
		
		$this->_helper->layout->setLayout( 'nolayout' );
		
		$formAddTerminal = new Application_Form_Ligacao();
		
		$formAddTerminal->setAction( 'salvar' )->setMethod( 'post' )->setName( '$formAddTerminal' );
		$ufs = $this->_uf->getList(array('pairs'=>true));
		$ufs['']='-- Selecione --';
		asort($ufs);
		$formAddTerminal->uf_id->setMultiOptions($ufs);
		$formAddTerminal->setDecorators( array( array( 'viewScript', array( 'viewScript' => '/terminal/templates/tplAddTerminal.phtml' ) ) ) );
		
		$this->view->formAddTerminal =  $formAddTerminal; 
		
	}
	public function editAction()
	{
		
		$this->_helper->layout->setLayout( 'nolayout' );
		
		$terminal = $this->_terninal->getList(array('id'=>$this->_getParam('id'), 'row'=> true));
		
		$formEditTerminal = new Application_Form_Ligacao();
		
		$formEditTerminal->id->setValue($terminal['id']);
		
		$formEditTerminal->terminal->setValue($terminal['terminal']);
		
		$formEditTerminal->data_inicio->setValue($terminal['data_inicio']);
		
		$formEditTerminal->data_fim->setValue($terminal['data_fim']);
		
		$ufs = $this->_uf->getList(array('pairs'=>true));
		$ufs['']='-- Selecione --';
		asort($ufs);
		
	
		$formEditTerminal->uf_id->setMultiOptions($ufs);
		
		$formEditTerminal->uf_id->setValue($terminal['uf_id']);
		
		
		$formEditTerminal->setAction( 'salvar' )->setMethod( 'post' )->setName( '$formEditTerminal' );
		
		$formEditTerminal->setDecorators( array( array( 'viewScript', array( 'viewScript' => '/terminal/templates/tplEditTerminal.phtml' ) ) ) );
		
		$this->view->formEditTerminal =  $formEditTerminal;
		
	}
	public function viewAction()
	{
		$this->_helper->layout->setLayout( 'nolayout' );
		
		$terminal = $this->_terninal->getList(array('id'=>$this->_getParam('id'), 'row'=> true));
		$this->view->terminal = $terminal; 	
	}
	public function salvarAction()
	{
		ini_set('display_errors', 1);
		ini_set('display_startup_errors', 1);
		error_reporting(E_ALL);
		
		$params = $this->_request->getParams();
		
		$data = array(
			'terminal' => $params['terminal'],
			'data_inicio'=> $params['data_inicio'],
			'data_fim'=> $params['data_fim'],
			'uf_id'=> $params['uf_id'],
		);
		if(isset($params['id'])){
			$data['id'] = $params['id'];
		}
		
		if($this->_terninal->save($data))
		{
			$this->_helper->json->sendJson("sucesso");	
		}else
		{
			$this->_helper->json->sendJson("erro");
		}
		
	}
	
	public function deleteAction()
	{
		ini_set('display_errors', 1);
		ini_set('display_startup_errors', 1);
		error_reporting(E_ALL);
		
		$params = $this->_request->getParams();
		
		if(isset($params['id'])){
			$data['id'] = $params['id'];
		}
		
		if($this->_terninal->deleteRow($data))
		{
			$this->_helper->json->sendJson("sucesso");	
		}else
		{
			$this->_helper->json->sendJson("erro");
		}
		
	}

}