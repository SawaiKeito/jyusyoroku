<?php
 
header("Content-type: text/html; charset=utf-8");
 
function db_connect(){
	//データベース接続
	$server =   'sawai.naviiiva.work';
	$userName = 'naviiiva_user'; 
	$password = '!Samurai1234'; 
	$dbName = 'sawai';
 
	$mysqli = new mysqli($server, $userName, $password,$dbName);
 
	if ($mysqli->connect_error){
		echo $mysqli->connect_error;
		exit();
	}else{
		$mysqli->set_charset("utf-8");
	}
	return $mysqli;
}
    $mysqli = db_connect();
    $sql = "SELECT * FROM mydb";
    $result = $mysqli -> query($sql);
 
if(empty($_POST)) {
	echo "<a href='index.php'>index.php</a>←こちらのページからどうぞ";
	exit();
}else{
	//名前入力チェック
	if (!isset($_POST['name'])  || $_POST['name'] === "" ){
		$errors['name'] = "名前が入力されていません。";
	}
	if (!isset($_POST['postnamber'])  || $_POST['postnamber'] === "" ){
		$errors['postnamber'] = "郵便番号が入力されていません。";
	}
	if (!isset($_POST['addres'])  || $_POST['addres'] === "" ){
		$errors['addres'] = "住所が入力されていません。";
	}
	if (!isset($_POST['gmail'])  || $_POST['gmail'] === "" ){
		$errors['gmail'] = "メールが入力されていません。";
	}
	if (!isset($_POST['phoen'])  || $_POST['phoen'] === "" ){
		$errors['phoen'] = "携帯電話番号が入力されていません。";
	}
	if (!isset($_POST['tell'])  || $_POST['tell'] === "" ){
		$errors['tell'] = "自宅電話番号が入力されていません。";
	}

    $errors=array();
	if(count($errors) === 0){
		//プリペアドステートメント
		$stmt = $mysqli->prepare("UPDATE mydb SET name=?,postnamber=?,addres=?,gmail=?,phoen=?,tell=? WHERE id=?");
	
		
			if ($stmt) {
			//プレースホルダへ実際の値を設定する
			$stmt->bind_param('ssssssi', $name,$postnamber,$addres,$gmail,$phoen,$tell,$id);
			$name = $_POST['name'];
			$postnamber = $_POST['postnamber'];
			$addres = $_POST['addres'];
			$gmail = $_POST['gmail'];
			$phoen = $_POST['phoen'];
			$tell = $_POST['tell'];
			$id =$_POST['id'];
			//クエリ実行
			$stmt->execute();
			
			//ステートメント切断
			$stmt->close();
		}else{
			echo $mysqli->errno . $mysqli->error;
		}
	}
  }

 
 
// データベース切断
$mysqli->close();
		
?>
 
<!DOCTYPE html>
<html>
<head>
<title>変更画面</title>
</head>
<body>
<h1>変更画面</h1> 
 
<?php if (count($errors) === 0): ?>
<p>変更完了しました。</p>
<?php elseif(count($errors) > 0): ?>
<?php
foreach($errors as $value){
	echo "<p>".$value."</p>";
}
?>
<?php endif; ?>
<button onclick="location.href='https://sawai.naviiiva.work/contactForm_full/index.php'">戻る</button>
</body>
</html>