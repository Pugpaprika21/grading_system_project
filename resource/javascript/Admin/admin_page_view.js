$(document).ready(function() {
    $.getScript("../../resource/javascript/public_JS/Ajax.js", function(script, textStatus, jqXHR) {
        var resp = null;
        var admin_info = window.localStorage.getItem('admin_info');
        var admin_id = JSON.parse(admin_info);
        $('#btn-submit').prop('disabled', true);
        //
        (function() {
            let option = ``;
            let rowNum = 1;
            resp = Ajax.get('../../controllers/Admin/show_student_id.php');
            resp.forEach(function(students) {
                option = `<option value="${students.stu_id}">ลำดับที่ ${rowNum} : รหัสนักศึกษา : ${students.stu_id}</option>`;
                $('#select-student-id').append(option);
                rowNum++;
            });
        })();
        // 
        $('#select-student-id').change(function(e) {
            e.preventDefault();
            let stu_id = $(this).val();
            $('#btn-cal-avg-grade').attr('student-id', stu_id);
            $('#btn-see-course-name').attr('student-id', stu_id);
            resp = Ajax.get('../../controllers/Admin/request_student_detail.php', {
                stu_id: stu_id
            });

            if (resp.length != 0) {
                resp.forEach(function(students) {
                    $('#p_img').attr('src', `../../resource/upload/user_upload/${students.p_img}`);
                    $('#s_fname').val(students.fname);
                    $('#s_lname').val(students.lname);
                    $('#s_gender').val(students.gender);
                    $('#sb_date').val(students.b_date);
                    $('#s_branch').val(students.branch);
                    $('#s_faculty').val(students.faculty);
                    $('#s_section').val(students.section);
                    $('#s_phone').val(students.phone);
                    $('#s_email').val(students.email);
                    $('#btn-submit').prop('disabled', false);
                    $('#btn-see-course-name').prop('disabled', false);
                    $('#btn-cal-avg-grade').prop('disabled', false);
                });
            } else {
                $('#p_img').attr('src', `../../resource/upload/user_upload/img_avatar.png`);
                $('#s_fname').val('');
                $('#s_lname').val('');
                $('#s_gender').val('');
                $('#sb_date').val('');
                $('#s_branch').val('');
                $('#s_faculty').val('');
                $('#s_section').val('');
                $('#s_phone').val('');
                $('#s_email').val('');
                $('#form-submit-insert-grade')[0].reset();
                $('#btn-submit').prop('disabled', true);
                $('#btn-see-course-name').prop('disabled', true);
                $('#btn-cal-avg-grade').prop('disabled', true);
                $('#show-detail-course-name').empty();
            }

            displaySideBar(stu_id);
        });
        //
        $('#form-submit-insert-grade').submit(function(e) {
            e.preventDefault();

            let gradeData = {
                admin_id: admin_id[0].admin_id,
                stu_id: $('#select-student-id').val(),
                term: $('#term').val(),
                sec: $('#sec').val(),
                course_code: $('#course_code').val(),
                course_name: $('#course_name').val(),
                credit: $('#credit').val(),
                grade: $('#select-score-grade').val(),
                group_sec: $('#group_sec').val(),
                grade_date: $('#grade_date').val()
            };

            resp = Ajax.post('../../controllers/Admin/request_insert_grade.php', gradeData);
            if (resp.status == 200) {
                Swal.fire(
                    'สำเร็จ',
                    'เพิ่มข้อมูลสำเร็จ',
                    'success'
                ).then(function(result) {
                    window.location.reload();
                });
            }
        });
        //
        $('#btn-see-course-name').click(function(e) {
            e.preventDefault();
            let tbody = ``;
            let rowNum = 1;
            let stu_id = $(this).attr('student-id');
            resp = Ajax.get('../../controllers/Admin/request_gradeDetail_SideBar.php', {
                stu_id: stu_id
            });

            if (resp.length !== 0) {
                $('#modal-course-name').modal('show');
                resp.forEach(function(courses) {
                    tbody = `
                        <tr>
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="${courses.gradedt_id}">
                                </div>
                            </td>
                            <td>${courses.term}</td>
                            <td>${courses.sec}</td>
                            <td>${courses.course_code}</td>
                            <td>${courses.course_name}</td>
                            <td>${courses.credit}</td>
                            <td>${courses.grade}</td>
                            <td>${courses.group_sec}</td>
                        </tr>
                    `;
                    $('#show-detail-course-name').append(tbody);
                    rowNum++;
                });
            }
        });
        //
        $('#btn-cal-avg-grade').click(function(e) {
            e.preventDefault();
            let stu_id = $(this).attr('student-id');
            resp = Ajax.get('../../controllers/Admin/request_calGrade.php', {
                stu_id: stu_id
            });
            if (resp.massage == 'update') {
                Swal.fire(
                    'สำเร็จ',
                    'เเก้ไขเกรดเฉลี่ยสำเร็จ ' + resp.grade_total,
                    'success'
                ).then(function(result) {
                    $('#btn-cal-avg-grade').attr('student-id', resp.stu_id);
                    $('#btn-cal-avg-grade').attr('class', 'btn btn-warning btn-sm');
                    $('#btn-cal-avg-grade').html('เเก้ไขเกรดเฉลี่ย');
                    setTimeout(function() {
                        window.location.reload();
                    }, 1500);
                });
            }
        });
        //
        $('#form-submit-detail-course-name').submit(function(e) {
            e.preventDefault();
            let gradedt_id = [];
            let stu_id = $('#btn-cal-avg-grade').attr('student-id');
            $('.form-check-input').each(function(index, element) {
                if ($(this).is(':checked')) {
                    gradedt_id.push($(this).val());
                }
            });

            resp = Ajax.post('../../controllers/Admin/request_deleteMutipleCourse.php', {
                gradedt_id: gradedt_id
            });

            if (resp.status == 200) {
                Swal.fire(
                    'สำเร็จ',
                    'ลบรายวิชาสำเร็จ',
                    'success'
                ).then(function(result) {
                    $('#modal-course-name').modal('hide');
                    setTimeout(function() {
                        resp = Ajax.get('../../controllers/Admin/request_calGrade.php', {
                            stu_id: stu_id
                        });
                        window.location.reload();
                    }, 1000);
                });
            }
        });
        //
        function displaySideBar(stu_id) {
            let tbody = ``;
            let rowNum = 1;
            resp = Ajax.get('../../controllers/Admin/request_gradeDetail_SideBar.php', {
                stu_id: stu_id
            });

            if (resp.length !== 0) {
                $('#show-qty-course-name').html('จำนวนรายวิชา : ' + resp.length);
                resp.forEach(function(courses) {
                    tbody = `
                        <tr>
                            <td>${rowNum}</td>
                            <td>${courses.course_name}</td>
                            <td>${courses.grade_date}</td>
                        </tr>
                    `;
                    $('#show-course-name').append(tbody);
                    rowNum++;
                });
            } else {
                $('#show-course-name').empty();
                $('#show-qty-course-name').html('ไม่พบรายวิชา');
                $('#btn-see-course-name').prop('disabled', true);
                $('#btn-cal-avg-grade').prop('disabled', true);
            }
        }
    });
    //
    $.getScript("../../resource/javascript/public_JS/Chart.js", function(script, textStatus, jqXHR) {
        //
        (function() {
            let resp = Ajax.get('../../controllers/Admin/request_dashBoard.php');
            resp.forEach(function(grades_data) {
                ChartObject.config("myChart-bar", "bar", [
                    "เกรด A", "เกรด B+", "เกรด B", "เกรด C+",
                    "เกรด C", "เกรด D+", "เกรด D", "เกรด F",
                ], "สถิติ", [
                    "rgba(27, 89, 236, 0.5)",
                    "rgba(183, 236, 27, 0.5)",
                    "rgba(183, 155, 128, 0.5)",
                    "rgba(82, 190, 100, 0.5)",
                    "rgba(158, 147, 200, 0.5)",
                    "rgba(75, 202, 225, 0.5)",
                    "rgba(195, 95, 191, 0.5)",
                    "rgba(255, 99, 99 , 0.5)",
                ], [
                    "rgba(27, 89, 236, 1)",
                    "rgba(183, 236, 27, 1)",
                    "rgba(183, 155, 128, 1)",
                    "rgba(82, 190, 100, 1)",
                    "rgba(158, 147, 200, 1)",
                    "rgba(75, 202, 225, 1)",
                    "rgba(195, 95, 191, 1)",
                    "rgba(255, 99, 99, 1)",
                ], grades_data);
                //
                ChartObject.config("myChart-donut", "doughnut", [
                    "เกรด A", "เกรด B+", "เกรด B", "เกรด C+",
                    "เกรด C", "เกรด D+", "เกรด D", "เกรด F",
                ], "สถิติ", [
                    "rgba(27, 89, 236, 0.5)",
                    "rgba(183, 236, 27, 0.5)",
                    "rgba(183, 155, 128, 0.5)",
                    "rgba(82, 190, 100, 0.5)",
                    "rgba(158, 147, 200, 0.5)",
                    "rgba(75, 202, 225, 0.5)",
                    "rgba(195, 95, 191, 0.5)",
                    "rgba(255, 99, 99 , 0.5)",
                ], [
                    "rgba(27, 89, 236, 1)",
                    "rgba(183, 236, 27, 1)",
                    "rgba(183, 155, 128, 1)",
                    "rgba(82, 190, 100, 1)",
                    "rgba(158, 147, 200, 1)",
                    "rgba(75, 202, 225, 1)",
                    "rgba(195, 95, 191, 1)",
                    "rgba(255, 99, 99, 1)",
                ], grades_data);
            });
        })();
        //
    });
    //
});
//
function logOut() {
    Swal.fire(
        'สำเร็จ',
        'ออกจากระบบ',
        'success'
    ).then(function(result) {
        window.localStorage.clear();
        window.location.href = '../../index.php?logout=success';
    });
}