<?php
ini_set('display_errors',1);            //错误信息
ini_set('display_startup_errors',1);    //php启动错误信息
error_reporting(-1);                    //打印出所有的 错误信息
ini_set('error_log', dirname(__FILE__).'/error_log.txt'); //将出错信息输出到一个文本文件

require('global.php');

  $LVS = array(
    'tha'=>array("Idx"=>1, 
    	"Title"=>'&#1514;&#1493;&#1512;&#1492; &#1504;&#1489;&#1497;&#1488;&#1497;&#1501; &#1499;&#1514;&#1493;&#1489;&#1497;&#1501;', 
    	"Liber"=>'Biblia Hebraica', 
    	"Edition"=>'tha', "OT"=>0, "Chaps"=>39), 
    'nth'=>array("Idx"=>2, 
    	"Title"=>'&#1489;&#1512;&#1497;&#1514; &#1495;&#1491;&#1513;&#1492; &#1506;&#1500; &#1508;&#1497; &#1502;&#1513;&#1497;&#1495;', 
    	"Liber"=>'Novum Testamentum Hebraica', 
    	"Edition"=>'nth', "OT"=>47, "Chaps"=>73), 
    'lxx'=>array("Idx"=>3, 
    	"Title"=>'&#7977; &#924;&#949;&#964;&#940;&#966;&#961;&#945;&#963;&#953;&#962; &#964;&#8182;&#957; &#7961;&#946;&#948;&#959;&#956;&#942;&#954;&#959;&#957;&#964;&#945;', 
    	"Liber"=>'Vetus Testamentum gr&aelig;ce iuxta LXX interpretes (Septuaginta Interpretum Versio)', 
    	"Edition"=>'lxx', "OT"=>0, "Chaps"=>60), 
    'ntg'=>array("Idx"=>4, 
    	"Title"=>'&#7977; &#922;&#945;&#953;&#957;&#8052; &#916;&#953;&#945;&#952;&#942;&#954;&#951;', 
    	"Liber"=>'Novum Testamentum gr&aelig;ce', 
    	"Edition"=>'ntg', "OT"=>0, "Chaps"=>27),
    'vul'=>array("Idx"=>5, "Title"=>'Biblia Sacra', "Liber"=>'Vulgata Sixtina - Clementina', "Edition"=>'vul', "OT"=>0, "Chaps"=>73), 
    'nov'=>array("Idx"=>6, "Title"=>'Nova Vulgata', "Liber"=>'Bibliorum Sacrorum Editio (1978)', "Edition"=>'nov', "OT"=>0, "Chaps"=>73), 
    'csb'=>array("Idx"=>7, "Title"=>'&#24605;&#39640;&#22307;&#32463;', "Liber"=>'Studium Biblicum ', "Edition"=>'csb', "OT"=>0, "Chaps"=>73), 
    'nab'=>array("Idx"=>8, "Title"=>'New American Bible', "Liber"=>'New American Bible', "Edition"=>'nab', "OT"=>0, "Chaps"=>73), 
    'jb'=>array("Idx"=>9, "Title"=>'La Bible de J&eacute;rusalem', "Liber"=>'La Bible de J&eacute;rusalem', "Edition"=>'jb', "OT"=>0, "Chaps"=>73));


	//$liber = 'gen';
$caput = isset($_GET['c']) ? $_GET['c'] : 1;

$links = isset($_GET['liber']) ? $_GET['liber'] : '';
list($liber, $chap, $edition) = explode(",", $links.',,,');

if (isset($links)){
	list($liber, $chap, $edition) = explode(",", $links.',,,');

}

$caput 		= $chap;
$liberId 	= 0;
$editionId 	= 0;
$book		=  '';
$subtitle	=  '';

if ($edition!= ''){
	$editionId 	=  $LVS[strtolower($edition)]["Idx"];
  	$book 		=  $LVS[strtolower($edition)]["Title"];
  	$subtitle 	=  $LVS[strtolower($edition)]["Liber"];
  	$subtitle 	=  str_ireplace("|", "<br>",$subtitle);
}

require('toc.php');

