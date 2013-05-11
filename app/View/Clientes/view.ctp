<div class="clientes view">
<h2><?php  echo __('Cliente'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($cliente['Cliente']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Nome'); ?></dt>
		<dd>
			<?php echo h($cliente['Cliente']['nome']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Street'); ?></dt>
		<dd>
			<?php echo h($cliente['Cliente']['street']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Complemente'); ?></dt>
		<dd>
			<?php echo h($cliente['Cliente']['complemente']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('City'); ?></dt>
		<dd>
			<?php echo h($cliente['Cliente']['city']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('State'); ?></dt>
		<dd>
			<?php echo h($cliente['Cliente']['state']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Zipcode'); ?></dt>
		<dd>
			<?php echo h($cliente['Cliente']['zipcode']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Country'); ?></dt>
		<dd>
			<?php echo h($cliente['Cliente']['country']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Cms Client Code'); ?></dt>
		<dd>
			<?php echo h($cliente['Cliente']['cms_client_code']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Editar Cliente'), array('action' => 'edit', $cliente['Cliente']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Deletar Cliente'), array('action' => 'delete', $cliente['Cliente']['id']), null, __('Are you sure you want to delete # %s?', $cliente['Cliente']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Listar Clientes'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Novo Cliente'), array('action' => 'add')); ?> </li>
		
	</ul>
</div>

