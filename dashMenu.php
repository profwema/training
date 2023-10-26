                            <div class="dashbord-list">
                                <ul>

                                    <li class='<?php if ($dashSection == 'userSummary') echo "active" ?>'>
                                        <a href="userSummary.php">
                                            <i class="fa fa-list"></i> ادارة الحساب
                                        </a>
                                    </li>
                                    <li class='<?php if ($dashSection == 'myCourses') echo "active" ?>'>
                                        <a href="myCourses.php">
                                            <i class="fa fa-list"></i> الدورات المشترك فيها
                                        </a>
                                    </li>
                                    <li class='<?php if ($dashSection == 'pendCourses') echo "active" ?>'>
                                        <a href="pendCourses.php">
                                            <i class="fa fa-list"></i> الدورات قيد الاشتراك
                                        </a>
                                    </li>
                                    <li>
                                        <a href="logout.php">
                                            <i class="fa fa-sign-out"></i> تسجيل الخروج
                                        </a>
                                    </li>
                                </ul>
                            </div>