<?php

class ItensController extends AppController{
    
    //public $scaffold;
    public $uses= array('Pedido','Produto', 'Item');
    var $components = array('Upload');
    
    public function add_item(){
        
        $params = array('fields' =>array('Produto.id','Produto.nome'),'order'=>array('Produto.nome'=>'asc')); 
        $params_pedido = array('fields' =>array('Pedido.os','Pedido.entradapedido_id'), 'conditions' =>array('Pedido.id'=>$this->Session->read('pedido_id') )); 
        $this->set('produtos',$this->Produto->find('list',$params) );    
        $this->set('pedido_id', $this->Session->read('pedido_id'));
        $this->set('pedido_os', $this->Pedido->find('first',$params_pedido));
        $params_itens_pedido= array('fields'=>array('Item.id','Item.name_capa','Item.name_miolo','Item.paginas','Item.quantidade','Produto.nome', 'Produto.cartaovisita', 'Produto.codigo'), 'conditions'=>array('Item.pedido_id'=>$this->Session->read('pedido_id')));
        $params_cv = array('filds'=>array('Produto.id'),'conditions'=>array('Produto.cartaovisita'=> true));
        $this->set('lista_cv', $this->Produto->find('list',$params_cv));
        $this->set('itens_pedido', $this->Item->find('all',$params_itens_pedido) );
    }
    public function insere_item(){
        
        
    
    if (!empty($this->data)) {

        $path_completo = APP.'webroot'.DS.'files'.DS . $this->Session->read('pedido_id');
        
  
        if(empty($this->data['Item']['url_miolo']['tmp_name'])) {

            $this->Session->setFlash(__('É preciso enviar o miolo referente ao trabalho',true));

            return false;

        }
        
        
                
        $path = $this->cria_pasta_pedido($path_completo);
        
        
       

        $this->Upload->setPath($path);
        
        
        $codigo_cms = $this->Produto->read('cartaovisita', $this->data['produto_id']);
        
      // exit(0);
        
       // var_dump( $codigo_cms);
      
     if(!$codigo_cms['Produto']['cartaovisita']){
         
   
       if(empty($this->data['Item']['url_capa']['tmp_name'])) {

            $this->Session->setFlash(__('É preciso enviar o capa referente ao trabalho',true));

            return false;

        }
        
        
        
        $novo_arquivo = $this->Upload->copyUploadedFile($this->data['Item']['url_capa'], '');
//
// echo "<br><br><br><br>".$novo_arquivo;
// exit(0);

        //grava dados do arquivo no banco de dados
        $this->request->data['Item']['pedido_id'] = $this->data['pedido_id'];
        $this->request->data['Item']['name_capa'] = $novo_arquivo;
        $this->request->data['Item']['urlcapa'] = "http://fgv.singulardigital.com.br/fgv_interno/app/webroot/files/".$this->Session->read('pedido_id') . "/".$novo_arquivo;

        //$this->request->data['Item']['url_capa']['file_name'] = $novo_arquivo;

        $this->request->data['Item']['url_capa']['file_size'] = number_format($this->data['Item']['url_capa']['size']/1024, 2) . " KB";

        $this->request->data['Item']['url_capa']['type'] = $this->data['Item']['url_capa']['type'];
        
     }
        
        
        
        
        $novo_arquivo = $this->Upload->copyUploadedFile($this->data['Item']['url_miolo'], '');



        //grava dados do arquivo no banco de dados
        $this->request->data['Item']['pedido_id'] = $this->data['pedido_id'];
        $this->request->data['Item']['produto_id'] = $this->data['produto_id'];
        $this->request->data['Item']['name_miolo'] = $novo_arquivo;
        $this->request->data['Item']['urlmiolo'] = "http://fgv.singulardigital.com.br/fgv_interno/app/webroot/files/".$this->Session->read('pedido_id') . "/".$novo_arquivo;

        $this->request->data['Item']['url_miolo']['file_name'] = $novo_arquivo;

        $this->request->data['Item']['url_miolo']['file_size'] = number_format($this->data['Item']['urlmiolo']['size']/1024, 2) . " KB";

        $this->request->data['Item']['url_miolo']['type'] = $this->data['Item']['urlmiolo']['type'];



        if ($this->Item->save($this->data)) { //salva o trabalho



            $this->Session->setFlash(__('Item Inserido com sucesso.', true));

            $this->redirect(array('controller' => 'itens', 'action' => 'add_item'));

        } else {

            $this->Session->setFlash(__('Desculpe. O trabalho não pode ser salvo. Tente novamente.', true));

        }

     }//fecha if - formulario enviado
    }
    
    public function finaliza_pedido(){
        
        
        
        
        
        }
    
     private function cria_pasta_pedido($path){
      
     
      if(!is_dir($path)){
          umask(0);
          mkdir($path,0777,true);
         
          return  $path;
          
      }else{
          return  $path;
          
      }
      
      
  }
  
  public function deleta_item($id_item){
      
      if($this->Item->delete($id_item)){
          $this->Session->setFlash(__('Item removido com sucesso.', true));
         $this->redirect(array('controller' => 'itens', 'action' => 'add_item'));
      }else{
          $this->Session->setFlash(__('Impossível apagar item.', false));
      }
      
  }
  
  function formato_cartao(){
      
  }
    

  
 
  
}
?>
