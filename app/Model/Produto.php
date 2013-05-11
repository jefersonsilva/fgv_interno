<?php
App::uses('AppModel', 'Model');
/**
 * Produto Model
 *
 * @property Item $Item
 */
class Produto extends AppModel {
    
    
    
    
    public $validate = array(
        'codigo' => array(
                   'isUnique'=>
                    array(
                        'rule' => 'isUnique',
                        'required' => true,
                        'allowEmpty' => false,
                        'message' => 'Este campo deve conter um valor numérico' 
                        )

                ),
        
        
    );


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Item' => array(
			'className' => 'Item',
			'foreignKey' => 'produto_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);

}
