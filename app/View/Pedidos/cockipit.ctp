<?php
/**
 * 
 * Author: Jeferson Silva
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       Cake.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
?>
    <script type=text/javascript>//setTimeout('document.location=document.location',2000);</script>  

<div >
        <table>
            <tr>

                <th>
                   <a href="listar/Pedido.os" > OS</a> 
                </th>

                <th>
                    <a href="listar/Entradapedido.nome" > Solicitante</a> 

                </th>
                <th>
                   <a href="listar/Cliente.nome" > Cliente</a>  
                </th>
                <th>
                    <a href="listar/Status.nome" > Status</a> 
                </th>

                <th>
                     <a href="listar/Entradapedido.prazo_estimado" > Prazo</a>
                </th>
                <th>
                    <a href="listar/Pedido.prioridade" > Prioridade</a> 
                </th>
                <th>
                    Ações
                </th>

            </tr>
            <?php foreach($pedidos as $pedido): ?>
            <tr>

                <td>
                    <?php //logica para exibir numero da OS caso seja criado interno ?>
                    <?php if(!empty($pedido['Entradapedido']['id'])):?>

                        <?php echo $pedido['Entradapedido']['id'] ?>
                    <?php else: ?>
                        <?php echo $pedido['Pedido']['os'] ?>
                    <?php endif; ?>
                </td>
                <td>
                    <?php echo $pedido['Entradapedido']['nome'] ?>

                </td>


                <td>
                    <?php echo $pedido['Cliente']['nome'] ?>
                </td>

                <td>
                    <?php /**  a tabela a baixo é pra exibição de  status no formato horizontal. Tá meio confuso mas vou tentar explicar o máximo possivel */ ?>
                   <table id="table_status">

                      <tr>

                          <?php /* A lógica abaixo consiste no seguinte: se o status for diferente de recebido, exibe histórico, e o status atual. senao exibe o recebido */ ?>

                            <?php if($pedido['Status']['nome'] == "Recebido"): ?>
                          <?php /* lógica complexa e estranha para exibir o status recebido, tanto quando vindo de clientes quando feito internamente   */?>
                          <td> <?php echo $pedido['Status']['nome'] . "<br>"; $status_pedido_recebido = (empty($pedido['Entradapedido']['created'])? $pedido['Pedido']['created']: $pedido['Entradapedido']['created']); echo  str_replace(" ", "<br>", $status_pedido_recebido) ?>
                            <?php else: ?>

                                    <div class="status_passados">
                                        <?php foreach($pedido['Historico'] as $hist):?>
                                    </div>

                                    <td>
                                        <div class="status_passados">
                                            <?php echo  $hist['nome'] ."<br>".str_replace(" ", "<br>", $hist['data']) ?>
                                        </div>
                                    </td>

                                        <?php endforeach;?>     
                                    <td>
                                        <?php echo $pedido['Status']['nome']."<br>". str_replace(" ", "<br>", $pedido['Pedido']['status_updated'])  ?> 
                                    </td>

                            <?php endif; ?>
                     </tr>
                   </table>
                </td>

                <td>
                    <?php echo $pedido['Entradapedido']['prazo_estimado'] ?>
                </td>
                <td class="actions">
                    <?php if(empty( $pedido['Pedido']['prioridade'] )):?>


                          <?php echo $this->Html->link('Inserir', '/Pedidos/prioridade/'.$pedido['Pedido']['id'].'?height=400&width=450' ,array( 'class' => 'thickbox' ) )?>
                    <?php else: ?>
                             <?php echo $pedido['Pedido']['prioridade'] ?>
                    <?php  endif; ?>
                </td>
                <td class="actions">
                    <?php echo $this->Html->link('Detalhes', array('controller'=>'Pedidos', 'action'=>'view',$pedido['Pedido']['id'])) ?>






                    <?php switch ($pedido['Pedido']['status_id']):   
                      case 1:  ?>
                            <?php /** lógica criada para nao permitir que baixe arquivos de pedidos montados internamente  */ ?>
                            <?php if(!empty($pedido['Entradapedido']['id'] )): ?>
                                <?php echo $this->Html->link('Baixar', array('controller'=>'Pedidos', 'action'=>'baixar',$pedido['Entradapedido']['id'])) ?>
                            <?php else: ?>
                                <a href="#" > baixar</a>
                            <?php endif; ?>

                            <?php if(!empty($pedido['Pedido']['os'])):  ?>    
                                <?php echo $this->Html->link('Enviar', array('controller'=>'Pedidos', 'action'=>'enviar',$pedido['Pedido']['id'])) ?>

                            <?php else: ?>
                                <a href="#" > enviar</a>
                            <?php endif; ?>
                            <?php echo $this->Html->link('Cancelar', '/Pedidos/cancelar/'.$pedido['Pedido']['id'].'?height=400&width=450' ,array( 'class' => 'thickbox' ) )?>  
                     <?php break; ?>

                     <?php case 2: //baixado ?>
                                <?php echo $this->Html->link('Enviar', array('controller'=>'Pedidos', 'action'=>'enviar',$pedido['Pedido']['id'])) ?>

                            <?php echo $this->Html->link('Cancelar', '/Pedidos/cancelar/'.$pedido['Pedido']['id'].'?height=400&width=450' ,array( 'class' => 'thickbox' ) )?>  
                     <?php break; ?>

                      <?php case 3:  //enviado?>
                            <div class="status_passados">Pedido já enviado</div>
                     <?php break; ?>

                      <?php case 4:  //finalizado?>
                            <div class="status_passados">Pedido já finalizado</div>
                     <?php break; ?>

                     <?php case 0:  //cancelado?>
                           <div class="status_passados">Pedido cancelado</div>
                     <?php break; ?>


                    <?php endswitch; ?>




                </td>

            </tr>
            <?php    endforeach; ?>

        </table>
</div>
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
