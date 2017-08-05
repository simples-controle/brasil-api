<?php

/* @var $this yii\web\View */

$this->title = 'SUPER API';
$token = '';
if(isset(Yii::$app->user->identity)){
	$token = Yii::$app->user->identity->auth_key;
	?>
	<div  class="bg-primary" style="padding-left:10px;padding-right:10px;">
		<hr/>
		<p>
			<b>E-mail de registro: </b><?=Yii::$app->user->identity->username?>
		</p>
		<h3>
			<i class="glyphicon glyphicon-ok"></i> <b>ACCESS TOKEN: </b>
			<span class="label label-success"><?=$token ?></span>
		</h3>
		<br>
		<p>
			Para qualquer consulta a API você precisará usar sua Chave de Autenticação ACCESS TOKEN
		</p>
		<hr/>

	</div>
	<?php
}
?>

<hr/>
<h3> <i class="glyphicon glyphicon-bullhorn"></i> <b>SOBRE A SUPER API</b></h3>
<hr/>
<p>
	A Super API é um projeto que tem o objetivo de ajudar desenvolvedores, web designers e estudantes a integrar dados aos seus projetos, 
	sejam sites, aplicativos mobile ou plataformas web. 
	Não somos a fonte do dado, e sim um HUB de dados, 
	conectado a diversas fontes de dados, padronizando, 
	e disponibilizando para consulta dos usuários 
	em suas implementações. 
	Sendo assim, nos reservamos da obrigação de manter as APIs 
	no ar sem data limite de disponibilidade, 
	sempre que uma fonte de dado sair do ar, 
	e nosso time não conseguir achar outra fonte de dado 
	que a subistituia, essa API sairá do ar, 
	pois ficaremos sem fonte de dados para conectarmos 
	ao nosso HUB de webservices. 
	
</p>


<br/>
<hr/>
<h3> <i class="glyphicon glyphicon-thumbs-up"></i> <b>AJUDE A MANTER</b></h3>
<hr/>
Faça uma doação voluntária ao time desenvolvedor em qualquer valor, isso irá custear o desenvolvimento, domínio, servidores e suporte.
<br>
<br>
<b>Suporte: </b> lbtecnologia@gmail.com
<br>
<br>
	
<!-- INICIO FORMULARIO BOTAO PAGSEGURO -->
<form action="https://pagseguro.uol.com.br/checkout/v2/donation.html" method="post">
<!-- NÃO EDITE OS COMANDOS DAS LINHAS ABAIXO -->
<input type="hidden" name="currency" value="BRL" />
<input type="hidden" name="receiverEmail" value="lbtecnologia@gmail.com" />
<input type="hidden" name="iot" value="button" />
<input type="image" src="https://stc.pagseguro.uol.com.br/public/img/botoes/doacoes/184x42-doar-assina.gif" name="submit" alt="Pague com PagSeguro - é rápido, grátis e seguro!" />
</form>
<!-- FINAL FORMULARIO BOTAO PAGSEGURO -->


<?php
if(!isset(Yii::$app->user->identity)){
	?>

	<br/>
	<hr/>
	<h3> <i class="glyphicon glyphicon-user"></i> <b>CRIE SUA CONTA GRÁTIS</b></h3>
	<hr/>

	<a href="user-management/auth/registration" class="btn btn-lg btn-success"><i class="glyphicon glyphicon-ok"></i> Criar Conta e Obter Minha ACCESS TOKEN</a>
	<a href="user-management/auth/login" class="btn btn-lg btn-primary"><i class="glyphicon glyphicon-user"></i> Logar em minha conta!</a>

	<br>
	<br>
	<?php
}
?>


<br/>
<hr/>
<h3> <i class="glyphicon glyphicon-screenshot"></i> <b>API'S</b></h3>
<hr/>

<div style="border:1px solid #DDDDDD; background:#ECECEC; padding:10px;">
	<h4 > <i class="glyphicon glyphicon-usd"></i> <b>CÂMBIO</b> </h4>
	<hr>
	<table class="table table-striped table-bordered table-hover table-responsive">
		<thead>
			<th style="width:15%">API</th>
			<th style="width:55%">DESCRIÇÃO</th>
			<th style="width:30%">METÓDO</th>
		</thead>
		<tbody>
			<tr>
				<td>EURO X REAL</td>
				<td>Consulta no Yahoo Finance a taxa de câmbio Euro x Real</td>
				<td><a href="/cambio/euro-real/?access-token=<?=$token ?>" target="_blank" class="btn btn-block btn-primary">/cambio/euro-real</a></td>
			</tr>
			<tr>
				<td>DOLAR X REAL</td>
				<td>Consulta no Yahoo Finance a taxa de câmbio Dólar x Real</td>
				<td><a href="/cambio/dolar-real/?access-token=<?=$token ?>" target="_blank" class="btn btn-block btn-primary">/cambio/dolar-real</a></td>
			</tr>
			
		</tbody>
	</table>
	<small>Fonte Yahoo</small>
