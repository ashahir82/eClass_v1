<?php
header("Access-Control-Allow-Origin: *");//to allow cross-site

include '../core/init.php';


if(isset($_POST['module_id'])) {
	$module_id=sanitize($_POST['module_id']);
	
	echo '<ul data-role="listview" data-filter="true" data-filter-placeholder="Carian topik..." data-inset="true">';
	
	$result = mysql_query("SELECT * FROM `topic` WHERE `module_id` = $module_id");
	if (mysql_num_rows($result) != 0) {
		// output data of each row
		while ($row = mysql_fetch_array($result)) {
			echo '<li><a class="selectContent" href="#" id="' . $row['topic_id'] . '">' . $row['name'] . '</a></li>';
		}
	} else {
		echo "<li>No record found!!!</li>";
	}
	
	echo '</ul>';
	echo '<a class="selectModule" id="' . $module_id . '" href="#" data-role="button" role="button" data-ajax="false">Back</a>';
}
?>