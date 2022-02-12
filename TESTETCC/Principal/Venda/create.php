<?php 
include_once('../../Dependencias/conexao.php');

session_start();
if(!isset($_SESSION['id_usuario'])){
    header('Location: ../../index.php');
    exit();
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@200;300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="..\..\Dependencias\estilo.css">
    <link rel="stylesheet" href="..\..\Dependencias/styleCad.css">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css"
    integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">

    <script src="../../Dependencias/js/jquery.min.js"></script>
    <script src="../../Dependencias/js/jquery.validate.min.js"></script>
    <script src="../../Dependencias/js/messages_pt_BR.min.js"></script>
    <script src="../../Dependencias/js/additional-methods.min.js"></script> 

    <script type="text/javascript" >
        $(document).ready(function(){
            $("#form").validate({

                rules: {
                    valor: {
                        number: true,
                    },
                    peso: {
                        required: false,
                        number: true,
                    }
                    
                },

                submitHandler: function(form) {
                    form.submit();
                }
            });
        })
    </script>

    <title>Vendas</title>
</head>

<body class="alt">
    <header class="cabecalho">
        <h1>Vendas</h1>
        <h2>Cadastro de Vendas</h2>
    </header>
    <main class="principal">
        <div class="conteudo">
            <div class="content update">
                <h2 class="text-center">
                    Pagina de Cadastro
                </h2>
                <form id="form" action="createAux.php" method="post">
                    <div class="container">
                        <div class="row">
                            <span class="req">Campos com * devem ser preenchidos</span>
                            <span class="req">Usar . no lugar de , para números </span>
                            <div class="col-md-4">
                                Selecione o Cliente*:
                                <select class="form-control " name="nome_cliente">
                                    <?php
                                    $sql = "SELECT * FROM cliente WHERE ativo = 1 ORDER BY id_cliente";
                                    $result = mysqli_query($conn, $sql);
                                    while($row = mysqli_fetch_array($result)): ?>
                                    <option value="<?= $row['id_cliente'] ?>"><?= $row['nome_cliente']?></option>
                                    
                                    <?php endwhile ?>
                                </select>
                            </div>
                            <div class="col-md-4">
                                Selecione o Produto*:
                                <select class="form-control " name="nome_produto">
                                    <?php
                                    $sql = "SELECT * FROM produto WHERE comercializavel = 1 AND ativo = 1  ORDER BY id_produto";
                                    $result = mysqli_query($conn, $sql);
                                    while($row = mysqli_fetch_array($result)): ?>
                                    <option value="<?= $row['id_produto'] ?>"><?= $row['nome_produto']?></option>

                                    <?php endwhile ?>
                                </select>
                            </div>
                            <div class="col-md-4">
                                Quantidade do Produto*:
                                <input class="form-control" type="number" name="qtd_produto" required ><br>
                            </div>
                            <div class="col-md-4">
                                Numero Nota Fiscal:
                                <input class="form-control" type="text" name="nota"><br>
                            </div>
                            <div class="col-md-4">
                                Valor total*:
                                <input class="form-control" type="float" name="valor" required>
                            </div>
                            <div class="col-md-4">
                                Peso total:
                                <input class="form-control" type="float" name="peso">
                            </div>
                            <div class="col-md-4">
                                Data Pedido*:
                                <input class="form-control" type="date" name="data_pedido" value="<?=date('Y-m-d')?>" required><br>
                            </div>
                            <div class="col-md-4">
                                Data Entrega:
                                <input class="form-control" type="date" name="data_entrega" ><br>
                            </div>
                            <div class="col-md-4">
                                Status*:
                                <select class="form-control mb-2" name="status">
                                    <option value="Em_aberto">Em Aberto</option>
                                    <option value="Entregue">Entregue</option>
                                    <option value="Concluida">Concluída</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                Tipo pagamento*:
                                <select class="form-control mb-2" name="tipo_pagamento">
                                    <option value="Dep_Bancario">Depósito Bancário</option>
                                    <option value="Pix">Via Pix</option>
                                    <option value="Dinheiro">Dinheiro em especie</option>
                                    <option value="Prazo">À Prazo</option></option>
                                    <option value="Cheque">Cheque</option></option>
                                </select>
                            </div>
                            <div class="col-md-8">
                                
                            </div>
                            <div class="col-md-4">
                                <button class="btn btn-primary btn-lg" type="submit">
                                    Inserir Venda <i class="fas fa-cart-plus"></i>
                                </button><br><br>

                                <a class="btn btn-success btn-lg" href="read.php">
                                    Voltar <i class="fa fa-arrow-circle-left"></i>
                                </a>
                                <?php
                                if(isset($_SESSION['msg']))
                                    echo $_SESSION['msg'];
                                    unset($_SESSION['msg'])
                                
                                ?>
                            </div>

                        </div>
                    </div>





                </form>
            </div>
        </div>
    </main>
    <footer class="rodape">
        KIbrasa boa made by Artur & Wagner © <?= date('Y');?>
    </footer>
</body>

</html>