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

<?php 
//trecho de código abaixo para converter array do php em formato js
 
        $array_js = "[";
        foreach($lista_cv as $cv)
        {
            $array_js .= "'".$cv. "',";
        }
        
        $array_js .= "]"
 ?>

<h2>Pedido Numero 
<?php if(empty( $pedido_os['Pedido']['entradapedido_id'])):  ?>
    <?php echo $pedido_os['Pedido']['os'] ?>
<?php else: ?>
    <?php echo $pedido_os['Pedido']['entradapedido_id'] ?>
<?php endif; ?>
</h2>


<?php if(!empty($itens_pedido)): ?>

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
        Codigo
    </th>
    <th>
        Quantidade
    </th>
    <th>
        Formato
    </th>
   
    <th>
        Excluir
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
            <?php echo $itens['Produto']['codigo'] ?>
        </td>
        <td>
            <?php echo $itens['Item']['quantidade'] ?>
        </td>
        <td>
            <?php echo $itens['Produto']['nome'] ?>
        </td>
        
        <td>
            
            <a href="deleta_item/<?php echo $itens['Item']['id'] ?>">X</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>

<?php endif; ?>


 <?php echo $this->Form->create('Item', array('type'=>'file', "action"=>"insere_item"));?>  

  <fieldset>

  <legend><?php __('Add Item no pedido'); ?></legend>

  
  <?php echo $this->Form->input('Formato', array('name'=>'produto_id','onchange'=>"cv_ou_livro($array_js)", 'type' => 'select', 'options' => $produtos)); ?>
  
  <?php echo $this->Form->input('url_miolo', array('type'=>'file')); ?>
  <div id="ItemUrlCapa">
    <?php echo $this->Form->input('url_capa', array('type'=>'file', 'id'=>'url_capa')); ?>
  </div>
  <?php echo $this->Form->input('quantidade'); ?>
  <?php echo $this->Form->input('paginas'); ?>
  <?php echo $this->Form->input('pedido_id',array('type'=>'hidden', 'name'=>'pedido_id', 'value'=>$pedido_id)); ?>
  

</fieldset>

<?php echo $this->Form->submit("Incluir Item"); ?>

<?php echo $this->form->end(); ?>

 <?php echo $this->Form->create('Pedido', array("action"=>"finaliza_pedido"));?>  
<?php echo $this->Form->input('pedido_id',array('type'=>'hidden', 'name'=>'pedido_id', 'value'=>$pedido_id)); ?>

<?php echo $this->Form->submit("Finalizar Pedido"); ?>

<?php echo $this->form->end(); ?>