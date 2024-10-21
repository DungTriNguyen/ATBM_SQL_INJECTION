// ----------------------------- AJAX load du lieu len
async function getInforPass() {
       try {
              const response = await fetch('../../../BLL/AccountBLL.php', {
                     method: 'POST',
                     headers: {
                            'Content-Type': 'application/x-www-form-urlencoded'
                     },
                     body:
                            'function=' + encodeURIComponent('checkLogin')
              });
              const data = await response.json();
              let result = data[0];
              console.log(result);

              if (result.result == 'success') {

                     console.log(result.passWord);

                     return result.passWord;

              } else {
                     window.location.href = "../../../GUI/view/Login.php";
              }
       } catch (error) {
              console.error('Error:', error);
       }
}
getInforPass();

async function getInforUser() {
       try {
              const response = await fetch('../../../BLL/AccountBLL.php', {
                     method: 'POST',
                     headers: {
                            'Content-Type': 'application/x-www-form-urlencoded'
                     },
                     body:
                            'function=' + encodeURIComponent('checkLogin')
              });
              const data = await response.json();
              let result = data[0];
              console.log(result);

              if (result.result == 'success') {


                     return result;

              } else {
                     window.location.href = "../../../GUI/view/Login.php";
              }
       } catch (error) {
              console.error('Error:', error);
       }
}

async function submitChangePass(event) {
       event.preventDefault();

       let dataPass = await getInforPass();
       let passEnter = document.getElementById('password').value;

       if (dataPass == passEnter) {
              // kiem tra dinh dang
              let newPass = document.getElementById('new_password').value;
              let repeatPass = document.getElementById('repeat_password').value;

              if (isVaidPassword(newPass)) {
                     // kiem tra mat khau nhap lai
                     if (newPass === repeatPass) {

                            let dataUser = await getInforUser();
                            let userName = dataUser.userName;
                            let passWord = dataUser.passWord;
                            let name = dataUser.name;
                            let dateCreate = dataUser.dateCreate;
                            let birth = dataUser.birth;
                            let sex = dataUser.sex;
                            let phoneNumber = dataUser.phoneNumber;
                            let email = dataUser.email;
                            let codePermission = dataUser.codePermission;
                            let accountStatus = dataUser.accountStatus;
                            let address = dataUser.address;

                            const response = await fetch('../../../BLL/AccountBLL.php', {
                                   method: 'POST',
                                   headers: {
                                          'Content-Type': 'application/x-www-form-urlencoded'
                                   },
                                   body:
                                          'function=' + encodeURIComponent('updateAccount') + '&userName=' + encodeURIComponent(userName) + '&passWord=' + encodeURIComponent(newPass) + '&dateCreate=' + encodeURIComponent(dateCreate) + '&accountStatus=' + encodeURIComponent(accountStatus) + '&name=' + encodeURIComponent(name) + '&address=' + encodeURIComponent(address) + '&email=' + encodeURIComponent(email) + '&phoneNumber=' + encodeURIComponent(phoneNumber) + '&birth=' + encodeURIComponent(birth) + '&sex=' + encodeURIComponent(sex) + '&codePermission=' + encodeURIComponent(codePermission)
                            });
                            const data = await response.json();

                            console.log(data);

                            if (data.mess == 'success') {
                                   await Swal.fire({
                                          position: "center",
                                          icon: "success",
                                          title: "Cập nhật thành công, Bạn cần phải đăng nhập lại để cập nhật thông tin mới !!",
                                   });
                                   // gọi đăng xuất
                                   try {
                                          const response = await fetch('../../../BLL/AccountBLL.php', {
                                                 method: 'POST',
                                                 headers: {
                                                        'Content-Type': 'application/x-www-form-urlencoded'
                                                 },
                                                 body: 'function=' + encodeURIComponent('logout_whenExitPage')
                                          });
                                          const data = await response.json();

                                          if (data.length == 0) {
                                                 window.location.href = "../../../GUI/view/login.php";
                                          }

                                   } catch (error) {
                                          console.error('Error:', error);
                                   }

                            } else {
                                   await Swal.fire({
                                          icon: "error",
                                          title: "Oops...",
                                          text: "Cập nhật thất bại",
                                   });
                            }

                     } else {
                            await Swal.fire({
                                   icon: "error",
                                   title: "Oops...",
                                   text: "Mật khẩu nhập lại không trùng khớp với mật khẩu mới !!",
                            });
                     }
              } else {
                     await Swal.fire({
                            icon: "error",
                            title: "Oops...",
                            text: "Mật khẩu từ 6 đến 20 ký tự !!",
                     });
              }
       } else {
              await Swal.fire({
                     icon: "error",
                     title: "Oops...",
                     text: "Không nhập đúng mật khẩu hiện tại !!",
              });
       }

}

// kiểm tra mật khẩu
function isVaidPassword(passWord) {
       var passwordRegex = /^[a-zA-Z\d@_-]{6,20}$/;
       return passwordRegex.test(passWord);
}
