async function getInfor() {
       // Tạo một đối tượng URLSearchParams từ đường dẫn URL hiện tại
       let urlParams = new URLSearchParams(window.location.search);

       // Lấy giá trị của tham số 'code' từ URL hiện tại
       let userName = urlParams.get('username');

       if (userName != null && userName != '') {
              const response = await fetch('../../BLL/AccountBLL.php', {
                     method: 'POST',
                     headers: {
                            'Content-Type': 'application/x-www-form-urlencoded'
                     },
                     body: 'function=' + encodeURIComponent('getObjAccount') + '&userName=' + encodeURIComponent(userName)
              });

              const data = await response.json();
              console.log(data);
              if (data != null) {
                     return data;
              } else {
                     window.location.href = `../../GUI/view/login.php`;
              }
       }
}
getInfor();

async function resetPass(event) {

       event.preventDefault();
       let newPass = document.getElementById('newPassword').value;
       let rePass = document.getElementById('rePassword').value;

       if (isVaidPassword(newPass)) {
              if (newPass === rePass) {
                     let dataUser = await getInfor();

                     if (dataUser != null) {
                            let userName = dataUser.userName;
                            let passWord = newPass;
                            let accountStatus = dataUser.accountStatus;
                            let address = dataUser.address;
                            let birth = dataUser.birth;
                            let codePermission = dataUser.codePermission;
                            let dateCreate = dataUser.dateCreate;
                            let email = dataUser.email;
                            let name = dataUser.name;
                            let sex = dataUser.sex;
                            let phoneNumber = dataUser.phoneNumber;

                            const response = await fetch('../../BLL/AccountBLL.php', {
                                   method: 'POST',
                                   headers: {
                                          'Content-Type': 'application/x-www-form-urlencoded'
                                   },
                                   body:
                                          'function=' + encodeURIComponent('updateAccount') + '&userName=' + encodeURIComponent(userName) + '&passWord=' + encodeURIComponent(passWord) + '&dateCreate=' + encodeURIComponent(dateCreate) + '&accountStatus=' + encodeURIComponent(accountStatus) + '&name=' + encodeURIComponent(name) + '&address=' + encodeURIComponent(address) + '&email=' + encodeURIComponent(email) + '&phoneNumber=' + encodeURIComponent(phoneNumber) + '&birth=' + encodeURIComponent(birth) + '&sex=' + encodeURIComponent(sex) + '&codePermission=' + encodeURIComponent(codePermission)
                            });
                            const data = await response.json();

                            if (data.mess == 'success') {
                                   await Swal.fire({
                                          position: "center",
                                          icon: "success",
                                          title: "Successful change! You need to log back in so the information displayed can be updated.",
                                   });
                                   // gọi đăng xuất
                                   try {
                                          const response = await fetch('../../BLL/AccountBLL.php', {
                                                 method: 'POST',
                                                 headers: {
                                                        'Content-Type': 'application/x-www-form-urlencoded'
                                                 },
                                                 body: 'function=' + encodeURIComponent('logout_whenExitPage')
                                          });
                                          const data = await response.json();

                                          if (data.length == 0) {
                                                 window.location.href = "../../GUI/view/login.php";
                                          }

                                   } catch (error) {
                                          console.error('Error:', error);
                                   }

                            } else {
                                   await Swal.fire({
                                          icon: "error",
                                          title: "Oops...",
                                          text: "Update failed!",
                                   });
                            }

                     }

              } else {
                     Swal.fire({
                            position: "center",
                            icon: "error",
                            title: "The confirmation password does not match the new password !!",
                            showConfirmButton: false,
                            timer: 2000
                     });
              }
       } else {
              Swal.fire({
                     position: "center",
                     icon: "error",
                     title: "Password must be between 6 and 20 characters !!",
                     showConfirmButton: false,
                     timer: 2000
              });
       }
}

// kiểm tra mật khẩu
function isVaidPassword(passWord) {
       var passwordRegex = /^[a-zA-Z\d@_-]{6,20}$/;
       return passwordRegex.test(passWord);
}