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



<div id="header">			
    <nav id="menu">
        <?php echo $this->Html->link($this->Html->image('home.jpg'),'/pages/home', array('target' => '_parent', 'escape' => false));?>
        <?php echo $this->Html->link($this->Html->image('admin.jpg'),'/pages/como_usar', array('target' => '_parent', 'escape' => false));?>
        <?php echo $this->Html->link($this->Html->image('enviar_pedido.jpg'),'/pedidos/cria_pedido', array('target' => '_parent', 'escape' => false));?>
        <?php echo $this->Html->link($this->Html->image('listar.jpg'),'/pedidos/listar', array('target' => '_parent', 'escape' => false));?>
        <?php echo $this->Html->link($this->Html->image('filtro.jpg'),'/pedidos/filtro'.'?height=200&width=350' , array('escape' => false, 'class' => 'thickbox'));?>            
    </nav>
</div>