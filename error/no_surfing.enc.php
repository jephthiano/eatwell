<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/addons/function.inc.php');// all functions
$follow_type = 'no follow';
$image_link = file_location('media_url','home/logo.png');
$page = "SITE UNDER UPGRADE";
$page_name = $page." | ".strtoupper(get_xml_data('company_name'));
?>
<!DOCTYPE html>
<html>
<head><?php require_once(file_location('inc_path','meta.inc.php'));?><title><?=$page_name?></title></head>
<body id="body"class=""style="font-family: Roboto,sans-serif;width:100%;">
    <center>
        <div class="j-card-4 j-color6 j-round"style="width:96%;max-width:400px;height:auto;margin-top:50px">
            <div class="j-display-container">
                <div class="j-container">
                    <br><br>
                    <div style="width:150px;height: 150px;"class="j-border-color1 j-border j-circle j-display-container">
                        <span class="j-display-middle j-text-color1"><i class="<?=icon('times')?> j-xxlarge"></i></span>
                    </div>
                    <div>
                        <p class="j-text-color1 j-xlarge">Site Not Accessible at the Moment</p>
                        <p class="j-text-color1 j-large">The site is undergoing upgrade at the moment, please try again later</p>
                        <br><br>
                    </div>
                </div>
            </div>
		</div>
	</center>
    <?php require_once(file_location('inc_path','js.inc.php')); //js?>
</body>
</html>