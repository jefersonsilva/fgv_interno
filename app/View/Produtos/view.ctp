<div class="produtos view">
<h2><?php  echo __('Produto'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($produto['Produto']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Nome'); ?></dt>
		<dd>
			<?php echo h($produto['Produto']['nome']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Código CMS'); ?></dt>
		<dd>
			<?php echo h($produto['Produto']['codigo']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Cartão de visitas'); ?></dt>
		<dd>
                    
                <?php if(empty($produto['Produto']['cartaovisita'])): ?>
                    Não
                <?php else: ?>
                    Sim
                <?php endif; ?>
		</dd>
		<dt><?php echo __('Quantidade Mínima Pagina'); ?></dt>
		<dd>
			<?php echo h($produto['Produto']['quantidade_minima_pagina']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Quantidade Máxima Pagina'); ?></dt>
		<dd>
			<?php echo h($produto['Produto']['quantidade_maxima_pagina']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Editar Produto'), array('action' => 'edit', $produto['Produto']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Deletar Produto'), array('action' => 'delete', $produto['Produto']['id']), null, __('Are you sure you want to delete # %s?', $produto['Produto']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Listar Produtos'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Novo Produto'), array('action' => 'add')); ?> </li>
		
	</ul>
</div>

