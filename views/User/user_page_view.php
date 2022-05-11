<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Mitr:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
    <link rel="stylesheet" href="../../resource/css/User/user_page_view.css">
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
    <!--  -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-6 col-md-2">
                <div class="list-group text-center">
                    <a class="list-group-item list-group-item-action" id="bg-a">
                        สถานะ : นักศึกษา
                    </a>
                    <a class="list-group-item list-group-item-action"><img src="../../resource/upload/user_upload/img_avatar.png" id="sidebar-profile"></a>
                    <a href="#" class="list-group-item list-group-item-action" id="btn-edit-profile">เเก้ไขข้อมูลประจำตัว</a>
                    <a href="#" class="list-group-item list-group-item-action" onclick="logOut()">ออกจากระบบ</a>
                </div>
                <br>
                <div class="card">
                    <div class="card-header" style="background-color: #6D76F5; color: #F7F5FC">
                        ผลการเรียน
                    </div>
                    <div class="card-body">
                        <div id="show-detali-grade">
                            <!--  -->
                        </div>
                    </div>
                    <div class="card-footer">
                        <!--  -->
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-10">
                <div class="card">
                    <div class="card-body">
                        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active btn-sm" id="pills-listGrade-tab" data-bs-toggle="pill" data-bs-target="#pills-grade" type="button" role="tab" aria-controls="pills-grade" aria-selected="true">รายงานผลการเรียน</button>
                            </li>
                        </ul>
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pills-grade" role="tabpanel" aria-labelledby="pills-listGrade-tab">
                                <div class="table-responsive-sm">
                                    <table class="table table align-middle table-borderless text-center display" id="myTable" width="100%">
                                        <thead class="table-bg">
                                            <tr>
                                                <td>ภาคเรียน</td>
                                                <td>SEC.</td>
                                                <td>รหัสวิชา</td>
                                                <td>ชื่อวิชา</td>
                                                <td>หน่วยกิต</td>
                                                <td>เกรด</td>
                                                <td>กลุ่มวิชา</td>
                                            </tr>
                                        </thead>
                                        <tbody id="display-grade-detail">
                                            <!--  -->
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">...</div>
                            <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">...</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="modal-edit-profile" tabindex="-1" aria-labelledby="modal-edit-profileLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-edit-profileLabel">เเก้ไขข้อมูลประจำตัว</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="form-edit-profile" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="text-center">
                            <img src="../../resource/upload/user_upload/img_avatar.png" class="rounded" id="img-profile">
                            <div class="row">
                                <div class="col-md-6 mt-4">
                                    <input type="text" class="form-control" id="username" name="username" aria-describedby="username" placeholder="username" required>
                                </div>
                                <div class="col-md-6 mt-4">
                                    <input type="text" class="form-control" id="password" name="password" aria-describedby="password" placeholder="password" required>
                                </div>
                                <div class="col-md-6 mt-4">
                                    <input type="text" class="form-control" id="fname" name="fname" aria-describedby="fname" placeholder="ชื่อ" required>
                                </div>
                                <div class="col-md-6 mt-4">
                                    <input type="text" class="form-control" id="lname" name="lname" aria-describedby="lname" placeholder="นามสกุล" required>
                                </div>
                                <div class="col-md-6 mt-4">
                                    <select class="form-select" id="gender" name="gender" aria-label="Default select example" required>
                                        <option selected>เลือกเพศ...</option>
                                        <option value="ชาย">ชาย</option>
                                        <option value="หญิง">หญิง</option>
                                        <option value="อื่นๆ">อื่นๆ</option>
                                    </select>
                                </div>
                                <div class="col-md-6 mt-4">
                                    <input type="date" class="form-control" id="b_date" name="b_date" aria-describedby="b_date" required>
                                </div>
                                <div class="col-md-6 mt-4">
                                    <input type="text" class="form-control mb-2" id="branch" name="branch" aria-describedby="branch" placeholder="สาขา" required>
                                </div>
                                <div class="col-md-6 mt-4">
                                    <input type="text" class="form-control mb-2" id="faculty" name="faculty" aria-describedby="faculty" placeholder="คณะ" required>
                                </div>
                                <div class="col-md-6 mt-4">
                                    <input type="text" class="form-control mb-2" id="section" name="section" aria-describedby="section" placeholder="ชั้นปีที่" required>
                                </div>
                                <div class="col-md-6 mt-4">
                                    <input type="phone" class="form-control" id="phone" name="phone" aria-describedby="phone" placeholder="เบอร์โทร" required>
                                </div>
                                <div class="col-md-6 mt-4">
                                    <input type="email" class="form-control" id="email" name="email" aria-describedby="email" placeholder="อีเมล" required>
                                </div>
                                <div class="col-md-6 mt-4">
                                    <input type="file" class="form-control mb-2" id="p_img" name="p_img" value="">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
                        <button type="submit" class="btn btn-primary">เเก้ไข</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!--  -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.1/chart.js" integrity="sha512-Lii3WMtgA0C0qmmkdCpsG0Gjr6M0ajRyQRQSbTF6BsrVh/nhZdHpVZ76iMIPvQwz1eoXC3DmAg9K51qT5/dEVg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.1.1/crypto-js.min.js" integrity="sha512-E8QSvWZ0eCLGk4km3hxSsNmGWbLtSCSUcewDQPQWZF6pEU8GlT8a5fF32wOl1i8ftdMhssTrF/OhyGWwonTcXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
    <script src="../../resource/javascript/User/user_page_view.js"></script>

</body>

</html>


