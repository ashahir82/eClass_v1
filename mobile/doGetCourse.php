<?php
header("Access-Control-Allow-Origin: *");//to allow cross-site

include '../core/init.php';

echo '<ul data-role="listview" data-filter="true" data-filter-placeholder="Carian kursus..." data-inset="true">';

$result = mysql_query("SELECT * FROM `course`");
if (mysql_num_rows($result) != 0) {
	// output data of each row
	while ($row = mysql_fetch_array($result)) {
		echo '<li><a class="selectModule" href="#" id="' . $row['course_id'] . '">' . $row['name'] . '</a></li>';
	}
} else {
	echo "<li>No record found!!!</li>";
}

echo '</ul>';
?>