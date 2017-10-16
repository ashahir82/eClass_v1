<?php
header("Access-Control-Allow-Origin: *");//to allow cross-site

include '../core/init.php';


if(isset($_POST['topic_id'])) {
	$topic_id=sanitize($_POST['topic_id']);
	$pages = 1;
	
	//count note
	$result = mysql_query("SELECT * FROM `quiz` WHERE `topic_id` = $topic_id");
	$total_notes = mysql_num_rows($result);
	if (mysql_num_rows($result) != 0) {
		// output data of each row
		while ($row = mysql_fetch_array($result)) {
			echo '
			<div data-role="page" class="eclass-page';
			if ($pages == 1) { echo ' ui-page-active'; }
			echo '" id="page_' . $pages . '" data-url="/eclass/quiz.html?tid=' . $topic_id . '">
				<div data-role="panel" id="menu-panel_' . $pages . '" class="menu-panel" data-position="left" data-display="overlay" data-theme="a">
					<ul data-role="listview">
						<li data-icon="home"><a href="home.html" data-ajax="false">Utama</a></li>
						<li data-icon="user"><a href="profile.html" data-ajax="false">Profil</a></li>
						<li data-icon="user"><a href="course.html" data-ajax="false">Kursus</a></li>
						<li data-icon="power"><a href="#" data-ajax="false" onClick="logOutClass()">Log Keluar</a></li>
					</ul>
				</div><!-- /panel -->
			
				<div data-role="header" class="eclass-header">
					<h1>eKelas</h1>
					<a href="#menu-panel_' . $pages . '" data-role="button" role="button" class="ui-btn ui-shadow ui-corner-all ui-icon-bars ui-btn-icon-notext">Menu</a>
				</div><!-- /header -->
			
				<div role="main" class="eclass-content ui-content">
					<h4>' . topic_name($topic_id) . '</h4>
					<div id="displayresult"> <!-- DIV to display the content from server page -->
					<p>' . $pages . '. ' . $row['question'] . '</p>
					<fieldset data-role="controlgroup">';
					$optionArray = explode("; ", $row['option']);
					$optionCount = count($optionArray);

					for($x = 0; $x < $optionCount; $x++) {
						echo '<input name="radio-choice-' . $pages . '" id="radio-choice-' . $pages . '-' . $x . '" value="choice-' . $pages . '-' . $x . '" data-key="';
						if ($x == 0) { echo 'a'; } else if ($x == 1) { echo 'b'; } else if ($x == 2) { echo 'd'; } else if ($x == 3) { echo 'd'; }
						echo '" type="radio"><label for="radio-choice-' . $pages . '-' . $x . '">' . $optionArray[$x] . '</label>';
					}
					echo '</fieldset>
					</div>
				</div><!-- /content -->
			
				<div data-role="footer" data-position="fixed" class="eclass-footer ui-footer-fixed">
					<div data-role="navbar">
						<ul>
							<li><a href="#';
							if ($pages != 1 ) { echo 'page_' . ($pages - 1); }
							echo '" id="btnPrev">Back</a></li>
							<li><a href="#';
							if ($pages < $total_notes ) { echo 'page_' . ($pages +1) . '" id="btnNext">Next'; } else { echo 'page_' . ($pages +1) . '" id="btnResult">Result'; }
							echo '</a></li>
						</ul>
					</div><!-- /navbar -->
					<h4>Hak Milik Terpelihara @ 2016, ILPKL</h4>
				</div><!-- /footer -->
			</div><!-- /page -->';
			$pages++;
		}
	} else {
		echo "<h1>No record found!!!</h1>";
	}
}
?>