$(document).ready(function() {
  //
  $.getScript("resource/javascript/public_JS/Ajax.js", function(script, textStatus, jqXHR) {
      //
      $('#form-login-student').submit(function(e) {
          e.preventDefault();
          let username = $('#username').val();
          let password = $('#password').val();

          if (username != null && username != "" && password != null && password != "") {

              let resp = Ajax.post('controllers/User/users_login.php', {
                  username: username,
                  password: password
              });

              if (resp.length != 0) {

                  if (resp[0].username == username && resp[0].password == password) {

                      Swal.fire(
                          'สำเร็จ',
                          'เข้าสู่ระบบ',
                          'success'
                      ).then(function(result) {
                          window.localStorage.setItem('stu_id', resp[0].stu_id);
                          window.localStorage.setItem('username', resp[0].username);
                          window.localStorage.setItem('password', resp[0].password);
                          window.location.href = 'views/User/user_page_view.php?login=success';
                      });
                  }

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
                  'username เเละ password ให้ครบถ้วน!',
                  'warning'
              ).then(function(result) {
                  window.location.reload();
              });
          }
      });
      //
  });
  //
});

function linkRegister() {
  window.location.href = `views/User/user_register_view.php?register=1`;
}