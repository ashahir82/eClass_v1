<?php
header("Access-Control-Allow-Origin: *");//to allow cross-site

include '../core/init.php';


if(isset($_POST['course_id'])) {
	$course_id=sanitize($_POST['course_id']);
	
	echo '<ul data-role="listview" data-filter="true" data-filter-placeholder="Carian modul..." data-inset="true">';
	
	$result = mysql_query("SELECT * FROM `module` WHERE `course_id` = $course_id");
	if (mysql_num_rows($result) != 0) {
		// output data of each row
		while ($row = mysql_fetch_array($result)) {
			echo '<li><a class="selectTopic" href="#" id="' . $row['module_id'] . '">' . $row['name'] . '</a></li>';
		}
	} else {
		echo "<li>No record found!!!</li>";
	}
	
	echo '</ul>';
	echo '<a href="#" data-role="button" role="button" data-ajax="false" onClick="selectCourse()">Back</a>';
}
?>