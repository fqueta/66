/* Função responsável por mostrar ou esconder o campo de imagem e vídeo no formulário de Cases de sucesso */
var showImageVideo = function(){
	if ($('#case-type').val() == "image") {
		$('#case-image').show();
		$('#case-video').hide();
	}
	else if($('#case-type').val() == "video"){
		$('#case-image').hide();
		$('#case-video').show();
	}
};

var showInput = function(target){
	if(target === 'menu'){
		$('.content-wrapper-content').hide();
		$('.content-wrapper-marketing').show();
		$('.content-wrapper-link').hide();
		$('.content-wrapper-list-link').hide();
	}
	else if(target === 'content'){
		$('.content-wrapper-content').show();
		$('.content-wrapper-marketing').show();
		$('.content-wrapper-link').hide();
		$('.content-wrapper-list-link').hide();
	}
	else if(target === 'marketing'){
		$('.content-wrapper-content').show();
		$('.content-wrapper-marketing').hide();
		$('.content-wrapper-link').hide();
		$('.content-wrapper-list-link').hide();
	}
	else if(target === 'link'){
		$('.content-wrapper-content').hide();
		$('.content-wrapper-marketing').show();
		$('.content-wrapper-link').show();
		$('.content-wrapper-list-link').hide();
	}
	else if(target === 'list_link'){
		$('.content-wrapper-content').hide();
		$('.content-wrapper-marketing').show();
		$('.content-wrapper-link').hide();
		$('.content-wrapper-list-link').show();
	}
}

$(document).ready(function() {
	showImageVideo();
	$('#case-type').change(function() {
		showImageVideo();
	});
	$('#select-page-type').change(function() {
		showInput($(this).val());
	});

	$('#featured_select').change(function() {
		if ($(this).val() == 'link'){
			$('.featured-content').hide();
			$('.featured-link').show();
		}
		else if ($(this).val() == 'content'){
			$('.featured-content').show();
			$('.featured-link').hide();
		}
		else{
			$('.featured-content').hide();
			$('.featured-link').hide();
		}
	});
});

var copyToClipboard = function(id){
	var $temp = $("<input>");
  $("body").append($temp);
  $temp.val($('#' + id).attr('copyurl')).select();
  document.execCommand("copy");
  $('#' + id).attr('data-ls-popover', 'open');
  window.setTimeout(() => {
  	$('.ls-popover-top').remove();
  }, 2000);
  $temp.remove();
}