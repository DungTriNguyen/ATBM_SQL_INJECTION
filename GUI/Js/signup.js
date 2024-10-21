// AJAX
async function checkUserName(userName) {

  try {

    // var username = document.getElementById('username').value;
    const response = await fetch('../../BLL/AccountBLL.php', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/x-www-form-urlencoded'
      },
      body: 'function=' + encodeURIComponent('checkUserName') + '&userName=' + encodeURIComponent(userName)
    });
    const data = await response.json();
    console.log(data);
    for (let i of data) {
      if (i.result == 'notFound') {
        return true;
      } else {
        return false;
      }
    }

  } catch (error) {
    console.error('Error:', error);
  }
}

async function signUp(userName, passWord, dateCreate, accountStatus, name, address, email, phone, datebirth, sex, codePermission) {
  try {

    // var username = document.getElementById('username').value;
    const response = await fetch('../../BLL/AccountBLL.php', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/x-www-form-urlencoded'
      },
      body: 'function=' + encodeURIComponent('addAccount') +
        '&userName=' + encodeURIComponent(userName) +
        '&passWord=' + encodeURIComponent(passWord) +
        '&dateCreate=' + encodeURIComponent(dateCreate) +
        '&accountStatus=' + encodeURIComponent(accountStatus) +
        '&name=' + encodeURIComponent(name) +
        '&address=' + encodeURIComponent(address) +
        '&email=' + encodeURIComponent(email) +
        '&phoneNumber=' + encodeURIComponent(phone) +
        '&birth=' + encodeURIComponent(datebirth) +
        '&sex=' + encodeURIComponent(sex) +
        '&codePermission=' + encodeURIComponent(codePermission)
    });
    const data = await response.json();
    console.log(data);
    for (let i of data) {
      if (i.result == 'success') {
        return true;
      } else {
        return false;
      }
    }

  } catch (error) {
    console.error('Error:', error);
  }
}




function showStep1() {
  document.getElementById('step1').style.display = 'block';
  document.getElementById('step2').style.display = 'none';
}

// Include regex for step 1
async function showStep2() {
  // Get form values
  var username = document.getElementById('username').value;
  var password = document.getElementById('password').value;
  var repeatPassword = document.getElementById('repeat-password').value;

  // Regular expressions for validation
  var usernameRegex = /^[a-zA-Z\d]{5,16}$/;
  var passwordRegex = /^[a-zA-Z\d@_-]{6,20}$/;

  // Check if the fields are filled correctly
  if (!usernameRegex.test(username)) {
    // alert('Vui lòng điền tên đăng nhập hợp lệ từ 5 đến 16 ký tự');
    Swal.fire({
      icon: "error",
      title: "Oops...",
      text: "Please enter a valid username of 5 to 16 characters!",
    });
    return false; // Stop the function if the username is not valid
  }
  if (!passwordRegex.test(password)) {
    // alert('Vui lòng điền mật khẩu hợp lệ');
    Swal.fire({
      icon: "error",
      title: "Oops...",
      text: "Please enter a valid password of 6 to 20 characters!",
    });
    return false; // Stop the function if the password is not valid
  }
  if (password !== repeatPassword) {
    // alert('Mật khẩu không trùng khớp! Vui lòng nhập lại');
    Swal.fire({
      icon: "warning",
      title: "Oops...",
      text: "Passwords do not match! Please re-enter!",
    });
    return false; // Stop the function if the passwords do not match
  }

  // check turng du lieu username
  if (await checkUserName(username) == false) {
    // alert('Tên đăng nhập đã bị trùng, xin hãy đổi tên đăng nhập khác');
    Swal.fire({
      icon: "warning",
      title: "Oops...",
      text: "The username is duplicated, please change to another username",
    });
    return false; // Stop the function if the username is not valid
  }

  // If all checks pass, hide step 1 and show step 2
  document.getElementById('step1').style.display = 'none';
  document.getElementById('step2').style.display = 'block';
}

// Regex for step 2
document.addEventListener("DOMContentLoaded", function () {
  var form = document.getElementById('registrationForm');
  form.addEventListener('submit', async function (event) {
    // Prevent form submission
    event.preventDefault();

    // Validation logic
    var username = document.getElementById('username').value;
    var password = document.getElementById('password').value;
    var name = document.getElementById('name').value;
    var email = document.getElementById('email').value;
    var phone = document.getElementById('phone').value;
    var datebirth = document.getElementById('dob').value;
    var sex = document.getElementById('gender').value;
    var address = document.getElementById('address').value;
    // Tạo một đối tượng Date mới, đại diện cho thời gian hiện tại
    var currentDate = new Date();

    // Lấy ngày, tháng và năm từ đối tượng Date
    var day = currentDate.getDate();
    var month = currentDate.getMonth() + 1; // Lưu ý: tháng trong JavaScript bắt đầu từ 0 (0 = Tháng 1)
    var year = currentDate.getFullYear();

    var dateCreate = `${year}-${month}-${day}`;

    // Regular expressions
    var nameRegex = /^[a-zA-Z\sÀÁÂÃÈÉÊÌÍÒÓÔÕÙÚĂĐĨŨƠàáâãèéêìíòóôõùúăđĩũơƯĂẠẢẤẦẨẪẬẮẰẲẴẶẸẺẼỀỀỂỄỆỈỊỌỎỐỒỔỖỘỚỜỞỠỢỤỦỨỪễệỉịọỏốồổỗộớờởỡợụủứừỬỮỰỲỴÝỶỸửữựỳỵỷỹ]+$/u
    var emailRegex = /^[A-Za-z0-9._%+-]+@gmail\.com$/
    var phoneRegex = /^\d{10}$/;

    // Validation checks
    if (!nameRegex.test(name)) {
      // alert('Tên không hợp lệ');
      Swal.fire({
        icon: "error",
        title: "Oops...",
        text: "Invalid name !",
      });
      return false;
    }
    if (!emailRegex.test(email)) {
      // alert('Email không hợp lệ');
      Swal.fire({
        icon: "error",
        title: "Oops...",
        text: "Invalid email !",
      });
      return false;
    }
    if (!phoneRegex.test(phone)) {
      // alert('Số điện thoại không hợp lệ');
      Swal.fire({
        icon: "error",
        title: "Oops...",
        text: "Invalid phone !",
      });
      return false;
    }
    // If all validations pass

    if (await signUp(username, password, dateCreate, '1', name, address, email, phone, datebirth, sex, 'user') == true) {
      // alert('Đăng ký thành công');
      await Swal.fire({
        position: "center",
        icon: "success",
        title: "Signup Success",
        showConfirmButton: false,
        timer: 2000
      });
      window.location.href = "../../GUI/view/login.php";

    } else {
      // alert('Đăng ký thất bại');
      Swal.fire({
        icon: "error",
        title: "Oops...",
        text: "Signup failed !",
      });
    }
  });
});


// chi thucj hien hanh dong khi trang load xong
window.addEventListener('load', function () {
  // Thực hiện các hàm bạn muốn sau khi trang web đã tải hoàn toàn, bao gồm tất cả các tài nguyên như hình ảnh, stylesheet, v.v.
  console.log('Trang Sign up đã load hoàn toàn');
});
