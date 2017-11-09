<?php

class Application_Form_Ligacao extends Zend_Form
{
	
	public $elementDecorators = array (
	    'ViewHelper',
    	'Label',
		'Errors'
    );

	public $elementDecoratorsBR = array(
        'ViewHelper',
        'Errors', 
        array(
            array(
                'data' => 'HtmlTag'
            )
        ),
        'Label'
    );

    public function init()
    {  
        $this->addElement (
			'hidden','id',
		    array(
		    	  'decorators' => $this->elementDecoratorsBR
		    )
	   	);
	   	
	   	$this->addElement (
			'text','terminal',
		    array(
		    	'size'=>'50',
		    	'label'      => 'Terminal',
				'style' => 'width=300',
		    	'required' => false,
				'decorators' => $this->elementDecoratorsBR
		    )
	   	);
	   	
	   	$this->addElement (
			'text','data_inicio',
		    array(
		    	'label'      => 'Data início',
		    	'size'=>'20',
				'style' => 'width=220',
		    	'required' => false,
				'decorators' => $this->elementDecoratorsBR
		    )
	   	);
	   	
	   	$this->addElement (
			'text','data_fim',
		    array(
		    	'label'      => 'Data Fim',
		    	'size'=>'20',
		    	
				'style' => 'width=220',
		    	'required' => false,
				'decorators' => $this->elementDecoratorsBR
		    )
	   	);
	   	
	   	$this->addElement (
			'select','cliente_id',
		    array(
		    	'size'=>'50',
				'style' => 'width=220',
		    	'required' => false,
		    	'validators' => array(
    				array('NotEmpty', true)
    			)
				
		    )
	   	);
	   //	$this->cliente_id->getValidator('NotEmpty')->setMessages(
        //	array(Zend_Validate_NotEmpty::IS_EMPTY => 'Favor preencher o campo!'));

    }
    
}