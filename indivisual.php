<?php
	session_name("j160219s");
	session_start();
?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>MatatabiHouse（情報工学実験）</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="css/slide.css">
<script type="text/javascript" src="js/openclose.js"></script>

</head>
<body>
<div id="container">
<header>
<h1 id="logo"><a href="index.php">MatatabiHouse</a></h1>
</header>
<!--小さな端末用（480px以下端末）メニュー-->
<nav id="menubar-s">
<ul>
<li><a href="index.php">Home</a></li>
<li><a href="list.php">Cast</a></li>
<li><a href = "ranking.php">Ranking</a></li>
<li><a href="login.php">Login</a></li>
</ul>
</nav>
<aside id="mainimg">
<img src="images/1.jpg" alt="" id="slide1">
<img src="images/2.jpg" alt="" id="slide2">
<img src="images/3.jpg" alt="" id="slide3">
<img src="images/kazari.png" alt="" id="kazari">
<!--大きな端末用（481px以上端末）メニュー-->
<nav id="menubar">
<ul>
<li><a href="index.php">Home</a></li>
<li><a href="list.php">Cast</a></li>
<li><a href="ranking.php">Ranking</a></li>
<li><a href="login.php">Login</a></li>
</ul>
</nav>
</aside>

<div id="contents">
<div id="main">
<section>
<?php
	if(!isset($_SESSION['login_name'])){
		print "<h2>MatatabiHouseへようこそ</h2>";
		print "MatatabiHouseはお好みの猫を指名して一緒に遊ぶことができるお店です。<br>";
		print "猫のご指名、ご予約は会員登録後に可能です。<br>";
	}else{
		print $_SESSION['login_name']. "  様の予約状況</h2>";
		$conn = pg_connect("host=localhost dbname=j160219s user=j160219s");
		$query_rsv  = "select * from reserved where u_id = $1";
		$u_id = $_SESSION['id'];
		$result_rsv = pg_prepare($conn, "rsvlist", $query_rsv);
		$result_rsv = pg_execute($conn, "rsvlist", array($u_id));
		if(pg_num_rows($result_rsv)==0){
			print "現在予約はしていません。<br>";
			print "ご希望の場合はキャスト一覧、指名ランキングページより、お好みの猫を選んでください。<br>";
		}
		else{
			$num = pg_num_rows($result_rsv);
			for($i = 0; $i < $num; $i++){
				$row = pg_fetch_assoc($result_rsv, $i);
				$date_rsv = $row['date_rsv'];
				$c_id = $row['c_id'];
				$query_c = "select * from cats where id = $1";
				$result_c = pg_prepare($conn, "src_c_{$i}", $query_c);
				$result_c = pg_execute($conn, "src_c_{$i}", array($c_id));
				$row_c = pg_fetch_assoc($result_c, 0);
				$c_name = $row_c['name'];
				print "日付：{$date_rsv}<br>";
				print "ご指名：{$c_name}ちゃん<br>";
print<<<EOS
				<form action="cancel.php" method="post">
				<input type="hidden" name="u_id" value="{$u_id}">
				<input type="hidden" name="c_id" value="{$c_id}">
				<input type="hidden" name="date_rsv" value="{$date_rsv}">
				<input type="submit" value="この予約を取り消す"><br>
				</form>
EOS;
			}
		}
	}
?>
<img src="images/sample.jpg" width="314" height="60" border="0" />
</section>
</div>
<!--/main-->

<div id="sub">
<nav class="box1">
<h2>MENU</h2>
<ul class="submenu">
<li><a href="list.php">キャスト一覧</a></li>
<li><a href="upload.php">キャスト採用</a></li>
<li><a href="ranking.php">指名ランキング</a></li>
</ul>
<h2>会員システム</h2>
<ul class="submenu2">
<?php
	if(!isset($_SESSION['login_name'])){
print<<<EOF
		<li><a href="regist.php">新規登録</a></li>
		<li><a href="login.php">ログイン</a></li>
EOF;
	}else{
print<<<EOF
		<li><a href="indivisual.php">予約状況</a></li>
		<li><a href="passwd.php">パスワード変更</a><li>
		<li><a href="logout.php">ログアウト</a></li>
EOF;
	}
?>
</ul>
</nav>
</div>
<!--/sub-->
</div>
<!--/contents-->
<p id="pagetop"><a href="#">↑</a></p>
</div>
<!--/container-->
<footer>
<small>Copyright&copy; <a href="index.html">SAMPLE CLUB</a> All Rights Reserved.</small>
<span class="pr"><a href="http://template-party.com/" target="_blank">《Web Design:Template-Party</a>＆<a href="http://girl-staff.com/">Girl-Staff》</a></span>
</footer>
</body>
</html>