?>
<!DOCTYPE html>
<html id="myhtml" xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>C.S.V.D - <?php echo $csvd[$language]; ?></title>
	<meta content="text/html; charset=utf-8" http-equiv="Content-Type"/>
	<meta content="always" name="referrer">
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  	<meta http-equiv="C.S.V.D" content="Centrum Studium Verbum Domini">
  	<meta name=AUTHOR content="Centrum Studium Verbum Domini">
  	<meta name=SECTION content="Biblia Sacra">
  	<meta name=KEYWORDS content="csvd centrum studium verbum domini, divine word study centre, centre d'édes verbum domini, 圣言研读中心, catholic, missionary, ecclesia dei, holy bible, biblia, biblia sacra">
  	<link rel="shortcut icon" type="image/vnd.microsoft.icon" href="http://www.csvd.org/favicon.ico">
	<!-- CSS File -->
	<link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
	<link href="css/bootstrap-theme.min.css" rel="stylesheet" id="bs-theme-stylesheet">
	<link href="css/glyphicon.css" rel="stylesheet" media="screen">
	<script src="js/jquery-2.1.4.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<!-- Custom styles CSS -->
	<link href="css/biblia.css" rel="stylesheet" type="text/css">

	<script type="text/javascript">
		$(document).ready(function(){
			
			$("#find").click(function(){
        		var v = $("#q").val();
				var m = $("#mqs").val();
				var c = v.length;
				if (c>1) {
					location='<?php echo $book_url;?>&q='+v;
				}
			});
       	});

 	function getQueryString(name) {
		var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)", "i");
		var url = window.location.search.substr(1);
		var r = url.match(reg);
		if (r != null) 
			return unescape(r[2]); 
		return null;
	}
	</script>
</head>

<body class="lang_<?php echo $edition; ?>">
<!-- Navigation start -->
<nav class="header">
	<div class="header">
    	<div class="navbar-head">
      		<a class="navbar-brand" href="">
        	<img src="css/csvd-logo.png" height="50" title="Centrum Studium Verbum Domini">
        	<span class="subtitle"><?php echo $csvd[$language]; ?></span>
     		</a>
    	</div>
    	<div class="nav navbar-right">
	      	<div class="dropdown" id="language-menu"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $menu_item['lang'][$language];?><span class="caret"></span></a></p>
	      		<ul class="dropdown-menu">
					<li><a href="<?php echo $book_url; ?>pl=lt" class="lx"><?php echo $menu_item['language']['lt'];?></a></li>
					<li><a href="<?php echo $book_url; ?>pl=zh"><font class="zh"><?php echo $menu_item['language']['zh'];?></font></a></li>
					<li><a href="<?php echo $book_url; ?>pl=en"><?php echo $menu_item['language']['en'];?></a></li>
					<li><a href="<?php echo $book_url; ?>pl=fr"><?php echo $menu_item['language']['fr'];?></a></li>
				</ul>
			</div>

		</div>
	</div>
</nav>
<!-- Navigation end -->

<!-- Begin #content -->
<a name="top"></a>
<div class="container container-xs-8 container-md-8 container-sm-4">
	<div class="form-group col-xs-12 col-md-3 col-md-offset-3" id="quickIdx">
<?php 
	if ($edition != ''){
	echo '
	<select class="form-control select" id="select" name="select" 
		onchange="location=\'?liber=\'+this.options[this.selectedIndex].value;">
		<option title=" '.$LVS[strtolower($edition)]['Title'].' " value="toc,,'.$edition.'" selected>'. 
		$LVS[strtolower($edition)]['Title'] .'</option>';

		foreach($CHAPTERS as $idx){
			//$idx = $TOC[$b];
			$sel = "";
			$b = strtolower($TOCS[$idx]);
			if (strtolower($liber) == strtolower($LIBER[$b][0])) {
				$sel = " selected";
				$liberId = $idx;
			}
			
			if (isset($TOCS[$idx])!=null ){
				$cap = '';
				if ($b == 'prolog' || $b == 'caput') $cap = $LIBER[$b][1];
				else{
					echo '<option title=" '.$LIBER[$b][2].' " value="'.$LIBER[$b][0].','.$cap.','.$edition.'"'.$sel.'>'
					.$LIBER[$b][2].'</option>';
				}
			}
		}

	echo '</select>';

	}

