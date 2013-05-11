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

<div id="esconde_menu"></div>

 <script>
$(function() {
$( "#datepicker" ).datepicker({ dateFormat: 'dd-mm-yy' }).val();
});
</script>

<?php echo $this->Form->create("Pedido",array("action"=>"prioridade") ) ?>
<?php echo $this->Form->input('Prioridade', array('name'=>'prioridade','size'=>'8', 'id'=>'datepicker')); ?>
<?php echo $this->Form->input('id', array('name'=>'id','size'=>'8', 'type'=>'hidden', 'value'=>$id )); ?>
<?php echo $this->Form->submit("Inserir"); ?>
<?php echo $this->Form->end(); ?>

