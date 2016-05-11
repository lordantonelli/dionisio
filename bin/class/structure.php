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

	public function header($receita = ""){
		if(!empty($receita)){
			$categoria = $receita->class;
		}else{
			$categoria = "";
		}	
	?>
		<!doctype html>

		<html lang="pt-br">
			<head>
			    <meta charset="utf-8">

			    <title>Divinas receitas</title>

			    <meta content="Receitas Divinas" name="AUTHOR">
			    <meta content="Copyright (c) 2016 by Receitas Divinas" name="COPYRIGHT">
			    <meta content="pt-br" name="LANGUAGE">			    
			    <?php
			    if(!empty($receita->meta)){?>
				    <meta content="<?= $receita->meta->og_title ?>" property="og:title">
				    <meta content="<?= $receita->meta->og_title ?>" name="KEYWORDS">
				    <meta content="<?= $receita->meta->og_description ?>" property="og:description">
				    <meta content="<?= $receita->meta->og_description ?>" name="DESCRIPTION" >
				    <meta content="<?= $receita->meta->og_image ?>" property="og:image">
				    <meta content="<?= $receita->meta->og_type ?>" property="og:type">
			    <?php
			    } ?>
			    <meta content="Receitas Divinas" property="og:site_name">
			    <meta content="http://<?= $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']?>" property="og:url">

			    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
			    <link href='https://fonts.googleapis.com/css?family=Alef:400,700' rel='stylesheet' type='text/css'>
			    <link href='https://fonts.googleapis.com/css?family=Roboto:400,400italic,300,500,700' rel='stylesheet' type='text/css'>
			    <link rel="stylesheet" href="<?= __SITE_NAME__ ?>bin/css/style.css">
			    <link rel="stylesheet" href="<?= __SITE_NAME__ ?>bin/css/bootstrap-datepicker.css">
			    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
			    <link rel="stylesheet" href="<?= __SITE_NAME__ ?>bin/plugin/owl_carousel/assets/owl.carousel.css">
			    <link rel="stylesheet" href="<?= __SITE_NAME__ ?>bin/plugin/jquery_bar_rating/fontawesome-stars.css">
			    
			    <!-- <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,300,400italic,300italic' rel='stylesheet' type='text/css'> -->

			</head>

		    <body data-spy="scroll" data-target=".navbar" data-offset="135">
		    	<header>
		    		<!-- <div class="borda-grega"></div> -->
		    		<div id="header-banner" >
		    			<div class="container">
		    				<div class="row-fluid accessibility-language-actions-container">
			                    <div class="span6 accessibility-container">
			                        <ul id="accessibility">
			                            <li>
			                                <a accesskey="1" href="#content" id="link-conteudo">
			                                    Ir para o conteúdo
			                                </a>
			                            </li>
			                            <li class="separator">|</li>
			                            <li>
			                                <a accesskey="2" href="#navigation" id="link-navegacao">
			                                    Ir para o menu
			                                </a>
			                            </li>
			                            <li class="separator">|</li>
			                            <li>
			                                <a accesskey="3" href="#portal-searchbox" id="link-buscar">
			                                    Ir para a busca
			                                </a>
			                            </li>
			                            <li class="separator">|</li>
			                            <li>
			                                <a accesskey="4" href="#footer" id="link-rodape">
			                                    Ir para o rodapé
			                                </a>
			                            </li>
			                        </ul>
			                    </div>
			                    <!-- fim div.span6 -->
			                </div>
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
					    			<form class="form-wrapper cf" role="search" id="portal-searchbox">
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
				    				<li class="home"><a name="navigation" href="<?= __SITE_NAME__ ?>">HOME</a></li>
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
			if(strcmp($id, $value->id) == 0){
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
		$users = ['raquel da paz oliveira', 'Emanuelle Danttas', 'MariaCecilia', 'Lisandra', 'Joabe Oliveira', 'Icaro Santana', 'Silmara Dias da Silva', 'Maristella', 'Nana Spagnol', 'Priscila', 'Vanessa'];

	?>
		<div class="card-receita <?=($tamanho == 1 ? "card-pequeno" : "card-grande") ?> card-<?= $categoria ?>" itemscope="itemscope" itemtype="http://schema.org/Recipe">
			<a href="<?= __SITE_NAME__ ?>receita/<?= $dados->id ?>/<?= $this->toAscii($dados->name)?>">
				<div class="card-tab">
					<p><?= $nomeCategoria ?></p>
				</div>
				<div class="card-img" style="background-image: url('<?= $foto ?>)">
					<span><?= ucwords($this->limitarTexto($users[array_rand($users)], 25)) ?></span>
				</div>
				<div class="card-descricao">
					<div class="titulo"><?= $dados->name ?></div>
					<div class="descricao">
						<div class="rendimento">
							<p itemprop="recipeYield" value="<?= $dados->recipeYield->value ?>"><span class="fa fa-cutlery" aria-hidden="true"></span><?= $dados->recipeYield->human ?></p>
						</div>
						<div class="tempo">
							<p datetime="<?= $dados->totalTime->dateTime ?>" itemprop="totalTime"><span class="fa fa-clock-o" aria-hidden="true"></span><?= $dados->totalTime->human  ?></p>
						</div>
						<div class="avaliacao">
							<p itemprop="ratingCount"><i class="fa fa-users" aria-hidden="true"></i><?= $dados->aggregateRating->ratingCount ?></p>
							<p itemprop="ratingValue"><i class="fa fa-star" aria-hidden="true"></i></span><?= $dados->aggregateRating->ratingValue  ?></p>
						</div>
					</div>
				</div>
			</a>
		</div>

	<?php
	}//Fim generateCard

	public function footer($carousel = false){
	?>
				<footer id="footer">
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
				<script src="<?= __SITE_NAME__ ?>bin/plugin/jquery_bar_rating/jquery.barrating.min.js"></script>
				<script src="<?= __SITE_NAME__ ?>bin/js/bootstrap-datepicker.js"></script>

				<?php
				if($carousel){ ?>
					<script src="<?= __SITE_NAME__ ?>bin/plugin/owl_carousel/owl.carousel.js"></script>
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
					jQuery(document).ready(function(){ 
						jQuery('#rating-stars').barrating({ 
							theme: 'fontawesome-stars' 
						}); 
						jQuery('#input-data-nascimento').datepicker({
							format: "dd/mm/yyyy",
						    startDate: "-13y",
						    language: "pt-BR"
						});
						jQuery("#input-nome").mask("aZ");
						navColor('aves');
						navColor('bolos');
						navColor('carnes');
						navColor('doces');
						navColor('frutos');
						navColor('massas');
					}); 
					function navColor(classe){
						
 
						hoverOn = function(){
							jQuery("#nav-container").addClass(classe);
						}

						hoverOff = function(){
							jQuery("#nav-container").removeClass(classe);
						}

						jQuery("#nav-container ul li."+classe).hover(hoverOn, hoverOff);
					}

					//só aceita letras
					function soLetras(obj){
					     var tecla = (window.event) ? event.keyCode : obj.which;
					     if((tecla > 65 && tecla < 90)
					         ||(tecla > 97 && tecla < 122))
					               return true;
					     else{
					          if (tecla != 8) return false;
					          else return true;
					     }
					}
				</script>

			</body>
		</html> 

	<?php
	}

	public function toAscii($str) {

		$clean = iconv('UTF-8', 'ASCII//TRANSLIT', $str);
		$clean = preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '', trim($clean));
		$clean = strtolower(trim($clean, '-'));
		$clean = preg_replace("/[\/_|+ -]+/", '-', $clean);

		return $clean;
	}
	function limitarTexto($texto, $limite){
		$contador = strlen($texto);
		if ( $contador >= $limite ) {      
			$texto = substr($texto, 0, strrpos(substr($texto, 0, $limite), ' ')) . '...';
			return $texto;
		}
		else{
			return $texto;
		}
	}
}
?>