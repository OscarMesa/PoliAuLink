var Curses = {};
var id_delete,mode_save_to_update = 'save';

/**
*	Variables backbound
*/

var ModelCurces;

var CollectionCurces;

var ccurses;

$(document).live('ready',start);

function start(){

	$('#btn-deletecurse').live('click',DeleteCurso)

	$('#cursos').live('click',LoadViewCursos);

	$('.delete_curso').live('click',OpenWindowDeleteCurse);

	$('.edit_curso').live('click',OpenWindowCurse)

	$('#usuarios').live('click', LoadViewUsuarios);

	$('#profesiones').live('click',LoadViewProfessions);

	$('#universidades').live('click',LoadViewUniversities);

	$('#tipo_cursos').live('click',LoadViewTypeCourse);

	$('#tipo_contenidos').live('click',LoadViewTypeContenten);

	$('#ejercicios').live('click',LoadViewExcercices);

	$('#ecuaciones').live('click',LoadViewEquations);

	$('#btn-savecurse').live('click',SaveCurse);

	InitElementBackbone();
}

function InitElementBackbone(){
	 ModelCurces = Backbone.Model.extend({
     initialize: function() {
      console.log('Se inicio el modelo de los cursos');
     },
     defaults: {
      Id: 'undefined',
      id_type: 'undefined',
  	  name_type: 'undefined',
  	  id_tacher: 'undefined',
  	  name_tache: 'undefined'
     }
    });
     
    CollectionCurces = Backbone.Collection.extend({
     initialize: function() {
      console.log("Se inicio la colecccion de los cursos");
     },
     model: ModelCurces
    });
     
}
function SaveCurse(e){
	if(document.querySelector("#frm-newcurse").checkValidity()){ 
		if(mode_save_to_update == 'save'){
			$.ajax({
				type:"POST",
				dataType: "JSON",
				url: base_url + "curses/NewCurse",
				data: Curses,
				success: function(data){
					if(!data.rpt){
								for(x in data.step_msg){
									$('#error_' + x).html(data.step_msg[x]);
								}
					}else{
						$('#mcurces').modal('hide');
						OpenMessagesModal('Guardado exitoso','El curso se almaceno correctamente');
						LoadViewCursos();
					}
				},
				error: function(data){
					console.log(data);
				}
			});
		}else{
			$.ajax({
				type:"POST",
				dataType: "JSON",
				url: base_url + "curses/EditCurse",
				data: Curses,
				success: function(data){
					if(!data.rpt){
								for(x in data.step_msg){
									$('#error_' + x).html(data.step_msg[x]);
								}
					}else{
						$('#mcurces').modal('hide');
						OpenMessagesModal('Edición exitoso','El curso se edito correctamente');
						LoadViewCursos();
					}
				},
				error: function(data){
					console.log(data);
				}
			});
			mode_save_to_update = 'save';
			Curses = undefined;
		}
	}else{
		document.getElementById("btn-validatecurse").click();
	}
	e.preventDefault();
}
function OpenMessagesModal(title,body){
	$('#message .modal-header h3').html(title);
	$('#message .modal-body p').html(body);
	$('#message').modal('show');
}
function LoadDataTypeCurce(e){
	if(e.keyCode!=8 && $(this).val()!='' && $(this).val().length>2)
	{
		$.ajax({
			type:'POST',
			dataType: 'JSON',
			url: base_url + 'curses/LoadDataTypeCurce',
			data: 'filter=' + $(this).val(),
			success: function(data){
				$('#LayerTypeCurces').html('');
				$.each(data,function(key,value){
					$('#LayerTypeCurces').html($('#LayerTypeCurces').html()+'<option value="'+value.nombre+'">');
					console.log($('#LayerTypeCurces').html());
				});
				
			},
			error: function(data){
				conosle.log(data);
			} 
		});
	}	
}
function LoadViewEquations(){
	$("#homemain").html(CapaLoadImages()).load('equations/getAllEcuations');
}
function LoadViewExcercices(){
	$("#homemain").html(CapaLoadImages()).load('ejercicios/getAllExcrcies');
}
function LoadViewTypeContenten(){
	$("#homemain").html(CapaLoadImages()).load('contents/LoadViewTypeContents');
}
function LoadViewCursos(){
	$("#homemain").html(CapaLoadImages()).load('cursos/LoadViewCursos',null,function(data){
		$(this).html(data);
	});
}
function LoadViewUniversities(){
	$("#homemain").html(CapaLoadImages()).load('university/LoadViewUniversity',null,function(data){
		$(this).html(data);
	}) 	
}
function LoadViewUsuarios(){
	$("#homemain").html(CapaLoadImages()).load('usuario/LoadViewUsers',null,function(data){
		$(this).html(data);
	}) 
}
function LoadViewProfessions(){
	$("#homemain").html(CapaLoadImages()).load('professions/LoadViewProfessions');
}
function LoadViewTypeCourse(){
	$("#homemain").html(CapaLoadImages()).load('curses/LoadViewTypeCourse')
}
function CapaLoadImages(){
	imageLoad = document.createElement('div');
	$(imageLoad).attr('id','content-loading');
	$(imageLoad).html('<div class="circle"></div><div class="circle1"></div>');
	return $(imageLoad);
}
function OpenWindowDeleteCurse(){
	id_delete = $(this).attr('id');
	$('#message-delte-curse').modal('show');
}
function OpenWindowCurse(){
	if($(this).attr('class') == 'edit_curso'){
		mode_save_to_update = 'edit';
		element = eval(jQuery.parseJSON(JSON.stringify(ccurses.where({Id:$(this).attr('id')}))))[0];
		$('#Techer').val(element.name_tache);
		$('#TypeCurcesLoad').val(element.name_type);
		Curses['id'] = element.Id;
		Curses['id_teacher'] = element.id_tacher;
		Curses['id_typecurse'] = element.id_type;
		$('#mcurces').modal('show');
	}
}
function DeleteCurso(e){
	$('#message-delte-curse').modal('toggle');
	$.ajax({
		type: 'POST',
		dataType: 'JSON',
		url: 'curses/DeleteCurse',
		data: 'id=' + id_delete,
		success: function(response){
			if(response.col_afetada>0){
				$('#row_'+id_delete).hide('slow', function(){ $('#row_'+id_delete).remove(); });
			}else{
				alert('Se presento un error durante la eliminación');
				console.log(response);
			}
		},
		error: function(response){
			console.log(response);
		}
	});
}
function clear_form_elements(ele) {

	$(ele).find(':input').each(function() {
        switch(this.type) {
            case 'password':
			case 'select-multiple':
			case 'select-one':
            case 'text':
			case 'textarea':
                $(this).val('');
                break;
            case 'checkbox':
            case 'radio':
                this.checked = false;
        }
	});

}
function NewCurso(){
	$.ajax({
		type:'POST',
		dataType: 'JSON',
		url: 'cursos/NewCurso',
		success: function(response){
			id = response.id_new_curso;
			// row = '<tr id="row_'+id+'">
			// 	<td>'+id+'</td>
			// 	<td>
			// 		<div class="edit" id="'+id+':'+CryptoJS.SHA1("nombre")+':'+CryptoJS.SHA1("tipo_curso")+'">Diligenciar campo</div>
			// 		<span class="message_error" id="error_'+id+':'+CryptoJS.SHA1('nombre')+':'+CryptoJS.SHA1("tipo_curso")+'"></span>
			// 		</td><td><div class="edit" id="'+id+':'+CryptoJS.SHA1('descripcion')+':'+CryptoJS.SHA1('tipo_curso')+'">Diligenciar campo</div>
			// 		<span class="message_error" id="error_'+id+':'+CryptoJS.SHA1('descripcion')+':'+CryptoJS.SHA1("tipo_curso")+'"></span>
			// 		</td><td><a href="javascript:void(0);" class="delete_curso" id='+id+'><i class="icon-trash"></i></a></td></tr>"';
			
			$("#homemain table").append(row).show('slow');

		},
		error: function function_name (response) {
			alert('Ocurrio un error durante la creación');
			console.log(response);
		}
	});
}

