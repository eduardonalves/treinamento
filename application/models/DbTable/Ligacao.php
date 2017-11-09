<?php
class Application_Model_DbTable_Ligacao extends Zend_Db_Table_Abstract
{
	protected $_db;
	protected $_name;
	protected $_primary;
	
	public function init(){
	 	$this->_db		= Zend_Registry::get("db1");
		$this->_schema	= "treinamento";
		$this->_name	= 'ligacoes';
		$this->_primary	= 'id';
		$this->_schemaName	= $this->_schema . '.' . $this->_name;	
	}
	public function save($params= array()){
		$select = "INSERT INTO ligacoes (terminal, data_inicio, data_fim)  values (?,?,?)";
		 $data = array($params['terminal'],$params['data_inicio'], $params['data_fim']);
		$this->_db->query($select, $data);	
		
		return true;
	}
}




