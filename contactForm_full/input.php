<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>カスタマー登録</title>
<link rel="stylesheet" href="style.css">
<script type="text/javascript" src="contact.js"></script>
</head>
<body>
<div><h1>アドレスブック</h1></div>
<div><h2>お客様情報入力画面</h2></div>
<div>
	<form action="confirm.php" method="post" name="form" onsubmit="return validate()">
		<h1 class="contact-title">　　　　　　　　　　お客様情報の入力</h1>
		<p>　　　お客様情報に誤りがないか確認の上、「確認画面へ」ボタンをクリックしてください。</p>
		<div>
                	<div>
				<label>お名前<span>必須</span></label>
				<input type="text" name="name" placeholder="例）山田太郎" value="">
			</div>
				<div>
				<label>住所番号<span>必須</span></label>
				<input type="text" name="postnamber" placeholder="例）0000000" value="">
			</div>
			<div>
				<label>住所<span>必須</span></label>
				<input type="text" name="addres" placeholder="例）〇〇県〇〇市〇〇町1−1−1　111号室" value="">
			</div>
			<div>
				<label>メールアドレス<span>必須</span></label>
				<input type="text" name="gmail" placeholder="例）guest@example.com" value="">
			</div>
			<div>
				<label>携帯電話番号<span>必須</span></label>
				<input type="text" name="phoen" placeholder="例）00000000000" value="">
			</div>
				<div>
				<label>自宅電話番号<span>必須</span></label>
				<input type="text" name="tell" placeholder="例）0000000000" value="">
			</div>
			
		</div>
		<button type="submit">確認画面へ</button>
	</form>
</div>
</body>
</html>