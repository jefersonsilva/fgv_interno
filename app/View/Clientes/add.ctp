<div class="clientes form">
<?php echo $this->Form->create('Cliente'); ?>
	<fieldset>
		<legend><?php echo __('Add Cliente'); ?></legend>
	<?php
		echo $this->Form->input('nome');
		echo $this->Form->input('street', array('label'=>'Rua'));
		echo $this->Form->input('complemente', array('label'=>'Complemento'));
		echo $this->Form->input('city', array('label'=>'Cidade'));
		echo $this->Form->input('state', array('label'=>'Estado'));
		echo $this->Form->input('zipcode', array('label'=>'Cep'));
		echo $this->Form->input('country', array('label'=>'País'));
		echo $this->Form->input('cms_client_code', array('label'=>'Código CMS do cliente'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Listar Clientes'), array('action' => 'index')); ?></li>
		
	</ul>
</div>
