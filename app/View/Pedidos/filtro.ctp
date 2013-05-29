
<h2>Selecione um status</h2>
<?php echo $this->Form->create("Pedido",array("action"=>"cockipit") ) ?>
<?php $lista_status = array(null=>'Escolha um Status',  '1'=>'Recebido','2'=>'Baixado', '3'=>'Enviado', '0'=>'Cancelado'); ?>
<?php echo $this->Form->input('Status', array('type'=> 'select', 'label'=>'Não notificar o Cliente', 'options'=>$lista_status, 'required'=>true)); ?>
<?php echo $this->Form->submit("Buscar"); ?>
<?php echo $this->Form->end(); ?>