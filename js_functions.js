function checkPw() {
	var pass = $("#pass1").val();
	var confPass = $("#pass2").val();
	if (pass != confPass) {
		$("#pass1").css("border","2px solid #aa474c");
		$("#pass2").css("border","2px solid #aa474c");
	}
	else {
		$("#pass1").css("border","2px solid #4ca579");
		$("#pass2").css("border","2px solid #4ca579");
	}
}