</div>

<br>

<div style="border:1px solid #DDDDDD; background:#ECECEC; padding:10px;">
	<h4 > <i class="glyphicon glyphicon-stats"></i> <b>BOVESPA</b> </h4>
	<hr>
	<table class="table table-striped table-bordered table-hover table-responsive">
		<thead>
			<th style="width:15%">API</th>
			<th style="width:55%">DESCRIÇÃO</th>
			<th style="width:30%">METÓDO</th>
		</thead>
		<tbody>
			<tr>
				<td>PETR3</td>
				<td>Consulta no Yahoo Finance o valor da ação da PETROBRAS S/A</td>
				<td><a href="bovespa/petr3/?access-token=<?=$token ?>" target="_blank" class="btn btn-block btn-primary">/bovespa/petr3</a></td>
			</tr>
			<tr>
				<td>PETR4</td>
				<td>Consulta no Yahoo Finance o valor da ação da PETROBRAS S/A</td>
				<td><a href="bovespa/petr4/?access-token=<?=$token ?>" target="_blank" class="btn btn-block btn-primary">/bovespa/petr4</a></td>
			</tr>
			<tr>
				<td>TOTS3</td>
				<td>Consulta no Yahoo Finance o valor da ação da TOTVS SISTEMAS</td>
				<td><a href="bovespa/tots3/?access-token=<?=$token ?>" target="_blank" class="btn btn-block btn-primary">/bovespa/tots3</a></td>
			</tr>
			<tr>
				<td>VALE3</td>
				<td>Consulta no Yahoo Finance o valor da ação da VALE S/A (ANTIGA VALE DO RIO DOCE)</td>
				<td><a href="bovespa/vale3/?access-token=<?=$token ?>" target="_blank" class="btn btn-block btn-primary">/bovespa/vale3</a></td>
			</tr>
			<tr>
				<td>VALE5</td>
				<td>Consulta no Yahoo Finance o valor da ação da VALE S/A (ANTIGA VALE DO RIO DOCE)</td>
				<td><a href="bovespa/vale5/?access-token=<?=$token ?>" target="_blank" class="btn btn-block btn-primary">/bovespa/vale5</a><td>
			</tr>
			<tr>
				<td>ELET3</td>
				<td>Consulta no Yahoo Finance o valor da ação da ELETROBRAS</td>
				<td><a href="bovespa/elet3/?access-token=<?=$token ?>" target="_blank" class="btn btn-block btn-primary">/bovespa/elet3</a></td>
			</tr>
			<tr>
				<td>ELET6</td>
				<td>Consulta no Yahoo Finance o valor da ação da ELETROBRAS</td>
				<td><a href="bovespa/elet6" target="_blank" class="btn btn-block btn-primary">/bovespa/elet6</a></td>
			</tr>
			<tr>
				<td>BBAS3</td>
				<td>Consulta no Yahoo Finance o valor da ação da BANCO DO BRASIL S/A</td>
				<td><a href="bovespa/bbsa3/?access-token=<?=$token ?>" target="_blank" class="btn btn-block btn-primary">/bovespa/bbsa3</a></td>
			</tr>
			<tr>
				<td>BBDC3</td>
				<td>Consulta no Yahoo Finance o valor da ação da BANCO bradesco S/A</td>
				<td><a href="bovespa/bbdc3/?access-token=<?=$token ?>" target="_blank" class="btn btn-block btn-primary">/bovespa/bbdc3</a></td>
			</tr>
			<tr>
				<td>BBDC4</td>
				<td>Consulta no Yahoo Finance o valor da ação da BANCO bradesco S/A</td>
				<td><a href="bovespa/bbdc4/?access-token=<?=$token ?>" target="_blank" class="btn btn-block btn-primary">/bovespa/bbdc4</a></td>
			</tr>
		</tbody>
	</table>
	<small>Fonte Yahoo</small>
</div>

<br>

<div style="border:1px solid #DDDDDD; background:#ECECEC; padding:10px;">
	<h4 > <i class="glyphicon glyphicon-briefcase"></i> <b>CONTÁBIL</b> </h4>
	<hr>
	<table class="table table-striped table-bordered table-hover table-responsive">
		<thead>
			<th style="width:15%">API</th>
			<th style="width:55%">DESCRIÇÃO</th>
			<th style="width:30%">METÓDO</th>
		</thead>
		<tbody>
			<tr>
				<td>CRT</td>
				<td>Lista de Código+Nome na tabela CODIGO DO REGIME TRIBUTÁRIO (CRT)</td>
				<td><a href="contabil/crt/?access-token=<?=$token ?>" target="_blank" class="btn btn-block btn-primary">/contabil/crt</a></td>
			</tr>
			
			
		</tbody>
	</table>
	<small>Fonte RECEITA FEDERAL</small>
