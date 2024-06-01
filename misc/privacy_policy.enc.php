<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/addons/function.inc.php'); // all functions
require_once(file_location('inc_path','session_check_nologout.inc.php'));
$data = "privacy policy";
$follow_type = 'follow';
$image_link = file_location('media_url','home/logo.png');
$image_type = substr($image_link,-3);
$page = strtoupper($data)." | ".strtoupper(get_xml_data('company_name'));
$page_name = $page." | ".get_xml_data('seo_tag');
$page_url = file_location('home_url','misc/privacy_policy/');
$keywords = get_json_data('keywords','about_us')."|".$page_name;
$description = $page_name;
insert_page_visit('privacy policy');
?>
<!DOCTYPE html>
<html>
<head><?php require_once(file_location('inc_path','meta.inc.php'));?><title><?=$page_name?></title></head>
<body id="body"class="j-color6"style="font-family:Roboto,sans-serif;">
	<?php require_once(file_location('inc_path','page_load.inc.php')); //page load?>
	<?php require_once(file_location('inc_path','navigation.inc.php'));//navigation?>
	<div class='j-center j-misc-padding'style="margin-top:20px;">
		<div class='j-xxlarge j-text-color1 j-bolder'><?=ucwords(get_xml_data('company_name'))?></div>
		<div class='j-xlarge j-text-color3 j-bolder'><?=ucwords($data)?></div>
	</div>
	<div class='j-misc-padding'>
			<div class='j-color j-padding'>
				
				 <div>
					<h4 title="Infomation about Jobsblog333 privacy policy"><b> 1. Information About Jobsblog333 Privacy Policy</b></h4>
					<p class="" style="padding-left: 30px">
						Here at Jobsblog333, we are committed to protecting and respecting your privacy at all times.
						If you have any queries, please contact us through the links we’ve provided at the footer. We
						may ask you to provide certain information such as name or email. Be assured that this information
						will be used with respect to this privacy statement. Be informed that we may update this privacy
						policy at any point in time, so you are expected to check this page once in a while to ensure
						that you are content with any changes that may occur.
					</p>
					<h4 title="What Information Do We Collect?"><b>2. What Information Do We Collect? </b></h4>
					<p class="" style="padding-left: 30px">
						The information we may collect includes the following:<br>
						<div style="padding-left: 50px">
							•	Names<br>
							•	Email addresses<br>
							•	Comments<br>
							•	Phonenumber<br>
							•	And some other informations
						</div>
					</p>
					<h4 title="What is the Information Used for?"><b> 3. What is the Information Used for?</b></h4>
					<p class="" style="padding-left: 30px">
						Most of the information requested from you are used to improve our services and enhance it quality
						. Information such as comment are publicized on our websites to let other users see your viewpoint.
						So you are responsible for any comment you publish.
					</p>
					<h4 title="Do We use cookies?"><b>4. Do We use cookies? </b></h4>
					<p class="" style="padding-left: 30px">
						Yes, we do. We use cookies to track activities on our website.
					</p>
					<h4 title='Controlling Your Personal Information'><b>5. Controlling Your Personal Information</b></h4>
					<p class="" style="padding-left: 30px">
						At Jobsblog333, any sensitive information such as email or any other information requested from
						you which are not publicized are safe with us, we have put in place suitable procedures that
						ensure the safety of your sensitive information.
					</p>
					<h4 title='Blog Comments Policy'><b>6. Blog Comments Policy</b></h4>
					<p class="" style="padding-left: 30px">
						We reserve the right to edit or delete any comments submitted to this blog without notice due to
						the following reasons;<br>
						<div style="padding-left: 50px">
							•	The comment is seen as spam or questionable spam.<br>
							•	The comment is profane.<br>
							•	The comment breeches any applicable local, national, or international law or regulation<br>
							•	The comment contains language or concepts that seem offensive.<br>
							•	The comment attacks another person personality.<br>
							•	The comment is unlawful or fraudulent.<br>
							•	The comment transmits, or procures the sending of, any unsolicited or unauthorized advertising
							or promotional contents or any other form of similar solicitation.<br>
							•	The comment knowingly transmits any data, send or upload any content that contains viruses,
							Trojan horses, worms, time-bombs, keystroke loggers, spywares, adware, or any other harmful
							programs or computer codes designed to adversely affect the operation of any computer software
							or hardware. <br>
							•	The comment inhibits users from using and enjoying our site.<br>
							•	The comment is threatening, abusive, offensive, vulgar, defamation, indecent, improper,
							profane, sexually explicit, racial.<br>
							•	The comment promotes violence.<br>
							•	The comment promotes discrimination based on race, sex, religion, national, disability, age
							or sexual orientation.<br>
							•	The comment violates the copyright, trademarks and rights of privacy Jobsblog333.com.<br>
							•	The comment contains any information, software or other contents of any commercial form.<br>
							•	The comment contains advertising, promotions or commercial solicitations of any kind.<br>
							•	The comment will likely harass, upset, embarrass, annoy any other person.<br>
							•	The comment contains false or misleading statements of fact.<br>
							•	The comment impersonates any person.<br>
							•	The comment contains content irrelevant to the subject matter of the message feature.
						</div>
					</p>
				 </div>
			</div>
	</div>
	<br>
	<div><?php require_once(file_location('inc_path','footer.inc.php')); //footer?></div>
	<span id='st'></span>
	<?php require_once(file_location('inc_path','js.inc.php')); //js?>
</body>
</html>