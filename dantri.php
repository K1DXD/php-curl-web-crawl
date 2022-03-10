<?php
// Tạo mới một CURL
$ch = curl_init();
$url = 'https://dantri.com.vn/the-gioi/benh-vien-nhi-ukraine-tan-hoang-vi-hung-mua-hoa-luc-20220310110941712.htm';
// Cấu hình cho CURL
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
// Thực thi CURL
$demo = curl_exec($ch);
// Ngắt CURL, giải phóng
curl_close($ch);
$doc = new DOMDocument();
$doc->loadHTML($demo);
$demo = $doc->getElementsByTagName('p');
$content;
$title;
$date;
foreach($demo as $data){
	if($data->parentNode->nodeName == 'div'){
		$content .= $data->nodeValue;
		$content .= '<br>';
	}
}
$demo1 = $doc->getElementsByTagName('h1');
$demo2 = $doc->getElementsByTagName('time');
$date = $demo2[0]->nodeValue;
$title = $demo1[0]->nodeValue;
echo $content;
echo $title;
echo '<br>';
echo $date;