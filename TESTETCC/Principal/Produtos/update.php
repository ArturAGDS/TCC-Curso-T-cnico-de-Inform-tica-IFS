<?php 
include_once('../../Dependencias/conexao.php');

session_start();
if(!isset($_SESSION['id_usuario'])){
    header('Location: ../../index.php');
    exit();
}
$id =$_GET['id'];
$sql = "SELECT * FROM produto WHERE id_produto = '$id'";
$result = mysqli_query($conn, $sql);
$produto = mysqli_fetch_assoc($result);
$nome = $produto['nome_produto'];

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

    <script src="../../Dependencias/js/jquery.min.js"></script>
    <script src="../../Dependencias/js/jquery.validate.min.js"></script>
    <script src="../../Dependencias/js/messages_pt_BR.min.js"></script>
    <script src="../../Dependencias/js/additional-methods.min.js"></script> 
    

    <script type="text/javascript" >
        $(document).ready(function(){
            $("#form").validate({

                rules: {
                    nome: {
                        required: true,
                    },
                    valor: {
                        number: true,
                    },
                    peso: {
                        number: true,
                    },
                    quantidade_estoque: {
                        number: true,
                    },
                },

                submitHandler: function(form) {
                    form.submit();
                }
            });
        })
    </script>

    <title>KI-BRASA BOA</title>
</head>
<body class="alt">
    <header class="cabecalho">
        <h1>Produtos</h1>
        <h2>Atualizar Produto</h2>
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
        Pagina de Atualização do Produto: <?php echo $nome?>
    </h2>
    <form id="form" action="updateAux.php" method="post">
        <div class="container">
        
            <div class="row">
                <span class="req">Campos com * devem ser preenchidos</span>
                <span class="req">Usar . no lugar de , para números </span>
                    
                    <input class="form-control" type="hidden" name="id"  value="<?=$produto['id_produto']?>" ><br>
                
            <div class="col-md-3">
                    Nome*:
                    <input class="form-control" type="text" name="nome"  value="<?php echo $nome ?>" required><br>
                </div>
                <div class="col-md-12">
                    Descrição*:
                    <input class="form-control" type="text" name="descricao" value="<?=$produto['descricao_produto']?>"  required ><br>
                </div>
                <div class="col-md-3">
                    Valor Unitário:
                    <input class="form-control" type="float" name="valor" value="<?=$produto['valor_unidade']?>">
                </div>
                <div class="col-md-3">
                    Peso:
                    <input class="form-control" type="float" name="peso" value="<?=$produto['peso_produto']?>" >
                </div>
                <div class="col-md-3">
                    É comercializavel?*:
                    <select class="form-control" name=com>
                        <option <?php if ($produto['comercializavel'] == 1): ?> selected="selected"<?php endif; ?> value="1">SIM</option>
                        <option <?php if ($produto['comercializavel'] == 0): ?> selected="selected"<?php endif; ?> value="0">NÃO</option>
                    </select>
                </div>
                <div class="col-md-3">
                    Qtd Estoque:
                    <input class="form-control" type="int" name="quantidade_estoque" value="<?=$produto['qtd_estoque']?>"><br>
                </div>
                <div class="col-md-4">
                    <button class="btn btn-primary btn-lg" type="submit">
                        Atualizar Produto <i class="fas fa-cart-plus"></i>
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
