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
                                                <a href="index"><i class="fa fa-cubes ml-1" aria-hidden="true"
                                                        title="الرئيسية"></i>
                                                    الرئيسية</a>
                                            </li>
                                            <li class="list-inline-item dropdown">
                                                <a href="index"><i class="fa fa-cubes ml-1" aria-hidden="true"
                                                        title="المراكز الفرعية"></i>
                                                    المراكز الفرعية</a>
                                                <div class="dropdown-content">

                                                    <?php
                                                    $i = 0;
                                                    $users = $db->getCenters();

                                                    if (isset($users)) $i++;
                                                    foreach ($users as $u) : $i++;
                                                    ?>


                                                    <a href="centercats.php?center=<?= $u['id'] ?>">
                                                        <?= $u['name'] ?>
                                                    </a>

                                                    <?php endforeach; ?>



                                                </div>
                                            </li>


                                        </ul>
                                    </div>
                                    <div class="mr-auto ml-auto">
                                        <a href="userSummary.php" class="button">
                                            <span>
                                                حسابي
                                            </span>
                                        </a>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--/ Header Main wrapper -->
                    </div>
                </div>
            </header>