<?php
session_start();
session_unset();

include('./bin/class/structure.php');


$structure = new Structure;

$structure -> header();
?>

<section id="cadastro-sec1">
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
				<aside>
					<div class="row">
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
							<h2>Entrar</h2>
						</div>
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
							<form id="form-login">
								<div class="form-group">
									<label for="input-email">Email</label>
									<input type="email" class="form-control" id="imput-email" placeholder="Email">
								</div>
								<div class="form-group">
									<label for="input-senha">Senha</label>
									<input type="password" class="form-control" id="input-senha" placeholder="Senha">
								</div>
							</form>
						</div>
					</div>		
				</aside>
			</div>
			<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 blue-grey-border-left">
				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<h2>Cadastrar</h2>
					</div>
					<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
						<div class="form-group">
							<label for="input-nome">Nome completo:</label>
							<input type="text" class="form-control" id="input-nome" placeholder="Nome completo">
						</div>
					</div>
					<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
						<div class="form-group">
							<label for="input-nome">Nascimento</label>
							<input type="text" class="form-control" id="input-nome" placeholder="Senha">
						</div>
					</div>
					<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
						<div class="form-group">
							<label for="input-nome">Cidade:</label>
							<input type="text" class="form-control" id="input-nome" placeholder="Nome completo">
						</div>
					</div>
					<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
						<div class="form-group">
							<label for="input-nome">Estado:</label>
							<input type="text" class="form-control" id="input-nome" placeholder="Nome completo">
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<?php
$structure -> footer();