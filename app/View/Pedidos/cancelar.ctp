
<h2>Por favor, digite o motivo do cancelamento</h2>
<?php echo $this->Form->create("Pedido",array("action"=>"cancelar") ) ?>
<?php echo $this->Form->input('obs', array('name'=>"data[Pedido][obs]" ,'size'=>'8')); ?>
<?php echo $this->Form->input('os', array('name'=>"data[Pedido][os]" ,'size'=>'8', 'type'=>'hidden', 'value'=>$id)); ?>
<?php echo $this->Form->input('id', array('name'=>"data[Pedido][id]",'size'=>'8', 'type'=>'hidden', 'value'=>$id )); ?>
<?php echo $this->Form->input('status_id', array('name'=>"data[Pedido][status_id]" ,'size'=>'8', 'type'=>'hidden', 'value'=>0 )); ?>
<?php echo $this->Form->input('status_updated',array('type'=>'hidden', 'name'=>"data[Pedido][status_updated]", 'value'=>date('Y-m-d H:i:s'))); ?>
<?php echo $this->Form->submit("Cancelar Pedido"); ?>
<?php echo $this->Form->end(); ?>