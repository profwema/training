		<!-- start: HEADER -->

		<div class="navbar navbar-inverse navbar-fixed-top">
			<!-- start: TOP NAVIGATION CONTAINER -->
			<div class="container">
				<div class="navbar-header">
					<!-- start: RESPONSIVE MENU TOGGLER -->
					<button data-target=".navbar-collapse" data-toggle="collapse" class="navbar-toggle" type="button">
						<span class="clip-list-2"></span>
					</button>
					<!-- end: RESPONSIVE MENU TOGGLER -->
					<!-- start: LOGO -->

					<a class="navbar-brand mr-x" href="index.php">
						منصة التدريب للمركز الرئيسي للتدريب المستدام -
						<?php
						if (isset($_SESSION['Center'])) {
							$data['id'] = $_SESSION['Center'];
							echo $db->getCenterName($data);
						} else {
							echo 'الاشراف العام';
						}
						?>
						- لوحة التحكم
					</a>



					<!-- end: LOGO -->
				</div>

				<div class="navbar-tools">
					<!-- start: TOP NAVIGATION MENU -->
					<ul class="nav navbar-right">
						<li class="dropdown current-user">

							<a class="dropdown-toggle" href="../index.php" target="_blank">
								<img src="assets/images/website.png" class="circle-img" alt="">
								<span class="username">مشاهدة الموقع</span>

							</a>
						</li>


						<!-- start: USER DROPDOWN -->
						<li class="dropdown current-user">
							<a data-toggle="dropdown" data-hover="dropdown" class="dropdown-toggle" data-close-others="true" href="#">
								<img src="assets/images/admin.png" class="circle-img" alt="">
								<span class="username">المدير</span>
								<i class="fa fa-arrow-down"></i>
							</a>
							<ul class="dropdown-menu">
								<!-- 								<li>
									<a href="pages_user_profile.html">
										<i class="clip-user-2"></i>
تعديل 									</a>
								</li> -->

								<li>
									<a href="logout.php">
										<i class="clip-exit"></i>
										خروج
									</a>
								</li>
							</ul>
						</li>
						<!-- end: USER DROPDOWN -->
						<!-- start: PAGE SIDEBAR TOGGLE -->

						<!-- end: PAGE SIDEBAR TOGGLE -->
					</ul>
					<!-- end: TOP NAVIGATION MENU -->
				</div>
			</div>
			<!-- end: TOP NAVIGATION CONTAINER -->
		</div>
		<!-- end: HEADER -->