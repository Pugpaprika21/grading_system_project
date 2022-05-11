    //
    $(document).ready(function() {
        $.getScript('../../resource/javascript/public_JS/Ajax.js', function(script, textStatus, jqXHR) {
            //
            var resp = null;
            var stu_id = window.localStorage.getItem('stu_id');
            //
            (function () {
                $('#myTable').DataTable({
                    data: Ajax.get('../../controllers/User/request_showGrade.php', {stu_id: stu_id}),
                    columns: [
                        {data: 'term'},
                        {data: 'sec'},
                        {data: 'course_code'},
                        {data: 'course_name'},
                        {data: 'credit'},
                        {data: 'grade'},
                        {data: 'group_sec'}
                    ]
                });
            })();
            //
            function sideBar() {
                Ajax.get('../../controllers/User/request_showProfile.php', {
                    stu_id: stu_id
                }).forEach(function(data, i) {
                    $('#sidebar-profile').attr('src', `../../resource/upload/user_upload/${data.p_img}`);
                });
            }

            sideBar();
            //
            $('#btn-edit-profile').click(function(e) {
                e.preventDefault();
                Ajax.get('../../controllers/User/request_showProfile.php', {
                    stu_id: stu_id
                }).forEach(function(data) {
                    $('#img-profile').attr('src', `../../resource/upload/user_upload/${data.p_img}`);
                    $('#username').val(data.username);
                    $('#password').val(data.password);
                    $('#fname').val(data.fname);
                    $('#lname').val(data.lname);
                    $('#gender').val(data.gender);
                    $('#b_date').val(data.b_date);
                    $('#branch').val(data.branch);
                    $('#faculty').val(data.faculty);
                    $('#section').val(data.section);
                    $('#phone').val(data.phone);
                    $('#email').val(data.email);
                    $('#p_img').attr('value', `${data.p_img}`);
                });

                $('#modal-edit-profile').modal('show');
            });
            //
            $('#form-edit-profile').submit(function(e) {
                e.preventDefault();

                let form_editPofile = new FormData($(this)[0]);
                form_editPofile.append('stu_id', stu_id);

                resp = Ajax.ajaxFormData('POST', '../../controllers/User/request_editProfile.php', form_editPofile);
                if (resp.status == 200) {
                    Swal.fire(
                        'สำเร็จ',
                        'เเก้ไขโปรไฟล์สำเร็จ',
                        'success'
                    ).then(function(result) {
                        sideBar();
                        $('#modal-edit-profile').modal('hide');
                    });
                }
            });
            //
            (function() {
                let div = ``;
                Ajax.get('../../controllers/User/request_showGradeToSidebar.php', {
                    stu_id: stu_id
                }).forEach(function(data) {
                    div = `
                        <div class="show-grade">
                            รวมหน่วยกิต ${data.credit_total} <br> ค่าคะแนนเฉลี่ย ${data.grade_total}
                        </div>
                    `;

                    $('#show-detali-grade').append(div);
                    $('.card-footer').append(`ประมวลผลวันที่ ${data.date_add_grade}`);
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
            'ลงทะเบียนสำเร็จ',
            'success'
        ).then(function(result) {
            window.localStorage.clear();
            window.location.href = '../../index.php?logout=success';
        });
    }