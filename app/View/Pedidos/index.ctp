<div class="pedidos index">
	<h2><?php echo __('Pedidos'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('os'); ?></th>
			<th><?php echo $this->Paginator->sort('updated'); ?></th>
			<th><?php echo $this->Paginator->sort('payload'); ?></th>
			<th><?php echo $this->Paginator->sort('prioridade'); ?></th>
			<th><?php echo $this->Paginator->sort('baixado'); ?></th>
			<th><?php echo $this->Paginator->sort('historico_status'); ?></th>
			<th><?php echo $this->Paginator->sort('cliente_id'); ?></th>
			<th><?php echo $this->Paginator->sort('entradapedido_id'); ?></th>
			<th><?php echo $this->Paginator->sort('status_id'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($pedidos as $pedido): ?>
	<tr>
		<td><?php echo h($pedido['Pedido']['id']); ?>&nbsp;</td>
		<td><?php echo h($pedido['Pedido']['created']); ?>&nbsp;</td>
		<td><?php echo h($pedido['Pedido']['os']); ?>&nbsp;</td>
		<td><?php echo h($pedido['Pedido']['updated']); ?>&nbsp;</td>
		<td><?php echo h($pedido['Pedido']['payload']); ?>&nbsp;</td>
		<td><?php echo h($pedido['Pedido']['prioridade']); ?>&nbsp;</td>
		<td><?php echo h($pedido['Pedido']['baixado']); ?>&nbsp;</td>
		<td><?php echo h($pedido['Pedido']['historico_status']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($pedido['Cliente']['id'], array('controller' => 'clientes', 'action' => 'view', $pedido['Cliente']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($pedido['Entradapedido']['id'], array('controller' => 'entradapedidos', 'action' => 'view', $pedido['Entradapedido']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($pedido['Status']['id'], array('controller' => 'statuses', 'action' => 'view', $pedido['Status']['id'])); ?>
		</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $pedido['Pedido']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $pedido['Pedido']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $pedido['Pedido']['id']), null, __('Are you sure you want to delete # %s?', $pedido['Pedido']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Pedido'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Clientes'), array('controller' => 'clientes', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Cliente'), array('controller' => 'clientes', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Statuses'), array('controller' => 'statuses', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Status'), array('controller' => 'statuses', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Entradapedidos'), array('controller' => 'entradapedidos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Entradapedido'), array('controller' => 'entradapedidos', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Items'), array('controller' => 'items', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Item'), array('controller' => 'items', 'action' => 'add')); ?> </li>
	</ul>
</div>
