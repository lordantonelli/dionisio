<?php
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

	public function header(){

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
			    <link rel="stylesheet" href="bin/css/style.css">
			    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
			    <!-- <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,300,400italic,300italic' rel='stylesheet' type='text/css'> -->

			</head>

		    <body data-spy="scroll" data-target=".navbar" data-offset="135">
		    	<header>
		    		<!-- <div class="borda-grega"></div> -->
		    		<div id="header-banner" >
		    			<div class="container">
		    				<h1 class="logo">Divinas Receitas</h1>
		    			</div>
	    			</div>
	    			<nav class="navbar" data-spy="affix" data-offset-top="135">
	    				<div class="container" id="nav-container">
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
				    				<li class="aves"><a href="lista.php?categoria=aves">AVES</a></li>
				    				<li class="bolos"><a href="lista.php?categoria=bolos" >BOLOS E TORTAS</a></li>
				    				<li class="carnes"><a href="lista.php?categoria=carnes">CARNES</a></li>
				    				<li class="doces"><a href="lista.php?categoria=doces" >DOCES</a></li>
				    				<li class="frutos"><a href="lista.php?categoria=frutos">FRUTOS DO MAR</a></li>
				    				<li class="massas"><a href="lista.php?categoria=massas">MASSAS</a></li>
				    			</ul>
				    			<form class="navbar-form navbar-right" role="search">
				    				<div class="form-group">
				    					<input list="Receitas" type="text" placeholder="Digite o nome da receita" class="form-control" id="">
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
				    				</div>
				    				<button type="submit" class="btn btn-default">Procurar</button>
				    			</form>
				    		</div><!-- /.navbar-collapse -->
				    	</div><!-- /container -->
				    </nav>
			    </header>
	<?php
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

		$foto = $dados['images'][0]['link'];
		
	?>
		<div class="card-receita <?=($tamanho == 1 ? "card-pequeno" : "card-grande") ?> card-<?= $categoria ?>">
			<div class="card-tab">
				<p><?= $nomeCategoria ?></p>
			</div>
			<div class="card-img" style="background-image: url('<?= $dados['images'][0]['link'] ?>)">

			</div>
			<div class="card-descricao">
				<div class="titulo"><?= $dados->name ?></div>
				<div class="descricao">
					<div class="rendimento">
						<i class="fa fa-cutlery" aria-hidden="true"></i>
						<p><?= $dados->recipeYield->human ?></p>
					</div>
					<div class="tempo">
						<i class="fa fa-clock-o" aria-hidden="true"></i>
						<p><?= $dados->totalTime->human  ?></p>
					</div>
				</div>
			</div>
		</div>

	<?php
	}//Fim generateCard

	public function footer(){
	?>
				<footer>
					<div class="container">
						<div class="row">
							<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
								<h2>Categorias</h2>
								<ul>
									<li><a href="lista.php?categoria=aves"  >AVES</a></li>
				    				<li><a href="lista.php?categoria=bolos" >BOLOS E TORTAS</a></li>
				    				<li><a href="lista.php?categoria=carnes">CARNES</a></li>
				    				<li><a href="lista.php?categoria=doces" >DOCES</a></li>
				    				<li><a href="lista.php?categoria=frutos">FRUTOS DO MAR</a></li>
				    				<li><a href="lista.php?categoria=massas">MASSAS</a></li>
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
}
?>