<?php
session_start();
session_unset();

include('./bin/class/structure.php');

if(!empty($_REQUEST['id'])){
	$id = $_REQUEST['id'];
}else{
	$id = '146540';
}

/*else{
	header("Location: index.php"); 
}*/

$structure = new Structure;

$receita = $structure->buscaReceita($id);
/*if ($receita == false) {
	header("Location: index.php");
}*/

$rand = array_rand($_SESSION['receitas'][$receita->class], 4);
$card1 = $_SESSION['receitas'][$receita->class][$rand[0]];
$card2 = $_SESSION['receitas'][$receita->class][$rand[1]];
$card3 = $_SESSION['receitas'][$receita->class][$rand[2]];
$card4 = $_SESSION['receitas'][$receita->class][$rand[3]];

$structure -> header($receita);

?>

<section id="detalhes-sec1">
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 blue-grey-border">
				<div class="row" itemscope="itemscope" itemtype="http://schema.org/Recipe">
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<h2><?= $receita->name ?></h2>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<div class="carousel">
							<div class="owl-carousel owl-theme">
							<?php
								foreach ($receita->images as $key => $value) {
									echo '<div class="foto" style="background-image:url('.$value->link.')"> </div>';
									if(count($receita->images) <= 1){
										echo '<div class="foto" style="background-image:url('.$value->link.')"> </div>';
									}
								}
							?>
							</div>
						</div>
						<div class="dados-receita">
							<div class="descricao">
								<div class="rendimento">
									<i class="fa fa-cutlery" aria-hidden="true"></i>
									<p class="titulo">Rendimento</p>
									<p itemprop="recipeYield" value="<?= $receita->recipeYield->value ?>"><?= $receita->recipeYield->human ?></p>
								</div>
								<div class="tempo">
									<i class="fa fa-clock-o" aria-hidden="true"></i>
									<p class="titulo">Preparo</p>
									<p datetime="<?= $receita->totalTime->dateTime ?>" itemprop="totalTime"><?= $receita->totalTime->human  ?></p>
								</div>
							</div>
							<div class="avaliacao" itemprop="aggregateRating" itemscope="itemscope" itemtype="http://schema.org/AggregateRating">
								<div class="avaliacao-qtd">
									<i class="fa fa-users" aria-hidden="true"></i>
									<p class="titulo">Qtd. Avaliações</p>
									<p itemprop="ratingCount"><?= $receita->aggregateRating->ratingCount  ?></p>
								</div>
								<div class="avaliacao-atual">
									<i class="fa fa-star" aria-hidden="true"></i>
									<p class="titulo">Avaliação</p>
									<p itemprop="ratingValue"><?= $receita->aggregateRating->ratingValue  ?></p>
								</div>
							</div>
						</div>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<h3>Ingredientes</h3>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<ul>
						<?php
							foreach ($receita->ingredients->default as $key => $value) { ?>
								<li><p itemprop="recipeIngredient"><?= $value ?></p></li>
							<?php
							}
						?>
						</ul>						
					</div>

					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<h3>Modo de preparo</h3>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<ol>
						<?php
							foreach ($receita->instructions->default as $key => $value) { ?>
								<li><p itemprop="recipeInstructions"><?= $value ?></p></li>
							<?php
							}
						?>
						</ol>
						<div class="export">
							<a class="btn btn-export" target="_blank" href="<?= __SITE_NAME__ . 'exportar/xml/'.$receita->id.'/'.$structure->toAscii($receita->name) ?>">Exportar em xml</a>
							<a class="btn btn-export" target="_blank" href="<?= __SITE_NAME__ . 'exportar/json/'.$receita->id.'/'.$structure->toAscii($receita->name) ?>">Exportar em json</a>
						</div>				
					</div>

					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<h3>Comentarios</h3>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<form id="form-coment" onsubmit="enviaComentario(); return false;">
							<div class="avaliacao-nova">
								<p>SELECIONE UMA NOTA:<br>Passe o mouse em cima e selecione a sua nota.</p>
								<select id="rating-stars">
									<option value="1">1</option>
									<option value="2">2</option>
									<option value="3">3</option>
									<option value="4">4</option>
									<option value="5">5</option>
								</select>
							</div>
							<textarea class="form-control" rows="6" placeholder="Deixe seu comentário..."></textarea>
							<button type="submit" class="btn btn-default">Enviar</button>
						</form>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12"><?php
						foreach ($receita->comments as $key => $value) {
						?>
							<div class="comentario">
								<div class="user">
									<div class="avatar">
										<img src="<?= __SITE_NAME__ ?>images/user_avatar.png">
									</div>
									<div class="dados">
										<p class="nome"><?= $value->userName ?></p>
										<p class="hora"><?= $value->dateTime ?></p>
										<div><?php
										for($i=0; $i < rand(2,6); $i++){
										?>
											<i class="fa fa-star" aria-hidden="true"></i>
										<?php
										}?>
										</div>
									</div>
								</div>
								<div class="text">
									<p><?=	$value->text ?></p>
								</div>
							</div>							
						<?php
						}?>
					</div>
				</div>
			</div>

			<div class="hidden-xs hidden-sm col-md-4 col-lg-4">
				<aside>
					<h3>Recomendações</h3>
					<?php
						$structure->generateCard(1, $card1);
						$structure->generateCard(1, $card2);
						$structure->generateCard(1, $card3);
						$structure->generateCard(1, $card4);
					?>				
				</aside>
			</div>
		</div>
	</div>
</section>

<script>
function enviaComentario(){
	jQuery('#form-coment >textarea').val('');
	jQuery('.br-widget >a:first-child').click();
	alert("Comentário enviado");
}
</script>
<?php
$structure -> footer(true);