<?php
	require_once("PagSeguro.class.php");

	if(isset($_GET['reference'])){
		$PagSeguro = new PagSeguro();
		$P = $PagSeguro->getStatusByReference($_GET['reference']);
		//echo $PagSeguro->getStatusText($P);
		
		$P = (int) $P;

		//echo $PagSeguro->getStatusText($P->status);
		echo $PagSeguro->getStatusText($P);
	}

	elseif(isset($_GET["code"]))
	{
		$PagSeguro = new PagSeguro();
		$P = $PagSeguro->getStatusByCode($_GET["code"]);
		$P = (int) $P;
		
		echo $PagSeguro->getStatusText($P);
	}

	else{
	    echo "Parâmetro \"reference\" não informado!";
	}

?>