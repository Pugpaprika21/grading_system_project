<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Mitr:wght@300&display=swap" rel="stylesheet">
    <!-- <link rel="stylesheet" href="../../resource/css/User/user_register_view.css"> -->
    <title>ระบบตัดเกรด</title>

    <style>
        nav {
            background-color: #6D76F5;
        }

        body {
            font-family: 'Mitr', sans-serif;
            background-color: #F7F5FC;
        }

        img {
            border-radius: 40%;
            height: 100px;
        }

        #card-register {
            margin-top: 15px;
            width: 80rem;
        }

        #btn-register {
            width: 100%;
        }
    </style>

</head>

<body>
    <!--  -->
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container-fluid">
            <a class="navbar-brand text-white" href="#">ระบบตัดเกรด</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link text-white" aria-current="page" href="../../index.php">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-box-arrow-in-left" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M10 3.5a.5.5 0 0 0-.5-.5h-8a.5.5 0 0 0-.5.5v9a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 .5-.5v-2a.5.5 0 0 1 1 0v2A1.5 1.5 0 0 1 9.5 14h-8A1.5 1.5 0 0 1 0 12.5v-9A1.5 1.5 0 0 1 1.5 2h8A1.5 1.5 0 0 1 11 3.5v2a.5.5 0 0 1-1 0v-2z" />
                                <path fill-rule="evenodd" d="M4.146 8.354a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H14.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3z" />
                            </svg> ย้อนกลับ
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!--  -->
    <div class="container">
        <div class="d-flex justify-content-center">
            <div class="card shadow-sm rounded" id="card-register" style="width: 40rem;">
                <div class="card-header">Register</div>
                <form id="form-register-student">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 mt-4">
                                <input type="text" class="form-control" id="username" name="username" aria-describedby="username" placeholder="username">
                            </div>
                            <div class="col-md-6 mt-4">
                                <input type="text" class="form-control" id="password" name="password" aria-describedby="password" placeholder="password">
                            </div>
                            <div class="col-md-6 mt-4">
                                <input type="text" class="form-control" id="fname" name="fname" aria-describedby="fname" placeholder="ชื่อ">
                            </div>
                            <div class="col-md-6 mt-4">
                                <input type="text" class="form-control" id="lname" name="lname" aria-describedby="lname" placeholder="นามสกุล">
                            </div>
                            <div class="col-md-6 mt-4">
                                <select class="form-select" id="gender" name="gender" aria-label="Default select example">
                                    <option selected>เลือกเพศ...</option>
                                    <option value="ชาย">ชาย</option>
                                    <option value="หญิง">หญิง</option>
                                    <option value="อื่นๆ">อื่นๆ</option>
                                </select>
                            </div>
                            <div class="col-md-6 mt-4">
                                <input type="date" class="form-control" id="b_date" name="b_date" aria-describedby="b_date">
                            </div>
                            <div class="col-md-6 mt-4">
                                <input type="text" class="form-control mb-2" id="branch" name="branch" aria-describedby="branch" placeholder="สาขา">
                            </div>
                            <div class="col-md-6 mt-4">
                                <input type="text" class="form-control mb-2" id="faculty" name="faculty" aria-describedby="faculty" placeholder="คณะ">
                            </div>
                            <div class="col-md-6 mt-4">
                                <input type="text" class="form-control mb-2" id="section" name="section" aria-describedby="section" placeholder="ชั้นปีที่">
                            </div>
                            <div class="col-md-6 mt-4">
                                <input type="phone" class="form-control" id="phone" name="phone" aria-describedby="phone" placeholder="เบอร์โทร">
                            </div>
                            <div class="col-md-6 mt-4">
                                <input type="email" class="form-control" id="email" name="email" aria-describedby="email" placeholder="อีเมล">
                            </div>
                            <div class="col-md-6 mt-4">
                                <input type="file" class="form-control mb-2" id="p_img" name="p_img">
                            </div>
                            <div class="d-flex justify-content-end">
                                <div class="col-md-6 mt-4">
                                    <img src="../../resource/upload/user_upload/img_avatar.png" id="imgs" width="100" height="100">
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary mt-4" id="btn-register">ลงทะเบียน</button>
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
    <script src="../../resource/javascript/User/user_register_view.js"></script>

</body>

</html>