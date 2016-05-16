<?php
session_start();

include('./bin/class/structure.php');

if(empty($_COOKIE['session'])){
	header("Location: index.php"); 
}

$structure = new Structure;

$structure -> header();
?>

<section id="section" class="cadastro-receita-sec1">
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-sm-8 col-md-8 col-md-offset-2 col-lg-8  col-lg-offset-2 blue-grey-border-left-right">
				<div class="row">
					<form id="form-cadastro-receita" onsubmit="cadastrar_receita(); return false;">
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
							<h2>Cadastrar receita</h2>
						</div>
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
							<div class="form-group">
								<label for="input-nome-receita">Nome da receita</label>
								<input type="text" class="form-control onlyLetter" id="input-nome-receita" placeholder="Nome da receita" required="required" maxlength="10" />
							</div>
							<div class="form-group">
								<label for="input-categoria">Categoria</label>
								<select class="form-control" id="input-categoria" name="input-categoria"  required="required"> 
									<option value="">Selecione a categoria</option> 
									<option value="aves">Aves</option> 
									<option value="bolos">Bolos e tortas</option>
									<option value="carnes">Carnes</option> 
									<option value="doces">Doces</option> 
									<option value="frutos">Frutos do mar</option> 
									<option value="massas">Massas</option>
								</select>
							</div>
							<div class="form-group">
								<label for="input-fotos">Selecione as fotos</label>
								<input class="form-control" type="file" id="input-fotos" name="input-fotos" multiple required="required" />
							</div>
							<div class="form-group">
								<label for="input-ingrediente">Ingredientes</label>
								<div id="input-ingredientes">
									<input type="text" class="form-control input-ingredientes" id="input-ingrediente" name="input-ingredientes[]" placeholder="Ingrediente 1" required="required"/>
								</div>
								<button type="button" onclick="addItemLista('#input-ingredientes', 'Ingrediente');">Adicionar ingrediente</button>
							</div>
							<div class="form-group">
								<label for="input-preparo">Modo de preparo</label>
								<div id="input-preparos">
									<input type="text" class="form-control input-preparos" id="input-preparo" name="input-preparo[]" placeholder="Passo 1" required="required"/>
								</div>
								<button type="button" onclick="addItemLista('#input-preparos', 'Passo');">Adicionar passo</button>

							</div>
						</div>
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
							<button type="submit" class="btn btn-warning" >Cadastrar</button>
						</div>

					</form>
				</div>
			</div>
		</div>
	</div>
</section>
<?php
$structure -> footer();