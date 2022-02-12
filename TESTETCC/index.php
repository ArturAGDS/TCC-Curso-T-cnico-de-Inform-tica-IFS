<?php
session_start();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Dependencias/style-login.css">
    <title>KI-BRASA BOA</title>
</head>
<body>
    <form action="logar.php" method="post">
    <div class="linha"></div>
    <div class="login-geral">
        <div class="login-esquerda">
            <h1>Acesse o sistema</h1><br>
            <img src="imagens/logo-transparente.png" class="imagem" alt="logo">
        </div>
        <div class="login-direita">
            <div class="bloco-login">
                <h1>LOGIN</h1>
                <?php
    if(isset($_SESSION['nao_autenticado'])):
        ?>
        <h4 style="color:red;"> Usuario ou senha inválidos</h4>
        
        <?php
        
        endif;
        unset($_SESSION['nao_autenticado'])
        ?>
                <div class="textfield">
                    <label for="usuario">Usuário</label>
                    <input type="text" name="usuario" placeholder="Digite seu usuário">
                </div>
                <div class="textfield">
                    <label for="senha">Senha</label>
                    <input type="password" name="senha" placeholder="Digite sua senha">
                </div>
                <a href="Cadastro/cadastrar.php">Cadastre-se</a>
                <button class="btn-login">ENTRAR</button>
            </div>
        </div>
            
    </div>
    <div class="linha2"></div>
    </form>
</body>
</html>