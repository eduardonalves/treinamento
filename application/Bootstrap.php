<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{

	protected $_docRoot;
	
	protected function _initPath()
	{
		$this->_docRoot = realpath(APPLICATION_PATH . '/../');
		Zend_Registry::set('docRoot', $this->_docRoot);
	}

	protected function _initLoaderResource()
	{
	/*	$resourceLoader = new Zend_Loader_Autoloader_Resource(array(
				'basePath' => $this->_docRoot . '/application',
				'namespace' => 'Saffron'
			));
		$resourceLoader->addResourceTypes(array(
			'model' => array(
				'namespace' => 'Model',
				'path' => 'models'
			),
			'form' => array(
				'namespace' => 'Form',
				'path' => $this->_docRoot . '/application/library/Zend/Form'
			)
		));*/
		require_once "Zend/Loader/Autoloader.php";
		$autoloader = Zend_Loader_Autoloader::getInstance( );
		$autoloader->setFallbackAutoloader( true );	
		
	}

	protected function _initLog()
	{
		$writer = new Zend_Log_Writer_Stream(APPLICATION_PATH . '/../data/logs/error.log');
		return new Zend_Log($writer);
	}

	protected function _initView()
	{
		$view = new Zend_View();
		return $view;
	}
	
	public function _initDbAdapter() {
		$resource = $this->getPluginResource('multidb');
        $resource->init();
        $db1 = $resource->getDb('db1');
        Zend_Registry::set( "db1", $db1 );
		
	}

}