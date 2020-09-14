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

## Rotas

 <strong>/login</strong> => Valida o email e senha do usuario e retorna o token para acesso das demais rotas


'/generate-adm-user'

'/user'

'/user'
'/user/{id}'
'/user/{id}'
'/bill'
'/bill'
'/bill/{id}'
'/bill/{id}'
'/bill/{id}'
/approve-payment/{id}'

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
