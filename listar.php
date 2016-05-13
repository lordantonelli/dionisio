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

?>

<section id="section" >
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<h2><?= $nomeCategoria ?></h2>
			</div>
		</div>
			<?php
			$i = 0;
			foreach ($_SESSION['receitas'][$categoria] as $key => $receita) {
				if($i == 0){ echo '<div class="row">';}

				echo '<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">';
				$structure->generateCard(1, $receita);
				echo '</div>';

				if($i >= 2 || $key == count($_SESSION['receitas'][$categoria])-1 ){
					echo '</div>';
					$i = 0;
				}else{
					$i++;
				}
			}
			?>
		
	</div>
</section>

<?php
$structure -> footer();