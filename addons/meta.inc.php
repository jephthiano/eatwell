<?php $website_type = "Ecommerce";?>
<meta charset="UTF-8"><meta name="viewport"content="width=device-width, initial-scale=1.0"><?=$follow_type==='no follow'?"<meta name='robots'content='noindex, nofollow, noachieve'>":"<meta name='robots'content='index, follow, achieve'>";?><meta http-equiv="Content-Type"content="text/html; charset=UTF-8"><meta http-equiv="X-UA-Compatible"content="IE=edge,chrome=1"><meta http-equiv="content-language"content="en">
<?php if($follow_type !== 'no follow'){?>
<meta name="author"content="<?=get_xml_data('company_name')?>"><meta name="appication-name"content="<?=get_xml_data('company_name')?>"><meta name="keyword"content="<?=$page_name?>"><meta name="keywords"content="<?=$keywords?>"><meta name="description"content="<?=$description?>"><meta itemprop="name"content="<?=$description?>">
<meta name="twitter:site"content="<?=$page_name?>"><meta name="twitter:card"content="summary_large_image"><meta name="twitter:image"content="<?=$image_link?>"><meta name="twitter:image:alt"content="<?=$page_name?> Image"><meta name="twitter:description"content="<?=$description?>">
<meta property="article:section"content="<?=$website_type?>"><meta property="article:published_time"content=""><meta property="fb:profile_id"content=""><link rel="canonical" href="<?=$page_url?>">
<meta property="og:type"content="<?=$website_type?>"><meta property="og:section"content="<?=$website_type?>"><meta property="og:locale"content="en_US"><meta property="og:title"content="<?=$page_name?>"><meta property="og:description"content="<?=$website_type?>"><meta property="og:url"content="<?=$page_url?>"><meta property="og:site_name"content="<?=$image_link?>"><meta property="og:image"content="<?=$image_link?>"><meta property="og:image:secure_url"content="<?=$page_url?>"><meta property="og:image:width"content="1200"><meta property="og:image:height"content="550"><meta property="og:image:alt"content="<?=$page_name?> Image"><meta property="og:title"content="<?=$description?>">
<?php
$keyword_array = explode('|',$keywords);
if(count($keyword_array) > 0){foreach($keyword_array AS $index => $keyword){?><meta property="article:tag"content="<?=$keyword?>"><meta name="news_keywords"content="<?=$keyword?>"><?php }}
}
?>
<link rel='icon'href="<?=$image_link?>"type="image/<?=$image_type?>">
<link rel="stylesheet"href="https://fonts.googleapis.com/css?family=Roboto">
<link rel="stylesheet"href="https://fonts.googleapis.com/css?family=Sofia">
<link rel="stylesheet"href="https://fonts.googleapis.com/css?family=Kurale">
<script src="<?=file_location('home_url','plugins/jQueryP3.4.1.js');?>"></script>
<link rel="stylesheet"href="<?=file_location('home_url','plugins/color.css');?>">
<link rel="stylesheet"href="<?=file_location('home_url','plugins/j.css');?>">
<?php
global $local_url,$link_type;
if(strstr($local_url,'000webhostapp') || $link_type === 'internal_link'){
  $plugin = 'home_url';
}else{
    if(strstr($local_url,'admin')){
        $plugin = 'admin_url';
    }elseif(strstr($local_url,'seller')){
        $plugin = 'seller_url';
    }else{
        $plugin = 'home_url';
    }
}
?>
<link rel="stylesheet"href="<?= file_location($plugin,'plugins/fontawesome/css/all.min.css');?>">
<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
<style>
    .j-color1,.j-hover-color1:hover{color:white!important;background-color:<?=get_json_data('primary_color','color')?>!important}
    .j-text-color1,.j-hover-text-color1:hover{color:<?=get_json_data('primary_color','color')?>!important}
    .j-border-color1,.j-hover-border-color1:hover{border-color:<?=get_json_data('primary_color','color')?>!important}
    .j-color2,.j-hover-color2:hover{color:#fff!important;background-color:<?=get_json_data('secondary_color','color')?>!important}
    .j-text-color2,.j-hover-text-color2:hover{color:<?=get_json_data('secondary_color','color')?>!important}
    .j-border-color2,.j-hover-border-color2:hover{border-color:<?=get_json_data('secondary_color','color')?>!important}
</style>