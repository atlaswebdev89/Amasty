(function ($) {
     "use strict";
     
        /* Изменение поведения placeholder при событиях фокусировке и потере фокуса */
            $('form').find('input, textarea').each(function (e) {
                    let input= $(this);
                    let placeholder =input.attr('placeholder');
                    input.on('focus', function (e) {
                            $(this).attr('placeholder','');
                    })
                    input.on('blur', function (e) {
                            $(this).attr('placeholder',placeholder);
                    });
            });
        
        /* Валидация данных формы перед выполнением ajax запроса*/
	$('#main-form').validate({
		rules: {
			football_club:{
				required:true,
				minlength: 2
			},
		},
		errorPlacement: function (error, element) {},
		submitHandler: function(form) {
			urlencodeForm(form);
		}
	});
        
        function urlencodeForm(form) {
		let form_encode = $(form).serializeArray();
		ajaxTransferUrlEncode(form, form_encode);
	}
        
        /*Функция передачи данных формы*/
	function ajaxTransferUrlEncode(forma, dataForm) {
		
                let uri = 'scripts/football.php';
                let form =$(forma);
                let elem = form.closest('div');
            
                
		
                $.ajax({
			type: 'POST',
			url: uri,
			data:dataForm,
			timeout: 5000,
			//Указывая тип json использовать функцию JSON.parse не надо будет ошибка
			dataType: "json",
			beforeSend: function (data) {
				//Блокируем кнопку и элементы формы
				form.find('button, input, textarea').attr('disabled', 'disabled');
			},
			success:  function (data) {
				if(data) {
                                        //Убираем блок вывода
                                        $('.msg').remove();
					//Если ошибок нет, очищаем форму
					if(data.status == true){
						//Включение кнопки и элементов формы
						form.find('button, input, textarea').removeAttr('disabled');
                                                    //Формируем полученный результат
                                                    elem.append("<div class='msg col-md-12 mt-3'><p class='m-3 '>Ответ:</p></div>");
                                                    let content = '<table class="table table-striped">';
                                                    content+='<thead><tr><th>Номинал</th><th>Количество</th></tr></thead>';
                                                    content+='<tbody>';
                                                        for(var key in data.message){
                                                            content+='<tr><td>'+key+'</td><td>'+data.message[key]+'</td></tr>';
                                                        }
                                                    content+='</tbody></table>';
                                                $('.msg').append(content);                                                                
					}else if(data.status == false) {
						//Включение кнопки и элементов формы
						form.find('button, input, textarea').removeAttr('disabled');
						//Формируем полученный результат
                                                elem.append("<div class='msg col-md-12 mt-3'><p class='m-3 '>Ответ:</p></div>");
						let content = '<div class="m-3 p-3 error-msg"><p class="m-0">'+data.message+'</p><div>';
						$('.msg').append(content);
					}
				}
			},
			error: function(x, t, e){
				if( t === 'timeout') {
					//Включение кнопки и элементов формы
					form.find('button,input, textarea').removeAttr('disabled');
                                        //Формируем полученный результат
                                                elem.append("<div class='msg col-md-12 mt-3'><p class='m-3 '>Ответ:</p></div>");
						let content = '<div class="m-3 p-3 error-msg"><p>Превышено время ожидания</p><div>';
						$('.msg').append(content);
				}
			}
		})
	}
    
})(jQuery);