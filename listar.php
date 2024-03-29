<?php
session_start();

include('./bin/class/structure.php');

if(!empty($_REQUEST['categoria'])){
	$categoria = $_REQUEST['categoria'];
}else{
	$categoria = "aves";
}

if(strcmp( $categoria, "aves") == 0){
	$nomeCategoria = "Aves";
}elseif(strcmp($categoria, "bolos") == 0){
	$nomeCategoria = "Bolos e tortas";

}elseif(strcmp($categoria, "carnes") == 0){
	$nomeCategoria = "Carnes";

}elseif(strcmp($categoria, "doces") == 0){
	$nomeCategoria = "Doces";

}elseif(strcmp($categoria, "frutos") == 0){
	$nomeCategoria = "Frutos do mar";

}elseif(strcmp($categoria, "massas") == 0){
	$nomeCategoria = "Massas";
}

$receita = new ArrayObject();
$receita->setFlags(ArrayObject::STD_PROP_LIST|ArrayObject::ARRAY_AS_PROPS);
$receita->class = $categoria;

$structure = new Structure;

$structure -> header($receita);

//Mais acessadas
/*$rand = array_rand($_SESSION['BD'], 4);
$card7 = $_SESSION['BD'][$rand[0]];
$card8 = $_SESSION['BD'][$rand[1]];
$card9 = $_SESSION['BD'][$rand[2]];
$card10 = $_SESSION['BD'][$rand[3]];*/

//print_r($card1);
?>

<section>
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<h2><?= $nomeCategoria ?></h2>
			</div>
			<?php
				foreach ($_SESSION['receitas'][$categoria] as $key => $receita) {
					echo '<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">';
					$structure->generateCard(1, $receita);
					echo '</div>';
				}
			?>
		</div>
	</div>
</section>

<?php
$structure -> footer();