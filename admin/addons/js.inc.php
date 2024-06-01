<script>
<?php
$js = ['general','admin','social_handle','message','category','food','user','order','transaction','misc','log','refund'];
foreach($js AS $section){require_once(file_location('admin_inc_path',"js/$section.js.php"));}
?>
</script>