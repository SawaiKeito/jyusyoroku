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
if (!isset($_POST['update'])){ 
		echo "IDエラー";
		exit();
	}else{
		//プリペアドステートメント
		$stmt = $mysqli->prepare("SELECT * FROM mydb WHERE id=?");
		if ($stmt) {
			//プレースホルダへ実際の値を設定する
			$stmt->bind_param('i', $_POST['id']);
			//クエリ実行
			$stmt->execute();
			
			//結果変数のバインド
			$stmt->bind_result($name,$postnamber,$addres,$gmail,$phoen,$tell,$id);
			// 値の取得
			$stmt->fetch();
						
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
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>カスタマーインフォ</title>
<link rel="stylesheet" href="style.css">
<script type="text/javascript" src="contact.js"></script>
</head>
<body>
<div><h1>アドレスブック</h1></div>
<div><h2>カスタマー情報欄</h2> </div>
<form action="fixok.php" method="post" name="form" onsubmit="return validate()">
	<div>
                	<div>
				<label>お名前</label>
				<input type="text" name="name" value="<?=htmlspecialchars($name, ENT_QUOTES, 'UTF-8')?>">
                <input type="hidden" name="id" value="<?=$id?>">

			</div>
				<div>
				<label>住所番号</label>
				<input type="text" name="postnamber"  value="<?=htmlspecialchars($postnamber, ENT_QUOTES, 'UTF-8')?>">
                <input type="hidden" name="id"　value="<?=$id?>" >

			</div>
			<div>
				<label>住所</label>
				<input type="text" name="addres" value="<?=htmlspecialchars($addres, ENT_QUOTES, 'UTF-8')?>">
                <input type="hidden" name="id"value="<?=$id?>" >

			</div>
			<div>
				<label>メールアドレス</label>
				<input type="text" name="gmail" value="<?=htmlspecialchars($gmail, ENT_QUOTES, 'UTF-8')?>">
                <input type="hidden" name="id"value="<?=$id?>" >

			</div>
			<div>
				<label>携帯電話番号</label>
				<input type="text" name="phoen" value="<?=htmlspecialchars($phoen, ENT_QUOTES, 'UTF-8')?>">
                <input type="hidden" name="id"value="<?=$id?>" >

			</div>
				<div>
				<label>自宅電話番号</label>
				<input type="text" name="tell" value="<?=htmlspecialchars($tell, ENT_QUOTES, 'UTF-8')?>">
                <input type="hidden" name="id"value="<?=$id?>" >

			</div>
			
    </div>
<input type="submit" value="変更する">
</form>
 
</body>
</html>