</div>

<br>



<div style="border:1px solid #DDDDDD; background:#ECECEC; padding:10px;">
	<h4 > <i class="glyphicon glyphicon-envelope"></i> <b>CORREIOS</b> </h4>
	<hr>
	<table class="table table-striped table-bordered table-hover table-responsive">
		<thead>
			<th style="width:15%">API</th>
			<th style="width:55%">DESCRIÇÃO</th>
			<th style="width:30%">METÓDO</th>
		</thead>
		<tbody>
			<tr>
				<td>CEP</td>
				<td>
					Consulta um determinado CEP e retorna dados de logradouro, bairro, cidade, uf, códigos ibge da localidade.
				</td>
				<td><a href="correios/consulta-cep?cep=57046-831&access-token=<?=$token ?>" target="_blank" class="btn btn-block btn-primary">correios/consulta-cep?cep=57046-831</a></td>
			</tr>
			
			
			
		</tbody>
	</table>
	<small>Fonte Várias</small>
</div>

<br>

<div style="border:1px solid #DDDDDD; background:#ECECEC; padding:10px;">
	<h4 > <i class="glyphicon glyphicon-map-marker"></i> <b>GEOGRÁFICO</b> </h4>
	<hr>
	<table class="table table-striped table-bordered table-hover table-responsive">
		<thead>
			<th style="width:15%">API</th>
			<th style="width:55%">DESCRIÇÃO</th>
			<th style="width:30%">METÓDO</th>
		</thead>
		<tbody>
			<tr>
				<td>ESTADOS BR</td>
				<td>
					Retorna uma lista simples do tipo SIGLA => ESTADO com todos os estados brasileiros.
				</td>
				<td><a href="geo/estados/?access-token=<?=$token ?>" target="_blank" class="btn btn-block btn-primary">geo/estados</a></td>
			</tr>
			
			
			
		</tbody>
	</table>
	<small>Fonte IBGE</small>
</div>

<br>


<div style="border:1px solid #DDDDDD; background:#ECECEC; padding:10px;">
	<h4 > <i class="glyphicon glyphicon-piggy-bank"></i> <b>FINANCEIRO</b> </h4>
	<hr>
	<table class="table table-striped table-bordered table-hover table-responsive">
		<thead>
			<th style="width:15%">API</th>
			<th style="width:55%">DESCRIÇÃO</th>
			<th style="width:30%">METÓDO</th>
		</thead>
		<tbody>
			<tr>
				<td>BANCOS BR</td>
				<td>
					Retorna uma lista simples do tipo CÓDIGO => BANCO com todos os bancos brasileiros.
				</td>
				<td><a href="financeiro/bancos/?access-token=<?=$token ?>" target="_blank" class="btn btn-block btn-primary">financeiro/bancos</a></td>
			</tr>
			
			
			
		</tbody>
	</table>
	<small>Fonte Banco Central</small>
</div>

<br>


<div style="border:1px solid #DDDDDD; background:#ECECEC; padding:10px;">
	<h4 > <i class="glyphicon glyphicon-fire"></i> <b>CLIMA E TEMPO</b> </h4>
	<hr>
	<table class="table table-striped table-bordered table-hover table-responsive">
		<thead>
			<th style="width:15%">API</th>
			<th style="width:55%">DESCRIÇÃO</th>
			<th style="width:30%">METÓDO</th>
		</thead>
		<tbody>
			<tr>
				<td>TEMPO AGORA</td>
				<td>
					Retorna dados sobre o clima de agora em uma cidade dada.
					<br>
					A fonte de dados é o site climatempo.com.br
					<br>
					Para saber qual cidade informar na consulta a API, basta
					procurar a cidade no site clima tempo e copiar do final da URL o 'codigo/cidade'. 
					<br>
					Por exemplo 321/riodejaneiro-rj para Cidade do Rio de Janeiro (RJ).
				</td>
				<td><a href="tempo/agora?cidade=321/riodejaneiro-rj&access-token=<?=$token ?>" target="_blank" class="btn btn-block btn-primary">tempo/agora?cidade=321/riodejaneiro-rj</a></td>
			</tr>
			
			
			
		</tbody>
	</table>
	<small>Site Clima Tempo</small>
</div>

<br>