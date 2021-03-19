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
			rated:{
				required:true,
				minlength: 2
			},
			summa:{
                                minlength: 2,
				required:true,
                                digits: true
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
		let uri = 'scripts/bankomat.php';
		let form =$(forma);
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
					//Если ошибок нет, очищаем форму
					if(data.status == true){
						//Очистка формы
						//form[0].reset();
						//Включение кнопки и элементов формы
						form.find('button, input, textarea').removeAttr('disabled');
						form.find('#response_order').remove();
						form.append("<div id='response_order' class=''><p class='msg text-center m-0 pb-3'></p> </div>");
						form.find("div.msg").html(data.message);
						form.find("div.msg").addClass("msg-success").fadeIn("slow");
						setTimeout(function () {
							//Если форма в модально окне, закрываем модальное окно при успехе
							if (form.closest('.modal').hasClass('modal')) {
								form.closest('.modal').modal( 'hide' );
							}
							$('p.msg').fadeOut("slow").removeClass('msg-success').html("");
						}, 3000);
					}else {
						form.find('#response_order').remove();
						form.append("<div id='response_order' class=''><p class='msg text-center m-0 pb-3'></p> </div>");
						form.find("p.msg").html(data.message);
						form.find("p.msg").addClass("msg-error").fadeIn("slow");
						setTimeout(function () {
							$('p.msg').fadeOut("slow");
							//Включение кнопки и элементов формы
							form.find('button,input, textarea').removeAttr('disabled');
						},2000);
					}
				}
			},
			error: function(x, t, e){
				if( t === 'timeout') {
					// Произошел тайм-аут
					form.find('#loading').remove();
					//Очистка формы
					form[0].reset();
					//Включение кнопки и элементов формы
					form.find('button,input, textarea').removeAttr('disabled');
					form.find('#response_order').remove();
					form.append("<div id='response_order' class=''><p class='msg text-center m-0 pb-3'></p> </div>");
					form.find("p.msg").html('Превышено время ожидания');
					form.find("p.msg").addClass("msg-error").fadeIn("slow");
					setTimeout(function() { $('p.msg').fadeOut("slow"); }, 3000);
				}
			}
		})
	}
    
})(jQuery);