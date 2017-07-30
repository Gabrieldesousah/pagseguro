<?php
header("access-control-allow-origin: https://pagseguro.uol.com.br");
header("Content-Type: text/html; charset=UTF-8",true);
date_default_timezone_set('America/Sao_Paulo');

require_once("PagSeguro.class.php");
$PagSeguro = new PagSeguro();
	
//EFETUAR PAGAMENTO	
$venda = array("codigo"=>"18293",
			   "valor"=>100.00,
			   "descricao"=>"VENDA DE pirulito",
			   "nome"=>"felipe augusto",
			   "email"=>"c71525297558843122225@sandbox.pagseguro.com.br",
			   "telefone"=>"(62) 3297-5322",
			   "rua"=>"nao  importa",
			   "numero"=>"3",
			   "bairro"=>"importa nao",
			   "cidade"=>"goianira",
			   "estado"=>"GO", //2 LETRAS MAIÚSCULAS
			   "cep"=>"74.453-440",
			   "codigo_pagseguro"=>"");
			   
$PagSeguro->executeCheckout($venda,"https://seumerito.com/pagseguro/".$_GET['codigo']);

//----------------------------------------------------------------------------


//RECEBER RETORNO
if( isset($_GET['transaction_id']) ){
	$pagamento = $PagSeguro->getStatusByReference($_GET['codigo']);
	
	$pagamento->codigo_pagseguro = $_GET['transaction_id'];
	if($pagamento->status==3 || $pagamento->status==4){
		//ATUALIZAR DADOS DA VENDA, COMO DATA DO PAGAMENTO E STATUS DO PAGAMENTO
		
	}else{
		//ATUALIZAR NA BASE DE DADOS
	}
}

?>