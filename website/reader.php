<?php

/*
 * C.S.V.D TextDate Reader Module
 * Version 2.1
 * Update August 5, 2019
 * Author by Joseph Meng (monet@a-oct.com)
 * 
 */
 
$word = '';

$texts = $textdb->read_text($edition, strtolower($liber), $caput);

if ($texts){
	echo '<div class="text_'.$edition.'">';
	foreach ($texts as $text) {
			//echo $text['cs_links'] .'<p>';
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
			if ($word != '') $c_liber = ucfirst($text['cs_liber']).' '; 
			if ($text['cs_caput'] > 0 ) echo '<a name="'.$text['cs_verse'] .'"></a><sup> '.$c_liber.$text['cs_caput'] .':'.$text['cs_verse'] .'</sup> ';
			$tm = str_ireplace('/', '<br />', $text['cs_texte']);
			echo str_ireplace('\\', '<br />', $tm) .'</p>';
		}
			
	}
	echo '</div>';
}
	//<!--Book page nav-->
	echo '<div id="links">';
	$nextLiberId = $liberId +1;

	$chapId = $chap;
	if ($chap == '' || $chap == 0) $chapId = 0;
	$currentChaps = $LIBER[strtolower($liber)][3];

	if ($liberId > 1){
		$prevLiber = $TOCS[$liberId - 1];
		echo '<font class="board"><a href="?liber='.$prevLiber .',,'.$edition.'">'.$LIBER[strtolower($prevLiber)][1] .'</a></font>';
	}

	if ($currentChaps > 1 && $chapId > 1){
		$prevChapId = $chapId -1;
		echo '<font class="board"><a href="?liber='.$liber.','.($chapId -1).','.$edition.'">'.$page_item['prev'][$language].'</a></font>';
	}else{
		echo '<font class="board disable">'.$page_item['prev'][$language].'</font>';
	}

	echo '<font class="board"><a href="#top">'.$page_item['top'][$language].'</a></font>';
		
	if ($chapId < $LIBER[strtolower($liber)][3]) {
		$nextChapId = $chapId +1;
		echo '<font class="board"><a href="?liber='.$liber.','.($chapId +1).','.$edition.'">'.$page_item['next'][$language].'</a></font>';
	}else{
		echo '<font class="board disable">'.$page_item['next'][$language].'</font>';
	}
		
	if ($liberId < $LVS[strtolower($edition)]['Chaps'] )
	{
		//$nextLiber = $LIBER[strtolower($nextLiber)][0];
		$nextLiber = $TOCS[$liberId + 1];
		echo '<font class="board"><a href="?liber='.$nextLiber.',,'.$edition.'">'.$LIBER[strtolower($nextLiber)][1] .'</a></font>';			
	}
	echo '</div>';


