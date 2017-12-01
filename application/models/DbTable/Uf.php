<?php
class Application_Model_DbTable_Uf extends Zend_Db_Table_Abstract
{
	protected $_db;
	protected $_name;
	protected $_primary;
	protected $_where='';
	protected $_order='';
	protected $_select='';
	
	public function init(){
	 	$this->_db		= Zend_Registry::get("db1");
		$this->_schema	= "treinamento";
		$this->_name	= 'ufs';
		$this->_primary	= 'id';
		$this->_schemaName	= $this->_schema . '.' . $this->_name;	
	}
	public function save($params= array()){
		if(isset($params['id']))
		{
			$this->update($params,'id='.$params['id']);		
		}else{
			$this->insert($params);	
		}
		
		return true;
	}
	public function deleteRow($params= array()){
		
		if($this->delete('id='.$params['id']))
		{
					return true;
		}else{
			return false;
		}
	
	}
	public function getList($params = array())
	{
		$this->_select = $this->_db->select( );
		
		$this->_select->from( array( "u" => "ufs" ),
					   array( "u.id","u.uf") );
		
		if(isset($params['id']))
		{
			if($params['id']!='')
			{
				$this->_select->where("u.id = ?", $params['id']);
			}
		}
		
		$this->_select->order('u.id DESC');
  	
		if(isset($params['row']))
		{
			return $this->_db->fetchRow( $this->_select );
		}else if(isset($params['pairs']))
		{
			return $this->_db->fetchPairs( $this->_select );
		}else if(isset($params['page']))
		{
			$paginator = Zend_Paginator::factory($this->_select);
			$paginator->setCurrentPageNumber($params['page']);
			return $paginator;
		}else
		{
			return $this->_db->fetchAll( $this->_select );
		}
	
	}
}




