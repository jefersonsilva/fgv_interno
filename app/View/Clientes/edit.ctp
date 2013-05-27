<div class="clientes form">
<?php echo $this->Form->create('Cliente'); ?>
	<fieldset>
		<legend><?php echo __('Edit Cliente'); ?></legend>
	<?php
		echo $this->Form->input('id');
                echo $this->Form->input('nome', array('size'=>'40'));
		echo $this->Form->input('street', array('label'=>'Rua, número (ex: xxxxx, 000) ','size'=>'40'));
		echo $this->Form->input('complemente', array('label'=>'Complemento','size'=>'40'));
		echo $this->Form->input('city', array('label'=>'Cidade'));
		echo $this->Form->input('state', array('label'=>'Estado', 'size'=>'2'));
		echo $this->Form->input('zipcode', array('label'=>'Cep','size'=>'9'));
		echo $this->Form->input('country', array('label'=>'País','size'=>'7'));
		echo $this->Form->input('cms_client_code', array('label'=>'Código CMS do cliente','size'=>'5'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Cliente.id')), null, __('Tem certeza que deseja apagar # %s?', $this->Form->value('Cliente.id'))); ?></li>
		<li><?php echo $this->Html->link(__('Listar Clientes'), array('action' => 'index')); ?></li>
		
	</ul>
</div>
