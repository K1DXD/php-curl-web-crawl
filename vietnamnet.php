<?php
// Tạo mới một CURL
$ch = curl_init();
$url = 'https://vietnamnet.vn/vn/kinh-doanh/thi-truong/nghe-don-mai-tang-gia-manh-cay-xang-lai-treo-bien-het-hang-821792.html';
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
	if($data->getAttribute('class') == 't-j'){
		$content .= $data->nodeValue;
		$content .= '<br>';
	}
}
$demo1 = $doc->getElementsByTagName('h1');
$title = $demo1[0]->nodeValue;
$demo2 = $doc->getElementsByTagName('span');
foreach($demo2 as $data){
	if($data->getAttribute('class') == 'ArticleDate'){
		$date .= $data->nodeValue;
	}
}
echo $content;
echo $title;
echo '<br>';
echo $date;