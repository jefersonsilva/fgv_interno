<div class="produtos index">
	<h2><?php echo __('Produtos'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('nome'); ?></th>
			<th><?php echo $this->Paginator->sort('codigo','Código CMS'); ?></th>
			<th><?php echo $this->Paginator->sort('cartaovisita', 'Cartão de Visitas'); ?></th>
			<th><?php echo $this->Paginator->sort('quantidade_minima_pagina', 'Quantidade mínima de páginas'); ?></th>
			<th><?php echo $this->Paginator->sort('quantidade_maxima_pagina', 'Quantidade máxima de páginas'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($produtos as $produto): ?>
	<tr>
		<td><?php echo h($produto['Produto']['id']); ?>&nbsp;</td>
		<td><?php echo h($produto['Produto']['nome']); ?>&nbsp;</td>
		<td><?php echo h($produto['Produto']['codigo']); ?>&nbsp;</td>
		<?php if(empty($produto['Produto']['cartaovisita'])): ?>
                    <td>Não</td>
                <?php else: ?>
                    <td>Sim</td>
                <?php endif; ?>
		<td><?php echo h($produto['Produto']['quantidade_minima_pagina']); ?>&nbsp;</td>
		<td><?php echo h($produto['Produto']['quantidade_maxima_pagina']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $produto['Produto']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $produto['Produto']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $produto['Produto']['id']), null, __('Realmente deseja apagar # %s?', $produto['Produto']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Página {:page} de {:pages}, total de {:count} produtos')
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
		<li><?php echo $this->Html->link(__('Novo Produto'), array('action' => 'add')); ?></li>
		
	</ul>
</div>
