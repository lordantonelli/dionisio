<?php

define("__SITE_NAME__", "http://localhost/siade/dionisio/");

class Structure{

	function Structure(){
		if(empty($_SESSION['receitas'])){
			$receitas = json_decode(file_get_contents("BDreceitas.json"));

			foreach ($receitas as $key => $receita) {
				$_SESSION['BD'][] = $receita;
				$_SESSION['receitas'][$receita->class][] = $receita;

				$tempo = $receita->totalTime->dateTime;
				if( ($tempo == "PT5M") || ($tempo == "PT10M") || ($tempo == "PT15M") || ($tempo == "PT20M")){
					$_SESSION['receitas']['rapidas'][] = $receita;
				}

				$rating = $receita->aggregateRating->ratingValue;
				if($rating >= 4){
					$_SESSION['receitas']['melhores'][] = $receita;
				}

				/*$ratingCount = $receita->aggregateRating->ratingCount;

				if( empty($_SESSION['receitas']['acessadas']) || count($_SESSION['receitas']['acessadas']) < 4 ){
					$_SESSION['receitas']['acessadas'][] = $receita;
				}else{
					$listAces[] = $_SESSION['receitas']['acessadas'];

					foreach ($_SESSION['receitas']['acessadas'] as $keyAce => $rec) {
						if($ratingCount > $rec->aggregateRating->ratingCount){

						}
					}
				}*/

			}
		}
	}

	public function header($categoria = ''){

	?>
		<!doctype html>

		<html lang="pt-br">
			<head>
			    <meta charset="utf-8">

			    <title>Divinas receitas</title>
			    <meta name="description" content="">
			    <meta name="author" content="">

			    <meta content="Tudo Gostoso" property="og:site_name">
			    <meta content="http://www.tudogostoso.com.br/receita/23-bolo-de-cenoura.html" property="og:url">
			    	

			    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
			    <link href='https://fonts.googleapis.com/css?family=Alef:400,700' rel='stylesheet' type='text/css'>
			    <link href='https://fonts.googleapis.com/css?family=Roboto:400,400italic,300,500,700' rel='stylesheet' type='text/css'>
			    <link rel="stylesheet" href="<?= __SITE_NAME__ ?>bin/css/style.css">
			    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
			    <link rel="stylesheet" href="<?= __SITE_NAME__ ?>bin/plugin/owl_carousel/assets/owl.carousel.css">
			    
			    <!-- <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,300,400italic,300italic' rel='stylesheet' type='text/css'> -->

			</head>

		    <body data-spy="scroll" data-target=".navbar" data-offset="135">
		    	<header>
		    		<!-- <div class="borda-grega"></div> -->
		    		<div id="header-banner" >
		    			<div class="container">
		    				<div class="row">
		    					<div  class="col-md-6">
		    						<h1 class="logo">Divinas Receitas</h1>
		    					</div>
		    					<div class="col-md-6">
		    					<!--
		    						<form role="search">
					    				<div class="input-group">
					    					<input list="Receitas" type="text" placeholder="Digite o nome da receita..." class="form-control" id="">
											<datalist id="Receitas">
												<?php
													foreach ($_SESSION['receitas'] as $cat => $receita) {
														if($cat != 'rapidas' && $cat != 'melhores'){
															foreach ($receita as $key => $value) {
																echo '<option value="'.trim($value->name).'">';
															}
														}
													}
												?>
											</datalist>
					    					<span class="input-group-btn">
					    						<button type="submit" class="btn btn-default">Procurar</button>
					    					</span>
					    				</div>
					    			</form>
					    			-->
					    			<form class="form-wrapper cf" role="search">
								        <input list="Receitas" type="text" title="Digite o nome da receita" placeholder="Digite o nome da receita..." class="col-md-9">
								        <datalist id="Receitas">
												<?php
													foreach ($_SESSION['receitas'] as $cat => $receita) {
														if($cat != 'rapidas' && $cat != 'melhores'){
															foreach ($receita as $key => $value) {
																echo '<option value="'.trim($value->name).'">';
															}
														}
													}
												?>
											</datalist>
								        <button type="submit" class="col-md-3">Procurar</button>
								    </form>  
		    					</div>
		    				</div>
		    			</div>
	    			</div>
	    			<nav class="navbar" data-spy="affix" data-offset-top="135">
	    				<div class="container <?= $categoria ?>" id="nav-container">
	    					<div class="navbar-header">
							    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-list">
								    <span class="icon-bar"></span>
								    <span class="icon-bar"></span>
								    <span class="icon-bar"></span>
							    </button>
							    <!-- <a class="navbar-brand" href="#">WebSiteName</a> -->
						    </div>
				    		<div class="collapse navbar-collapse" id="navbar-list">
				    			<ul class="nav navbar-nav">
				    				<li class="home"><a href="<?= __SITE_NAME__ ?>">HOME</a></li>
				    				<li class="aves"><a href="<?= __SITE_NAME__ ?>categoria/aves">AVES</a></li>
				    				<li class="bolos"><a href="<?= __SITE_NAME__ ?>categoria/bolos" >BOLOS E TORTAS</a></li>
				    				<li class="carnes"><a href="<?= __SITE_NAME__ ?>categoria/carnes">CARNES</a></li>
				    				<li class="doces"><a href="<?= __SITE_NAME__ ?>categoria/doces" >DOCES</a></li>
				    				<li class="frutos"><a href="<?= __SITE_NAME__ ?>categoria/frutos">FRUTOS DO MAR</a></li>
				    				<li class="massas"><a href="<?= __SITE_NAME__ ?>categoria/massas">MASSAS</a></li>
				    			</ul>
				    		</div><!-- /.navbar-collapse -->
				    	</div><!-- /container -->
				    </nav>
			    </header>
	<?php
	}

