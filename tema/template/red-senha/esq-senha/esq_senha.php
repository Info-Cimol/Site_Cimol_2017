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
            <div class="fechar">X</div>
            <div id="imagem"><img src="images/cimol_branco.png"/></div>
            <div id="sbv"><h3><p>ESQUECEU SUA SENHA?</p></h3></div>
            <div id="msg"><p>INFORME SEU EMAIL PARA QUE POSSAMOS LHE ENVIAR UMA MENSAGEM DE DEFINIÇÃO DE SENHA</p></div>
            <form action="definir_senha.php" method="POST" class="form-log">
                <div class="form-grupo">
                    <div class="col-sm-10" id="pqp">
                        <input type="email" class="form-control input-lg" id="email" placeholder="Email">
                    </div>                    
                </div>                
                <div class="form-grupo">
                    <div class="col-sm-offset-2 col-sm-10" id="pqp">
                        <button type="button" id="enviar" class="btn btn-primary btn-lg btn-block"><strong>ENVIAR</strong></button>
                    </div>
                </div>
            </form>          
        </section>
    </body>
</html>