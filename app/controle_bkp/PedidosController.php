<?php

class PedidosController extends AppController{
    
    public $uses= array('Cliente', 'Pedido','Item', 'Status', 'Entradapedido');


    public function cria_pedido(){
        
        $params = array('fields' =>array('Cliente.id','Cliente.nome'));
        
        $this->set('clientes',$this->Cliente->find('list',$params) );
        
    }
    
    public function add_pedido(){
        
        
        $isPost = $this->request->is('post');//Se é um POST e recebemos dados do formulário
        if($isPost && !empty($this->request->data)) 
        {//Tenta salvar os dados da inscrição
            if($this->Pedido->save($this->request->data)) {
                //Registro inserido com sucesso!            
                $this->Session->write('pedido_id',$this->Pedido->id);
                $this->Session->write('pedido_os', $this->Pedido->read(array('os')));
                $this->redirect(array('controller' => 'items', 'action' => 'add_item'));
            }
        } 
        
        
        
    }
    public function listar(){
        $params = array('fields' =>array('Entradapedido.id', 'Entradapedido.nome', 'Cliente.nome','Status.nome',
                                         'Pedido.status_id', 'Pedido.payload','Pedido.created',
                                         'Pedido.updated', 'Entradapedido.prazo_estimado', 'Pedido.prioridade'));
        
        $this->set('pedidos',$this->Pedido->find('all',$params) );
        
    }
    
    public function detalhes_pedido($pedido_id){
        
        $params_itens_pedido= array('fields'=>array('Item.name_capa','Item.name_miolo','Item.paginas','Item.quantidade', 'Produto.nome'), 'conditions'=>array('Item.pedido_id'=>$pedido_id));
        $this->set('itens_pedido', $this->Item->find('all',$params_itens_pedido) );
        $this->Pedido->id = $pedido_id;
        $this->set('OS', $this->Pedido->read(array('entradapedido_id')));
        
    }
    
    public function enviar_pedido($pedido_id){
            
        $params_clientes= array('fields'=>array('Cliente.nome','Cliente.street',
                                                'Cliente.state','Cliente.complemente',
                                                'Cliente.city','Cliente.country',
                                                'Cliente.zipcode', 'Pedido.updated','Pedido.id'),
            
                                'conditions'=>array(
                                                      'Pedido.id'=>$pedido_id ));
        
        
        
        
        
        if(date("l")=="Thursday" || date("l")=="Friday")
        {
                $data_saida = date("m/d/Y",mktime(date('H'),date('i'),date('s'),date('m'),(date('d')+4),date('Y')));
        }
        else
        {
                $data_saida = date("m/d/Y",mktime(date('H'),date('i'),date('s'),date('m'),(date('d')+2),date('Y')));
        }


        $clientes = $this->Pedido->find('first',$params_clientes) ;

        $novo_post_cliente = "SING";    
        
        $params_itens_pedidos = array('fields'=>array('Item.urlcapa','Item.urlmiolo',
                                                      'Item.paginas','Item.quantidade',
                                                      'Produto.codigo'), 
                                      'conditions'=>array('Item.pedido_id'=>$pedido_id));
        
        $lista_itens_pedidos = $this->Item->find('all',$params_itens_pedidos) ;
        
        
        
        
        
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
                                    <CustomerID>'.$novo_post_cliente.'</CustomerID>
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
                                            if($itens['Produto']['codigo']!="P2863" && $itens['Produto']['codigo']!="P2864")
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


                    }
        
        
        
       
        


            $montando_xml .=" </OrderRequest>
                </Request>
            </cXML>";


          
                   //$this->redirect(array('controller' => 'pedidos', 'action' => 'listar'));

            echo $montando_xml;



            $url_dev = "http://orders.colorcentriccorp.com:8080/SingTest/default.singtest";
            $url_prod = "http://orders.colorcentriccorp.com:8080/SingProd/default.SingProd";

            $curl = curl_init($url_dev);

            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

