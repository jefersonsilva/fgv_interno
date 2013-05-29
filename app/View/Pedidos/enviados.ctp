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
                    Resposta CMS
                </th>

               
                <th>
                    Data
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
                    <?php echo $pedido['Pedido']['payload'] ?>
                </td>
                
                <td >
                        <?php echo $pedido['Pedido']['status_updated'] ?>
                    
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
