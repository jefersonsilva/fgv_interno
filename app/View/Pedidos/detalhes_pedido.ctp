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



<h2>
    Ordem de serviço: <?php echo $OS['Pedido']['os'] ?>
</h2>


<table>
    
    
    
    <th>
        Nome Capa
    </th>
    <th>
        Nome Miolo
    </th>
    <th>
        Páginas
    </th>
    <th>
        Quantidade
    </th>
    <th>
        Formato
    </th>
    <?php foreach($itens_pedido as $itens): ?>
    <tr>
        <td>
            <?php echo $itens['Item']['name_capa'] ?>
        </td>
        <td>
            <?php echo $itens['Item']['name_miolo'] ?>
        </td>
        <td>
            <?php echo $itens['Item']['paginas'] ?>
        </td>
        <td>
            <?php echo $itens['Item']['quantidade'] ?>
        </td>
        <td>
            <?php echo $itens['Produto']['nome'] ?>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
