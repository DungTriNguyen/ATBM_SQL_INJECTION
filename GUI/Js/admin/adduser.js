//Ràng buộc dữ liệu nhập vào
var dataPermission = "";

function validateUser(
  usernameValue,
  passWordValue,
  confirmPassWordValue,
  dateCreatedValue,
  nameValue,
  accountStatusValue,
  addressValue,
  emailValue,
  phoneNumberValue,
  birthValue,
  sexValue,
  codePermissionsValue
) {
  console.log("okkk");
  console.log(usernameValue);

  // event.preventDefault();

  // Kiểm tra các trường có được nhập đầy đủ không
  if (
    !usernameValue ||
    !passWordValue ||
    !confirmPassWordValue ||
    !dateCreatedValue ||
    !accountStatusValue ||
    !nameValue ||
    !addressValue ||
    !emailValue ||
    !phoneNumberValue ||
    !birthValue ||
    !sexValue ||
    !codePermissionsValue
  ) {
    Swal.fire({
      icon: "error",
      title: "Lỗi",
      text: "Vui lòng điền đầy đủ thông tin",
    });
    return false;
  }

  // Kiểm tra định dạng email
  const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  if (!emailRegex.test(emailValue)) {
    Swal.fire({
      icon: "error",
      title: "Lỗi",
      text: "Email không hợp lệ",
    });
    return false;
  }

  // Kiểm tra định dạng số điện thoại
  const phoneRegex = /^0\d{9}$/;
  if (!phoneRegex.test(phoneNumberValue)) {
    Swal.fire({
      icon: "error",
      title: "Lỗi",
      text: "Số điện thoại phải có 10 chữ số và bắt đầu bằng số 0",
    });
    return false;
  }
  // Kiểm tra xem mật khẩu và mật khẩu nhập lại có khớp nhau không
  if (passWordValue !== confirmPassWordValue) {
    Swal.fire({
      icon: "error",
      title: "Mật khẩu không khớp",
      text: "Vui lòng điền lại mật khẩu",
    });
    return false;
  }
  const usernameRegex = /^[^\s@+]+$/;
  // const usernameRegex = /^[^-+=.\/?!#$%^&*@}{][^\s@+]*$/;
  if (!usernameRegex.test(usernameValue)) {
    Swal.fire({
      icon: "error",
      title: "Lỗi",
      text: "Tên đăng nhập không được chứa ký tự đặc biệt như '@' hoặc '+',...",
    });
    return false;
  }

  // Trả về true nếu tất cả các điều kiện đều thỏa mãn
  return true;
}
//Ràng buộc dữ liệu nhập vào
var dataPermission = "";

//Thêm đối tượng
async function addObj(event) {
  event.preventDefault();

  try {
    let usernameValue = document.getElementById("username").value.trim();
    let passWordValue = document.getElementById("passWord").value.trim();
    let confirmPassWordValue = document
      .getElementById("confirmPassWord")
      .value.trim(); // Lấy giá trị nhập lại mật khẩu
    let dateCreatedValue = document.getElementById("dateCreated").value.trim();
    let accountStatusValue = document
      .getElementById("accountStatus")
      .value.trim();
    let nameValue = document.getElementById("name").value.trim();
    let addressValue = document.getElementById("address").value.trim();
    let emailValue = document.getElementById("email").value.trim();
    let phoneNumberValue = document.getElementById("phoneNumber").value.trim();
    let birthValue = document.getElementById("birth").value.trim();
    let sexValue = document.getElementById("sex").value.trim();
    let codePermissionsValue = document.getElementById("codePermission").value;

    dateCreatedValue = new Date(dinhdangDate(new Date()))
      .toISOString()
      .slice(0, 10);

    if (
      !validateUser(
        usernameValue,
        passWordValue,
        confirmPassWordValue,
        dateCreatedValue,
        nameValue,
        accountStatusValue,
        addressValue,
        emailValue,
        phoneNumberValue,
        birthValue,
        sexValue,
        codePermissionsValue
      )
    ) {
      return;
    }

    console.log(usernameValue);
    console.log(passWordValue);
    let response = await fetch("../../../BLL/UserManagerBLL.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/x-www-form-urlencoded",
      },
      body:
        "function=" +
        encodeURIComponent("addObj") +
        "&username=" +
        encodeURIComponent(usernameValue) +
        "&passWord=" +
        encodeURIComponent(passWordValue) +
        "&dateCreated=" +
        encodeURIComponent(dateCreatedValue) +
        "&accountStatus=" +
        encodeURIComponent(accountStatusValue) +
        "&name=" +
        encodeURIComponent(nameValue) +
        "&address=" +
        encodeURIComponent(addressValue) +
        "&email=" +
        encodeURIComponent(emailValue) +
        "&phoneNumber=" +
        encodeURIComponent(phoneNumberValue) +
        "&birth=" +
        encodeURIComponent(birthValue) +
        "&sex=" +
        encodeURIComponent(sexValue) +
        "&codePermissions=" +
        encodeURIComponent(codePermissionsValue),
    });

    let data = await response.json();
    console.log(data);
    console.log(data.mess);
    if (data.mess === "success") {
      Swal.fire({
        title: "Thêm thành công!",
        width: 600,
        padding: "3em",
        color: "#716add",
        background: "#fff url(../../image/trees.png)",
        backdrop: `
          rgba(0,0,123,0.4)
          url("../../image/nyan-cat.gif")
          left top
          no-repeat
          
        `,
      });
    } else {
      Swal.fire({
        icon: "error",
        title: "Thêm không thành công",
        text: "Bị trùng dữ liệu",
      });
    }
  } catch (error) {
    console.error(error);
  }
}

function dinhdangDate(currentDate) {
  var year = currentDate.getFullYear();
  var month = currentDate.getMonth() + 1; // Tháng bắt đầu từ 0 nên phải cộng thêm 1
  var day = currentDate.getDate();

  return year + "-" + month + "-" + day;
}

async function getListObj() {
  try {
    // Gọi AJAX để xóa payment

    let response = await fetch("../../../BLL/ManagerUserGroupBLL.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/x-www-form-urlencoded",
      },
      body: "function=" + encodeURIComponent("getList"),
    });

    let data = await response.json();
    console.log(data);
    dataPermission = data;
    // loadDataUserGroup(data);
  } catch (error) {
    console.error(error);
  }
}

function loadDataUserGroup(data) {
  let container = document.getElementById("codePermission");
  let options = ``;
  for (let i of data) {
    let codePermission = i.codePermission;
    options += `<option value="${codePermission}">${i.namePermission}</option>`;
  }
  console.log(options);
  container.innerHTML = options;
}

window.addEventListener("load", async function () {
  // Thực hiện các hàm bạn muốn sau khi trang web đã tải hoàn toàn, bao gồm tất cả các tài nguyên như hình ảnh, stylesheet, v.v.
  console.log("Trang quản lý nhóm người dùng đã load hoàn toàn");
  await getListObj();
  loadDataUserGroup(dataPermission);
});
