<?php
App::uses('AppController', 'Controller');
/**
 * Pedidos Controller
 *
 * @property Pedido $Pedido
 */

App::uses('CakeEmail', 'Network/Email'); 
class PedidosController extends AppController {

    public $uses= array('Cliente', 'Pedido','Item', 'Status', 'Entradapedido', 'Historico', 'Produto', 'Erro');
    var $components = array('Email');
/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Pedido->recursive = 0;
		$this->set('pedidos', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Pedido->exists($id)) {
			throw new NotFoundException(__('Invalid pedido'));
		}
		$options = array('conditions' => array('Pedido.' . $this->Pedido->primaryKey => $id));
		$this->set('pedido', $this->Pedido->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Pedido->create();
			if ($this->Pedido->save($this->request->data)) {
				$this->Session->setFlash(__('The pedido has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The pedido could not be saved. Please, try again.'));
			}
		}
		$clientes = $this->Pedido->Cliente->find('list');
		$statuses = $this->Pedido->Status->find('list');
		$entradapedidos = $this->Pedido->Entradapedido->find('list');
		$this->set(compact('clientes', 'statuses', 'entradapedidos'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Pedido->exists($id)) {
			throw new NotFoundException(__('Invalid pedido'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Pedido->save($this->request->data)) {
				$this->Session->setFlash(__('The pedido has been saved'));
				$this->redirect(array('action' => 'listar'));
			} else {
				$this->Session->setFlash(__('The pedido could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Pedido.' . $this->Pedido->primaryKey => $id));
			$this->request->data = $this->Pedido->find('first', $options);
		}
		$clientes = $this->Pedido->Cliente->find('list');
		$statuses = $this->Pedido->Status->find('list');
		$entradapedidos = $this->Pedido->Entradapedido->find('list');
		$this->set(compact('clientes', 'statuses', 'entradapedidos'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @throws MethodNotAllowedException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Pedido->id = $id;
		if (!$this->Pedido->exists()) {
			throw new NotFoundException(__('Invalid pedido'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Pedido->delete()) {
			$this->Session->setFlash(__('Pedido deleted'));
			$this->redirect(array('action' => 'listar'));
		}
		$this->Session->setFlash(__('Pedido was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
        
        
        
        
        
         public function cria_pedido(){
        
        $params = array('fields' =>array('Cliente.id','Cliente.nome'));
        
        $this->set('clientes',$this->Cliente->find('list',$params) );
        
    }
    
    public function add_pedido(){
        
        
        $isPost = $this->request->is('post');//Se √© um POST e recebemos dados do formul√°rio
        if($isPost && !empty($this->request->data)) 
        {//Tenta salvar os dados da inscri√ß√£o
            
            if($this->Pedido->save($this->request->data)) {
                
                //Registro inserido com sucesso!            
                $this->Session->write('pedido_id',$this->Pedido->id);
                $this->Session->write('pedido_os', $this->Pedido->read(array('os')));
                $this->redirect(array('controller' => 'itens', 'action' => 'add_item'));
            }
        } 
        
        
        
    }
    
    /**
     * 
     * @param type $parametro_ordenacao
     */
    
    public function cockipit($parametro_ordenacao ='Pedido.id'){
        
        $this->layout = 'empty';
        $params = array('limit'=>10, 'fields' =>array('Entradapedido.id', 'Entradapedido.nome','Entradapedido.created', 'Cliente.nome','Status.nome',
                                         'Pedido.status_id', 'Pedido.payload','Pedido.created','Pedido.id', 'Pedido.os','Pedido.status_updated',
                                         'Pedido.updated', 'Entradapedido.prazo_estimado', 'Pedido.prioridade'), 
                        'order' =>array($parametro_ordenacao=>'desc')
            );
        
        $this->paginate = $params;
        
        $lista_pedidos =  $this->paginate('Pedido');

        $this->set('pedidos',$this->paginate('Pedido') );
        
    }
    
    public function listar($parametro_ordenacao ='Pedido.id'){
        
        
        
    }
    
    
    public function detalhes_pedido($pedido_id){
        
        $params_itens_pedido= array('fields'=>array('Item.name_capa','Item.name_miolo','Item.paginas','Item.quantidade', 'Produto.nome'), 'conditions'=>array('Item.pedido_id'=>$pedido_id));
        $this->set('itens_pedido', $this->Item->find('all',$params_itens_pedido) );
        $this->Pedido->id = $pedido_id;
        $this->set('OS', $this->Pedido->read(array('entradapedido_id')));
        
    }
    
    
    /**
     * envio de pedido ao cms
     */
    
    function finaliza_pedido(){
        
        $pedido_id = $this->data['pedido_id'];
        
        
        $params_clientes= array('fields'=>array('Cliente.nome','Cliente.street',
                                                'Cliente.state','Cliente.complemente',
                                                'Cliente.city','Cliente.country','Cliente.cms_client_code',
                                                'Cliente.zipcode', 'Pedido.created','Entradapedido.id','Status.nome'),
            
                                'conditions'=>array(
                                                      'Pedido.id'=> $pedido_id));
   
        
        
        

        $clientes = $this->Pedido->find('first',$params_clientes) ;

        //$novo_post_cliente = "SING";    
        
        
        $data_saida =  $this->data_saida($pedido_id);
        //$novo_post_cliente = $clientes['Cliente']['cms_client_code'];    
        
        $params_itens_pedidos = array('fields'=>array('Item.urlcapa','Item.urlmiolo',
                                                      'Item.paginas','Item.quantidade',
                                                      'Produto.codigo'), 
                                      'conditions'=>array('Item.pedido_id'=>$pedido_id));
        
        $lista_itens_pedidos = $this->Item->find('all',$params_itens_pedidos) ;
        
        
        if(!empty($lista_itens_pedidos)){
        
   
        $montando_xml='<?xml version="1.0" encoding="ISO-8859-1"?>
                    <cXML xml:lang="en-US" version="1.2.005" payloadID="'.$pedido_id.'.1361983100142@sog.singulardigital.com.br"
                        timestamp="'.date("Y-m-dTH:i:s").'">
                        <Header>
                            <From>
                                <Credential domain="Singular">
                                    <Identity>Singular</Identity>
                                </Credential>
                            </From>
                            <To>
                                <Credential domain="Colorcentric">
                                    <Identity>Colorcentric</Identity>
                                </Credential>
                            </To>
                            <Sender>
                                <Credential domain="DUNS">
                                    <Identity>Singular</Identity>
                                    <SharedSecret>sho0752grer</SharedSecret>
                                </Credential>
                            </Sender>
                        </Header>
                        <Request deploymentMode="production">
                            <OrderRequest>
                                <OrderRequestHeader type="new" orderID="'.$pedido_id.'" orderDate="'.date("Y-m-dTH:i:s").'">
                                    <BillTo>
                                        <Address addressID="1">
                                            <Name xml:lang="en-US">Singular, LLC</Name>
                                            <PostalAddress name="Singular">
                                                <DeliverTo>Newton Neto</DeliverTo>
                                                <Street>RUA CAPITAO GUYNEMER</Street>
                                                <Street>QUADRA 20 LOTE 5 PARTE 6</Street>
                                                <City>Rio de Janeiro</City>
                                                <State>RJ</State>
                                                <PostalCode>25250000</PostalCode>
                                                <Country isoCountryCode="BR">BR</Country>
                                            </PostalAddress>
                                            <Phone>
                                                <TelephoneNumber>
                                                    <CountryCode isoCountryCode="BR">55</CountryCode>
                                                    <AreaOrCityCode>21</AreaOrCityCode>
                                                    <Number>36517477</Number>
                                                </TelephoneNumber>
                                            </Phone>
                                        </Address>
                                    </BillTo>
                                    <Shipping>
                                        <Money currency="USD"/>
                                        <Description xml:lang="en-US"/>
                                    </Shipping>
                                    <Tax>
                                        <Money currency="USD"/>
                                        <Description xml:lang="en-US"/>
                                    </Tax>
                                    <Comments xml:lang="en-US"/>
                                    <CustomerID>'.$clientes['Cliente']['cms_client_code'].'</CustomerID>
                                </OrderRequestHeader>';
        
   

                    $conta_linhas= 1;
                    foreach($lista_itens_pedidos as $itens){

                    $montando_xml .=' <ItemOut requestedDeliveryDate="'.$data_saida.'" lineNumber="'.$conta_linhas.'" quantity="1">
                    <ItemID>
                        <SupplierPartID>'.$itens['Produto']['codigo'].'</SupplierPartID>
                        <SupplierPartAuxiliaryID>Clients</SupplierPartAuxiliaryID>
                    </ItemID>
                    <ItemDetail>
                        <UnitPrice>
                            <Money currency="USD"/>
                        </UnitPrice>
                        <Description xml:lang="en-US">The Test Book of Tests</Description>
                        <UnitOfMeasure>EA</UnitOfMeasure>
                                            <Classification domain=""/>';
                                            //if($itens['Produto']['codigo']!="P2863" && $itens['Produto']['codigo']!="P2864")
                                            if(!$this->cartaovisita($itens['Produto']['codigo']))    
                                            {
                                            $montando_xml.='
                                            <URL>'.$itens['Item']['urlcapa'].'</URL>';
                                            }
                        $montando_xml.='
                        <URL>'.$itens['Item']['urlmiolo'].'</URL>
                        <Extrinsic name="quantityMultiplier">'.$itens['Item']['quantidade'].'</Extrinsic>
                        <Extrinsic name="Pages">'.$itens['Item']['paginas'].'</Extrinsic>
                        <Extrinsic name="endCustomerOrderID">105-3552447-8639424</Extrinsic>
                        <Extrinsic name="requestedShipper">ABACUS</Extrinsic>
                                    </ItemDetail>';

                                            $montando_xml.='
                                            <ShipTo>
                                                    <Address id="1">
                                                    <Name xml:lang="pt-BR">----</Name>
                                                    <PostalAddress name="Customer">
                                                    <DeliverTo>'.$clientes['Cliente']['nome'].'</DeliverTo>
                                                    <Street>'.$clientes['Cliente']['street'].'</Street>
                                                    <Street>'.$clientes['Cliente']['complemente'].'</Street>
                                                    <City>'.$clientes['Cliente']['city'].'</City>
                                                    <State>'.$clientes['Cliente']['state'].'</State>
                                                    <PostalCode>'.$clientes['Cliente']['zipcode'].'</PostalCode>
                                                            <Country isoCountryCode="BR">BR</Country>
                                                    </PostalAddress>
                                                    <Phone>
                                                            <TelephoneNumber>
                                                            <Number>5855551212</Number>
                                                    </TelephoneNumber>
                                            </Phone>
                                    </Address>
                            </ShipTo>
                    </ItemOut>';
                     $conta_linhas++;                       

                    }
        
        
   
            $montando_xml .=" </OrderRequest>
                </Request>
            </cXML>";

            
           
           
            
            $url_dev = "http://orders.colorcentriccorp.com:8080/SingTest/default.singtest";
            $url_prod = "http://orders.colorcentriccorp.com:8080/SingProd/default.SingProd";

            $curl = curl_init($url_dev);

            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

            curl_setopt($curl, CURLOPT_HTTPHEADER, Array('Content-Type: application/xml; charset=ISO-8859-1'));

            curl_setopt($curl, CURLOPT_POSTFIELDS, $montando_xml);

            $exec = curl_exec($curl);

            curl_close($curl);

            $xml= simplexml_load_string($exec);
            
          
           
           //verificando se o pedido foi com sucesso para o cms
        if( $xml->Response->Status['code'] == 200){
            //salvando o histórico atual no historico    
            $params_historico = array('Historico'=>array('nome'=>$clientes['Status']['nome'],'data'=>$this->Session->read('data_pedido'), 'pedido_id'=> $pedido_id));    
            $this->Historico->save($params_historico);

            //atualizando o status atual e salvando a resposta do cms
            $array_dados = array('Pedido'=> array('id' => $pedido_id, 'status_id' =>'3','status_updated' =>date('Y-m-d H:i:s'),'os'=>$pedido_id ,'payload'=> $xml["payloadID"]));
            $this->Pedido->save($array_dados);

            //passando informaco ao usuário que seu pedido foi enviado ao cms
            $this->Session->setFlash(__('O pedido '.$clientes['Entradapedido']['id']. ' foi enviado com sucesso para o CMS!! veja: '.$xml["payloadID"], true));
        }else{
            $params_erro = array('pedido_id'=>$pedido_id, 'mensagem' => $xml->Response->Status['text'], 'codigo'=>$xml->Response->Status['code']);
            $this->Erro->save($params_erro);
            //passando informaco ao usuário que seu pedido teve problemas
            $this->Session->setFlash(__('O pedido '.$clientes['Entradapedido']['id']. ' está com problemas :( : '.$xml->Response->Status['text']. " Corrija-o e tente novamente", true));
            
        }
        
        $this->redirect(array('controller' => 'pedidos', 'action' => 'listar'));
        
      }else{     $this->Session->setFlash(__("É necessário incluir itens no Pedido para envio", false));
                  $this->redirect(array('controller' => 'itens', 'action' => 'add_item'));
      }
        
        
    }
            
    /**
     * 
     * @param type $id formulario de envio ao cms
     */
    
    
    function enviar($id = null){
        
        $params = array('fields' =>array('Cliente.id','Cliente.nome'));
        $this->set('clientes',$this->Cliente->find('list',$params) );
        $this->set('pedido_id',$id );
        
        
        $data_pedido = $this->Pedido->read('Pedido.updated',$id);
        $this->Session->write('data_pedido', $data_pedido['Pedido']['updated']);
      
        
        
        
    }
    /**
     * 
     * @param type $id id do produto a ser baixado
     */
    
    function baixar($id = null){
      
        
        
        $path = APP.'webroot/files/uploads/';
        
        
        // diretório onde será compactado
        $diretorio = $path;
 
        // inicializa a classe ZipArchive
        $zip = new ZipArchive();
        // abre o arquivo .zip
        if ($zip->open($path.$id.".zip", ZIPARCHIVE::CREATE) !== TRUE) {
        die ("Erro!");
        }

        $iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($diretorio.$id));

        // itera cada pasta/arquivo contido no diretório especificado
        foreach ($iterator as $key=>$value) {
            
            //pegando o nome sem o path que ira para o zip
            $array_real_name = split("/", $key);
            $max = sizeof($array_real_name);
            $real_name = $array_real_name[$max -1];
            
            // adiciona o arquivo ao .zip
            $zip->addFile(realpath($key), iconv('ISO-8859-1', 'IBM850', $real_name)) or die ("ERRO: Não é possível adicionar o arquivo: $key");
        }
        // fecha e salva o arquivo .zip gerado
        $zip->close();

        
        $this->viewClass = 'Media';
        
        $params = array(
            'id'        => $id.".zip",
            'name'      => $id,
            'download'  => true,
            'extension' => 'zip',
            'path'      => 'webroot/files/uploads/'
        );
        
        
        //pegando o id do pedido
        
        $pedido_id = $this->Pedido->field('Pedido.id', array('Pedido.entradapedido_id'=> $id));

        //pegando os dados do status atual
        $dados_status = $this->Pedido->read(array('Status.nome','Pedido.created','Pedido.id'), $pedido_id);

        
        //salvando o histórico atual no historico    
        $params_historico = array('Historico'=>array('nome'=>$dados_status['Status']['nome'],'data'=>$dados_status['Pedido']['created'], 'pedido_id'=> $pedido_id));    
        $this->Historico->save($params_historico);
        
        //atualizando o status atual e salvando a resposta do cms
        $array_dados = array('Pedido'=> array('id' => $pedido_id, 'status_id' =>'2','status_updated' =>date('Y-m-d H:i:s'), 'baixado'=>true, 'os'=>$pedido_id));
        $this->Pedido->save($array_dados);

        $this->set($params);
       // echo "<meta HTTP-EQUIV='refresh' CONTENT='35; url=pagina.php?recarregar=nao'>";
        
    }
    
    /**
     * 
     * @param type string $produto_cms codigo cms do produto
     * @return type bool se é um cartao, sim ou nao
     */
    
    private function cartaovisita($produto_cms){        
         
        
        return $this->Produto->field('cartaovisita', array('Produto.codigo'=>$produto_cms)); 
        
    }
    
    /**
     * 
     * @param type int $pedido_id id do pedido
     * @return type datetime retorna a data de saída do cms
     */
    
    private function data_saida($pedido_id ){
        
        $data_saida = $this->Pedido->read('prioridade',$pedido_id);
        
        //var_dump($data_saida);
        if(empty( $data_saida['Pedido']['prioridade'])){
        
                
                if(date("l")=="Thursday" || date("l")=="Friday")
                {
                        $data_saida = date("m/d/Y",mktime(date('H'),date('i'),date('s'),date('m'),(date('d')+4),date('Y')));
                }
                else
                {
                        $data_saida = date("m/d/Y",mktime(date('H'),date('i'),date('s'),date('m'),(date('d')+2),date('Y')));
                }
        }  else {
            
            
            $data_saida = date('m-d-Y', strtotime($data_saida['Pedido']['prioridade']));
            
        }
        
        
        return $data_saida;
        
    }
    
    /**
     * 
     * @param int $id id do pedido que será incluido prioridade
     * @return boll caso consiga inserir, retorna ok
     */
    
    function prioridade($id = null){
        
        $this->layout = 'empty';
        
        if ($this->request->is('post') || $this->request->is('put')) {
            
			if ($this->Pedido->save($this->request->data)) {
				$this->Session->setFlash(__('Prioridade Inserida com sucesso'));
				$this->redirect(array('action' => 'listar'));
			} else {
				$this->Session->setFlash(__('Não foi possivel inserir prioridade. Tente novamente'));
			}
		} else {
			$this->set('id', $id);
		}        
    }
    
    
    /**
     * @param int $id id do pedido a ser cancelado
     * @return bool retorna ok caso consiga cancelar
     * 
     */
    
   function cancelar($id = null){
        
       $this->layout = 'empty';
       
       
       
       
       
       
       
         if ($this->request->is('post') || $this->request->is('put')) {

             if(!empty($this->request->data['Pedido']['obs'])){

                    //pegando os dados do status atual
                    $dados_status = $this->Pedido->read(array('Status.nome','Pedido.updated','Pedido.status_updated','Pedido.created' ,'Entradapedido.email','Entradapedido.id'), $this->request->data['Pedido']['id']);

                    $this->request->data['status_updated'] = date('Y-m-d H:i:s');
                    $this->request->data['status_id'] = 0;
       
                    
                    
                    
                  if ($this->Pedido->save($this->request->data)) {
                          $this->Session->setFlash(__('Pedido cancelado com sucesso'));


                          if($dados_status['Status']['nome'] == 'Recebido'){
                              $params_historico = array('Historico'=>array('nome'=>$dados_status['Status']['nome'],'data'=>$dados_status['Pedido']['created'], 'pedido_id'=> $this->request->data['Pedido']['id']));    
                          }else{
                              $params_historico = array('Historico'=>array('nome'=>$dados_status['Status']['nome'],'data'=>$dados_status['Pedido']['status_updated'], 'pedido_id'=> $this->request->data['Pedido']['id']));    
                          }
                          //salvando o histórico atual no historico      
                          $this->Historico->save($params_historico);
                          
                          if(!empty($dados_status['Entradapedido']['email'])){
                          
                            $Email = new CakeEmail();
                            $Email->config('fgv');
                            $Email->viewVars(array('numero_pedido' => $dados_status['Entradapedido']['id'], 'motivo'=> $this->request->data['Pedido']['obs']));
                            $Email->template('cancelamento');
                            
                            $Email->to($dados_status['Entradapedido']['email']);
                            $Email->subject('Pedido Cancelado!');
                            $Email->send();
                          }
                          
                          $this->redirect(array('action' => 'listar'));

                          

                  } else {
                          $this->Session->setFlash(__('Não foi possivel Cancelar. Tente novamente'));
                  }
             }else{
                 
                 $this->Session->setFlash(__('Não foi possivel cancelar. Digite um motivo'));
                 $this->redirect(array('controller' => 'pedidos', 'action' => 'listar'));
             }
        } else {
                $this->set('id', $id);
        }       
        
        
        
    }
    
    function teste_email(){
        
        
        $Email = new CakeEmail();
        $Email->config('fgv');
        
        $Email->to('eusoujeferson@gmail.com');
        $Email->subject('About test');
        $Email->send('vai');

    }
    
   
        
        
}
