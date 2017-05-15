<link rel="stylesheet"  href="<?php echo base_url();  ?>public/temas/default/css/login.css" media="screen" >
       <section>
            <div id="imagem"><img src="<?php echo base_url();  ?>public/temas/default/images/cimol_branco.png"/></div>
            <div id="sbv"><h3><p>SEJA BEM-VINDO</p></h3></div>
            <div id="msg"><p>SE VOCê Já POSSUI CADASTRO,<br>INFORME SEUS DADOS DE ACESSO</p></div>
            <form class="form-log" action="<?php echo base_url();  ?>usuario/autenticar" method="POST">
                <div class="form-grupo">
                    <div class="col-sm-10" id="pqp">
                        <input type="email" class="form-control input-lg" name="email" placeholder="Email" />
                    </div>                    
                </div>
                <div class="form-grupo">
                    <div class="col-sm-10" id="pqp">
                        <input type="password" class="form-control input-lg" name="senha" placeholder="Senha" />
                    </div>
                </div>
                <div class="form-grupo">
                    <div class="col-sm-offset-2 col-sm-10" id="pqp">
                        <input type="submit" id="enviar" class="btn btn-primary btn-lg btn-block" name="autenticar" value="Enviar" />
                    </div>
                </div>
            </form>
            <div class="cadastro">
                <p>Se você não possui usuário<br> avito,<a href="<?php echo base_url();  ?>solicitar_senha" ><strong>Clique aqui</strong></a></p>
            </div>
            <div id="esq-sen">
                <p><a href="<?php echo base_url();  ?>esqueceu_senha" >Esqueceu a senha?</a></p>
            </div>
        </section>
