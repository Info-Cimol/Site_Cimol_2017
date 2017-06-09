	var x=0;
	var curso_id=null;
	
	function form_professor(professor){
			
			
			$('#modal-body').html('');
			   		form="<form action='"+base_url+"admin/professor/editar_imagem/"+professor.id+"' method='post' enctype='multipart/form-data'>"+
        			"<div class='padded'>"+
    				"<input type='hidden' name='professor[pessoa_id]' value='"+professor.pessoa_id+"' />"+
	                "<div class='control-group'>"+
	                    "<label class='control-label'>Nome:</label>"+
	                    "<div class='controls'>"+
	                        "<input type='text' name='professor[nome]' value='"+professor.nome+"' maxlength='60' required/>"+
	                    "</div>"+
	                "</div>"+
	                "<div class='control-group'>"+
                   " <label class='control-label'>Carga Horária</label>"+
                    "<div class='controls'>"+
                        "<input type='text' class='span1' name='professor[carga_horaria]' value='"+professor.carga_horaria+"'/>"+
                    "</div>"+ 
                 "</div>"+
	                "<div class='control-group'>"+
                    "<label class='control-label'>RG:</label>"+
                    "<div class='controls'>"+
                        "<input type='text' name='professor[rg]' value='"+professor.rg+"' maxlength='60' required/>"+
                    "</div>"+
                "</div>"+
	                "<div class='control-group'>"+
	                    "<label class='control-label'>CPF:</label>"+
	                    "<div class='controls'>"+
	                        "<input type='text' name='professor[cpf]' value='"+professor.cpf+"' maxlength='60' required/>"+
	                    "</div>"+
	            	"</div>"+
	                "<div class='control-group'>"+
                    "<label class='control-label'>telefone(s)<button   class='btn btn-blue btn-mini' onclick='adicionar_campo_telefone();return false;'>+</button>:</label>"+
                    "<div class='controls' id='telefones'>"+
            			
            			"</div>"+
                	"</div>"+
	                "<div class='control-group'>"+
                    "<label class='control-label'>Email:</label>"+
                    "<div class='controls' id='emails'>"+
            			
                    "</div>"+
                "</div>"+
	                "<div class='control-group'>"+
	                "<label class='control-label'>Trocar foto:</label>"+
	                    "<input type='file' name='foto' >"+
	                    "</div>"+
		                "<input type='hidden' name='old-foto' value='"+professor.foto+"'>";
					   	if(professor.foto!=""){
					   		form+="<img src='"+base_url+professor.foto+"' />";
					   	}else{	
					   		form+="<img src='"+base_url+"public/images/prof.jpg' />"; 
						}
					form+="<div class='form-actions'>"+
	                "<input type='submit'  class='btn btn-blue' name='salvar' value='Salvar'>"+
	            "</div>"+
	            "<input type='hidden' name='old-foto' value='"+professor.foto+"'>"+
	           
	        "</form>";
		    $('#modal-body').append(form);

		}
		   

		function adicionar_campo_telefone(){
			$('#telefones').append("<br/><input type='text' class='span1' name='professor[telefone]["+x+"][ddd]' placeholder='DDD'/>"+
					"&nbsp;<input type='text' class='span2' name='professor[telefone]["+x+"][numero]' placeholder='Número' />"+
					"<select maxlength='20' name='professor[telefone]["+x+"][tipo]' >"+
		        	"<option value='celular'>Celular</option>"+
		        	"<option value='comercial'>Comercial</option>"+
		        	"<option value='residencial'>Residencial</option>"+
		        	
		        "</select>");
				x++;
			
		}



		function adicionar_campo_email(){
			$('#emails').append("<br/><input type='text' class='span3' name='professor[email][]' maxlength='60' />");
			
		}
		
	
		function editar_professor(id){
			$('#modal-body').html('');
			$.ajax({
		        url: base_url+"admin/professor/buscar/"+id,
		        dataType: 'json',
		        type: "post",
		        success: function(data){
		        	console.log(data[0]);
		            form_professor(data[0]);
		            telefones='';
		            for(i=0;i<data[0].telefones.length;i++){
						x=i+1;
						telefones +="<input type='text' class='span1' name='professor[telefone]["+i+"][ddd]' placeholder='DDD' value='"+data[0].telefones[i].ddd+"'/>"+
						"&nbsp;<input type='text' class='span2' name='professor[telefone]["+i+"][numero]' placeholder='Número' value='"+data[0].telefones[i].numero+"'/>";
						if(data[0].telefones[i].tipo=='celular'){
							telefones +="<select maxlength='20' name='professor[telefone]["+i+"][tipo]' >"+
									"<option value='celular' selected>- Tipo -</option>"+
			        				"<option value='celular' selected>Celular</option>"+
			        				"<option value='comercial'>Comercial</option>"+
			        				"<option value='residencial'>Residencial</option>"+
			        				"</select><br/>";
						}else if(data[0].telefones[i].tipo=='comercial'){
							telefones +="<select maxlength='20' name='professor[telefone]["+i+"][tipo]' >"+
									"<option value='celular' selected>- Tipo -</option>"+
			        				"<option value='celular' >Celular</option>"+
			        				"<option value='comercial' selected>Comercial</option>"+
			        				"<option value='residencial'>Residencial</option>"+
			        				"</select><br/>"
			        				;
						}else if(data[0].telefones[i].tipo=='residencial'){
							telefones +="<select maxlength='20' name='professor[telefone]["+i+"][tipo]' >"+
									"<option value='celular' selected>- Tipo -</option>"+
			        				"<option value='celular' >Celular</option>"+
			        				"<option value='comercial'>Comercial</option>"+
			        				"<option value='residencial' selected>Residencial</option>"+
			        				"</select><br/>"
			        				;
						}else{
							telefones +="<select maxlength='20' name='professor[telefone]["+i+"][tipo]' >"+
									"<option value='celular' selected>- Tipo -</option>"+
			        				"<option value='celular' >Celular</option>"+
			        				"<option value='comercial'>Comercial</option>"+
			        				"<option value='residencial'>Residencial</option>"+
			        				"</select><br/>"
			        				;
			
						}
						
					}
		            $('#telefones').append(telefones);    
					
					email='';
		            for(i=0;i<data[0].emails.length;i++){
		            	email+="<input type='text' class='span3' name='professor[email][]' value='"+data[0].emails[i].email+"' /><br/>";
		            	$('#emails').append(email);    
		            }
		}
			});
		}
		
		
		function novo_professor(){ 
			$('#modal-body').html('');
			professor={id:'',pessoa_id:'',nome:'',carga_horaria:'',rg:'',cpf:'',emails:'',foto:'',telefones:''};
			form_professor(professor);
			adicionar_campo_email();
			adicionar_campo_telefone();
			
		}
		
		