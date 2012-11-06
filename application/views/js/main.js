$(document).ready(function () {

	$('#btn-ajax').click(function () {

		var params = {
			param1: 'val1',
			param2: 'val2',
			param3: ['aaa', 'bbb']
		};

		//Do not forget the final slash at the end of the URL!
		$.getJSON(URL_SITE + 'ajax/get_ajax_content/', params, function (data) {

			if (data) {

				for (var i = 0, el; el = data[i]; ++i) {

					$('#ajax-wrap').append($('<p />').text(el.id + ' - ' + el.title));

				}//end for

			}//end if

		});//end getJSON

	});//end click

});//end ready