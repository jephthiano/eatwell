<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/addons/function.inc.php'); // all functions
require_once(file_location('inc_path','session_check_nologout.inc.php'));
$data = "terms of service";
$follow_type = 'follow';
$image_link = file_location('media_url','home/logo.png');
$image_type = substr($image_link,-3);
$page = strtoupper($data)." | ".strtoupper(get_xml_data('company_name'));
$page_name = $page." | ".get_xml_data('seo_tag');
$page_url = file_location('home_url','misc/terms_of_service/');
$keywords = get_json_data('keywords','about_us')."|".$page_name;
$description = $page_name;
insert_page_visit('terms of service');
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
					<h4><b>1. Information About Jobsblog333</b></h4>
					<p class="" style="padding-left: 30px">
						1.1 Jobsblog333.com is a website and a division of JOBS ENTERPRISE, operated by the ENTERPRISE.<br>
						1.2 We are a company registered in Nigeria and under company number….. We have our office at …<br>
						1.3 Jobsblog333.com is a part of JOBS ENTERPRISE.<br>
					</p>
					<h4><b>2. Terms Of Website Use</b></h4>
					<p class="" style="padding-left: 30px">
						2.1 Whether as a guest or registered user. Please read the term of use in this page alongside the
						documents referred to in it before you start to use the site.<br>
						2.2 By using Jobsblog333.com, you indicate that you accept these terms of use, which include the privacy
						and policy that applies to the site and you agree to abide by the privacy and policy.<br>
						2.3 If you do not agree to the terms of use, please do not use the site.<br>
					</p>
					<h4><b>3. Jobsblog Property Rights</b></h4>
					<p class="" style="padding-left: 30px">
						3.1 We are the owner or the licensee of all intellectual property rights in our site, and the contents
						published on it. They are protected by Copyright laws.
						All rights are reserved to us and our licenses.
						As a guest to Jobsblog333.com, you may download a single copy of material for personal, non-commercial use and purpose only.
						No distribution or copying for business or commercial use is permitted without our prior consent(written).<br>
						3.2 You must acknowledge the existence of our status and any identified contributors as the author of information and contents on our site.<br>
						3.3 Jobsblog333.com is one of the trademarks of JOBS ENTERPRISES. All other trademarks used on our site
						are the property of their owners respectively<br>
					</p>
					<h4><b>4. Acceptable Use Of Service</b></h4>
					<p class="" style="padding-left: 30px">
						4.1 You may use Jobsblog333.com only for lawful purposes. You may not use the site:
						<div style="padding-left: 50px">
							• In any way that breeches any applicable local, national, or international law or regulation<br>
							• In any way that is unlawful or fraudulent.<br>
							• To send, knowingly receive, upload, download, use or re-use any content which does not comply with our content standard.<br>
							• To transmit, or procure the sending of, any unsolicited or unauthorized advertising or
							promotional contents or any other form of similar solicitation (spam).<br>
							• To knowingly transmit any data, send or upload any content that contains viruses, Trojan
							horses, worms, time-bombs, keystroke loggers, spywares, adware, or any other harmful programs or
							computer codes designed to adversely affect the operation of any computer software or hardware.<br>
						</div>
					</p>
					<p class="" style="padding-left: 30px">
						4.2 You also agree not to access without authority, interfere with, damage or disrupt:
						<div style="padding-left: 50px">
							•	Any part of our site;<br>
							•	Any equipment or network on which our site is stored;<br>
							•	Any software used in the provision of the site;<br>
							•	Any equipment or network owned or used by any third party;<br>
						</div>
					</p>
					<h4><b>5. Message Features And Content Use</b></h4>
					<p class="" style="padding-left: 30px">
						5.1 Whenever you use a feature which allow you to upload contents to Jobsblog333.cm or make contact with
						other users of the site, you must abide by this section.<br>
						5.2 We will provide clear and direct information to you on any kind of service offered anywhere we
						provide any message features.<br>
						5.3 The use of any of our message features by minor is subject to the consent of their parents or
						guardians. Jobsblog333.com advises parents who allow their children to use the message features that it
						is important that they communicate with their children regarding their safety and wellness online.
						Minors who use any message feature should be made aware of the potential risks that may occur to them.<br
						5.4 Note that anywhere we moderate a message feature, we will provide you a means of contacting the
						moderator incase a concern or difficulty arise.<br>
						5.5 You must use message feature in a responsible manner and you are totally and solely responsible for
						any content you transmit.<br>
					</p>
					<p class="" style="padding-left: 30px">
						5.6 You must not transmit any message in connection with any message features that:
						<div style="padding-left: 50px">
							•	Inhibit users from using and enjoying our site.<br>
							•	Is threatening, abusive, offensive, vulgar, defamation, indecent, improper, profane, sexually explicit, racial.<br>
							•	Promote violence.<br>
							•	Promote discrimination based on race, sex, religion, national, disability, age or sexual orientation.<br>
							•	Violates the copyright, trademarks and rights of privacy Jobsblog333.com.<br>
							•	Contain any information, software or other contents of any commercial form.<br>
							•	Contain advertising, promotions or commercial solicitations of any kind.<br>
							•	Will likely harass, upset, embarrass, annoy any other person.<br>
							•	Contain false or misleading statements of fact:<br>
							•	Impersonate any person.<br>
							•	Contain content irrelevant to the subject matter of the message feature.<br>
						</div>
					</p>
					<p class="" style="padding-left: 30px">
						5.7 We will determine, in our discretion whether a breach of our acceptable term of use has occurred through your use of Jobsblog333.com
					</p>
					<p class="" style="padding-left: 30px">
						5.8 Failure to comply with our acceptable use policy may result in any or all of the following action
						<div style="padding-left: 50px">
							•	Immediate, temporary or permanent withdrawal of your right to use the site<br>
							•	Immediate, temporary or permanent removal of any posting or material uploaded by you to Jobsblog333.com.<br>
							•	Issue of a warning to you.<br>
							•	Legal proceeding.<br>
							•	Further legal action against you.<br>
							•	Disclosure of such information to law enforcement agency authorities if necessary.<br>
						</div>
					</p>
					<h4><b>6. Registered Users</b></h4>
					<p class="" style="padding-left: 30px">
						6.1 In any request for your registration, you are responsible for maintaining the confidentiality of your
						password and account information. You are totally and solely responsible for anything that occurs under
						your account.<br>
						6.2 Notify Jobsblog333.com for any unauthorized use of password or account or nay other breach of security.<br>
						6.3 Jobsblog333.com is not responsible for any loss or damage resulted from the disclosure of your password contrary to these Term of Use<br>
						6.4 You retain the ownership of any content you publish using the message feature.<br>
						6.5 We have the right to store any content you post on our site and you are responsible totally and solely for any content you provide to us.<br>
					</p>
					<h4><b>7. Children And Young People</b></h4>
					<p class="" style="padding-left: 30px">
						Our site is primarily aimed at users who are over the age of 18. There are however no barriers to those
						who are under the age of 18 accessing the site or registering as users. Users under 18 should only use
						Jobsblog333.com with the permission of a parent or guardian. The parents or guardian of such child should
						review the Term of Use carefully.
					</p>
					<h4><b>8. Information And Availability</b></h4>
					<p class="" style="padding-left: 30px">
						• While we take every care to ensure that we provide the site with information that are up-to-date, accurate
						and complete, some of the information supplied are from third parties and we may not be able to check its
						accuracy and completeness. You are advised to check and verify the accuracy of any information before
						relying on it.<br>
						• Due to inherent nature of internet, errors interruptions and delays may occur in the service at any time.<br>
						• Accordingly, the site is provided “as is” without any warranties of any kind and we do not accept any liability
						arising from any inaccuracy or omission in the information or interruption in availability due to internet
						ineffectiveness.<br>
					</p>
					<h4><b>9. Links From Jobsblog333.com</b></h4>
					<p class="" style="padding-left: 30px">
						Where Jobsblog333.com contains links to other sites and resources provided by third parties, we have no
						control over the contents of these sites or resources, and accept no responsibility for them or for any
						loss or damage that may arise from your use of them. So as users, you are expected to understand the
						contents on such sites before giving any information.
					</p>
					<h4><b>10. Variation</b></h4>
					<p class="" style="padding-left: 30px">
						We may revise these Terms of Use at any time by amending this Page. You are expected to check this page from time to time to take note
						of any changes we make.
					</p>
					<h4><b>11. Your Information And Privacy</b></h4>
					<p class="" style="padding-left: 30px">
						If you choose to post your location, your intended location or any other such personal information via
						the message features or by any other method on our site, you accept that it is entirely at your own risk
						and we are not responsible for any harm or loss that occurs as a result of the information you share.
					</p>
					<h4><b>12. Product Purchase</b></h4>
					<p class="" style="padding-left: 30px">
						When you buy any product or service from a third party seller through our site, the seller’s individual
						liability will be set out in the seller’s terms and conditions.
					</p>
					<h4><b>13. Jurisdiction And Applicable Law</b></h4>
					<p class="" style="padding-left: 30px">
						• The NIGERIA courts will have exclusive jurisdiction over any claim arising from, or related to, a visit on our site.<br>
						• These Terms of Use and any dispute or claim arising out of or in connection with them or subject matter
						shall be governed by and construed in accordance with the law of Nigeria.
					</p>
					<h4><b>14. Contact Us</b></h4>
					<p class="" style="padding-left: 30px">
						•	If you have any concerns about the contents that appears on our site contact us at <a href="mailto:jobsblog333@gmail.com"
						class='j-btn j-red j-round'>Jobsblog333@gmail.com</a>.<br>
						•	Thank you for visiting our site.
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