<?php 
	// フォームのボタンが押されたら
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		// フォームから送信されたデータを各変数に格納
		$name = $_POST["name"];
		$postnamber= $_POST["postnamber"];
		$addres = $_POST["addres"];
		$gmail = $_POST["gmail"];
		$phoen = $_POST["phoen"];
		$tell = $_POST["tell"];
		
	}

	// 登録ボタンが押されたら
	if (isset($_POST["submit"])) {
		// 送信ボタンが押された時に動作する処理をここに記述する
        	 // INSERT文を変数に格納
    $sql = "INSERT INTO mydb (name,postnamber,addres,gmail,phoen,tell) VALUES (:name,:postnamber,:addres,:gmail,:phoen,:tell)";
    //挿入する値は空のまま、SQL実行の準備をする
    $stmt = $pdo->prepare($sql);
    // 挿入する値を配列に格納する
    $params = array(':name' => $name, ':postnamber' => $postnamber, ':addres' => $addres,':gmail' => $gmail,':phoen' => $phoen,':tell' => $tell);
    //挿入する値が入った変数をexecuteにセットしてSQLを実行
    $stmt->execute($params);
 		// サンクスページに画面遷移させる
		header("Location: https://sawai.naviiiva.work/contactForm_full/index.php");
		exit;
	}

    

?>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>確認画面</title>
<link rel="stylesheet" href="style.css">
</head>
<body>
<div><h1>アドレスブック</h1></div>
<div><h2>入力確認画面</h2></div>
<div>
	<form action="confirm.php" method="post">
            <input type="hidden" name="name" value="<?php echo $name; ?>">
            <input type="hidden" name="postnamber" value="<?php echo $postnamber; ?>">
            <input type="hidden" name="addres" value="<?php echo $addres; ?>">
            <input type="hidden" name="gmail" value="<?php echo $gmail; ?>">
            <input type="hidden" name="phoen" value="<?php echo $phoen; ?>">
            <input type="hidden" name="tell" value="<?php echo $tell; ?>">
            <h1 class="contact-title">入力内容確認</h1>
            <p>入力内容はこちらで宜しいでしょうか？<br>よろしければ「送信する」ボタンを押して下さい。</p>
            <div>
                <div>
                    <label>お名前</label>
                    <p><?php echo $name; ?></p>
                </div>
                <div>
                    <label>住所番号</label>
                    <p><?php echo  $postnamber; ?></p>
                </div>
                <div>
                    <label>住所</label>
                    <p><?php echo $addres; ?></p>
                </div>
                <div>
                    <label>メール</label>
                    <p><?php echo $gmail; ?></p>
                </div>
                <div>
                    <label>携帯電話番号</label>
                    <p><?php echo $phoen; ?></p>
                </div>
                <div>
                    <label>自宅電話番号</label>
                    <p><?php echo $tell; ?></p>
                </div>
            </div>
		<input type="button" value="内容を修正する" onclick="history.back(-1)">
		<button type="submit" name="submit">登録する</button>
	</form>
	<?php
	ini_set('display_errors', 1);
    error_reporting(E_ALL);
	try{
	$dsn = 'mysql:host=sawai.naviiiva.work;dbname=sawai;charset=utf8mb4';
    $user = 'naviiiva_user';
    $pass = '!Samurai1234';
    
    //MySQLのデータベースに接続
    $pdo = new PDO($dsn, $user, $pass);
    //PDOのエラーレポートを表示
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $name = $_POST["name"];
		$postnamber= $_POST["postnamber"];
		$addres = $_POST["addres"];
		$gmail = $_POST["gmail"];
		$phoen = $_POST["phoen"];
		$tell = $_POST["tell"];

} catch (PDOException $e) {
    exit('データベースに接続できませんでした。' . $e->getMessage());

	}
         
    ?>
</div>
</body>
</html>