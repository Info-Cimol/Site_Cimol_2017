	var x=0;
	var curso_id=null;
	function form_aluno(aluno){
			console.log(aluno.nome);
			$('#modal-body').html('');
			   		form="<form action='"+base_url+"admin/aluno/editar_imagem/"+aluno.id+"' method='post' enctype='multipart/form-data'>"+
        			"<div class='padded'>"+
    				"<input type='hidden' name='aluno[pessoa_id]' value='"+aluno.pessoa_id+"' />"+
	                "<div class='control-group'>"+
	                    "<label class='control-label'>Nome:</label>"+
	                    "<div class='controls'>"+
	                        "<input type='text' name='aluno[nome]' value='"+aluno.nome+"' maxlength='60' required/>"+
	                    "</div>"+
	                "</div>"+
	               
	                "<div class='control-group'>"+
                    "<label class='control-label'>RG:</label>"+
                    "<div class='controls'>"+
                        "<input type='text' name='aluno[rg]' value='"+aluno.rg+"' maxlength='60' required/>"+
                    "</div>"+
                "</div>"+
	                "<div class='control-group'>"+
	                    "<label class='control-label'>CPF:</label>"+
	                    "<div class='controls'>"+
	                        "<input type='text' name='aluno[cpf]' value='"+aluno.cpf+"' maxlength='60' required/>"+
	                    "</div>"+
	            	"</div>"+
	                "<div class='control-group'>"+
                    	"<label class='control-label'>telefone(s)<button   class='btn btn-blue btn-mini'>+</button>:</label>"+
                    	"<div class='controls' id='telefones'>"+
            			
	            			
            			"</div>"+
                	"</div>"+
	                "<div class='control-group'>"+
                    "<label class='control-label'>Email:</label>"+
                    "<div class='controls' id='emails'>"+
            			"<input type='text' class='span3' name='aluno[email][]' value='' placeholder='Email'/>"+
                    "</div>"+
                "</div>"+
	                "<div class='control-group'>"+
	                "<label class='control-label'>Trocar foto:</label>"+
	                    "<input type='file' name='foto' >"+
	                    
	                "</div>"+
	                "<input type='hidden' name='old-foto' value='"+aluno.foto+"'>";
				   	if(aluno.foto!=""){
				   		form+="<img src='"+base_url+aluno.foto+"' />";
				   	}else{	
				   		form+="<img src='"+base_url+aluno.foto+"' />"; 
					}
				form+="<div class='form-actions'>"+
	                "<input type='submit'  class='btn btn-blue' name='salvar' value='Salvar'>"+
	            "</div></form>";
				
		        $('#modal-body').append(form);

		}
		   

		function adicionar_campo_telefone(){
			$('#telefones').append("<br/><input type='text' class='span1' name='aluno[telefone]["+x+"][ddd]' placeholder='DDD'/>"+
					"&nbsp;<input type='text' class='span2' name='aluno[telefone]["+x+"][numero]' placeholder='Número' />"+
					"<select maxlength='20' name='aluno[telefone]["+x+"][tipo]' >"+
		        	"<option value='celular'>Celular</option>"+
		        	"<option value='comercial'>Comercial</option>"+
		        	"<option value='residencial'>Residencial</option>"+
		        	
		        "</select>");
			x++;
		}



		function adicionar_campo_email(){
			$('#email').append("<br/><input type='text' class='span3' name='aluno[email][]' maxlength='60' />");
			
		}
		
	
		function editar_aluno(id){
			//console.log(base_url+"admin/aluno/buscar/"+id);
			$('#modal-body').html('');
			$.ajax({
		        url: base_url+"admin/aluno/buscar/"+id,
		        dataType: 'json',
		        type: "post",
		        success: function(data){
		        	console.log(data[0]);
		        	form_aluno(data[0]);
		            telefones='';
		            if(data[0].telefones.length>0){
		            	
		           
			            for(i=0;i<data[0].telefones.length;i++){
							//x=i+1;
							telefones +="<input type='text' class='span1' name='aluno[telefone]["+x+"][ddd]' placeholder='DDD' value='"+data[0].telefones[i].ddd+"'/>"+
							"&nbsp;<input type='text' class='span2' name='aluno[telefone]["+x+"][numero]' placeholder='Número' value='"+data[0].telefones[i].numero+"'/>";
							if(data[0].telefones[i].tipo=='celular'){
								telefones +="<select maxlength='20' name='aluno[telefone]["+x+"][tipo]' >"+
										"<option value='celular' selected>- Tipo -</option>"+
				        				"<option value='celular' selected>Celular</option>"+
				        				"<option value='comercial'>Comercial</option>"+
				        				"<option value='residencial'>Residencial</option>"+
				        				"</select><br/>";
							}else if(data[0].telefones[i].tipo=='comercial'){
								telefones +="<select maxlength='20' name='aluno[telefone]["+x+"][tipo]' >"+
										"<option value='celular' selected>- Tipo -</option>"+
				        				"<option value='celular' >Celular</option>"+
				        				"<option value='comercial' selected>Comercial</option>"+
				        				"<option value='residencial'>Residencial</option>"+
				        				"</select><br/>"
				        				;
							}else if(data[0].telefones[i].tipo=='residencial'){
								telefones +="<select maxlength='20' name='aluno[telefone]["+x+"][tipo]' >"+
										"<option value='celular' selected>- Tipo -</option>"+
				        				"<option value='celular' >Celular</option>"+
				        				"<option value='comercial'>Comercial</option>"+
				        				"<option value='residencial' selected>Residencial</option>"+
				        				"</select><br/>"
				        				;
							}else{
								telefones +="<select maxlength='20' name='aluno[telefone]["+x+"][tipo]' >"+
										"<option value='celular' selected>- Tipo -</option>"+
				        				"<option value='celular' >Celular</option>"+
				        				"<option value='comercial'>Comercial</option>"+
				        				"<option value='residencial'>Residencial</option>"+
				        				"</select><br/>"
				        				;
				
							}
						}
		            }else{
		            	adicionar_campo_telefone();
		            }
		            $('#telefones').append(telefones);
					
		            emails='';
		            if(data[0].emails.lengt>0){
			            for(i=0;i<data[0].emails.length;i++){
			            	$('#emails').append(emails);
			  	        }
		            }else{
		            	$('#emails').append(emails);
		            }
		           // $('#emails').append(emails);
		        }
			});
		}
		
		
		function novo_aluno(){ 
			$('#modal-body').html('');
			aluno={id:'',pessoa_id:'',nome:'',matricula:'',rg:'',cpf:'',emails:'',foto:'',telefones:''};
			form_aluno(aluno);
			adicionar_compo_telefone();
		}
		
		