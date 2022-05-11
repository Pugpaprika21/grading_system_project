$(document).ready(function() {
    $.getScript("../../resource/javascript/public_JS/Ajax.js", function(script, textStatus, jqXHR) {
        //
        var resp = null;
        var admin_info = window.localStorage.getItem('admin_info');
        var admin_id = JSON.parse(admin_info);
        //
        (function() {
            resp = Ajax.get('../../controllers/Admin/request_student_data.php');
            $('#myTable').DataTable({
                data: resp,
                columns: [
                    {data: 'stu_id'}, 
                    {data: 'fname'}, 
                    {data: 'lname'}, 
                    {data: 'gender'},
                    {data: 'b_date'}, 
                    {data: 'branch'}, 
                    {data: 'faculty'}, 
                    {data: 'section'},
                    {data: 'phone'}, 
                    {data: 'email'}, 
                    {data: null}, 
                    {data: null}
                ],
                columnDefs: [
                    {
                        targets: 10,
                        orderable: false,
                        render: function(data, type, row) {
                            return `
                                <img src="../../resource/upload/user_upload/${data.p_img}" style="width: 42px; height: 42px; border-radius: 10px;">
                            `;
                        }
                    },
                    {
                        targets: 11,
                        orderable: false,
                        render: function(data, type, row) {
                            return `
                                <div class="dropdown">
                                    <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" id="dropdown-action" data-bs-toggle="dropdown" aria-expanded="false">
                                        action
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="dropdown-action">
                                        <li><button class="dropdown-item" id="btn-edit" type="button" onclick="btnAvg(${data.stu_id})">ดู คะเเนนเฉลี่ย</button></li>
                                        <li><button class="dropdown-item" id="btn-edit" type="button" onclick="btnEdit(${data.stu_id})">เเก้ไข</button></li>
                                        <li><button class="dropdown-item" id="btn-delete" type="button" onclick="btnDelete(${data.stu_id})">ลบ</button></li>
                                    </ul>
                                </div>
                            `;
                        }
                    }
                ]
            });
        })();
        //
    });
});
//
function btnAvg(stu_id) {
    let resp = Ajax.get('../../controllers/User/request_showGradeToSidebar.php', {stu_id: stu_id});
    resp.forEach(function (data) {
        Swal.fire(
            'ข้อมูลเกรดเฉลี่ย',
            `เกรดเฉลี่ย : ${data.grade_total} <br> หน่วยกิตรวม ${data.credit_total} <br> วันประมวลผล : ${data.date_add_grade}`,
            'info'
        ); 
    });
}
//
function btnEdit(stu_id) {
    $('#btn-edit-profile').attr('student-id', stu_id);
    Ajax.get('../../controllers/Admin/request_student_detail.php', {
        stu_id: stu_id
    }).forEach(function(student) {
        $('#username').val(student.username);
        $('#password').val(student.password);
        $('#fname').val(student.fname);
        $('#lname').val(student.lname);
        $('#gender').val(student.gender);
        $('#b_date').val(student.b_date);
        $('#branch').val(student.branch);
        $('#faculty').val(student.faculty);
        $('#section').val(student.section);
        $('#phone').val(student.phone);
        $('#email').val(student.email);
        $('#stu-img').attr('src', `../../resource/upload/user_upload/${student.p_img}`);
    });

    $('#modal-student').modal('show');
}
//
function btnDelete(stu_id) {
    Swal.fire({
        title: 'คำเตือน',
        text: `ต้องการลบนักศึกษารหัส ${stu_id} หรือ ไม่!`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then(function (result) {
        if (result.isConfirmed) {
            Swal.fire(
                'สำเร็จ',
                `ลบนักศึกษารหัส ${stu_id} เเล้ว`,
                'success'
            ).then(function (result) {
                let resp = Ajax.get('../../controllers/Admin/request_delStudent.php', {
                    stu_id: stu_id
                });
            });
        }
    });
}
//
document.getElementById('form-modal-student-edit').addEventListener('submit', function(e) {
    e.preventDefault();
    let stu_id = document.getElementById('btn-edit-profile').getAttribute('student-id');
    let form_editPofile = new FormData(this); 
    form_editPofile.append('stu_id', stu_id);

    let resp = Ajax.ajaxFormData('POST', '../../controllers/User/request_editProfile.php', form_editPofile);

    if (resp.status == 200) {
        Swal.fire(
            'สำเร็จ',
            'เเก่ไขข้อมูลสำเร็จ',
            'success'
        ).then(function(result) {
            window.location.reload();
        });
    }
});
//
function logOut() {
    Swal.fire(
        'สำเร็จ',
        'ออกจากระบบ',
        'success'
    ).then(function(result) {
        window.localStorage.removeItem('admin_info');
        window.location.href = '../../index.php?logout=success';
    });
}
//