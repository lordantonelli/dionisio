<?php
session_start();
session_unset();

include('./bin/class/structure.php');


$structure = new Structure;

$structure -> header();
?>

<section id="section" class="cadastro-sec1">
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
				<aside>
					<div class="row">
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
							<h2>Entrar</h2>
						</div>
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
							<form id="form-login" onSubmit="login(); return false;">
								<div class="form-group">
									<label for="input-email-log">Email</label>
									<input type="email" class="form-control" id="input-email-log" placeholder="Email">
								</div>
								<div class="form-group">
									<label for="input-senha-log">Senha</label>
									<input type="password" class="form-control" id="input-senha-log" placeholder="Senha">
								</div>
								<button type="submit" class="btn btn-warning">Cadastrar</button>
							</form>
						</div>
					</div>		
				</aside>
			</div>
			<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 blue-grey-border-left">
				<div class="row">
					<form id="form-cadastro" onsubmit="cadastrar(); return false;">
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
							<h2>Cadastrar</h2>
						</div>
						<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
							<div class="form-group">
								<label for="input-nome">Nome completo</label>
								<input type="text" class="form-control onlyLetter" id="input-nome" placeholder="Nome completo" required="required" >
							</div>
						</div>
						<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
							<div class="form-group">
								<label for="input-data-nascimento">Data de nascimento (&gt;13 anos)</label>
								<input type="text" class="form-control" id="input-data-nascimento" required="required">
							</div>
						</div>
						<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
							<div class="form-group">
								<label for="input-cidade">Cidade:</label>
								<input type="text" class="form-control onlyLetter" id="input-cidade" placeholder="Nome da cidade" required="required">
							</div>
						</div>
						<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
							<div class="form-group">
								<label for="input-estado">Estado:</label>
								<select class="form-control" name="input-estado"  required="required"> 
									<option value="">Selecione o Estado</option> 
									<option value="ac">Acre</option> 
									<option value="al">Alagoas</option> 
									<option value="am">Amazonas</option> 
									<option value="ap">Amapá</option> 
									<option value="ba">Bahia</option> 
									<option value="ce">Ceará</option> 
									<option value="df">Distrito Federal</option> 
									<option value="es">Espírito Santo</option> 
									<option value="go">Goiás</option> 
									<option value="ma">Maranhão</option> 
									<option value="mt">Mato Grosso</option> 
									<option value="ms">Mato Grosso do Sul</option> 
									<option value="mg">Minas Gerais</option> 
									<option value="pa">Pará</option> 
									<option value="pb">Paraíba</option> 
									<option value="pr">Paraná</option> 
									<option value="pe">Pernambuco</option> 
									<option value="pi">Piauí</option> 
									<option value="rj">Rio de Janeiro</option> 
									<option value="rn">Rio Grande do Norte</option> 
									<option value="ro">Rondônia</option> 
									<option value="rs">Rio Grande do Sul</option> 
									<option value="rr">Roraima</option> 
									<option value="sc">Santa Catarina</option> 
									<option value="se">Sergipe</option> 
									<option value="sp">São Paulo</option> 
									<option value="to">Tocantins</option> 
								</select>
							</div>
						</div>
						<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
							<div class="form-group">
								<label for="input-telefone">Telefone:</label>
								<input type="text" class="form-control" id="input-telefone" required="required" placeholder="(xx) x xxxx-xxxx" >
							</div>
						</div>

						<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
							<div class="form-group">
								<label for="input-email">Email:</label>
								<input type="email" class="form-control" id="input-email" required="required" >
							</div>
						</div>
						<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
							<div class="form-group">
								<label for="input-senha">Senha:</label>
								<input type="password" class="form-control" id="input-senha"  required="required">
							</div>
						</div>
						<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
							<div class="form-group">
								<label for="input-senha2">Confirmação da senha:</label>
								<input type="password" class="form-control" id="input-senha2"  required="required">
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