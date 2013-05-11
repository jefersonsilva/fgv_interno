<?php
App::uses('AppModel', 'Model');
/**
 * Pedido Model
 *
 * @property Cliente $Cliente
 * @property Entradapedido $Entradapedido
 * @property Status $Status
 * @property Item $Item
 */
class Pedido extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	
	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Cliente' => array(
			'className' => 'Cliente',
			'foreignKey' => 'cliente_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Entradapedido' => array(
			'className' => 'Entradapedido',
			'foreignKey' => 'entradapedido_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Status' => array(
			'className' => 'Status',
			'foreignKey' => 'status_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Item' => array(
			'className' => 'Item',
			'foreignKey' => 'pedido_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		), 'Historico'
	);

}
