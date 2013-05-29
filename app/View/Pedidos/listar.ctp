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
    
<script>
    
function carrega_pagina(){
        $(function(){
            $("#carregando").hide();
                pagina = "http://projetosdojef.com.br/fgv_interno/index.php/pedidos/cockipit";
                
                $("#carregando").ajaxStart(function(){
                    $(this).show();
                })
                $("#carregando").ajaxStop(function(){
                    $(this).hide();
                })
               $("#cockipit").load(pagina)

        })  
 }
 
 carrega_pagina();
 window.setInterval(carrega_pagina, 50000);
</script>
<?php echo $this->Html->image("ajax-loader.gif", array("id" => "carregando"))?>

<div id="cockipit">
    
    
</div>