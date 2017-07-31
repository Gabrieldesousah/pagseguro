<?php
header("access-control-allow-origin: https://pagseguro.uol.com.br");
header("Content-Type: text/html; charset=UTF-8",true);
date_default_timezone_set('America/Sao_Paulo');

require_once("PagSeguro.class.php");
$PagSeguro = new PagSeguro();
	
//EFETUAR PAGAMENTO	

//codigo é o  numero do produto
$venda = array("codigo"			=>$_POST["codigo"],
			   "valor"			=>$_POST["valor"],
			   "descricao"		=>$_POST["descricao"],
			   "nome"			=>$_POST["nome"],
			   "email"			=>$_POST["email"],
			   "telefone"		=>$_POST["telefone"],
			   "rua"			=>$_POST["rua"],
			   "numero"			=>$_POST["numero"],
			   "bairro"			=>$_POST["bairro"],
			   "cidade"			=>$_POST["cidade"],
			   "estado"		 	=>$_POST["estado"], //2 LETRAS MAIÚSCULAS
			   "cep"			=>$_POST["cep"],
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