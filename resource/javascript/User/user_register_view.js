$(document).ready(function() {
    //
    (function() {
        $.getScript("../../resource/javascript/public_JS/Ajax.js", function(script, textStatus, jqXHR) {
            //
            $('#form-register-student').submit(function(e) {
                e.preventDefault();

                let form_register = new FormData($(this)[0]);

                $('input').each(function(index, element) {

                    if (!$(this).val()) {
                        Swal.fire(
                            'คำเตือน',
                            'กรุณากรอกข้อมูลให้ครบทุกช่อง!',
                            'warning'
                        ).then(function(result) {
                            window.location.reload();
                        });

                        return false;

                    } else {

                        let resp = Ajax.ajaxFormData('POST', '../../controllers/User/user_register.php', form_register);

                        if (resp.status == 200) {
                            Swal.fire(
                                'สำเร็จ',
                                'ลงทะเบียนสำเร็จ',
                                'success'
                            ).then(function(result) {
                                window.location.href = '../../index.php?register=success';
                            });
                        }

                        return false;
                    }
                });
            });
            //
        });
    })();
    //
});