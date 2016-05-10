<?php
session_start();
session_unset();

include('./bin/class/structure.php');


$structure = new Structure;

$structure -> header();
//print_r($_SESSION['receitas']['melhores']);

//Melhores
$rand = array_rand($_SESSION['receitas']['melhores'], 3);
$card1 = $_SESSION['receitas']['melhores'][$rand[0]];
$card2 = $_SESSION['receitas']['melhores'][$rand[1]];
$card3 = $_SESSION['receitas']['melhores'][$rand[2]];

//Rapidas
$rand = array_rand($_SESSION['receitas']['rapidas'], 3);
$card4 = $_SESSION['receitas']['rapidas'][$rand[0]];
$card5 = $_SESSION['receitas']['rapidas'][$rand[1]];
$card6 = $_SESSION['receitas']['rapidas'][$rand[2]];


//Mais acessadas
$rand = array_rand($_SESSION['BD'], 4);
$card7 = $_SESSION['BD'][$rand[0]];
$card8 = $_SESSION['BD'][$rand[1]];
$card9 = $_SESSION['BD'][$rand[2]];
$card10 = $_SESSION['BD'][$rand[3]];

//print_r($card1);
?>

<section id="index-sec1">
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<h2>Aves</h1>
			</div>
			<?php
				foreach ($_SESSION['receitas']['aves'] as $key => $receita) {
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