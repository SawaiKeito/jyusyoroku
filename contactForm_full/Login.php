<?php
	

// エラーメッセージの初期化
$errorMessage = "";

// ログインボタンが押された場合
if (isset($_POST["login"])) {
    // 1. ユーザIDの入力チェック
    if (empty($_POST["userid"])) {  // emptyは値が空のとき
        $errorMessage = 'ユーザーIDが未入力です。';
    } else if (empty($_POST["password"])) {
        $errorMessage = 'パスワードが未入力です。';
    }

    if (!empty($_POST["userid"]) && !empty($_POST["password"])) {
        // 入力したユーザIDを格納
        $userid = $_POST["userid"];
       

        // 3. エラー処理
        try {
            $dsn = 'mysql:host=sawai.naviiiva.work;dbname=sawai;charset=utf8mb4';
            $user = 'naviiiva_user';
            $pass = '!Samurai1234';
            //MySQLのデータベースに接続　　 
             $pdo = new PDO($dsn, $user, $pass);
             //PDOのエラーレポートを表示
             $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


            $stmt = $pdo->prepare('SELECT * FROM rogin WHERE name = ? ');
            $stmt->execute(array($userid));

            $password = $_POST["password"];

            if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                if (password_verify($password, $row['password'])) {
                    // 入力したIDのユーザー名を取得
                    $id = $row['name'];
                    // $sql = "SELECT * FROM rogin WHERE name = $id";  //入力したIDからユーザー名を取得
                    // $stmt = $pdo->query($sql);
                    // foreach ($stmt as $row) {
                    //     $row['name'];
                    // }
                    header("Location:https://sawai.naviiiva.work/contactForm_full/index.php");
                    exit();
                } else {
                    $errorMessage = 'ユーザーIDあるいはパスワードに誤りがあります。';
                }
            } else {
                $errorMessage = 'ユーザーIDあるいはパスワードに誤りがあります。';
            }
        } catch (PDOException $e) {
            $errorMessage = 'データベースエラー';
            print_r($pdo->errorInfo());
        }
    }
}
?>

<!doctype html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>カスタマー登録</title>
<link rel="stylesheet" href="style.css">
<script type="text/javascript" src="contact.js"></script>
</head>
    <body>
        <div><h1>アドレスブック</h1></div>
        <div><h2>ログイン画面</h2></div>
        <form id="loginForm" name="loginForm" action="" method="POST">
            <fieldset>
                <legend>ログインフォーム</legend>
                <div><font color="#ff0000"><?php echo htmlspecialchars($errorMessage, ENT_QUOTES); ?></font></div>
                <label for="userid">ユーザーID</label><input type="text" id="userid" name="userid" placeholder="ユーザーIDを入力" value="<?php if (!empty($_POST["userid"])) {echo htmlspecialchars($_POST["userid"], ENT_QUOTES);} ?>">
                <br>
                <label for="password">パスワード</label><input type="password" id="password" name="password" value="" placeholder="パスワードを入力">
                <br>
                <input type="submit" id="login" name="login" value="ログイン">
            </fieldset>
        </form>
       
    </body>
</html>