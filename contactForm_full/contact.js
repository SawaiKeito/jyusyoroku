var validate = function() {

	var flag = true;

	removeElementsByClass("error");
	removeClass("error-form");

	// お名前の入力をチェック
	if(document.form.name.value == ""){
		errorElement(document.form.name, "お名前が入力されていません");
		flag = false;
	}

	// 住所番号の入力をチェック
	if(document.form.postnamber.value == ""){
		errorElement(document.form.postnamber, "郵便番号が入力されていません");
        	flag = false;
	} else {
		// 住所番号の形式をチェック
		if(!validateNumber(document.form.postnamber.value)){
			errorElement(document.form.postnamber, "半角数字のみ入力ください");
            flag = false;
		}else {
			if(!validateAd(document.form.postnamber.value)){
				errorElement(document.form.postnamber, "郵便番号が正しくありません");
				flag = false;
			}
		}
	}
	
		// 住所の入力をチェック
	if(document.form.addres.value == ""){
		errorElement(document.form.addres, "住所が入力されていません");
		flag = false;
	}

	// メールアドレスの入力をチェック
	if(document.form.gmail.value == ""){
		errorElement(document.form.gmail, "メールアドレスが入力されていません");
		flag = false;
	} else {
		// メールアドレスの形式をチェック
		if(!validateMail(document.form.gmail.value)){
			errorElement(document.form.gmail, "メールアドレスが正しくありません");
			flag = false;
		}
	}

	// 携帯電話番号の入力をチェック
	if(document.form.phoen.value == ""){
		errorElement(document.form.phoen, "携帯電話番号が入力されていません");
		flag = false;
	} else {
		// 電話番号の形式をチェック
		if(!validateNumber(document.form.phoen.value)){
			errorElement(document.form.phoen, "半角数字のみを入力してください");
			flag = false;
		} else {
			if(!validatePh(document.form.phoen.value)){
				errorElement(document.form.phoen, "携帯電話番号が正しくありません");
				flag = false;
			}
		}
	}
	
		// 自宅電話番号の入力をチェック
	if(document.form.tell.value == ""){
		errorElement(document.form.tell, "自宅電話番号が入力されていません");
		flag = false;
	} else {
		// 電話番号の形式をチェック
		if(!validateNumber(document.form.tell.value)){
			errorElement(document.form.tell, "半角数字のみを入力してください");
			flag = false;
		} else {
			if(!validateTell(document.form.tell.value)){
				errorElement(document.form.tell, "自宅電話番号が正しくありません");
				flag = false;
			}
		}
	}

	return flag;
}




var errorElement = function(form, msg) {
	form.className = "error-form";
	var newElement = document.createElement("div");
	newElement.className = "error";
	var newText = document.createTextNode(msg);
	newElement.appendChild(newText);
	form.parentNode.insertBefore(newElement, form.nextSibling);
}


var removeElementsByClass = function(className){
	var elements = document.getElementsByClassName(className);
	while (elements.length > 0){ 
		elements[0].parentNode.removeChild(elements[0]);
	}
}

var removeClass = function(className){
	var elements = document.getElementsByClassName(className);
	while (elements.length > 0) {
		elements[0].className = "";
	}
}

var validateMail = function (val){
	if (val.match(/^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/)==null) {
		return false;
	} else {
		return true;
	}
}


var validateNumber = function (val){
	if (val.match(/[^0-9]+/)) {
		return false;
	} else {
		return true;
	}
}


var validateTell = function (val){
	if (val.match(/^[0-9-]{10,10}$/) == null) {
		return false;
	} else {
		return true;
	}
}

var validatePh = function (val){
	if (val.match(/^[0-9-]{11,11}$/) == null) {
		return false;
	} else {
		return true;
	}
}

var validateAd = function (val){
	if (val.match(/^[0-9-]{7,7}$/) == null) {
		return false;
	} else {
		return true;
	}
}

var validateKana = function (val){
	if (val.match(/^[ぁ-ん]+$/) == null) {
		return false;
	} else {
		return true;
	}
}