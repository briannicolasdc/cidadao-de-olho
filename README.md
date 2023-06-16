Objetivo do projeto:

Monitorar o gasto público estadual em verbas indenizatórias;

Intruções de como rodar o projeto:

Clone o repositorio dentro do repositorio do projeto, rode o comando
'mysql -h 127.0.0.1 -P 3306 -u root -p deputadosDB'
e digite a senha 'password' quando requisitado;

Após conectar ao db, abra outra aba no terminal
e insira o comando 'php artisan serve' e acesse a url 127.0.0.1:8000;

Em seguida,abra uma terceira aba no terminal
e rode php artisan migrate:fresh para
que o DB funcione corretamente;

Descrição do código:

\App\Http\Controllers\JsonController.php : 

Essa classe possui uma única função 'store' que chama uma função da classe PostController que requisita
a lista de deputados em json para a api, limpa a tabela do db e insere os dados 
na tabela;

\App\Http\Controllers\PostController.php

Essa classe possui 5 funções:

'getDeputadosList' que recebe a lista de deputados da api;

'getGastosMesDeputado' que recebe o id do deputado e o mês
referente aos gastos, e requisita esses dados para a api;

'getGastoTotalDeputado' que recebe o id do deputado e calcula
o gasto total dele no ano de 2019;

'deputados' que armazena o gasto de cada deputado e seu nome
no array, ordena-o e seleciona os 5 deputados que mais gastaram;

'getRedes' que percorre a lista com todos os deputados, e conta
quantos deputados utilizam cada uma delas;

\routes\web.php: diretório onde são definidas as rotas






