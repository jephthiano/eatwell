<script>
<?php
$js = ['general','after_load','message','user','order','contact','review'];
foreach($js AS $section){
 require_once(file_location('inc_path',"js/$section.js.php"));
}
?>
</script>