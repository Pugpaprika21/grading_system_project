$(document).ready(function() {
    $.getScript("../../resource/javascript/public_JS/Ajax.js", function(script, textStatus, jqXHR) {
        $('#form-login-admin').submit(function(e) {
            e.preventDefault();
            let username = $('#username').val();
            let password = $('#password').val();
            if (username != "" && username != null && password != "" && password != null) {
                let resp = Ajax.post('../../controllers/Admin/admin_login.php', {
                    username: username,
                    password: password
                });

                if (resp.length != 0) {
                    Swal.fire(
                        'สำเร็จ',
                        'ลงทะเบียนสำเร็จ',
                        'success'
                    ).then(function(result) {
                        window.localStorage.setItem('admin_info', JSON.stringify(resp));
                        window.location.href = '../../views/Admin/admin_page_view.php?login=success';
                    });
                } else {
                    Swal.fire(
                        'ผิดพลาด',
                        'username หรือ password ไม่ถูกต้อง!',
                        'error'
                    ).then(function(result) {
                        window.location.reload();
                    });
                }

            } else {
                Swal.fire(
                    'คำเตือน',
                    'กรุณากรอก username เเละ password ให้ครบถ้วน!',
                    'warning'
                ).then(function(result) {
                    window.location.reload();
                });
            }
        });
    });
});