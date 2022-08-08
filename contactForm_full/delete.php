<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>カスタマーインフォ</title>
<link rel="stylesheet" href="style.css">
</head>
<body>
<div><h1>アドレスブック</h1></div>
<div><h2>カスタマー情報欄</h2> </div>

<?php
 
header("Content-type: text/html; charset=utf-8");
    $id = $_POST['id'];
    var_dump($id);
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
	if (!isset($_POST['id']) ){
		echo "IDエラー";
		exit();
	}else{
		//プリペアドステートメント
		$stmt = $mysqli->prepare('DELETE FROM mydb WHERE id = ?');
		
		if($stmt){
			//プレースホルダへ実際の値を設定する
			$stmt->bind_param('i', $id);
			$id = $_POST['id'];
					
			$stmt->execute();
			
			//変更された行の数が1かどうか
			if($stmt->affected_rows == 1){
				echo "削除いたしました。";
			}else{
				echo "削除失敗です";
			}
		
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

<button onclick="location.href='https://sawai.naviiiva.work/contactForm_full/index.php'">戻る</button>
</body>
</html>
