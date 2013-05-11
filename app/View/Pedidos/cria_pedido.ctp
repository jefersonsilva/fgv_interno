<?php
/**
 * 
 * Author: Jeferson Silva
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       Cake.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
?>


<?php echo $this->Form->create("Pedido",array("action"=>"add_pedido") ) ?>
<?php echo $this->Form->input('os', array('size'=>'8', 'label'=> 'Número do Pedido' )); ?>
<?php echo $this->Form->input('status',array('type'=>'hidden', 'name'=>"data[Pedido][status_id]", 'value'=>"1")); ?>
<?php echo $this->Form->input('status_updated',array('type'=>'hidden', 'name'=>"data[Pedido][status_updated]", 'value'=>date('Y-m-d H:i:s'))); ?>
<?php echo $this->Form->input('Clientes', array('name'=>"data[Pedido][cliente_id]", 'type' => 'select', 'options' => $clientes)); ?>

<?php echo $this->Form->submit("Criar"); ?>

<?php echo $this->form->end(); ?>