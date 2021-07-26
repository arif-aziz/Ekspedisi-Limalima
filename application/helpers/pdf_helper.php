<?php

function header_pdf($jenis = ''){
	$CI = & get_instance();
	$CI->cezpdf->selectFont(base_url() . 'include/fonts');	
	$all = $CI->cezpdf->openObject();
	$image = imagecreatefrompng(base_url()."img/logo.png");
	$CI->cezpdf->saveState();
	$CI->cezpdf->setStrokeColor(0,0,0,1);//set color  black
	$CI->cezpdf->addImage($image,30,500,870,0,100);//(image, koordinat from left, koordinat from bottom, size panjang)
	$CI->cezpdf->ezSetMargins(50,50,50,50);//atas, bawah, kiri, kanan
	
		// $CI->cezpdf->line(30,550,820,550);//garis atas
		// $CI->cezpdf->line(30,550,30,40);//garis kiri
		// $CI->cezpdf->line(30,40,820,40);//garis bawah
		// $CI->cezpdf->line(820,550,820,40);//garis bawah
	
	$CI->cezpdf->restoreState();
	$CI->cezpdf->closeObject();
	$CI->cezpdf->addObject($all,'add');
}

function footer_pdf($jenis = ''){
	$CI = & get_instance();
	$CI->cezpdf->selectFont(base_url() . 'include/fonts');	
	$all = $CI->cezpdf->openObject();
	$image = imagecreatefrompng(base_url()."img/logo2.png");
	$CI->cezpdf->saveState();
	
	$CI->cezpdf->addImage($image,30,10,920);//(image, koordinat from left, koordinat from bottom, size panjang)
	$CI->cezpdf->ezSetMargins(50,50,50,50);//atas, bawah, kiri, kanan
		// $CI->cezpdf->line(30,550,820,550);//garis atas
		// $CI->cezpdf->line(30,550,30,40);//garis kiri
		// $CI->cezpdf->line(30,40,820,40);//garis bawah
		// $CI->cezpdf->line(820,550,820,40);//garis bawah
	$CI->cezpdf->restoreState();
	$CI->cezpdf->closeObject();
	$CI->cezpdf->addObject($all,'add');
}


function page_number(){
	$CI = & get_instance();
	$CI->cezpdf->ezStartPageNumbers(975,28,8,'','{PAGENUM}',1);
	$CI->cezpdf->ezSetMargins(50,50,50,50);
}

?>