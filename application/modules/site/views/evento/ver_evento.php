<link rel="stylesheet" href="<?php echo base_url();  ?>public/site/css/evento.css" />

<div id="conteudo">
        
    <div id="imagem-descricao">
            <div id="imagem">
                <img src="<?php echo base_url().$evento[0]->url_imagem.$evento[0]->nome_imagem ?>"/>
            </div>

            <div id="feintec">
                <p><strong><?php echo $evento[0]->titulo?></strong></p>
            </div>
            

            <div id="sobre-evento">
                <p><strong>SOBRE O EVENTO</strong></p>
                <p>
                    <?php echo $evento[0]->resumo?>
                </p>
                <p>
                    <?php echo $evento[0]->descricao?>
                </p>
            </div>
    </div>

    <div id="lista-eventos">
            <div id="edicoes">
                <h4><strong>EDIÇÕES</strong></h4>
            </div>
                <?php 
                    foreach($edicoes AS $edicao){
                ?>
                <div class="item-evento-descricao">
                    <a href="#">
                        <img src="<?php echo base_url().$edicao->url_imagem.$edicao->nome_imagem?>"/>
                        <div class="descricao-evento">
                            <div class="titulo"><strong><?php echo $edicao->titulo?></strong></div>
                        </div>    
                    </a>
                </div>
                <?php
                    }
                ?>
    </div>   
            
</div>