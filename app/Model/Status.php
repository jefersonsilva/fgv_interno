<?php


class Status extends AppModel{
    
    public $hasMany = array("Pedido");
    public $useTable = 'status';
}

?>
