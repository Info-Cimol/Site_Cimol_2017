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
            <div id="titulo"><strong><p>DEFINA SUA SENHA</p></strong></div>
            <div id="mensagem"><p> VOCÊ SOLICITOU A DEFINIÇÃO DE SENHA PARA: </p></div>
            <div id="email"><p>*****@g***l.com</p></div>
            <form class="form-login">
                <div class="form-grupo">
                    <div class="col-sm-10" id="senha">
                        <input type="password" class="form-control input-lg" name="senha" placeholder="Nova senha">
                    </div>
                </div>
                <div class="form-grupo">
                    <div class="col-sm-10" id="nova-senha">
                        <input type="password" class="form-control input-lg" name="nova-senha" placeholder="Digite novamente sua senha">
                    </div>
                </div>
                <div class="form-grupo">
                    <div class="col-sm-offset-2 col-sm-10" id="botao">
                        <input type="submit" name="enviar" value="Enviar">
                    </div>
                </div>
            </form>
            
            
        </section>
        
    </body>
</html>