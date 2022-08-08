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
 
//クエリ失敗
if(!$result) {
	echo $mysqli->error;
	exit();
}
    
    //連想配列で取得
while($row = $result->fetch_array(MYSQLI_ASSOC)){
	$rows[] = $row;
}
 
//結果セットを解放
$result->free();
 
// データベース切断
$mysqli->close();

       
?>
<header>
<nav>
<ul>
<li class=”current”><a href='index.php'>Home</a></li>
<li><a  href='input.php'>住所の追加</a></li>
<li><a href='Login.php'>ログアウト</a></li>
<li><a href='SignUp.php'>アカウント追加</a></li>
</ul>
</nav>
</header>
      
<table border='1'>
	<?php
	$dsn = 'mysql:host=sawai.naviiiva.work;dbname=sawai;charset=utf8mb4';
    $user = 'naviiiva_user';
    $password = '!Samurai1234';
    if (empty($_SERVER["HTTP_REFERER"])) {
  //リダイレクト
  header('Location:Login.php');
}
    
	if ($_POST) {
        try {
            $dbh = new PDO($dsn, $user, $password);
            $search_word = $_POST['word'];
            $search_kensaku = $_POST['kensaku'];
            if($search_word=="" and $search_kensaku==""){
              echo "お名前または住所をご入力ください";
            }
            else{
                $sql ="select * from mydb where name like '".$search_word."%' and addres like '".$search_kensaku."%'" ;
                $sth = $dbh->prepare($sql);
                $sth->execute();
                $result = $sth->fetchAll();
                if($result){
                    foreach ($result as $row) {
                        echo $row['name']."  ";
                        echo $row['gmail']."  ";
                        echo $row['postnamber']."  ";
                        echo $row['addres']."  ";
                        echo $row['phoen']."  ";
                        echo $row['tell']."  ";
                        
                        echo "<br />";
                    }
                }
                else{
                    echo "見つかりませんでした";
                }
            }
            
            
            
        }catch (PDOException $e) {
            echo  "<p>Failed : " . $e->getMessage()."</p>";
            exit();
        }
    }
    ?>
	
	<div>Search user name</div>
    <form action="" method="POST">
        <label>名前：</label>
        <input type="text" name="word" /><br>
        <label>住所：</label>
        <input type="text" name="kensaku" />　<br>
        <input type="submit" value="Search" />
    </form>
	
<tr><td>お名前</td><td>住所番号</td><td>住所</td><td>メールアドレス</td><td>携帯電話番号</td><td>自宅電話番号</td><td>変更</td><td>削除</td></tr>
 
<?php 
foreach($rows as $row){
 ?>
 
<tr> 
	<td><?=htmlspecialchars($row['name'], ENT_QUOTES, 'UTF-8')?></td>
	<td><?=$row['postnamber']?></td>
	<td><?=htmlspecialchars($row['addres'], ENT_QUOTES, 'UTF-8')?></td>
	<td><?=htmlspecialchars($row['gmail'], ENT_QUOTES, 'UTF-8')?></td>
	<td><?=$row['phoen']?></td>
	<td><?=$row['tell']?></td>
	<td>
	<form action="fix.php" method="post">
		<input type="submit" name="update" value="変更する">
		<input type="hidden" name="id" value="<?=$row['id']?>">
		</form>
	</td>
	<td>
      <form action="delete.php" method="post">
        <input type="submit" name="delete" onclick='return confirm("よろしいですか？")' f value="削　除">
        <input type="hidden" name="id" value="<?php echo $row["id"]; ?>" />
      </form>
	</td>
</tr>
 
 <?php 
 } 
 ?>
 
</table>

</body>
</html>