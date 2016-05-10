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
			<div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 blue-grey-border">
				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<h2>Destaques</h2>
					</div>
					<div class="col-md-6 col-lg-6">
						<?php
							$structure->generateCard(2, $card1);
						?>
					</div>
					<div class="col-md-6 col-lg-6">
						<?php
							$structure->generateCard(1, $card2);
							$structure->generateCard(1, $card3);
						?>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<h2>Receitas rapidas</h2>
					</div>
					<div class="col-md-6 col-lg-6">
						<?php
							$structure->generateCard(2, $card4);
						?>
					</div>
					<div class="col-md-6 col-lg-6">
						<?php
							$structure->generateCard(1, $card5);
							$structure->generateCard(1, $card6);
						?>
					</div>
				</div>
			</div>
			<div class="hidden-xs hidden-sm col-md-4 col-lg-4">
				<aside>
					<div class="row">
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
							<h2>Mais acessados</h2>
						</div>
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
							<?php
								$structure->generateCard(1, $card7);
								$structure->generateCard(1, $card8);
								$structure->generateCard(1, $card9);
								$structure->generateCard(1, $card10);
							?>
						</div>
					</div>		
				</aside>
			</div>
		</div>
	</div>
</section>

<?php
$structure -> footer();