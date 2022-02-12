<?php 
include_once('../../Dependencias/conexao.php');

session_start();

if(!isset($_SESSION['id_usuario'])){
    header('Location: ../../index.php');
    exit();
}
$id =$_GET['id'];

$sql = "SELECT * from venda v inner join itemvenda i on v.id_venda = i.id_itemvenda inner join cliente c ON c.id_cliente = v.cliente_id_cliente WHERE v.id_venda = $id";
$result = mysqli_query($conn, $sql);
$venda = mysqli_fetch_assoc($result);

/* if (!$produto){
    $_SESSION['msgUP'] = "<p style='color:red;'>Produto não Encontrado</p>";
} */

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@200;300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="..\..\Dependencias\estilo.css">
    <link rel="stylesheet" href="..\..\Dependencias/styleCad.css">
   
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">

    <title>KI-BRASA BOA</title>
</head>
<body class="alt">
    <header class="cabecalho">
        <h1>Vendas</h1>
        <h2>Atualizar Venda</h2>
    </header>
    <main class="principal">
        <div class="conteudo">
        <div class="content update">
        <?php
                    if(isset($_SESSION['msgUP']))
                        echo $_SESSION['msgUP'];
                        unset($_SESSION['msgUP'])
                    
                    ?>
    <h2 class="text-center">
        Pagina de Atualização da Venda #<?php echo $id?>
    </h2>
    <form action="updateAux.php" method="post">
    <div class="container">
                        <div class="row">
                            <span class="req">Campos com * devem ser preenchidos</span>
                            <span class="req">Usar . no lugar de , para números </span>
                            <input class="form-control" type="hidden" name="id"  value="<?=$venda['id_venda']?>" required><br>
                            <div class="col-md-4">
                                Selecione o Cliente*:
                                <select class="form-control " name="nome_cliente">
                                    <?php
                                    $sql = "SELECT * FROM cliente WHERE ativo = 1 ORDER BY id_cliente";
                                    $result = mysqli_query($conn, $sql);
                                    while($row = mysqli_fetch_array($result)): ?>
                                    <option  <?php if ($venda['cliente_id_cliente'] == $row['id_cliente']): ?> selected="selected"<?php endif; ?>  value="<?= $row['id_cliente'] ?>"><?= $row['nome_cliente']?></option>
                                    
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
                                    <option  <?php if ($venda['produto_id_produto'] == $row['id_produto']): ?> selected="selected"<?php endif; ?>   value="<?= $row['id_produto'] ?>"><?= $row['nome_produto']?></option>

                                    <?php endwhile ?>
                                </select>
                            </div>
                            <div class="col-md-4">
                                Quantidade do Produto*:
                                <input class="form-control" type="number" name="qtd_produto" required  value="<?=$venda['qtd_produto']?>"><br>
                            </div>
                            <div class="col-md-4">
                                Numero Nota Fiscal:
                                <input class="form-control" type="text" name="nota" value="<?=$venda['numero_nota']?>"><br>
                            </div>
                            <div class="col-md-4">
                                Valor total*:
                                <input class="form-control" type="float" name="valor"value="<?=$venda['valor_venda']?>" required>
                            </div>
                            <div class="col-md-4">
                                Peso total:
                                <input class="form-control" type="float" name="peso" value="<?=$venda['peso_venda']?>">
                            </div>
                            <div class="col-md-4">
                                Data Pedido*:
                                <input class="form-control" type="date" name="data_pedido"  value="<?=date('Y-m-d', strtotime($venda['data_pedido']) )?>"  required><br>
                            </div>
                            <div class="col-md-4">
                                Data Entrega:
                                <input class="form-control" type="date" name="data_entrega" value="<?=date('Y-m-d', strtotime($venda['data_entrega']) )?>"  ><br>
                            </div>
                            <div class="col-md-4">
                                Status*:
                                <select class="form-control mb-2" name="status">
                                    <option <?php if ($venda['status'] == "Em_aberto"): ?> selected="selected"<?php endif; ?> value="Em_aberto">Em Aberto</option>
                                    <option <?php if ($venda['status'] == "Entregue"): ?> selected="selected"<?php endif; ?> value="Entregue">Entregue</option>
                                    <option <?php if ($venda['status'] == "Concluida"): ?> selected="selected"<?php endif; ?> value="Concluida">Concluída</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                Tipo pagamento*:
                                <select class="form-control mb-2" name="tipo_pagamento">
                                <option <?php if ($venda['tipo_pagamento'] == "Dep_Bancario"): ?> selected="selected"<?php endif; ?> value="Dep_Bancario">Depósito Báncario</option>
                                    <option <?php if ($venda['tipo_pagamento'] == "Pix"): ?> selected="selected"<?php endif; ?> value="Pix">Via Pix</option>
                                    <option <?php if ($venda['tipo_pagamento'] == "Dinheiro"): ?> selected="selected"<?php endif; ?> value="Dinheiro">Dinheiro em especie</option>
                                    <option <?php if ($venda['tipo_pagamento'] == "Prazo"): ?> selected="selected"<?php endif; ?> value="Prazo">À Prazo</option></option>
                                    <option <?php if ($venda['tipo_pagamento'] == "Cheque"): ?> selected="selected"<?php endif; ?> value="Cheque">Cheque</option></option>
                                </select>
                            </div>
                            <div class="col-md-8">
                                
                            </div>
                            <div class="col-md-4">
                                <button class="btn btn-primary btn-lg" type="submit">
                                    Atualizar Venda <i class="fas fa-cart-plus"></i>
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
    </main>
    <footer class="rodape">
        KIbrasa boa made by Artur & Wagner © <?= date('Y');?>
    </footer>
</body>
</html>
