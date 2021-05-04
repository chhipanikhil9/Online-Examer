	var courseField=document.getElementById('course');
	var semesterField=document.getElementById('semester');
	var email=document.getElementById('email');
	var rollno=document.getElementById('rollno');
	var contact=document.getElementById('contact');
	var pwd=document.getElementById('pwd');
	var cpwd=document.getElementById('cpwd');
	var emailerror=document.getElementById('emailerror');
	var rollerror=document.getElementById('rollerror');
	var contacterror=document.getElementById('contacterror');
	var pwd=document.getElementById('pwd');
	var cpwd=document.getElementById('cpwd');
	var lemail=document.getElementById('lemail');
	var lpwd=document.getElementById('lpwd');
	var loginerror=document.getElementById('loginerror');
	var signuperror=document.getElementById('signuperror');

	function courseChange(){
		semesterField.innerHTML='';
		var course=courseField.value;
		var l=0;
		if(course=='mca'){
			l=6;
		}else if(course=='mt'){
			l=4;
		}else{
			l=8;
		}
		for(var i=1;i<=l;i++){
			semesterField.innerHTML+='<option value="'+i+'">'+i+'</option>';
		}
	}

	//to verify email
	function validateEmail(emailField){
        var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
        if (reg.test(emailField.value) == false){
            return false;
        }
        return true;
	}

	//checks whole validation
	function signupValidation(){
		if(!validateEmail(email)){
			emailerror.style.visibility='visible';
			console.log('email false');
			return false;
		}

		if(rollno.value.length<4 || rollno.value.length>10){
			rollerror.style.visibility='visible';
			console.log('rollnoerror false');
			return false;
		}

		if(contact.value.length!=10){
			contacterror.style.visibility='visible';
			console.log('contacterror false');
			return false;
		}

		if(pwd.value.length<8 || pwd.value.length>20){
			pwderror.style.visibility='visible';
			console.log('pwderror false');
			return false;
		}

		if(pwd.value!=cpwd.value){
			cpwderror.style.visibility='visible';
			console.log('cpwderror false');
			return false;
		}

	}

	function loginValidation(){
		if(lemail.value.length<4){
			loginerror.style.visibility='visible';
			return false;
		}

		if(lpwd.value.length<4){
			loginerror.style.visibility='visible';
			return false;
		}
	}
	function  hideLError(){
		loginerror.style.visibility='hidden';
	}

	function hideNext(el){
		el=el.nextSibling.nextSibling;
		el.style.visibility='hidden';
		signuperror.style.visibility='hidden';
	}