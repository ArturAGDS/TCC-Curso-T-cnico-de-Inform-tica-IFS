<?php 
include_once('../../Dependencias/conexao.php');

session_start();

if(!isset($_SESSION['id_usuario'])){
    header('Location: ../../index.php');
    exit();
}
$id = $_GET['id'];
$sql = "SELECT * FROM despesas WHERE id_despesa = '$id'";
$result = mysqli_query($conn, $sql);
$despesa = mysqli_fetch_assoc($result);

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
  
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script>

        
    <script src="../../Dependencias/js/jquery.min.js"></script>
    <script src="../../Dependencias/js/jquery.validate.min.js"></script>
    <script src="../../Dependencias/js/messages_pt_BR.min.js"></script>
    <script src="../../Dependencias/js/additional-methods.min.js"></script> 
    

    <script type="text/javascript" >
        $(document).ready(function(){
            $("#form").validate({

                rules: {
                    valor_conta: {
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
        <h1>Despesas</h1>
        <h2>Atualizar Despesa</h2>
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
        Pagina de Atualização da Despesa: <?php echo $despesa['nome_conta']?>
    </h2>
            <form id="form" action="updateAux.php" method="post">
                <div class="container">
            
                        <div class="row">
                        <span class="req">Campos com * devem ser preenchidos</span>
                                <input class="form-control" type="hidden" name="id"  value="<?=$despesa['id_despesa']?>" required><br>
                            
                            
                            <div class="col-md-4">
                                Nome Despesa*:
                                <select class="form-control" name="nome_conta" selected="<?=$despesa['nome_conta']?>">
                                    <option <?php if ($despesa['nome_conta'] == "Alimentacao"): ?> selected="selected"<?php endif; ?> value="Alimentacao">Alimentação</option>
                                    <option <?php if ($despesa['nome_conta'] == "Combustivel"): ?> selected="selected"<?php endif; ?> value="Combustivel">Combustivel</option>
                                    <option <?php if ($despesa['nome_conta'] == "Estadia"): ?> selected="selected"<?php endif; ?> value="Estadia">Estadia</option>
                                    <option <?php if ($despesa['nome_conta'] == "Materia-Prima"): ?> selected="selected"<?php endif; ?> value="Materia-Prima">Materia prima</option></option>
                                    <option <?php if ($despesa['nome_conta'] == "Outros"): ?> selected="selected"<?php endif; ?> value="Outros">Outros</option></option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                Data Despesa*:
                                <input class="form-control" type="datetime-local" name="data_conta" value="<?=date('Y-m-d\TH:i', strtotime($despesa['data_conta']) )?>" required><br>
                            </div>

                            <div class="col-md-12">
                                Descrição Despesa*:
                                <input class="form-control" type="text" name="descricao_conta" value="<?=$despesa['descricao_conta']?>" required><br>
                            </div>

                            <div class="col-md-5">
                                Valor*:
                                <input class="form-control" type="float" name="valor_conta" value="<?=$despesa['valor_conta']?>" required><br>
                            </div>
                            
                            <div class="col-md-5">
                                Tipo pagamento*:
                                <select class="form-control mb-2" name="tipo_pagamento" selected="<?=$despesa['tipo_pagamento']?>">
                                    <option <?php if ($despesa['tipo_pagamento'] == "Dep_Bancario"): ?> selected="selected"<?php endif; ?> value="Dep_Bancario">Depósito Báncario</option>
                                    <option <?php if ($despesa['tipo_pagamento'] == "Pix"): ?> selected="selected"<?php endif; ?> value="Pix">Via Pix</option>
                                    <option <?php if ($despesa['tipo_pagamento'] == "Dinheiro"): ?> selected="selected"<?php endif; ?> value="Dinheiro">Dinheiro em especie</option>
                                    <option <?php if ($despesa['tipo_pagamento'] == "Prazo"): ?> selected="selected"<?php endif; ?> value="Prazo">À Prazo</option></option>
                                    <option <?php if ($despesa['tipo_pagamento'] == "Cheque"): ?> selected="selected"<?php endif; ?> value="Cheque">Cheque</option></option>
                                </select>
                            </div>
                            

                            <div class="col-md-4">
                                <button class="btn btn-primary btn-lg" type="submit">
                                    Atualizar Despesa <i class="fas fa-cart-plus"></i>
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