?>
	</div>
	<div class="form-group col-xs-2 col-md-2 col-sm-2">
		<input id="url" name="url" value="search" type="hidden">
		<select name="tm" class="form-control">
			<option value="0"><?php echo $menu_item['all'][$language];?></option>
			<option value="1"><?php echo $menu_item['vt'][$language];?></option>
			<option value="2"><?php echo $menu_item['nt'][$language];?></option>
		</select>
	</div>
	<div id="form-group col-xs-4 col-md-3 col-sm-3 ">
		<div class="input-group">
			<input class="form-control" id="q" name="q" type="text" value="<?php echo $query; ?>" placeholder="<?php echo $menu_item['search'][$language];?>">
			<div id="find" type="button" title=" Search... " class="btn btn-warning input-group-addon"><span class="glyphicon glyphicon-search"></span></div>
		</div>
	</div>
</div>

<section id="paper" class="container">
	<!-- Begin #main -->
	<div class="col-xs-12 col-sm-12 col-md-9 col-lg-9" id="biblia">
		<main id="liber" role="main">
			<div id="content" style="border: 0px solid #eee;">
<?php

if ($liber == '' || strtolower($liber) == 'toc'|| $edition == ''){
	echo '<div id="toc">';
	$toc_file = 'toc/toc-'.$edition.'.html';
	if(!file_exists($toc_file))
	{
	    $toc_file = 'csvd-intro.html';
	}

	require($toc_file);
	echo '</div>';

}elseif ($query != ''){
	$max = 25;
	$count = $textdb->find_word_row($edition, null, 0, $query);
	$pages = ceil($count/$max);

	$texts = $textdb->find_word($edition, null, 0, $query, $page, $max);
	//echo 'QUERY: '.sizeof($texts);

	if ($texts){
		echo '<div class="text_'.$edition.'">';
		foreach ($texts as $text) {
			if ($text['cs_cate'] == 2){
				echo '<h2 class="text-center lang_'. $edition .'">'.$text['cs_texte'].'</h2>';
			}elseif ($text['cs_cate'] == 3){
				echo '<h3 class="text-center lang_'. $edition .'">'.$text['cs_texte'].'</h3>';
			}elseif ($text['cs_cate'] == 4){
				echo '<h4 class="ltext-center ang_'. $edition .'">'.$text['cs_texte'].'</h4>';
			}elseif ($text['cs_cate'] == 5){
				echo '<h5 class="text-center lang_'. $edition .'">'.$text['cs_texte'].'</h5>';
			}elseif ($text['cs_cate'] == 6){

			}else{
				echo '<p>';
				$c_liber ='';
				if ($query != '') $c_liber = ucfirst($text['cs_liber']).' ';

				if ($text['cs_caput'] > 0 ){
					//

					echo '<sup><a href="?liber='.ucfirst($text['cs_liber']).','.$text['cs_caput'].','.$text['cs_edition'].','.'#'.$text['cs_verse'].'">'.ucfirst($text['cs_liber']).' '.$text['cs_caput'] .':'.$text['cs_verse'] .'</a></sup> ';
				}	

				$tm = str_ireplace('/', '<br />', $text['cs_texte']);
				$tm = str_ireplace($query, '<font color="red">'.$query."</font>", $tm);
				echo str_ireplace('\\', '<br />', $tm) .'</p>';
			}
		}
		echo '</div>';
		echo '<div id="links">';

			if ($pages <= 10){
				for ($c = 1; $c <= $pages; $c++ ){
					echo '<span><a href="?liber='.$url.'&q='.$query.'&p='.$c.'">'.$c.'</a> ';
				}

			}else{
				$sp = 1;
				$sn = $pages;

				if ($page > 5) $sp = $page-5;
				if ($page < $pages-5) $sn = $page+5;

				for ($c = $sp; $c <= $sn; $c++ ){
					if ($page == $c){
						echo '<span><b>' .$c .'</b></span> ';
					}else{
						echo '<span><a href="?liber='.$url.'&q='.$query.'&p='.$c.'">'.$c.'</a> ';
					}
					
				}
				echo '...<span><a href="?liber='.$url.'&q='.$query.'&p='.$pages.'">'.$pages.'</a> ';
			}
			
		echo '</div>';
	}

}else{

	//Chatper List
	$title = '';
	$chaps = 0;

	if (isset($LIBER[strtolower($liber)])!=''){

		$title = $LIBER[strtolower($liber)][2];
		$chaps = $LIBER[strtolower($liber)][3];

		$lb = strtolower($liber);
		echo '<h1 class="lang_'.$edition.'"><a href="?liber=toc,,'.$edition.'">'.$LVS[$edition]['Title'].'</a></h1>';
		echo '<h2 class="lang_'.$edition.'">'.$title.'</h2>';
		echo '<div id="caput">';

		//CHAPTERS INDEX
		if (strtolower($liber) != 'prolog'){
			if ($chap == ''){
				echo '	<p class="intro"><font class="read">'.$menu_item['intro'][$language].'</font></p>';
			}else{

				echo '	<p class="intro"><a href="?liber='.$liber.',,'.$edition.'" class="cp'.$language.'">'.$menu_item['intro'][$language].'</a></p>';
			}
			echo '	<p id="caputIdx">';

			for ($c = 1; $c <= $chaps; $c++){
				if ($chap == $c){
					echo '<font class="read">'.$c.'</font>';
				}else{
					echo '<a href="?liber='.$liber.','.$c.','.$edition.'">'.$c.'</a>';				
				}
			}
			echo '</p>';
		}
		echo '</div>';
		
		//CONTENT TEXT
		require('reader.php');
	}
}

