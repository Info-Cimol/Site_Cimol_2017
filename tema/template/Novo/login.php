<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, user-scalable=no">
        <title>Login</title>
        <meta name="author" content="Ana Thais">
        <link rel="stylesheet"  href="./css/style.css" media="screen" >
        <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen" >
    </head>
    <body>
        
        <section>
            
            <div id="imagem"><img src="images/cimol_branco.png"/></div>
            <div id="titulo"><strong><p>SEJA BEM-VINDO</p></strong></div>
            <div id="mensagem"><p> SE VOCÊ JÁ POSSUI USUÁRIO ATIVO, INFORME SEUS DADOS DE ACESSO </p></div>
            
            <form class="form-login">
                <div class="form-grupo">
                    <div class="col-sm-10" id="email" >
                        <input type="email" class="input-login form-control input-lg " name="email" placeholder="Email">
                    </div>                    
                </div>
                <div class="form-grupo">
                    <div class="col-sm-10" id="senha" >
                        <input type="password" class="form-control input-lg" name="senha" placeholder="Senha">
                    </div>
                </div>
                <div class="form-grupo">
                    <div class="col-sm-offset-2 col-sm-10" id="botao" >
                        <input type="submit" name="enviar" value="Enviar">
                    </div>
                </div>
            </form>
            
            <div class="cadastro">
                <p>Se você não possui usuário avito, <a href="#" ><strong>clique aqui</strong></a></p>
            </div>
            <div class="esqueceu">
                <p><a href="#" >Esqueceu a senha?</a></p>
            </div>
            
        </section>
        
    </body>
</html>