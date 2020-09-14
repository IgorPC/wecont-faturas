<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Documentação</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/35505cabf9.js" crossorigin="anonymous"></script>

    <style>
        body{
            background-color: #f8f9fa;
        }
        .bdg{
            font-size: 18px;
        }
        .ac-bg-success{
            background-color: #00FF7F;
        }

        .ac-bg-warning{
            background-color: #F0E68C;
        }
        .ac-bg-info{
            background-color: #7FFFD4;
        }
        .ac-bg-danger{
            background-color: #FF6347;
        }
        .ac-title{
            text-decoration: none;
            font-weight: bold;
            font-size: 18px;
            color: black;
        }
        .ac-description{
            color: black;
            font-size: 14px;
            font-weight: bold;
        }
        .buttom-hover:hover{
            text-decoration: none;
        }
    </style>

</head>
<body>
<div class="container mb-4">
    <div class="jumbotron mt-2">
        <h1 class="display-4">Projeto de Faturas, We Cont!</h1>
        <p class="lead">Esse projeto foi desenvolvido para a segunda fase do processo seletivo para desenvolvedor BackEnd da We Cont.</p>
        <hr class="my-4">
        <p>Abaixo estará descrito as rotas, seus parametros e retornos.</p>
        <a class="btn btn-outline-dark float-left" href="https://github.com/IgorPC/wecont-faturas" role="button">Código no GitHub <i class="fab fa-github"></i> </a>
        <button class="btn btn-outline-info float-right" data-toggle="modal" data-target="#exampleModal" role="button">Informações Importantes <i class="fas fa-info-circle"></i> </button>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Informações Importantes</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Os dados de acesso do ADM são:</p>
                    <p>Email: <strong>adm@adm.com</strong></p>
                    <p>Password: <strong>123456</strong></p>
                    <hr>
                    <p>As rotas que possuem uma chave são protegidas por autenticação JWT, e apenas informações
                    e atualizações referentes ao dono do token estão disponiveis. Ou seja, é possivel atualizar e
                    visualizar os proprios dados.</p>
                    <hr>
                    <p>A conta ADM não pode ser alterada nem excluida.</p>
                    <p>O campo de email é unico e imutavel.</p>
                    <p>Os demais dados são passiveis de atualização, desde que sigam as regras pre-definidas.</p>
                    <hr>
                    <p>Todas as requisições devem ter o <strong>Header</strong> Accept: application/json</p>
                    <hr>
                    <p>Para informações mais detalhadas sobre cada rota, acesse a documentação disponivel no <a
                            href="https://github.com/IgorPC/wecont-faturas">GitHub</a>.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>

    <h3>Autenticação</h3>
    <div class="mt-4" id="accordion">
        <div class="card">
            <div class="card-header ac-bg-warning" id="headingOne">
                <h5 class="mb-0">
                    <button class="btn btn-link buttom-hover" data-toggle="collapse" data-target="#collapse1" aria-expanded="true" aria-controls="collapse1">
                        <span class="badge badge-pill badge-warning bdg">POST</span>
                        <span class="ml-4 ac-title">/login</span>
                        <span class="ml-5 ac-description"><i class="fas fa-arrow-right"></i> Valida o EMAIL e SENHA do Usuário e retorna um token valido</span>
                    </button>
                    <!--<span class="float-right mt-2"> <i class="fas fa-key"></i></span>-->
                </h5>
            </div>

            <div id="collapse1" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                <div class="card-body">
                    <p CLASS="text-center"> <i class="fas fa-link"></i> {{env('APP_URL')}}/api/login</p>
                    <div class="row">
                        <div class="col-md-6">
                            <h4>Campos: </h4>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">email</li>
                                <li class="list-group-item">password</li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <h4>Retorno: </h4>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">Token</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--END-->
    <hr>
    <h3>Usuário</h3>
    <div class="mt-4" id="accordion">
        <div class="card">
            <div class="card-header ac-bg-success" id="headingOne">
                <h5 class="mb-0">
                    <button class="btn btn-link buttom-hover" data-toggle="collapse" data-target="#collapse2" aria-expanded="true" aria-controls="collapse1">
                        <span class="badge badge-pill badge-success bdg">GET</span>
                        <span class="ml-4 ac-title">/generate-adm-user</span>
                        <span class="ml-5 ac-description"><i class="fas fa-arrow-right"></i> Cadastra o usuario adminstrador caso o mesmo ainda não exista </span>
                    </button>
                    <!--<span class="float-right mt-2"> <i class="fas fa-key"></i></span>-->
                </h5>
            </div>

            <div id="collapse2" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                <div class="card-body">
                    <p CLASS="text-center"> <i class="fas fa-link"></i> {{env('APP_URL')}}/api/generate-adm-user</p>
                    <div class="row">
                        <div class="col-md-6">
                            <h4>Campos: </h4>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">Sem Parametros</li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <h4>Retorno: </h4>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">Sem retorno</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--END-->
    <div class="mt-2" id="accordion">
        <div class="card">
            <div class="card-header ac-bg-warning" id="headingOne">
                <h5 class="mb-0">
                    <button class="btn btn-link buttom-hover" data-toggle="collapse" data-target="#collapse3" aria-expanded="true" aria-controls="collapse1">
                        <span class="badge badge-pill badge-warning bdg">POST</span>
                        <span class="ml-4 ac-title">/user</span>
                        <span class="ml-5 ac-description"><i class="fas fa-arrow-right"></i> Cadastra um novo usuario ao sistema (Apenas o ADM pode efetuar o cadastro) </span>
                    </button>
                    <span class="float-right mt-2"> <i class="fas fa-key"></i></span>
                </h5>
            </div>

            <div id="collapse3" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                <div class="card-body">
                    <p CLASS="text-center"> <i class="fas fa-link"></i> {{env('APP_URL')}}/api/user</p>
                    <div class="row">
                        <div class="col-md-6">
                            <h4>Campos: </h4>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">name</li>
                                <li class="list-group-item">email</li>
                                <li class="list-group-item">password</li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <h4>Retorno: </h4>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">Sem retorno</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--END-->
    <div class="mt-2" id="accordion">
        <div class="card">
            <div class="card-header ac-bg-success" id="headingOne">
                <h5 class="mb-0">
                    <button class="btn btn-link buttom-hover" data-toggle="collapse" data-target="#collapse4" aria-expanded="true" aria-controls="collapse1">
                        <span class="badge badge-pill badge-success bdg">GET</span>
                        <span class="ml-4 ac-title">/user</span>
                        <span class="ml-5 ac-description"><i class="fas fa-arrow-right"></i> Retorna os dados do usuario autenticado </span>
                    </button>
                    <span class="float-right mt-2"> <i class="fas fa-key"></i></span>
                </h5>
            </div>

            <div id="collapse4" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                <div class="card-body">
                    <p CLASS="text-center"> <i class="fas fa-link"></i> {{env('APP_URL')}}/api/user</p>
                    <div class="row">
                        <div class="col-md-6">
                            <h4>Campos: </h4>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">Sem Parametros</li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <h4>Retorno: </h4>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">name</li>
                                <li class="list-group-item">email</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--END-->
    <div class="mt-2" id="accordion">
        <div class="card">
            <div class="card-header ac-bg-danger" id="headingOne">
                <h5 class="mb-0">
                    <button class="btn btn-link buttom-hover" data-toggle="collapse" data-target="#collapse5" aria-expanded="true" aria-controls="collapse1">
                        <span class="badge badge-pill badge-danger bdg">DELETE</span>
                        <span class="ml-4 ac-title">/user/{id}</span>
                        <span class="ml-5 ac-description"><i class="fas fa-arrow-right"></i> Remove um usuario e suas faturas (Caso existam) </span>
                    </button>
                    <span class="float-right mt-2"> <i class="fas fa-key"></i></span>
                </h5>
            </div>

            <div id="collapse5" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                <div class="card-body">
                    <p CLASS="text-center"> <i class="fas fa-link"></i> {{env('APP_URL')}}/api/user/{id}</p>
                    <div class="row">
                        <div class="col-md-6">
                            <h4>Campos: </h4>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">Sem Parametros</li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <h4>Retorno: </h4>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">Sem Retorno</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--END-->
    <div class="mt-2" id="accordion">
        <div class="card">
            <div class="card-header ac-bg-info" id="headingOne">
                <h5 class="mb-0">
                    <button class="btn btn-link buttom-hover" data-toggle="collapse" data-target="#collapse6" aria-expanded="true" aria-controls="collapse1">
                        <span class="badge badge-pill badge-info bdg">PUT</span>
                        <span class="ml-4 ac-title">/user/{id}</span>
                        <span class="ml-5 ac-description"><i class="fas fa-arrow-right"></i> Atualiza o nome e/ou senha do usuario </span>
                    </button>
                    <span class="float-right mt-2"> <i class="fas fa-key"></i></span>
                </h5>
            </div>

            <div id="collapse6" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                <div class="card-body">
                    <p CLASS="text-center"> <i class="fas fa-link"></i> {{env('APP_URL')}}/api/user/{id}</p>
                    <div class="row">
                        <div class="col-md-6">
                            <h4>Campos: </h4>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">name (OPCIONAL)</li>
                                <li class="list-group-item">password (OPCIONAL)</li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <h4>Retorno: </h4>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">Sem Retorno</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--END-->
    <hr>
    <h3>Faturas</h3>
    <div class="mt-4" id="accordion">
        <div class="card">
            <div class="card-header ac-bg-warning" id="headingOne">
                <h5 class="mb-0">
                    <button class="btn btn-link buttom-hover" data-toggle="collapse" data-target="#collapse7" aria-expanded="true" aria-controls="collapse1">
                        <span class="badge badge-pill badge-warning bdg">POST</span>
                        <span class="ml-4 ac-title">/bill</span>
                        <span class="ml-5 ac-description"><i class="fas fa-arrow-right"></i> Cria uma nova fatura </span>
                    </button>
                    <span class="float-right mt-2"> <i class="fas fa-key"></i></span>
                </h5>
            </div>

            <div id="collapse7" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                <div class="card-body">
                    <p CLASS="text-center"> <i class="fas fa-link"></i> {{env('APP_URL')}}/api/bill</p>
                    <div class="row">
                        <div class="col-md-6">
                            <h4>Campos: </h4>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">due (YYYY-MM-DD)</li>
                                <li class="list-group-item">url</li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <h4>Retorno: </h4>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">Sem Retorno</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--END-->
    <div class="mt-2" id="accordion">
        <div class="card">
            <div class="card-header ac-bg-success" id="headingOne">
                <h5 class="mb-0">
                    <button class="btn btn-link buttom-hover" data-toggle="collapse" data-target="#collapse8" aria-expanded="true" aria-controls="collapse1">
                        <span class="badge badge-pill badge-success bdg">GET</span>
                        <span class="ml-4 ac-title">/bill</span>
                        <span class="ml-5 ac-description"><i class="fas fa-arrow-right"></i> Retorna todas as faturas do usuario autenticado </span>
                    </button>
                    <span class="float-right mt-2"> <i class="fas fa-key"></i></span>
                </h5>
            </div>

            <div id="collapse8" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                <div class="card-body">
                    <p CLASS="text-center"> <i class="fas fa-link"></i> {{env('APP_URL')}}/api/bill</p>
                    <div class="row">
                        <div class="col-md-6">
                            <h4>Campos: </h4>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">Sem Parametros</li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <h4>Retorno: </h4>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">Faturas</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--END-->
    <div class="mt-2" id="accordion">
        <div class="card">
            <div class="card-header ac-bg-info" id="headingOne">
                <h5 class="mb-0">
                    <button class="btn btn-link buttom-hover" data-toggle="collapse" data-target="#collapse9" aria-expanded="true" aria-controls="collapse1">
                        <span class="badge badge-pill badge-info bdg">PUT</span>
                        <span class="ml-4 ac-title">/bill/{id}</span>
                        <span class="ml-5 ac-description"><i class="fas fa-arrow-right"></i> Atualiza os dados da fatura passada na url </span>
                    </button>
                    <span class="float-right mt-2"> <i class="fas fa-key"></i></span>
                </h5>
            </div>

            <div id="collapse9" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                <div class="card-body">
                    <p CLASS="text-center"> <i class="fas fa-link"></i> {{env('APP_URL')}}/api/bill/{id}</p>
                    <div class="row">
                        <div class="col-md-6">
                            <h4>Campos: </h4>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">due (OPCIONAL)</li>
                                <li class="list-group-item">url (OPCIONAL)</li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <h4>Retorno: </h4>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">Sem Retorno</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--END-->
    <div class="mt-2" id="accordion">
        <div class="card">
            <div class="card-header ac-bg-success" id="headingOne">
                <h5 class="mb-0">
                    <button class="btn btn-link buttom-hover" data-toggle="collapse" data-target="#collapse10" aria-expanded="true" aria-controls="collapse1">
                        <span class="badge badge-pill badge-success bdg">GET</span>
                        <span class="ml-4 ac-title">/bill/{id}</span>
                        <span class="ml-5 ac-description"><i class="fas fa-arrow-right"></i> Retorna os dados de uma fatura passada na url </span>
                    </button>
                    <span class="float-right mt-2"> <i class="fas fa-key"></i></span>
                </h5>
            </div>

            <div id="collapse10" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                <div class="card-body">
                    <p CLASS="text-center"> <i class="fas fa-link"></i> {{env('APP_URL')}}/api/bill/{id}</p>
                    <div class="row">
                        <div class="col-md-6">
                            <h4>Campos: </h4>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">Sem Parametros</li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <h4>Retorno: </h4>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">Fatura</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--END-->
    <div class="mt-2" id="accordion">
        <div class="card">
            <div class="card-header ac-bg-danger" id="headingOne">
                <h5 class="mb-0">
                    <button class="btn btn-link buttom-hover" data-toggle="collapse" data-target="#collapse11" aria-expanded="true" aria-controls="collapse1">
                        <span class="badge badge-pill badge-danger bdg">DELETE</span>
                        <span class="ml-4 ac-title">/bill/{id}</span>
                        <span class="ml-5 ac-description"><i class="fas fa-arrow-right"></i> Remove uma fatura passada na url </span>
                    </button>
                    <span class="float-right mt-2"> <i class="fas fa-key"></i></span>
                </h5>
            </div>

            <div id="collapse11" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                <div class="card-body">
                    <p CLASS="text-center"> <i class="fas fa-link"></i> {{env('APP_URL')}}/api/bill/{id}</p>
                    <div class="row">
                        <div class="col-md-6">
                            <h4>Campos: </h4>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">Sem Parametros</li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <h4>Retorno: </h4>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">Sem Retorno</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--END-->
    <div class="mt-2" id="accordion">
        <div class="card">
            <div class="card-header ac-bg-info" id="headingOne">
                <h5 class="mb-0">
                    <button class="btn btn-link buttom-hover" data-toggle="collapse" data-target="#collapse12" aria-expanded="true" aria-controls="collapse1">
                        <span class="badge badge-pill badge-info bdg">PUT</span>
                        <span class="ml-4 ac-title">/approve-payment/{id}</span>
                        <span class="ml-5 ac-description"><i class="fas fa-arrow-right"></i> Aprova o pagamento de uma fatura com status aberta (1) e/ atrasada (2) passada na url </span>
                    </button>
                    <span class="float-right mt-2"> <i class="fas fa-key"></i></span>
                </h5>
            </div>

            <div id="collapse12" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                <div class="card-body">
                    <p CLASS="text-center"> <i class="fas fa-link"></i> {{env('APP_URL')}}/api/approve-payment/{id}</p>
                    <div class="row">
                        <div class="col-md-6">
                            <h4>Campos: </h4>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">Sem Parametros</li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <h4>Retorno: </h4>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">Sem Retorno</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--END-->
</div>

<hr>
<p class="font-weight-bolder text-center">Todos os direitos reservados &copy Igor Coutinho</p>

</body>
</html>