?>			</div>
		</main>
	</div>
	<!-- End #main -->
	<!-- Begin #sidebar -->
	<div class="widget-area col-xs-12 col-sm-12 col-md-3 col-lg-3" id="sidebar" role="complementary">
		<div class="panel panel-default libers">
			<div id="quaere-bot"></div>
				<h4 class="cats" unselectable="on">Bibliotheca</h4>
				<ul id="libers" class="text-left">
	<?php
		//Book list. (Slide Right)

		if ($liber == '') $liber = 'toc';
		$b = 1;
		//for ($b = 1; $b <= sizeof($LVS); $b++)
		foreach ($LVS as $bible) {
			
			if ($bible["Edition"] == $edition) {
				echo '<li class="current">';
			}else{
				echo '<li>';
			}
			//echo '<a href="?liber='.$liber.','.$chap.','.$LVS[$b]["Biblia"].'" title="'.$LVS[$b]["Liber"].'"><font class="m'.$b.'">' .$LVS[$b]["Title"].'</font></a></li>';
			echo '<a href="?liber='.$liber.','.$chap.','.$bible["Edition"].'" title="'.$bible["Liber"].'"><font class="m'.$b.'">' .$bible["Title"].'</font></a></li>';
		}
	?>
				</ul>			
				<div id="adbox">
					<p class="cats" unselectable="on">Donationes</p>
					<p><b>Support and Participation!</b></p>
					<p>Your contributions are necessary to promote our mission and projects such as C.S.V.D. </p>
				</div>
			</div>
		</div><!-- End .panel -->
	</section>
</div>

	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-23289894-2"></script>
	<script>
	  window.dataLayer = window.dataLayer || [];
	  function gtag(){dataLayer.push(arguments);}
	  gtag('js', new Date());

	  gtag('config', 'UA-23289894-2');
	</script>
	<!-- Begin #footer -->
	<footer id="footer" class="footer navbar-fixed-bottom" unselectable="on">
		<div id="footer_content" class="row text-left" unselectable="on">
			<font class="col-xs-12 col-sm-12 col-md-6">&copy; 2008-<?php echo date("Y")  ?>
			  <a href="http://www.csvd.org"><strong>Centrum Studium Verbum Domini</strong></a>
			<br />
			  <!--script language="javascript" src="http://61.135.129.87/front/v_count/countshow.jsp?Count_Login_Id=FDDE0E848CC1CB9F178685A05FBECB17"></script-->
			  <!--Tech-Support: <font color="#ffa500">SELENE</font> <font color="#0099EE">A.I LAB</font> ( 2000 - 2017 )-->
			  <abbr title="E-mail">E:</abbr> <a href="mailto:editor@csvd.org">editor@csvd.org</a>
			  | Update : <!--07 June 2009--> 20 Oct 2017<p></p>
			</font>
		</div>
	</footer>
</body>
</html>
