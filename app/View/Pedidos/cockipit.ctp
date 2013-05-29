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

<?php //var_dump($this->Time); ?>
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
                <th id="status-cockpit">
                     Status <br>
                         
                            <ul>
                                <li id="recebido">
                                    Recebido    
                                </li>
                                <li id="baixado">
                                    Baixado
                                </li>
                                <li id="enviado">
                                    Enviado
                                </li>
                                <li id="cancelado">
                                    Cancelado
                                </li>
                          </ul>
                       
                    
                </th>

                <th>
                     <a href="listar/Entradapedido.prazo_estimado" > Prazo</a>
                </th>
                <th>
                    <a href="listar/Pedido.prioridade" > Prazo Solicitado</a> 
                </th>
                <th>
                    Ações
                </th>

            </tr>
            <?php foreach($pedidos as $pedido): ?>
            <tr>

                <td>
                    

                        <?php echo $pedido['Entradapedido']['id'] ?>
                   
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
                              
                            
                            
                            <?php switch ($pedido['Pedido']['status_id']): 
                                
                            case 1: ?>
                            
                            <td><div class="data-status status_atual"> <?php echo  date("d/m-H:i", strtotime($pedido['Entradapedido']['created']));   ?> </div></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <?php break; ?>
                            <?php case 2: ?>
                            
                            <td><div class="data-status status_passados"> <?php echo  date("d/m-H:i", strtotime($pedido['Historico'][0]['data']));   ?> </div></td>
                            <td><div class="data-status status_atual"> <?php echo  date("d/m-H:i", strtotime($pedido['Pedido']['status_updated']));   ?> </div></td>
                            <td></td>
                            <td></td>
                            <?php break; ?>
                            
                            <?php case 3: ?>
                                <td><div class="data-status status_passados"> <?php echo  date("d/m-H:i", strtotime($pedido['Historico'][0]['data']));   ?> </div></td>
                                <td><div class="data-status status_passados"> <?php echo  date("d/m-H:i", strtotime($pedido['Historico'][1]['data']));   ?> </div></td>
                                <td><div class="data-status status_atual"> <?php echo  date("d/m-H:i", strtotime($pedido['Pedido']['status_updated']));   ?> </div></td>
                                <td></td>
                            <?php break; ?>
                                
                            <?php case 0: ?>
                                <td>
                                    <div class="data-status status_passados"> 
                                        <?php if(!empty($pedido['Historico'][0]['data'])): ?>
                                            <?php echo  date("d/m-H:i", strtotime($pedido['Historico'][0]['data']));   ?>
                                        <?php else: ?>
                                            -
                                        <?php endif;?>
                                            
                                    </div>
                                </td>
                                <td>
                                    <div class="data-status status_passados"> 
                                        <?php if(!empty($pedido['Historico'][1]['data'])): ?>
                                            <?php echo  date("d/m-H:i", strtotime($pedido['Historico'][1]['data']));   ?> 
                                        <?php else: ?>
                                            -
                                        <?php  endif; ?>
                                    </div>
                                </td>
                                <td>-</td>
                                <td><div class="data-status status_cancelado"> <?php echo  date("d/m-H:i", strtotime($pedido['Pedido']['status_updated']));   ?> </div></td>
                            <?php break; ?>
                                
                                
                            <?php endswitch; ?>
                            
                              
                          
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
                                <a href="#" class="inative"> Baixar</a>
                            <?php endif; ?>

                            <?php if(!empty($pedido['Pedido']['os'])):  ?>    
                                <?php echo $this->Html->link('Enviar', array('controller'=>'Pedidos', 'action'=>'enviar',$pedido['Pedido']['id'])) ?>

                            <?php else: ?>
                                <a href="#" class="inative"> Enviar</a>
                            <?php endif; ?>
                            <?php echo $this->Html->link('Cancelar', '/Pedidos/cancelar/'.$pedido['Pedido']['id'].'?height=400&width=450' ,array( 'class' => 'thickbox' ) )?>  
                     <?php break; ?>

                     <?php case 2: //baixado ?>
                                <a href="#" class="inative"> Baixar</a>
                                <?php echo $this->Html->link('Enviar', array('controller'=>'Pedidos', 'action'=>'enviar',$pedido['Pedido']['id'])) ?>

                            <?php echo $this->Html->link('Cancelar', '/Pedidos/cancelar/'.$pedido['Pedido']['id'].'?height=400&width=450' ,array( 'class' => 'thickbox' ) )?>  
                     <?php break; ?>

                      <?php case 3:  //enviado?>
                            <a href="#" class="inative" > baixar</a>
                            <a href="#" class="inative"> Enviar</a>
                            <a href="#" class="inative"> Cancelar</a>
                     <?php break; ?>

                      <?php case 4:  //finalizado?>
                            <div class="status_passados">Pedido já finalizado</div>
                     <?php break; ?>

                     <?php case 0:  //cancelado?>
                           <a href="#" class="inative"> baixar</a>
                            <a href="#" class="inative"> Enviar</a>
                            <a href="#" class="inative"> Cancelar</a>
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
