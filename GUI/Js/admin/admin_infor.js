// ----------------------------- AJAX load du lieu len
async function getInfor() {
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

                     await showInfor(result.userName, result.passWord, result.dateCreate, result.dateBirth, result.name, result.email, result.phoneNumber, result.sex, result.address);



              } else {
                     window.location.href = "../../../GUI/view/Login.php";
              }
       } catch (error) {
              console.error('Error:', error);
       }
}
getInfor()

async function showInfor(username, passWord, dateCreate, dateBirth, name, email, phone, sex, address, codePermission) {

       // username
       document.getElementById('username').value = username;

       //name
       document.getElementById('name').value = name;

       // email
       document.getElementById('mail').value = email;

       //phone
       document.getElementById('phone').value = phone;

       //sex
       if (sex == 'Male') {
              document.getElementById('gender').innerHTML = `
                     <label class="mb-1 fs-5" for="">Giới tính</label>
                     <select id="sex" class="form-control" name="sex" >
                     <option value="Male" selected >Nam</option>
                     <option value="Female">Nữ</option>
                     </select>
              `;
       } else {
              document.getElementById('gender').innerHTML = `
                     <label class="mb-1 fs-5" for="">Giới tính</label>
                     <select id="sex" class="form-control" name="sex" >
                     <option value="Male"  >Nam</option>
                     <option value="Female" selected>Nữ</option>
                     </select>
              `;
       }

       //address
       document.getElementById('address').value = address;

       // await submitChangeInfor(username,passWord,dateCreate,dateBirth,name,email,phone,sex,address,codePermission);

}


// lấy password cũ
async function getPassWord() {
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
              // console.log(result);

              if (result.result == 'success') {
                     return result.passWord;
              } else {
                     window.location.href = "../../GUI/view/Login.php";
              }
       } catch (error) {
              console.error('Error:', error);
       }
}

// lấy dateCreate cũ
async function getDateCreate() {
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
              // console.log(result);

              if (result.result == 'success') {
                     return result.dateCreate;
              } else {
                     window.location.href = "../../GUI/view/Login.php";
              }
       } catch (error) {
              console.error('Error:', error);
       }
}

// lấy dateBirth cũ
async function getDateBirth() {
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
              // console.log(result);

              if (result.result == 'success') {
                     return result.birth;
              } else {
                     window.location.href = "../../GUI/view/Login.php";
              }
       } catch (error) {
              console.error('Error:', error);
       }
}

// lấy codePermisison cũ
async function getCodePermission() {
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
              // console.log(result);

              if (result.result == 'success') {
                     return result.codePermission;
              } else {
                     window.location.href = "../../GUI/view/Login.php";
              }
       } catch (error) {
              console.error('Error:', error);
       }
}




async function submitChangeInfor(event) {

       event.preventDefault();


       let userName = document.getElementById('username').value;
       let passWord = await getPassWord();
       let dateCreate = await getDateCreate();
       let dateBirth = await getDateBirth();
       let nameChange = document.getElementById('name').value;
       let emailChange = document.getElementById('mail').value;
       let addressChange = document.getElementById('address').value;
       let phoneNumberChange = document.getElementById('phone').value;
       let codePermission = await getCodePermission();
       let sexChange = document.getElementById('sex').value;

       // console.log(sexChange);

       if (nameChange != '' && addressChange != '' && isValidGmail(emailChange) == true && isValidPhoneNumber(phoneNumberChange) == true) {
              const response = await fetch('../../../BLL/AccountBLL.php', {
                     method: 'POST',
                     headers: {
                            'Content-Type': 'application/x-www-form-urlencoded'
                     },
                     body:
                            'function=' + encodeURIComponent('updateAccount') + '&userName=' + encodeURIComponent(userName) + '&passWord=' + encodeURIComponent(passWord) + '&dateCreate=' + encodeURIComponent(dateCreate) + '&accountStatus=' + encodeURIComponent('1') + '&name=' + encodeURIComponent(nameChange) + '&address=' + encodeURIComponent(addressChange) + '&email=' + encodeURIComponent(emailChange) + '&phoneNumber=' + encodeURIComponent(phoneNumberChange) + '&birth=' + encodeURIComponent(dateBirth) + '&sex=' + encodeURIComponent(sexChange) + '&codePermission=' + encodeURIComponent(codePermission)
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
                     text: "Cần nhập thông tin đúng định dạng",
              });
       }

}

// check format email
function isValidGmail(email) {
       // Biểu thức chính quy để kiểm tra định dạng
       const gmailRegex = /^[a-zA-Z0-9._%+-]+@gmail.com$/;

       // Sử dụng test() để kiểm tra email với biểu thức chính quy
       return gmailRegex.test(email);
}
// check phonenumber
function isValidPhoneNumber(phoneNumber) {
       // Sử dụng biểu thức chính quy để kiểm tra số điện thoại
       const isVNPhoneMobile =
              /^(0|\+84)(\s|\.)?((3[2-9])|(5[689])|(7[06-9])|(8[1-689])|(9[0-46-9]))(\d)(\s|\.)?(\d{3})(\s|\.)?(\d{3})$/;

       // Kiểm tra xem số điện thoại phù hợp với biểu thức chính quy không
       return isVNPhoneMobile.test(phoneNumber);
}
