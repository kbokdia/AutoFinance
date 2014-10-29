$(".upper-case").focusout(function(event){
	var str = $(this).val()
	var str_arr = str.split(' ');
	str="";

	for (var i = 0; i < str_arr.length; i++) {
		str += returnCaps(str_arr[i]) + " ";
	}
	str = str.trim();
	$(this).val(str);
});

$('.alert').click(function(event){
	$('.alert').slideUp('slow');
});

function returnCaps(str){
	return str.charAt(0).toUpperCase() + str.slice(1).toLowerCase();
}