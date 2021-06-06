var mail = false;
var userName = false;
var password = false;
var doublePassword = false;

// E-Mail-Adresse prüfen (Quelle: https://blog.webmart.de/2010/05/31/prufung-und-validierung-von-email-adressen-per-javascript-regex/)
String.prototype.isEmail = function () {
	var validmailregex = /^[-a-z0-9~!$%^&*_=+}{\'?]+(\.[-a-z0-9~!$%^&*_=+}{\'?]+)*@([a-z0-9_][-a-z0-9_]*(\.[-a-z0-9_]+)*\.([a-z][a-z]+)|([0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}))(:[0-9]{1,5})?$/i
	return validmailregex.test(this);
}

function checkEMail(email) {
	mail = email.isEmail();
	$("#emailError td span").html(mail ? '' : 'Gebe eine gültige E-Mail-Adresse ein');
	if (email.isEmail()) {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
				userName = (this.responseText == 'true') ? true : false;
				$("#emailError td span").html(userName ? '' : 'Leider ist die E-Mail schon vergeben');
				checkAll();
            }
        };
        xmlhttp.open("GET", "/blog/include/email_check.php?email=" + email, true);
        xmlhttp.send();
	}
	checkAll();
}

function checkUserName(name) {
	if (name.length == 0) {
		$('#userNameError td span').html('');
		userName = false;
		checkAll();
    } else {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
				userName = (this.responseText == 'true') ? true : false;
				$("#userNameError td span").html(userName ? '' : 'Leider ist der Nutzername schon vergeben');
				checkAll();
            }
        };
        xmlhttp.open("GET", "/blog/include/username_check.php?name=" + name, true);
        xmlhttp.send();
    }
}

function checkPassword(p) {
	password = (p != '' && p.length > 5 && p != $('[name=benutzername]')[0].value);
	$("#passwortError td span").html(password ? '' : 'Das Passwort stimmt nicht mit unseren Sicherheitsstands überein');
	checkAll()
}

function checkDoublePasswort(p) {
	doublePassword = ($('[name=passwort]')[0].value == p)
	$("#passwortErrorWdhl td span").html(doublePassword ? '' : 'Das Passwort stimmt nicht mit unseren Sicherheitsstands überein');
	checkAll()
}

function checkAll() {
	if (mail && userName && password && doublePassword) {
		$('#submit')[0].removeAttribute('disabled');
	} else {
		$('#submit')[0].setAttribute('disabled', '');
	}
}
