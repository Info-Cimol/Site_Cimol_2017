<link rel="stylesheet" href="<?php echo base_url();  ?>public/site/css/evento.css" />
<link rel="stylesheet"  href="<?php echo base_url();  ?>public/site/css/lightbox.css" >
<link rel="stylesheet" href="<?php echo base_url();  ?>public/site/css/bootstrap.min.css" >

<div id="conteudo">
    <div id="imagem-descricao">
                <div id="imagem">  
                    <img src="<?php echo base_url().$edicao[0]->url_imagem.$edicao[0]->nome_imagem ?>"/>
                </div>

                <div id="feintec">
                    <p><strong><?php echo $edicao[0]->titulo?></strong></p>
                </div>

                <div id="sobre-evento">
                    <p><?php echo $edicao[0]->slogan?></p>
                    <p><?php echo $edicao[0]->data_final?></p>
                </div>
    </div>
    
    <div id="imagens-paineis">
            <div id="imagem_evento">
                <h3>IMAGENS</h3>
                
                <?php 
                    foreach($imagens AS $imagem){
                ?>
                
                <a href="<?php echo base_url().$imagem->url_imagem.$imagem->nome ?>" data-lightbox="galeria" >               
                
                <img src="<?php echo base_url().$imagem->url_imagem.$imagem->nome ?>" class="img-thurmbnail"/>
                
                </a>
                
                <?php
                    }
                ?>
                
                <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Título do modal</h4>
                      </div>
                      <div class="modal-body">
                        ...
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                        <button type="button" class="btn btn-primary">Salvar mudanças</button>
                      </div>
                    </div>
                  </div>
                </div>
                
            </div>
            
            <div id="painel_evento">
                
                <h3>PAINEIS</h3>
                    <?php 
                        foreach($paineis AS $painel){
                    ?>

                    <div class="item-evento-descricao-painel">
                            <img src="<?php echo base_url().$painel->url_imagem.$painel->nome_imagem?>"/>
                            <div class="descricao-evento-painel">
                                <div class="titulo"><strong><?php echo $painel->titulo?></strong></div> 
                                <div class="descricao_painel"><?php echo $painel->descricao?></div>
                                <?php echo $painel->data?> - <?php echo $painel->hora?>
                            </div> 
                    </div>

                    <?php
                        }
                    ?> 
                
            </div>
            
    </div>
    <script src="<?php echo base_url();  ?>public/js/jquery-2.1.4.min.js"></script>
    <script src="<?php echo base_url();  ?>public/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url();  ?>public/js/lightbox.min.js"></script>
</div>
