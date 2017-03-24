	 <div class="sidebar-background">
	<div class="primary-sidebar-background">
	</div>
</div>
<div class="primary-sidebar">
	<!-- Main nav -->
    <br />
    <div style="text-align:center;">
    	<a href="<?php echo base_url();?>">
        	<img src="<?php echo base_url();?>public/professor/uploads/logo.png"  style="max-height:100px; max-width:100px;"/>
        </a>
    </div>
   	<br />
	<ul class="nav nav-collapse collapse nav-collapse-primary">
    
        
        <!------Aulas----->
		<li class="">
			<span class="glow"></span>
				<a href="<?php echo base_url();?>professor/aula" rel="tooltip" data-placement="right"
				data-original-title="aula">
					<!--<i class="icon-desktop icon-1x"></i>-->
                    <img src="<?php echo base_url();?>public/professor/template/images/icons/home.png" />
                    <span>Aulas</span>
				</a>
		</li>
		
		<!------disciplinas----->
		<li class="">
			<span class="glow"></span>
				<a href="<?php echo base_url();?>professor/disciplina" rel="tooltip" data-placement="right" 
                	data-original-title="turma">
					<!--<i class="icon-columns icon-1x"></i>-->
                    <img src="<?php echo base_url();?>public/professor/template/images/icons/noticeboard.png" />
					<span>Discíplinas</span>
				</a>
		</li>
		
		<!------turmas----->
		<li class="">
			<span class="glow"></span>
				<a href="<?php echo base_url();?>professor/turma" rel="tooltip" data-placement="right" 
                	data-original-title="turma">
					<!--<i class="icon-columns icon-1x"></i>-->
                    <img src="<?php echo base_url();?>public/professor/template/images/icons/noticeboard.png" />
					<span>Turmas</span>
				</a>
		</li>
		
		
	</ul>
</div>