<?php

class Item extends AppModel{
    
    public $useTable = 'items';
    
    public $belongsTo = array("Pedido","Produto");
    
    
    public $validate = array(
        'quantidade'=> array(
                    'rule' => 'numeric',
                    'message'=> 'deve ser um valor numérico'
        ),
        'paginas'=>array(
                    'rule' => 'numeric',
                    'message' => 'deve ser um numero'
                    
        ),
        'urlmiolo'=>array(
                    'rule'=> 'notEmpty',
                    'message' => 'Nao pode ser vazio'
        )
        
    );
    
}


?>
