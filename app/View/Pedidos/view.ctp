<div class="pedidos view">
<h2><?php  echo __('Pedido'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($pedido['Pedido']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($pedido['Pedido']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Os'); ?></dt>
		<dd>
			<?php echo h($pedido['Pedido']['os']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Updated'); ?></dt>
		<dd>
			<?php echo h($pedido['Pedido']['updated']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Payload'); ?></dt>
		<dd>
			<?php echo h($pedido['Pedido']['payload']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Prioridade'); ?></dt>
		<dd>
			<?php echo h($pedido['Pedido']['prioridade']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Baixado'); ?></dt>
		<dd>
			<?php echo h($pedido['Pedido']['baixado']); ?>
			&nbsp;
		</dd>
		
		<dt><?php echo __('Cliente'); ?></dt>
		<dd>
			<?php echo $this->Html->link($pedido['Cliente']['nome'], array('controller' => 'clientes', 'action' => 'view', $pedido['Cliente']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Entradapedido'); ?></dt>
		<dd>
			<?php echo $this->Html->link($pedido['Entradapedido']['nome'], array('controller' => 'entradapedidos', 'action' => 'view', $pedido['Entradapedido']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Status'); ?></dt>
		<dd>
			<?php echo $this->Html->link($pedido['Status']['nome'], array('controller' => 'statuses', 'action' => 'view', $pedido['Status']['id'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
	
		
		<li><?php echo $this->Html->link(__('Listar Pedidos'), array('action' => 'listar')); ?> </li>
		
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Items Relacionados'); ?></h3>
	<?php if (!empty($pedido['Item'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Name Capa'); ?></th>
		<th><?php echo __('Name Miolo'); ?></th>
		<th><?php echo __('Urlcapa'); ?></th>
		<th><?php echo __('Urlmiolo'); ?></th>
		<th><?php echo __('Paginas'); ?></th>
		<th><?php echo __('Quantidade'); ?></th>
		<th><?php echo __('Pedido Id'); ?></th>
		<th><?php echo __('Produto Id'); ?></th>
		
	</tr>
	<?php
		$i = 0;
		foreach ($pedido['Item'] as $item): ?>
		<tr>
			<td><?php echo $item['id']; ?></td>
			<td><?php echo $item['name_capa']; ?></td>
			<td><?php echo $item['name_miolo']; ?></td>
			<td><?php echo $item['urlcapa']; ?></td>
			<td><?php echo $item['urlmiolo']; ?></td>
			<td><?php echo $item['paginas']; ?></td>
			<td><?php echo $item['quantidade']; ?></td>
			<td><?php echo $item['pedido_id']; ?></td>
			<td><?php echo $item['produto_id']; ?></td>
			
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	
</div>
