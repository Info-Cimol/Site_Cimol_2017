function ver_path(id, value){
	$('#path-input-'+id).val(value);
	$('#path-'+id).css('display','block');
	$('#ver-path-'+id).text("Fechar");
	$('#ver-path-'+id).attr("onclick","fechar_path("+id+",'"+value+"');return false;");
}

function fechar_path(id, value){
	$('#link-'+id).css('display','none');
	$('#ver-path-'+id).text("Ver Caminho");
	$('#ver-path-'+id).attr("onclick","ver_path("+id+",'"+value+"');return false;");
}