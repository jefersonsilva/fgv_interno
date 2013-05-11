<?php

class ItemsController extends AppController{
    
    public $scaffold;
    public $uses= array('Pedido','Produto', 'Item');
    var $components = array('Upload');
    
    public function add_item(){
        
        $params = array('fields' =>array('Produto.id','Produto.nome')); 
        $this->set('produtos',$this->Produto->find('list',$params) );    
        $this->set('pedido_id', $this->Session->read('pedido_id'));
        $this->set('pedido_os', $this->Session->read('pedido_os'));
        $params_itens_pedido= array('fields'=>array('Item.id','Item.name_capa','Item.name_miolo','Item.paginas','Item.quantidade','Produto.nome'), 'conditions'=>array('Item.pedido_id'=>$this->Session->read('pedido_id')));
        
        $this->set('itens_pedido', $this->Item->find('all',$params_itens_pedido) );
    }
    public function insere_item(){
        
        
    
    //var_dump($this->data);
    
    
    
     if (!empty($this->data)) {


        if(empty($this->data['Item']['url_capa']['tmp_name'])) {

            $this->Session->setFlash(__('É preciso enviar o arquivo referente ao trabalho',true));

            return false;

        }
        if(empty($this->data['Item']['url_miolo']['tmp_name'])) {

            $this->Session->setFlash(__('É preciso enviar o arquivo referente ao trabalho',true));

            return false;

        }

        $path = $this->cria_pasta_pedido("files". "/".$this->Session->read('pedido_id'));


        $this->Upload->setPath($path);
        
         
        var_dump($this->data);
        
        
        $novo_arquivo = $this->Upload->copyUploadedFile($this->data['Item']['url_capa'], '');
//
//        echo "<br><br><br><br>".$novo_arquivo;
//        exit(0);

        //grava dados do arquivo no banco de dados
        $this->request->data['Item']['pedido_id'] = $this->data['pedido_id'];
        $this->request->data['Item']['produto_id'] = $this->data['produto_id'];
        $this->request->data['Item']['name_capa'] = $novo_arquivo;
        $this->request->data['Item']['urlcapa'] = "http://lajedo.singulardigital.com.br/fgv_interno/app/webroot/".$path . "/".$novo_arquivo;

        //$this->request->data['Item']['url_capa']['file_name'] = $novo_arquivo;

        $this->request->data['Item']['url_capa']['file_size'] = number_format($this->data['Item']['url_capa']['size']/1024, 2) . " KB";

        $this->request->data['Item']['url_capa']['type'] = $this->data['Item']['url_capa']['type'];
        
        
        
        
        
        
        $novo_arquivo = $this->Upload->copyUploadedFile($this->data['Item']['url_miolo'], '');



        //grava dados do arquivo no banco de dados
        $this->request->data['Item']['pedido_id'] = $this->data['pedido_id'];
        $this->request->data['Item']['name_miolo'] = $novo_arquivo;
        $this->request->data['Item']['urlmiolo'] = "http://lajedo.singulardigital.com.br/fgv_interno/app/webroot/". $path . "/".$novo_arquivo;

        $this->request->data['Item']['url_miolo']['file_name'] = $novo_arquivo;

        $this->request->data['Item']['url_miolo']['file_size'] = number_format($this->data['Item']['urlmiolo']['size']/1024, 2) . " KB";

        $this->request->data['Item']['url_miolo']['type'] = $this->data['Item']['urlmiolo']['type'];



        if ($this->Item->save($this->data)) { //salva o trabalho



            $this->Session->setFlash(__('Arquivo enviado com sucesso.', true));

            $this->redirect(array('controller' => 'items', 'action' => 'add_item'));

        } else {

            $this->Session->setFlash(__('Desculpe. O trabalho não pode ser salvo. Tente novamente.', true));

        }

     }//fecha if - formulario enviado
    }
    
    public function finaliza_pedido(){
        
        
        
        
        
        }
    
     private function cria_pasta_pedido($path){
      
      
      
      if(!is_dir($path)){
          mkdir('files/'.$this->Session->read('pedido_id'));
          
          return  'files/'.$this->Session->read('pedido_id');
          
      }else{
          return  'files/'.$this->Session->read('pedido_id');
          
      }
      
      
  }
  
  public function deleta_item($id_item){
      
      if($this->Item->delete($id_item)){
          $this->Session->setFlash(__('Item removido com sucesso.', true));
         $this->redirect(array('controller' => 'items', 'action' => 'add_item'));
      }else{
          $this->Session->setFlash(__('Impossível apagar item.', false));
      }
      
  }
    
        
}
?>
