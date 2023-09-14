            <header id="header" class="site-header cta_button" data-header-style="2">
                <div class="kl-main-header">
                    <div class="site-header-top-wrapper">
                        <!-- Header Main wrapper -->


                        <div class="site-header-main-wrapper d-flex nav-bottom" dir="rtl">
                            <div class="siteheader-container container align-self-center">
                                <div class="site-header-row site-header-main d-flex flex-row justify-content-between">
                                    <div
                                        class="site-header-main-left d-flex justify-content-start align-items-center w-100">
                                        <div class="main-menu-wrapper w-100">
                                            <div class="d-flex align-items-center justify-content-between w-100">
                                                <a href="https://tanta.edu.eg/Default.aspx">
                                                    <img width="210" height="70" src="img/logo.png" class="logo-img"
                                                        alt="جامعة طنطا" title="جامعة طنطا" />
                                                </a>
                                                <img class="ml-2" height="25" src="img/flag.png" />

                                                <a href="index.php">
                                                    <img width="300" src="img/sitelogo.jpg" class="logo-img" />
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>



                        <div class="site-services-header">
                            <div class="container">
                                <div class="d-flex">
                                    <div class="mr-auto ml-auto ">
                                        <ul class="list-inline align-items-right">
                                            <li class="list-inline-item">
                                                <a href="https://nsite3.tanta.edu.eg/stu-services.aspx"><i
                                                        class="fa fa-user ml-1" aria-hidden="true" title="الطلاب"></i>
                                                    خدمات طلاب</a>
                                            </li>
                                            <li class="list-inline-item">
                                                <a href="https://nsite3.tanta.edu.eg/post-services.aspx"><i
                                                        class="fa fa-graduation-cap ml-1" aria-hidden="true"
                                                        title="الدراسات العليا"></i> الدراسات العليا</a>
                                            </li>
                                            <li class="list-inline-item">
                                                <a href="https://nsite3.tanta.edu.eg/staff-services.aspx"><i
                                                        class="fa fa-users ml-1" aria-hidden="true"
                                                        title="أعضاء هيئة التدريس"></i> أعضاء هيئة التدريس</a>
                                            </li>
                                            <li class="list-inline-item">
                                                <a href="https://nsite3.tanta.edu.eg/emp-services.aspx"><i
                                                        class="fa fa-book ml-1" aria-hidden="true" title="العاملون"></i>
                                                    خدمات العاملين</a>
                                            </li>
                                            <li class="list-inline-item">
                                                <a href="https://nsite3.tanta.edu.eg/other-services.aspx"><i
                                                        class="fa fa-cubes ml-1" aria-hidden="true" title="الخدمات"></i>
                                                    الخدمات</a>
                                            </li>
                                        </ul>

                                    </div>
                                    <div class="mr-auto ml-auto">
                                        <?php
                          if (isset($_SESSION['user'])) {
                          ?>

                                        <a href="dashboard.php" class="small btn btn-success  rounded-0">
                                            <span> <?= $_SESSION['ar_name'] ?></span>
                                        </a>
                                        <a href="logout.php" class="small ">
                                            تسجيل خروج
                                        </a>



                                        <?php
                          } else {
                          ?>
                                        <a href="login.php" class="small login">
                                            تسجيل دخول
                                        </a>

                                        <?php
                          }
                          ?>

                                    </div>
                                </div>

                            </div>
                        </div>

                        <!--/ Header Main wrapper -->
                    </div>
                </div>
            </header>