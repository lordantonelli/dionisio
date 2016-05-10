<?php
session_start();
session_unset();

include('./bin/class/structure.php');


$structure = new Structure;

$structure -> header();

?>

<section>
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 blue-grey-border">
				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<h2>Destaques</h1>
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
						<h2>Receitas rapidas</h1>
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
					<h2>Mais acessados</h1>
					<?php
						$structure->generateCard(1, $card7);
						$structure->generateCard(1, $card8);
						$structure->generateCard(1, $card9);
						$structure->generateCard(1, $card10);
					?>				
				</aside>
			</div>
		</div>
	</div>
</section>

<?php
$structure -> footer();