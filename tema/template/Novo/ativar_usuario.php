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
            <strong><p id="titulo">ATIVAR USU�RIO</p></strong>
            <p id="mensagem"> PREENCHA O FORMUL�RIO ABAIXO E ATIVE SEU USU�RIO </p>
            
            <form class="form-login">
                <div class="form-grupo">
                    <div class="col-sm-10" id="campo-email">
                        <input type="email" class="input-login form-control input-lg " name="email" placeholder="Email">
                    </div>                    
                </div>
                <div class="form-grupo">
                    <select>
                        <option>Tipo de usu�rio</option>
                        <option>Aluno</option>
                        <option>Professor</option>
                        <option>Coordenador</option>
                        <option>Administrador</option>
                    </select>
                </div>
                <div class="form-grupo">
                    <div class="col-sm-offset-2 col-sm-10" id="botao" >
                        <input type="submit" name="enviar" value="Enviar">
                    </div>
                </div>
            </form>            
            
        </section>
        
    </body>
</html>