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
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@200;300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="..\..\Dependencias\estilo.css">
    <link rel="stylesheet" href="..\..\Dependencias/styleCad.css">
   
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script>

    
    <!-- <script src="../../Dependencias/js/jquery.min.js"></script> -->
    <script src="../../Dependencias/js/jquery.validate.min.js"></script>
    <script src="../../Dependencias/js/messages_pt_BR.js"></script>
    <script src="../../Dependencias/js/additional-methods.min.js"></script> 
    

    <script type="text/javascript" >
        $(document).ready(function(){
           
            $("#form").validate({

                rules: {
                    cpf: {
                        required: false,
                        cpfBR: true,
                    },
                    cnpj: {
                        required: false,
                        cnpjBR: true,
                    },
                    
                },
                messages:{
                    cpf:"Insira um CPF válido!",
                    cnpj:"Insira um CNPJ válido!",
                },
                
                
                submitHandler: function(form) {
                    form.submit();
                }
            });
            $("#cnpj").mask("00.000.000/0000-00");
        })

        

function meu_callback(conteudo) {
if (!("erro" in conteudo)) {
    //Atualiza os campos com os valores.

    document.getElementById('endereco').value=(conteudo.logradouro + " "+ conteudo.complemento +" , bairro: "+ conteudo.bairro );
    document.getElementById('bairro').value=(conteudo.bairro);
    document.getElementById('cidade').value=(conteudo.localidade);
    
} //end if.
else {
    //CEP não Encontrado.
   
    alert("CEP não encontrado.");
}
}

function pesquisacep(valor) {

//Nova variável "cep" somente com dígitos.
var cep = valor.replace(/\D/g, '');

//Verifica se campo cep possui valor informado.
if (cep != "") {

    //Expressão regular para validar o CEP.
    var validacep = /^[0-9]{8}$/;

    //Valida o formato do CEP.
    if(validacep.test(cep)) {


        //Cria um elemento javascript.
        var script = document.createElement('script');

        //Sincroniza com o callback.
        script.src = 'https://viacep.com.br/ws/'+ cep + '/json/?callback=meu_callback';

        //Insere script no documento e carrega o conteúdo.
        document.body.appendChild(script);

    } //end if.
    else {
        //cep é inválido.
        
        alert("Formato de CEP inválido.");
    }
} //end if.
else {
    //cep sem valor, limpa formulário.
    
}
};

    </script>




    <title>KI-BRASA BOA</title>
</head>
<body class="alt">
    <header class="cabecalho">
        <h1>Clientes</h1>
        <h2>Cadastro de Clientes</h2>
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
                        <div class="col-md-3">
                            Nome Cliente:
                            <input class="form-control" type="text" name="nome_cliente"><br>
                        </div>
                        <div class="col-md-3">
                            Nome Empresa:
                            <input class="form-control" type="text" name="nome_empresa"><br>
                        </div>

                        <div class="col-md-6">
                            Email contato:
                            <input class="form-control" type="text" name="email"><br>
                        </div>

                        <div class="col-md-3">
                            CEP*:
                            <input class="form-control" type="text" name="cep" maxlength="9" id="cep"  onblur="pesquisacep(this.value);"><br>
                            <script type="text/javascript">$("#cep").mask("00000-000");</script>
                        </div>
                        <div class="col-md-9">
                            Endereço*:
                            <input class="form-control" type="text" name="endereco" id="endereco" required><br>
                        </div>
                        
                        <div class="col-md-4">
                            Cidade*:
                            <input class="form-control" type="text" name="cidade" id="cidade" required>
                        </div>
                        <div class="col-md-4">
                            Bairro*:
                            <input class="form-control" type="text" name="bairro" id="bairro" required>
                        </div>
                        
                        <div class="col-md-4">
                            Telefone*:
                            <input type="tel" class="form-control" name="telefone" id="telefone" required /><br>
                            <script type="text/javascript">$("#telefone").mask("(00) 00000-0000");</script>
                        </div>

                        <div class="col-md-4">
                            CNPJ:
                            <input type="text" class="form-control" name="cnpj" id="cnpj" /><br>
                            <script type="text/javascript">$("#cnpj").mask("00.000.000/0000-00");</script>
                        </div>
                        
                        <div class="col-md-4">
                            CPF:
                            <input type="text" class="form-control" name="cpf" id="cpf" /><br>
                            <script type="text/javascript">$("#cpf").mask("000.000.000-00");</script>
                        </div>
                        
                        <div class="col-md-4">
                            Inscrição Estadual:
                            <input class="form-control" type="text" name="insc_estadual" >
                        </div>

                        <div class="col-md-4">
                            <button class="btn btn-primary btn-lg" type="submit">
                                Inserir Cliente <i class="fas fa-cart-plus"></i>
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