	public function buscaReceita($id){
		foreach ($_SESSION['BD'] as $key => $value) {
			if(strcmp($id, $value->id)){
				return $value;
				break;
			}
		}
		return false;
	}

	// 1 - Pequeno 2- Grande
	public function generateCard($tamanho, $dados){
		$categoria = $dados->class;

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

		$foto = $dados->images[0]->link;
		
	?>
		<div class="card-receita <?=($tamanho == 1 ? "card-pequeno" : "card-grande") ?> card-<?= $categoria ?>">
			<a href="<?= __SITE_NAME__ ?>receita/<?= $dados->id ?>/<?= $this->toAscii($dados->name)?>">
				<div class="card-tab">
					<p><?= $nomeCategoria ?></p>
				</div>
				<div class="card-img" style="background-image: url('<?= $foto ?>)">

				</div>
				<div class="card-descricao">
					<div class="titulo"><?= $dados->name ?></div>
					<div class="descricao">
						<div class="rendimento">
							<span class="fa fa-cutlery" aria-hidden="true"></span>
							<p><?= $dados->recipeYield->human ?></p>
						</div>
						<div class="tempo">
							<span class="fa fa-clock-o" aria-hidden="true"></span>
							<p><?= $dados->totalTime->human  ?></p>
						</div>
					</div>
				</div>
			</a>
		</div>

	<?php
	}//Fim generateCard

	public function footer($carousel = false){
	?>
				<footer>
					<div class="container">
						<div class="row">
							<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
								<h2>Categorias</h2>
								<ul>
									<li><a href="<?= __SITE_NAME__ ?>categoria/aves"  >AVES</a></li>
				    				<li><a href="<?= __SITE_NAME__ ?>categoria/bolos" >BOLOS E TORTAS</a></li>
				    				<li><a href="<?= __SITE_NAME__ ?>categoria/carnes">CARNES</a></li>
				    				<li><a href="<?= __SITE_NAME__ ?>categoria/doces" >DOCES</a></li>
				    				<li><a href="<?= __SITE_NAME__ ?>categoria/frutos">FRUTOS DO MAR</a></li>
				    				<li><a href="<?= __SITE_NAME__ ?>categoria/massas">MASSAS</a></li>
								</ul>
							</div>
							<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
								<h2>Outros Links</h2>
								<ul>
									<li><a href="#">HOME</a></li>
				    				<li><a href="#">REGISTRAR</a></li>
				    				<li><a href="#">SOBRE</a></li>
								</ul>
							</div>
							<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
								
							</div>
						</div>
					</div>
					<div class="container-fluid">
						<p>Desenvolvido por Guilherme e Humberto</p>
					</div>
				</footer>


				<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
				<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
				
				<?php
				if($carousel){ ?>
					<script src="bin/plugin/owl_carousel/owl.carousel.js"></script>
					<script>
						jQuery(document).ready(function(){
							jQuery('.owl-carousel').owlCarousel({
							    loop:true,
							    margin:10,
							    dots: true,
							    nav:false,
							    items: 1
							});	
						});
					</script>

				<?php
				} ?>

				<script>
					function navColor(classe){

						hoverOn = function(){
							jQuery("#nav-container").addClass(classe);
						}

						hoverOff = function(){
							jQuery("#nav-container").removeClass(classe);
						}

						jQuery("#nav-container ul li."+classe).hover(hoverOn, hoverOff);
					}

					navColor('aves');
					navColor('bolos');
					navColor('carnes');
					navColor('doces');
					navColor('frutos');
					navColor('massas');
				</script>

			</body>
		</html> 

	<?php
	}

	public function toAscii($str) {
		$clean = preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '', trim($str));
		$clean = strtolower(trim($clean, '-'));
		$clean = preg_replace("/[\/_|+ -]+/", '-', $clean);

		return $clean;
	}
}
?>