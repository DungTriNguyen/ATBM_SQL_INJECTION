// location.reload();
// ------------------------------------- AJAX LOGIN ---------------------------------------------
async function Login(event) {
  event.preventDefault();
  try {
    let userName = document.getElementById("userNameInput").value;
    let passWord = document.getElementById("passWordInput").value;
    // checkFormLogin()
    if (true) {
      const response = await fetch("../../BLL/AccountBLL.php", {
        method: "POST",
        headers: {
          "Content-Type": "application/x-www-form-urlencoded",
        },
        body:
          "function=" +
          encodeURIComponent("login") +
          "&userName=" +
          encodeURIComponent(userName) +
          "&passWord=" +
          encodeURIComponent(passWord),
      });
      const data = await response.json();

      let user = data[0];

      // Hiển thị thông báo tùy thuộc vào kết quả đăng nhập
      if (user.result == "success") {
        // alert('Đăng nhập thành công');
        // Nếu là tài khoản user
        if (user.codePermission == "user") {
          await Swal.fire({
            position: "center",
            icon: "success",
            title: "Login Success",
            showConfirmButton: false,
            timer: 2000,
          });
          window.location.href = "../../GUI/view/HomePage.php";
        }
        // Nếu tài khoản khác với user
        else {
          await Swal.fire({
            title: "Do you want to log in with administrator rights?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, I want!",
          }).then(async (result) => {
            if (result.isConfirmed) {
              await Swal.fire({
                position: "center",
                icon: "success",
                title: "Login Success",
                showConfirmButton: false,
                timer: 2000,
              });
              window.location.href = "../../GUI/view/admin/Tongquan.php";
            }
          });
        }
      } else if (user.result == "block") {
        // alert('Tài khoản của bạn bị khóa, vui lòng liên hệ với quản trị viên để mở khóa');
        Swal.fire({
          icon: "error",
          title: "Oops...",
          text: "Your account is locked, please contact the administrator to unlock it !",
        });
      } else if (user.result == "wrongPass") {
        // alert('Sai mật khẩu');
        Swal.fire({
          icon: "error",
          title: "Oops...",
          text: "Wrong Password!",
        });
      } else if (user.result == "notFound") {
        Swal.fire({
          icon: "error",
          title: "Oops...",
          text: "Account not found!",
          footer: `Don't have account ? <a href="../../GUI/view/signup.php">Sign up</a>`,
        });
        // alert('Không tìm thấy tài khoản');
      }
    }
    // showProductItem(data);
  } catch (error) {
    console.error("Error:", error);
  }
}

// Set up hàm js để tấn công
// async function Login(event) {
//   event.preventDefault();
//   try {
//     let userName = document.getElementById("userNameInput").value;
//     let passWord = document.getElementById("passWordInput").value;
//     // Bỏ qua việc kiểm tra form để dễ dàng thực hiện tấn công
//     // Bằng cách nhập `' OR '1'='1` vào các trường đầu vào
//     const response = await fetch("../../BLL/AccountBLL.php", {
//       method: "POST",
//       headers: {
//         "Content-Type": "application/x-www-form-urlencoded",
//       },
//       body:
//         "function=" +
//         encodeURIComponent("login") +
//         "&userName=" +
//         encodeURIComponent(userName) +
//         "&passWord=" +
//         encodeURIComponent(passWord),
//     });
//     const data = await response.json();
//     // console.log(data[3]);
//     // const responseText = await response.text(); // Thay vì dùng response.json()
//     // console.log(responseText); // Kiểm tra nội dung trả về
//     // const data = JSON.parse(responseText);
//     // console.log("mess=>ok");
//     if (data && data.length > 0) {
//       let user = data[0];
//       if (user.result == "success") {
//         Swal.fire({
//           position: "center",
//           icon: "success",
//           title: "Logged in successfully!",
//           showConfirmButton: false,
//           timer: 2000,
//         });
//         // Điều hướng sau khi đăng nhập thành công
//         window.location.href = "../../GUI/view/HomePage.php";
//       } else {
//         Swal.fire({
//           icon: "error",
//           title: "Oops...",
//           text: "Login failed!",
//         });
//       }
//     } else {
//       Swal.fire({
//         icon: "error",
//         title: "Oops...",
//         text: "Invalid response from server!",
//       });
//     }
//   } catch (error) {
//     console.error("Error:", error);
//   }
// }

// window.addEventListener('load', function () {
//        // Xử lý khi toàn bộ trang đã được tải xong
//        console.log('Toàn bộ trang đã được tải xong');
//        checkLogin();
// });
// ------------------------------------------- AJAX kiểm tra đăng nhập -----------------------------------------------
async function checkLogin() {
  // location.reload();
  try {
    const response = await fetch("../../BLL/AccountBLL.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/x-www-form-urlencoded",
      },
      body: "function=" + encodeURIComponent("checkLogin"),
    });
    const data = await response.json();

    console.log(data);
    let user = data[0];
    if (user.result == "success") {
      // window.location.href = "../../GUI/view/HomePage.php";
      if (user.codePermission == "user") {
        window.location.href = "../../GUI/view/HomePage.php";
      }
      // Nếu tài khoản khác với user
      else {
        window.location.href = "../../GUI/view/admin/Tongquan.php";
      }
    }
    // for (let i of data) {
    //        console.log(i);
    // }
    // showProductItem(data);
  } catch (error) {
    console.error("Error:", error);
  }
}

// checkLogin();
function checkFormLogin() {
  let userName = document.getElementById("userNameInput").value;
  let passWord = document.getElementById("passWordInput").value;
  // Regular expressions for validation
  var usernameRegex = /^[a-zA-Z\d]{5,16}$/;
  var passwordRegex = /^[a-zA-Z\d@_-]{6,20}$/;

  // Check if the fields are filled correctly
  if (!usernameRegex.test(userName)) {
    // alert('Vui lòng điền tên đăng nhập hợp lệ từ 5 đến 16 ký tự');
    Swal.fire({
      icon: "error",
      title: "Oops...",
      text: "Please enter a valid username of 5 to 16 characters!",
    });
    return false; // Stop the function if the username is not valid
  }
  if (!passwordRegex.test(passWord)) {
    // alert('Vui lòng điền mật khẩu hợp lệ');
    Swal.fire({
      icon: "error",
      title: "Oops...",
      text: "Please enter a valid password between 6 and 20 characters!",
    });
    return false; // Stop the function if the password is not valid
  }
  return true;
}

// chỉ thực hiện các hàm khi trang web đã load xong

window.addEventListener("load", function () {
  // Thực hiện các hàm bạn muốn sau khi trang web đã tải hoàn toàn, bao gồm tất cả các tài nguyên như hình ảnh, stylesheet, v.v.
  console.log("Trang Login đã load hoàn toàn");
  checkLogin();
});
