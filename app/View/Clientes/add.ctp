<div class="clientes form">
<?php echo $this->Form->create('Cliente'); ?>
	<fieldset>
		<legend><?php echo __('Add Cliente'); ?></legend>
	<?php
		echo $this->Form->input('nome');
		echo $this->Form->input('street');
		echo $this->Form->input('complemente');
		echo $this->Form->input('city');
		echo $this->Form->input('state');
		echo $this->Form->input('zipcode');
		echo $this->Form->input('country');
		echo $this->Form->input('cms_client_code');
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
