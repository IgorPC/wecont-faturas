## Sobre o projeto

Esse projeto foi realizado para atender a demanda da segunda fase do processo seletivo da vaga de Desenvolvedor BackEnd da WeCont.

## Especificações

O projeto foi desenvolvido utilizando a versão 7 do Laravel e o PHP na versão <strong>7.4.9</strong>. Para criação e modelagem do Banco de dados foram utilizadas as Migrations do Laravel e para manipulação dos mesmos foi utilizado o Eloquent como principal recurso.

<h5>Por quais motivos foram utilizados os metodos e recursos acima?</h5>

<ul>
    <li> Apesar da versão 8 do Laravel ja estar diponivel, optei por utilizar a 7 por familiaridade com o Framework e para evitar bugs ou inconsistencias.</li>
    <li> Estou utilizando uma das versões mais atuais do PHP por motivos de convenciencia, acredito que não seja necessario utilizar uma versão mais antiga sem um motivo especifico. </li>
    <li> As migrations foram utilizadas para facilitar uma possivel replicação do projeto em localhost. </li>
    <li> Utilizei o Eloquent pois quis mostrar a familiaridade para com o Framework e como ele minimiza as querys sql. </li>
</ul>

## Instalação do projeto em localhost

Para instalar o projeto, basta clonar esse repositorio e execultar o comando <strong>php artisan migrate</strong>. O comando vai instalar as dependencias necessarias e deixar o projeto pronto para ser usado. Um detalhe importante é que não será necessario criar um <strong>.env</strong> pois eu irei disponibilizar um com o JWT_SECRET, as unicas coisas que precisaram ser alteradas no <strong>.env</strong> serão os dados de acesso ao Banco de dados (Caso necessario).

### Autenticação e acesso a rotas

Com exeção da rota de login, todas as rotas da API são protegidas por autenticação JWT, inclusive a rota de criação de usuarios. Por esse motivo foi disponibilizada uma rota para a criação do usuario ADM (/generate-adm-user). Essa rota cadastra o usuario ADM caso o mesmo não tenha sido criado.
Para acessar as rotas protegidas com JWT deve-se enviar o Header Authorization com o conteudo <strong>Bearer {token}</strong>.
Todas as rotas devem ser enviadas com o Header <strong>Accept application/json</strong>.

<h2>Rotas</h2>
 
 <hr>
 
 <strong>(POST) /login</strong> => Valida o email e senha do usuario e retorna o token para acesso das demais rotas
 <p>Parametros</p>
 <ul>
    <li>email</li>
    <li>password</li>
 </ul>
 
 <hr>
 
 <strong>(GET) /generate-adm-user</strong> => Cadastra o usuario adminstrador caso o mesmo não esteja cadastrado
 
 <hr>

 <strong>(POST) /user</strong> => Cadastra um novo usuario no sistema (So pode ser feito utilizando um token gerado pelo ADM)
 <p>Parametros</p>
 <ul>
    <li>email</li>
    <li>password</li>
    <li>name</li>
 </ul>
 
 <hr>

 <strong>(GET) /user</strong> => Retorna os dados do usuario autenticado (A partir do token)
 <p>Parametros</p>
 
 <hr>
 
 <strong>(DELETE) /user/{id}</strong> => Remove um usuario e suas faturas (Caso existam faturas)
 <p>Parametros</p>
 
 <hr>
 
 <strong>(PUT) /user/{id}</strong> => Atualiza o nom e/ou a senha do usuario
 <p>Parametros</p>
 <ul>
    <li>password</li>
    <li>name</li>
 </ul>
 
 <hr>
 
 <strong>(POST) /bill</strong> => Insere uma nova fatura
 <p>Parametros</p>
 <ul>
    <li>user_id</li>
    <li>due (YYYY-MM-DD)</li>
    <li>url</li>
 </ul>
 
 <hr>
 
 <strong>(GET) /bill</strong> => Retorna todas as faturas do usuario autenticado (A partir do token)

 <hr>
 
 <strong>(PUT) /bill/{id}</strong> => Atualiza o vencimento e/ou a url da fatura desejada
 <p>Parametros</p>
 <ul>
    <li>due (YYYY-MM-DD)</li>
    <li>url</li>
 </ul>
 
 <hr>
 
 <strong>(GET) /bill/{id}</strong> => Retorna os dados de determinada fatura passada na url
 
 <hr>
 
 <strong>(DELETE) /bill/{id}</strong> => Remove determinada fatura passada na url
 
 <hr>
 
 <strong>(PUT) /approve-payment</strong> => Aprova o pagamento (3) de determinada fatura passada na url se a mesma tiver o status como aberta (1) e ou atrasada(2)
 
 <hr>

## Regras importantes a serem consideradas

<ul>
    <li>Apenas o usuario autenticado pelo token pode ter acesso e modificar dados pertinentes a sua conta, bem como as proprias faturas.</li>
    <li>As faturas possuem três tipos de status, 1 -> Aberta, 2 -> Atrasada e 3 -> Paga.</li>
    <li>A unica forma de alterar o status de uma fatura é mudando seu vencimento (due) ou aprovando seu pagamento pela rota apropriada.</li>
    <li>Os dados de acesso da conta ADM são: <strong>Email: adm@adm.com | senha: 123456</strong>.</li>
    <li>O email é unico e imutavel.</li>
    <li>A url da fatura é unica, mas pode ser alterada desde que não coincida com outra url cadastrada no banco.</li>
</ul>    

## Hospedagem

A aplicação se encontra hospedada na heroku para ser consumida. Foi criada uma documentação com mais detalhes visuais e mais simples de ser interpretada nesse link <a href ="https://wecont-faturas.herokuapp.com/">Documentação</a>

A url base para a API hospedada na heroku é: https://wecont-faturas.herokuapp.com/api

