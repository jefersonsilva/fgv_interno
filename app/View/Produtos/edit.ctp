<div class="produtos form">
<?php echo $this->Form->create('Produto'); ?>
	<fieldset>
		<legend><?php echo __('Editar Produto'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('nome');
		echo $this->Form->input('codigo');
		echo $this->Form->input('cartaovisita');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Produto.id')), null, __('Tem certeza que deseja apagar o  # %s?', $this->Form->value('Produto.id'))); ?></li>
		<li><?php echo $this->Html->link(__('Listar Produtos'), array('action' => 'index')); ?></li>
		
	</ul>
</div>