            curl_setopt($curl, CURLOPT_HTTPHEADER, Array('Content-Type: application/xml; charset=ISO-8859-1'));

            curl_setopt($curl, CURLOPT_POSTFIELDS, $montando_xml);

            $exec = curl_exec($curl);

            curl_close($curl);

            //echo $exec;

            $xml= simplexml_load_string($exec);
            echo  $xml["payloadID"]."'<br> code = '".$xml->Response->Status["code"]."',<br> texto = '".$xml->Response->Status["text"];
            //exit(0);
            //print_r($xml);

            //exit(0);
        
        
    }
    
    
    function finaliza_pedido(){
        
        $pedido_id = $this->data['pedido_id'];
        
        
        $params_clientes= array('fields'=>array('Cliente.nome','Cliente.street',
                                                'Cliente.state','Cliente.complemente',
                                                'Cliente.city','Cliente.country',
                                                'Cliente.zipcode', 'Pedido.updated','Pedido.id'),
            
                                'conditions'=>array(
                                                      'Pedido.id'=> $pedido_id));
        
        
        
        
        
        if(date("l")=="Thursday" || date("l")=="Friday")
        {
                $data_saida = date("m/d/Y",mktime(date('H'),date('i'),date('s'),date('m'),(date('d')+4),date('Y')));
        }
        else
        {
                $data_saida = date("m/d/Y",mktime(date('H'),date('i'),date('s'),date('m'),(date('d')+2),date('Y')));
        }


        $clientes = $this->Pedido->find('first',$params_clientes) ;

        $novo_post_cliente = "SING";    
        
        $params_itens_pedidos = array('fields'=>array('Item.urlcapa','Item.urlmiolo',
                                                      'Item.paginas','Item.quantidade',
                                                      'Produto.codigo'), 
                                      'conditions'=>array('Item.pedido_id'=>$pedido_id));
        
        $lista_itens_pedidos = $this->Item->find('all',$params_itens_pedidos) ;
        
        
        
        
        
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
                                    <CustomerID>'.$novo_post_cliente.'</CustomerID>
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
                                            if($itens['Produto']['codigo']!="P2863" && $itens['Produto']['codigo']!="P2864")
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


                    }
        
        
        
       
        


            $montando_xml .=" </OrderRequest>
                </Request>
            </cXML>";


          
                   //$this->redirect(array('controller' => 'pedidos', 'action' => 'listar'));

            //echo $montando_xml;



            $url_dev = "http://orders.colorcentriccorp.com:8080/SingTest/default.singtest";
            $url_prod = "http://orders.colorcentriccorp.com:8080/SingProd/default.SingProd";

            $curl = curl_init($url_dev);

            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

            curl_setopt($curl, CURLOPT_HTTPHEADER, Array('Content-Type: application/xml; charset=ISO-8859-1'));

            curl_setopt($curl, CURLOPT_POSTFIELDS, $montando_xml);

            $exec = curl_exec($curl);

            curl_close($curl);

            //echo $exec;

            $xml= simplexml_load_string($exec);
            //echo  $xml["payloadID"]."'<br> code = '".$xml->Response->Status["code"]."',<br> texto = '".$xml->Response->Status["text"];
            //exit(0);
            //print_r($xml);

            //exit(0);
        
        
   
        
        
        $this->Session->setFlash(__('Mãe!!! acabei!!! O pedido '.$this->data['pedido_id']. ' tá pronto!! veja: '.$xml["payloadID"]."'<br> code = '".$xml->Response->Status["code"]."',<br> texto = '".$xml->Response->Status["text"], true));
        $this->redirect(array('controller' => 'pedidos', 'action' => 'listar'));
        
        
        
    }
            
    function prioridade($id){
        
        
        $salvou = false;
        
        if($salvou){
            $this->redirect(array('controller' => 'pedidos', 'action' => 'listar'));
        }
        
    }
    
    
    function enviar($id){
        
    }
    
    
}


?>
