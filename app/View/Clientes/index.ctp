<div class="clientes index">
	<h2><?php echo __('Clientes'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('Nome'); ?></th>
			<th><?php echo $this->Paginator->sort('Rua'); ?></th>
			<th><?php echo $this->Paginator->sort('Complemento'); ?></th>
			<th><?php echo $this->Paginator->sort('Cidade'); ?></th>
			<th><?php echo $this->Paginator->sort('Estado'); ?></th>
			<th><?php echo $this->Paginator->sort('Cep'); ?></th>
			<th><?php echo $this->Paginator->sort('País'); ?></th>
			<th><?php echo $this->Paginator->sort('Código CMS do cliente'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($clientes as $cliente): ?>
	<tr>
		<td><?php echo h($cliente['Cliente']['id']); ?>&nbsp;</td>
		<td><?php echo h($cliente['Cliente']['nome']); ?>&nbsp;</td>
		<td><?php echo h($cliente['Cliente']['street']); ?>&nbsp;</td>
		<td><?php echo h($cliente['Cliente']['complemente']); ?>&nbsp;</td>
		<td><?php echo h($cliente['Cliente']['city']); ?>&nbsp;</td>
		<td><?php echo h($cliente['Cliente']['state']); ?>&nbsp;</td>
		<td><?php echo h($cliente['Cliente']['zipcode']); ?>&nbsp;</td>
		<td><?php echo h($cliente['Cliente']['country']); ?>&nbsp;</td>
		<td><?php echo h($cliente['Cliente']['cms_client_code']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $cliente['Cliente']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $cliente['Cliente']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $cliente['Cliente']['id']), null, __('Tem certeza que deseja apagar o  # %s?', $cliente['Cliente']['nome'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Página {:page} de {:pages}, mostrando {:current} linhas do total de {:count} , começando na linha {:start}, e terminando na linha {:end}')
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
		<li><?php echo $this->Html->link(__('Novo Cliente'), array('action' => 'add')); ?></li>
		
	</ul>
</div>
