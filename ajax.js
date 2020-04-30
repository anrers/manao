$( document ).ready(function() {
    
    $("#btn").click(
		function(){
			sendAjaxForm('result_form', 'ajax_form', 'action_ajax_form.php');
			return false; 
		}
	);

    $("#btn1").click(
		function(){
			sendAjaxForm('result_auth', 'auth_form', 'action_auth_form.php');
			return false; 
		}
	);
});
 
function sendAjaxForm(result_form, ajax_form, url) {
    $.ajax({
        url:     url, //url страницы (action_ajax_form.php)
        type:     "POST", //метод отправки
        dataType: "html", //формат данных
        data: $("#"+ajax_form).serialize(),  // Сеарилизуем объект
        success: function(response) { //Данные отправлены успешно
                result = $.parseJSON(response);
                if (result.status === 'ok') {
                    $('#ajax_form').css('display', 'none');//Скрываем форму
                    $('#result_form').html('Вы успешно зарегистрированы');
                } 
                else if(result.status === 'auth') {
                    $('#ajax_form').css('display', 'none');//Скрываем форму
                    $('#auth_form').css('display', 'none');//Скрываем форму
                    $('#result_auth').html('Hello ' + result.name).css('margin', '35%');
                }
                else {
                    let str = ''; //вывод ошибок
                    $.each(result, function(key, value) { 
                        res = value+'<br>'
                        str = str + res;
                    });
                     $('#' + result_form).html(str);
                }
        	
    	},
    	error: function(response) { // Данные не отправлены
            $('#'+result_form).html('Ошибка. Данные не отправлены.');
    	}
 	});
}
