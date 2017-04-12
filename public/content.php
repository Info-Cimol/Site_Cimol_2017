	<div id="content_right" >
	
		<div id="relacionamento">
			<h5>Espaço de Relacionamento</h5>
			<ul>
				<a href='<?php echo base_url()."feintec/"?>'><li>Feintec</li></a>
				<a href='<?php echo base_url()."servico/"?>'><li>Serviços</li></a>
				<a href='<?php echo base_url()."transporte/"?>'><li>Transporte</li></a>
				<a href='<?php echo base_url()."biblioteca/"?>'><li>Biblioteca</li></a>
				<a href='<?php echo base_url()."agenda/"?>'><li>Calendário</li></a>
				<a href='http://moodle2.cimol.g12.br/'><li>Moodle</li></a>
				<a href='<?php echo base_url()."coordenacao/"?>'><li>Coordenação</li></a>
				<a href='<?php echo base_url()."sri/"?>'><li>SRI</li></a>
			</ul>
		</div>
		<?php if(isset($videos)){
		//print_r($videos);?>
		<div id="videos">
			<h5>Vídeos</h5>
			
			<?php foreach($videos AS $video){
				//echo //$video->titulo;
				echo "<iframe width='190' height='100' src='".$video->url."' 
					frameborder='0' allowfullscreen></iframe>";
			}
			?>
			<!--  
			<div class='video'></div>
			<div class='video'></div>
			<div class='video'></div>
			<div class='video'></div>
			-->
		</div>
		<?php }?>
		<div id="social">
		
				<div id="fb-root"></div>
				<script>(function(d, s, id) {
				  var js, fjs = d.getElementsByTagName(s)[0];
				  if (d.getElementById(id)) return;
				  js = d.createElement(s); js.id = id;
				  js.src = "//connect.facebook.net/pt_BR/sdk.js#xfbml=1&version=v2.4";
				  fjs.parentNode.insertBefore(js, fjs);
				}(document, 'script', 'facebook-jssdk'));
				</script>
				<div class="fb-page" data-href="https://www.facebook.com/CimolOficial" data-width="165" data-height="490" data-small-header="true" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true" data-show-posts="false">
					<div class="fb-xfbml-parse-ignore">
						<blockquote cite="https://www.facebook.com/CimolOficial">
							<a href="https://www.facebook.com/CimolOficial">Cimol</a>
						</blockquote>
					</div>
				</div>
		</div>
						<?php 
						if(isset($this->produtos)){
							foreach($this->produtos AS $produto){
								echo"<div class='item_featured'>
									<img src='".$produto['url_imagem'].$produto['nome_imagem']."'/>
								</div>";
							}
						}
						
						?>
						
						
	
	</div>

</div>
