<div class="pedidos view">
<h2><?php  echo __('Pedido'); ?></h2>
	<dl>
		<dt><?php echo __('Id:'); ?></dt>
		<dd>
			<?php echo h($pedido['Pedido']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Criado:'); ?></dt>
		<dd>
			<?php echo h($pedido['Pedido']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('OS:'); ?></dt>
		<dd>
			<?php if (!empty($pedido['Pedido']['os'])): ?>
                        <?php echo $pedido['Pedido']['os']; ?>
                        <?php else: ?>
                        <?php echo $pedido['Pedido']['entradapedido_id']; ?>
                        <?php endif; ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Atualizado:'); ?></dt>
		<dd>
			<?php echo h($pedido['Pedido']['updated']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Resposta CMS:'); ?></dt>
		<dd>
			<?php echo h($pedido['Pedido']['payload']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Prioridade:'); ?></dt>
		<dd>
			<?php echo h($pedido['Pedido']['prioridade']); ?>
			&nbsp;
		</dd>
		
		
		<dt><?php echo __('Cliente:'); ?></dt>
		<dd>
			<?php echo $this->Html->link($pedido['Cliente']['nome'], array('controller' => 'clientes', 'action' => 'view', $pedido['Cliente']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Solicitante:'); ?></dt>
		<dd>
			<?php echo $pedido['Entradapedido']['nome'] ?>
			&nbsp;
		</dd>
                <dt><?php echo __('OBS Solicitante:'); ?></dt>
		<dd>
			<?php echo $pedido['Entradapedido']['obs'] ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Status:'); ?></dt>
		<dd>
			<?php echo $pedido['Status']['nome'] ?>
			&nbsp;
		</dd>
                <dt><?php echo __('Obs interna:'); ?></dt>
		<dd>
			<?php echo h($pedido['Pedido']['obs']); ?>
			&nbsp;
		</dd>
                <?php if(!empty($pedido['Erro'])):?>
                    <dt><?php echo "."; ?> </dt>
                    <dd>
                        <h3>Erros de envio </h3>
                    </dd>
                    <?php foreach ($pedido['Erro'] as $erros): ?>
                
                            <dt><?php echo __('Data:'); ?></dt>
                            <dd>
                                    <?php echo $erros['created'] ?>
                                    &nbsp;
                            </dd>
                            <dt><?php echo __('Código:'); ?></dt>
                            <dd>
                                    <?php echo $erros['codigo'] ?>
                                    &nbsp;
                            </dd>
                            <dt><?php echo __('Mensagem:'); ?></dt>
                            <dd>
                                    <?php echo h($erros['mensagem']); ?>
                                    &nbsp;
                            </dd>
                            <dt><?php echo ".  .  ."; ?></dt>
                            <dd>
                                    <?php echo ".  .  ."; ?>
                                    
                            </dd>
                            <?php endforeach; ?>

                            <dt><?php echo ".  .  ."; ?></dt>
                            <dd>
                                    <?php echo ".  .  ."; ?>
                                    
                            </dd>
                            <dt> <?php echo "." ?> </dt>
                            <dd>
                                
                                 <?php echo $this->Form->create('Pedido', array("action"=>"finaliza_pedido"));?>  
                                    <?php echo $this->Form->input('pedido_id',array('type'=>'hidden', 'name'=>'pedido_id', 'value'=>$pedido['Pedido']['id'])); ?>

                                    <?php echo $this->Form->submit("Enviar CMS"); ?>

                                    <?php echo $this->form->end(); ?>  
                            </dd>
                            
                            
                 <?php endif; ?>
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
