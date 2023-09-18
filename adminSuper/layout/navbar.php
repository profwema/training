			<!-- start: NAVBAR -->
			<div class="navbar-content">
			    <!-- start: SIDEBAR -->
			    <div class="main-navigation navbar-collapse collapse">
			        <!-- start: MAIN MENU TOGGLER BUTTON -->
			        <div class="navigation-toggler">
			            <i class="fa fa-arrow-left"></i>
			            <i class="fa fa-arrow-left" aria-hidden="true"></i>
			        </div>
			        <!-- end: MAIN MENU TOGGLER BUTTON -->
			        <!-- start: MAIN NAVIGATION MENU -->
			        <ul class="main-navigation-menu">
			            <li class='<?php if ($section == "home") echo "active open" ?>'>
			                <a href="index.php"><i class="fa fa-home"></i>
			                    <span class="title"> الرئيسية </span>
			                    <span class="selected"></span>
			                </a>
			            </li>
			            <?php
						if (isset($_SESSION['Center'])) {
						?>
			            <li class='<?php if ($section == "center") echo "active open" ?>'>
			                <a href="centerInfo.php">
			                    <i class="fa fa-sitemap" aria-hidden="true"></i>
			                    <span class="title">بيانات المركز</span></span>
			                    <span class="selected"></span>
			                </a>
			            </li>
			            <li class='<?php if ($section == "categories") echo "active open" ?>'>
			                <a href="categories.php">
			                    <i class="fa fa-sitemap" aria-hidden="true"></i>
			                    <span class="title">فئات الدورات</span>
			                    <span class="selected"></span>
			                </a>
			            </li>
			            <li class='<?php if ($section == "courses") echo "active open" ?>'>
			                <a href="courses.php">
			                    <i class="fa fa-tasks" aria-hidden="true"></i>
			                    <span class="title"> الدورات التدريبية </span>
			                    <span class="selected"></span>
			                </a>
			            </li>
			            <li class='<?php if ($section == "groups") echo "active open" ?>'>
			                <a href="groups.php"><i class="fa fa-users" aria-hidden="true"></i>
			                    <span class="title"> مجموعات التدريب</span>
			                    <span class="selected"></span>
			                </a>
			            </li>
			            <?php
						} else {
						?>
			            <li class='<?php if ($section == "centers") echo "active open" ?>'>
			                <a href="centers.php"><i class="fa fa-list-ol"></i>
			                    <span class="title"> المراكز التابعه</span>
			                    <span class="selected"></span>
			                </a>
			            </li>
			            <li class='<?php if ($section == "admins") echo "active open" ?>'>
			                <a href="centerAdmins.php"><i class="fa fa-user-circle" aria-hidden="true"></i>
			                    <span class="title"> مشرفين المراكز</span>
			                    <span class="selected"></span>
			                </a>
			            </li>
			            <li class='<?php if ($section == "nstractors") echo "active open" ?>'>
			                <a href="instractors.php"><i class="fa fa-user-circle" aria-hidden="true"></i>
			                    <span class="title">المدربين</span>
			                    <span class="selected"></span>
			                </a>
			            </li>
			            <li class='<?php if ($section == "trainfields") echo "active open" ?>'>
			                <a href="trainingFields.php"><i class="fa fa-user-circle" aria-hidden="true"></i>
			                    <span class="title">مجالات التدريب</span>
			                    <span class="selected"></span>
			                </a>
			            </li>
			            <?php
						}
						?>
			        </ul>
			        <!-- end: MAIN NAVIGATION MENU -->
			    </div>
			    <!-- end: SIDEBAR -->
			</div>
			<!-- evd: NAVBAR -->