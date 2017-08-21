
BRASIL API
============================

Brasil API é um projeto que tem o objetivo de ser um HUB de dados para desenvolvedores brasileiros. Ele deve concentrar todos os tipos de dados possíveis que desenvolvedores costumam capturar (aka catar) por aí em diversas fontes, ou por falta de experiência e conhecimento não conseguem fazer captações mais complexas como buscar e processar html (DOM) deterceiros no backend.

Para usar,  é preciso criar uma conta e ter uma access token no site do projeto www.brasilapi.com e lá tem instruções sobre todas as API's em produção (rodando).

Tecnologia empregada
--

Desenvolvido em PHP usando o Framework Yii2 e seus recursos para construção de webservices restfull (API Restfull) e usando banco de dados Mysql. 

Como colaborar?
--
1 - Abrindo issues sobre novas API's ou melhorias e erros nas atuais, nesse caso procure e informe posíveis fontes de dados na issue e reporte sempre as menssagens de erro caso seja um bug.

2 - Codificando e submetendo PR com correçes, melhorias, novas API's, etc.

Como instalar o ambiente para desenvolvimento?
-----

Antes de mais nada tenha um ambiente APACHE2 + MYSQL + PHP7 SOBRE LINUX (DE PREFERNCIA DEBIAN E DERIVADOS ;) ).

Em breve vamos estabelecer um docker para isso.

Pra instalar seu ambiente de desenvolvimento:

1 - Em primeiro lugar faça um clone desse projeto, em ambiente Linux rode:

``
git clone https://github.com/sururulab/brasil-api
``

2 - Depois, na pasta raíz d oprojeto rode o comando composer abaixo para atualizar as dependencias do projeto:

``
composer update
``

3 - Configure sua conexão com o banco de dados, já tendo um banco de dados novo e vazio sido criado. Edite o aquivo:

``
config/db.php
``

4 - E por fim implante no banco as suas novas versões, isso  feito atráves dos migrations, para isso rode o comando:

``
php yii migrate
``

Se tudo deu certo você já pode acessar o ambiente via navegador.


E ao programar?
-----

Seguir e usar o máximo de coisas e padres já estabelecidos pelo YII2 Framework (www.yiiframework.com) e os padres (stand) do PHP.

Sempre que construír uma nova API (controlador restfull) ou um novo método em algum existente, documentar o mesmo na view abaixo:

``
views/site/index.php
``
Usar sempre fontes de dados seguras, citar a fonte, tratar os dados e deveolver sempre texto puro em formatação padrão (tipos númericos, datas, etc).

Se for criar novas features que use banco de dados, criar suas modificações via YII2 migrations (www.yiiframework.com)

Se possível plugar testes de aceitação e de unidade usando o padrão YII2 Codecption (www.yiiframework.com) em toda modificação feita, se possível faça isso para o que já tem pronto!




