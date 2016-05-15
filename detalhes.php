<?php
session_start();
session_unset();

include('./bin/class/structure.php');

if(!empty($_REQUEST['id'])){
	$id = $_REQUEST['id'];
}else{
	header("Location: index.php"); 
}

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

<section id="section" class="detalhes-sec1">
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
									<span class="fa fa-cutlery" aria-hidden="true"></span>
									<p class="titulo">Rendimento</p>
									<p><span itemprop="recipeYield" ><?= $receita->recipeYield->human ?></span></p>
								</div>
								<div class="tempo">
									<span class="fa fa-clock-o" aria-hidden="true"></span>
									<p class="titulo">Preparo</p>
									<p><span itemprop="totalTime"><?= $receita->totalTime->human ?></span></p>
								</div>
							</div>
							<div class="avaliacao" itemprop="aggregateRating" itemscope="itemscope" itemtype="http://schema.org/AggregateRating">
								<div class="avaliacao-qtd">
									<span class="fa fa-users" aria-hidden="true"></span>
									<p class="titulo">Qtd. Avaliações</p>
									<p><span itemprop="ratingCount"><?= $receita->aggregateRating->ratingCount  ?></span></p>
								</div>
								<div class="avaliacao-atual">
									<span class="fa fa-star" aria-hidden="true"></span>
									<p class="titulo">Avaliação</p>
									<p><span itemprop="ratingValue"><?= $receita->aggregateRating->ratingValue  ?></span></p>
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
								<li><p><span itemprop="recipeIngredient"><?= $value ?></span></p></li>
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
								<li><p><span itemprop="recipeInstructions"><?= $value ?></span></p></li>
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
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12"><?php
					    if( !empty($_COOKIE["session"]) ){ ?>
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
						<?php
						} ?>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12"><?php
						foreach ($receita->comments as $key => $value) {
						?>
							<div class="comentario">
								<div class="user">
									<div class="avatar">
										<img src="<?= __SITE_NAME__ ?>images/user_avatar.png" alt="Foto do usuario <?= $value->userName ?>">
									</div>
									<div class="dados">
										<p class="nome"><?= $value->userName ?></p>
										<p class="hora"><?= $value->dateTime ?></p>
										<div><?php
										for($i=0; $i < rand(2,6); $i++){
										?>
											<span class="fa fa-star" aria-hidden="true"></span>
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