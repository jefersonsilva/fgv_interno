<div class="produtos form">
<?php echo $this->Form->create('Produto'); ?>
	<fieldset>
		<legend><?php echo __('Adicionar Produto'); ?></legend>
	<?php
		echo $this->Form->input('nome', array('size'=>'70'));
		echo $this->Form->input('codigo', array('size'=>'6', 'label'=>'Código CMS'));
		echo $this->Form->input('cartaovisita', array('label'=>'Cartão de visitas?'));
		echo $this->Form->input('quantidade_minima_pagina', array('size'=>'5', 'label'=>'Quantidade mínima de páginas'));
		echo $this->Form->input('quantidade_maxima_pagina', array('size'=>'5', 'label'=>'Quantidade máxima de páginas'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Cadastrar')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Listar Produtos'), array('action' => 'index')); ?></li>
		
	</ul>
</div>
