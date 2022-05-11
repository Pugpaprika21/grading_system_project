<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Mitr:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../resource/css/Admin/admin_page_view.css">
    <title>ระบบตัดเกรด</title>

</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container-fluid">
            <a class="navbar-brand text-white" href="#">ระบบตัดเกรด</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link text-white" aria-current="stu-data" href="../../views/Admin/admin_page_show_studentData.php">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
                                <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z" />
                            </svg> ดูข้อมูลนักศึกษา
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" aria-current="logout" href="#" onclick="logOut()">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-door-open" viewBox="0 0 16 16">
                                <path d="M8.5 10c-.276 0-.5-.448-.5-1s.224-1 .5-1 .5.448.5 1-.224 1-.5 1z" />
                                <path d="M10.828.122A.5.5 0 0 1 11 .5V1h.5A1.5 1.5 0 0 1 13 2.5V15h1.5a.5.5 0 0 1 0 1h-13a.5.5 0 0 1 0-1H3V1.5a.5.5 0 0 1 .43-.495l7-1a.5.5 0 0 1 .398.117zM11.5 2H11v13h1V2.5a.5.5 0 0 0-.5-.5zM4 1.934V15h6V1.077l-6 .857z" />
                            </svg> ออกจากระบบ
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <br>
    <div class="container-fluid">
        <div class="row">
            <div class="col-6 col-md-2">
                <div class="list-group text-center">
                    <a class="list-group-item list-group-item-action active" id="list-header-bg" aria-current="true">
                        สถานะ : Admin
                    </a>
                    <a class="list-group-item list-group-item-action"><img src="../../resource/upload/user_upload/img_avatar.png"></a>
                    <a href="#" class="list-group-item list-group-item-action" onclick="logOut()">ออกจากระบบ</a>
                </div>
                <hr>
                <div class="text-center">
                    <span id="show-qty-course-name">ไม่พบรายวิชา</span>
                    <table class="table table-bordered table-sm mt-2" id="table-show-course-name">
                        <thead id="tbl-bg">
                            <tr>
                                <td>#</td>
                                <td>ชื่อวิชา</td>
                                <td>บันทึก</td>
                            </tr>
                        </thead>
                        <tbody id="show-course-name">
                            <!--  -->
                        </tbody>
                    </table>
                    <button type="button" class="btn btn-primary btn-sm" id="btn-see-course-name" student-id="" disabled>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                            <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                        </svg> ดูรายวิชาเพิ่มเติม
                    </button>
                    <button type="button" class="btn btn-success btn-sm" id="btn-cal-avg-grade" student-id="" disabled>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16">
                            <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
                        </svg> คำนวนเกรดเฉลี่ย
                    </button>
                </div>
            </div>
            <div class="col-6 col-md-10">
                <div class="card">
                    <div class="card-body">
                        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active btn-sm" id="pills-insert-grade-tab" data-bs-toggle="pill" data-bs-target="#pills-grade" type="button" role="tab" aria-controls="pills-grade" aria-selected="false">เพิ่มเกรด</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link btn-sm" id="pills-static-tab" data-bs-toggle="pill" data-bs-target="#pills-static" type="button" role="tab" aria-controls="pills-static" aria-selected="false">สถิติ</button>
                            </li>
                        </ul>
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pills-grade" role="tabpanel" aria-labelledby="pills-insert-grade-tab">
                                <div class="row">
                                    <div class="col-6 col-md-7">
                                        <form id="form-submit-insert-grade">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <select class="form-select" id="select-student-id" name="select-student-id" aria-label="Default select example" required>
                                                        <option selected>รหัสนักศึกษา</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-6">
                                                    <input type="text" class="form-control" id="term" name="term" aria-describedby="term" placeholder="ภาคเรียน" required>
                                                </div>
                                                <div class="col-md-6">
                                                    <input type="text" class="form-control" id="sec" name="sec" aria-describedby="sec" placeholder="ห้อง" required>
                                                </div>
                                                <div class="col-md-6">
                                                    <input type="text" class="form-control" id="course_code" name="course_code" aria-describedby="course_code" placeholder="รหัสวิชา" required>
                                                </div>
                                                <div class="col-md-6">
                                                    <input type="text" class="form-control" id="course_name" name="course_name" aria-describedby="course_name" placeholder="ชื่อวิชา" required>
                                                </div>
                                                <div class="col-md-6">
                                                    <select class="form-select" id="credit" name="credit" aria-label="Default select example" required>
                                                        <option selected>หน่วยกิต</option>
                                                        <option>1</option>
                                                        <option>2</option>
                                                        <option>3</option>
                                                        <option>4</option>
                                                        <option>5</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-6">
                                                    <select class="form-select" id="select-score-grade" name="select-score-grade" aria-label="Default select example" required>
                                                        <option selected>เกรด</option>
                                                        <option>A</option>
                                                        <option>B+</option>
                                                        <option>B</option>
                                                        <option>C+</option>
                                                        <option>C</option>
                                                        <option>D+</option>
                                                        <option>D</option>
                                                        <option>F</option>
                                                        <option>W</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-6">
                                                    <select class="form-select" id="group_sec" name="group_sec" aria-label="Default select example" required>
                                                        <option selected>กลุ่มวิชา</option>
                                                        <option>c-วิชาบังคับ</option>
                                                        <option>m-วิชาเเกน</option>
                                                        <option>g-วิชาทั่วไป</option>
                                                        <option>i-วิชาอิสระ</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-6">
                                                    <input type="date" class="form-control" id="grade_date" name="grade_date" aria-describedby="grade_date" placeholder="grade_date" required>
                                                </div>
                                                <!--  -->
                                                <div class="col-md-6">

                                                </div>
                                                <!--  -->
                                            </div>
                                            <div class="d-flex justify-content-end mt-4">
                                                <button type="submit" class="btn btn-primary" id="btn-submit">บันทึก</button>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="col-6 col-md-5">
                                        <div class="row">
                                            <div class="text-center d-flex justify-content-center">
                                                <div class="col-md-6">
                                                    <img id="p_img" src="../../resource/upload//user_upload/img_avatar.png">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <input type="text" class="form-control" id="s_fname" aria-describedby="s_fname" placeholder="ชื่อ" readonly>
                                            </div>
                                            <div class="col-md-6">
                                                <input type="text" class="form-control" id="s_lname" aria-describedby="s_lname" placeholder="นามสกุล" readonly>
                                            </div>
                                            <div class="col-md-6">
                                                <input type="text" class="form-control" id="s_gender" aria-describedby="s_gender" placeholder="เพศ" readonly>
                                            </div>
                                            <div class="col-md-6">
                                                <input type="text" class="form-control" id="sb_date" aria-describedby="sb_date" placeholder="ว-ด-ป" readonly>
                                            </div>
                                            <div class="col-md-6">
                                                <input type="text" class="form-control" id="s_branch" aria-describedby="s_branch" placeholder="คณะ" readonly>
                                            </div>
                                            <div class="col-md-6">
                                                <input type="text" class="form-control" id="s_faculty" aria-describedby="s_faculty" placeholder="สาขา" readonly>
                                            </div>
                                            <div class="col-md-6">
                                                <input type="text" class="form-control" id="s_section" aria-describedby="s_section" placeholder="กลุ่ม" readonly>
                                            </div>
                                            <div class="col-md-6">
                                                <input type="text" class="form-control" id="s_phone" aria-describedby="s_phone" placeholder="เบอร์โทร" readonly>
                                            </div>
                                            <div class="col-md-6">
                                                <input type="text" class="form-control" id="s_email" aria-describedby="s_email" placeholder="อีเมล" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="pills-static" role="tabpanel" aria-labelledby="pills-static-tab">
                                <div class="row" id="static-data">
                                    <div class="col-6 col-md-4">
                                        <div class="card">
                                            <div class="card-body">
                                                <canvas id="myChart-bar" height="450"></canvas>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6 col-md-4">
                                        <div class="card">
                                            <div class="card-body">
                                                <canvas id="myChart-donut" height="50"></canvas>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--  -->
    <div class="modal fade" id="modal-course-name" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modal-course-nameLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <form id="form-submit-detail-course-name">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modal-course-nameLabel">ดูรายวิชาเพิ่มเติม</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <table class="table table align-middle text-center mt-2" id="tbl-detail-course-name">
                            <thead>
                                <tr>
                                    <td>ลบ</td>
                                    <td>เทอม</td>
                                    <td>ห้อง</td>
                                    <td>รหัสวิชา</td>
                                    <td>ชื่อวิชา</td>
                                    <td>หน่วยกิต</td>
                                    <td>เกรด</td>
                                    <td>กลุ่มวิชา</td>
                                </tr>
                            </thead>
                            <tbody id="show-detail-course-name">
                                <!---->
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" id="btn-close-modal" data-bs-dismiss="modal">ปิด</button>
                        <button type="submit" class="btn btn-primary">บันทึก</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!--  -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.1/chart.js" integrity="sha512-Lii3WMtgA0C0qmmkdCpsG0Gjr6M0ajRyQRQSbTF6BsrVh/nhZdHpVZ76iMIPvQwz1eoXC3DmAg9K51qT5/dEVg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.1.1/crypto-js.min.js" integrity="sha512-E8QSvWZ0eCLGk4km3hxSsNmGWbLtSCSUcewDQPQWZF6pEU8GlT8a5fF32wOl1i8ftdMhssTrF/OhyGWwonTcXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
    <script src="../../resource/javascript/Admin/admin_page_view.js"></script>

</body>

</html>
