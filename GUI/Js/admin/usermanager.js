// ------------------------------------------- AJAX kiểm tra đăng nhập -----------------------------------------------
async function checkLogin_usermanager() {
  try {
    const response = await fetch("../../../BLL/AccountBLL.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/x-www-form-urlencoded",
      },
      body: "function=" + encodeURIComponent("checkLogin"),
    });
    const data = await response.json();
    console.log(data);
    let result = data[0];
    if (result.result == "success" && result.codePermission != "user") {
      // getDataPermission_payment(result.codePermission);
      return result.codePermission;
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

async function getDataPermission_usermanager(codePermission) {
  try {
    const response = await fetch("../../../BLL/ManagerUserGroupBLL.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/x-www-form-urlencoded",
      },
      body:
        "function=" +
        encodeURIComponent("getArrPermissionDetail") +
        "&codePermission=" +
        encodeURIComponent(codePermission),
    });
    const data = await response.json();
    console.log(data);

    if (data != null) {
      // checkUpPermission_payment(data.permissionDetail,codePermission,"");
      return data;
    }
  } catch (error) {
    console.error("Error:", error);
  }
}

// setup các chức năng được truy cập
function checkUpPermission_usermanager(dataPermissionDetail, functionPoint) {
  if (functionPoint == "") {
    return false;
  }

  for (let item of dataPermissionDetail) {
    if (item.functionCode == "account") {
      console.log("Phan quyen");
      // thêm
      if (item.addPermission == "1" && functionPoint == "add") {
        console.log("Được phép thêm");
        return true;
      } else if (item.addPermission != "1" && functionPoint == "add") {
        console.log("Không Được phép thêm");
        return false;
      }
      // sửa
      if (item.fixPermission == "1" && functionPoint == "update") {
        console.log("Được phép sửa");
        return true;
      } else if (item.fixPermission != "1" && functionPoint == "update") {
        console.log("Không Được phép sửa");
        return false;
      }

      // xóa
      if (item.deletePermission == "1" && functionPoint == "delete") {
        console.log("Được phép xóa");
        return true;
      } else if (item.deletePermission != "1" && functionPoint == "delete") {
        console.log("Không Được phép xóa");
        return false;
      }
    }
  }
}

var dataPermission = "";
//Lấy danh sách đối tượng
async function getListObj() {
  try {
    // Gọi AJAX để xóa payment

    let response = await fetch("../../../BLL/UserManagerBLL.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/x-www-form-urlencoded",
      },
      body: "function=" + encodeURIComponent("getList"),
    });
    let data = await response.json();
    console.log(data);
    await loadData(data);
    loadPage();
  } catch (error) {
    console.error(error);
  }
}

//lấy dữ liệu từ kết quả  rearch
function searchAccount() {
  document.getElementById("input-search-account").oninput = async function () {
    try {
      // Gọi AJAX để xóa payment
      let str = document
        .getElementById("input-search-account")
        .value.trim()
        .toLowerCase();
      let response = await fetch("../../../BLL/UserManagerBLL.php", {
        method: "POST",
        headers: {
          "Content-Type": "application/x-www-form-urlencoded",
        },
        body:
          "function=" +
          encodeURIComponent("searchAccount") +
          "&str=" +
          encodeURIComponent(str),
      });

      let data = await response.json();
      if (data.length == 0) {
        console.log("Không có dữ liệu");

        document.querySelector("#Pagination").style.display = "none";
        loadData(data);
      } else {
        loadData(data);
        document.querySelector("#Pagination").style.display = "flex";
        loadItem(1, 4);
      }
      console.log(data);

      loadPage();
    } catch (error) {
      console.error(error);
    }
  };
}

async function loadData(data) {
  let container = document.getElementById("danhsachUser");
  let container1 = document.getElementById("delete-User");
  let container2 = document.getElementById("edit-User");
  let result = ``;
  let result1 = ``;
  let result2 = ``;
  let stt = 1;

  for (let i of data) {
    let username = i.username;
    let passWord = i.passWord;
    let dateCreated = i.dateCreated;
    let accountStatus = i.accountStatus;
    let name = i.name;
    let email = i.email;
    let phoneNumber = i.phoneNumber;
    let birth = i.birth;
    let sex = i.sex;
    let codePermissions = i.codePermissions;
    let strStt = "";
    if (i.accountStatus == "1") {
      strStt = `<td><a class="btn btn-sm btn-primary" title="Click để ẩn bình luận" onclick="updateStateUser('${i.username}','${i.accountStatus}',event)"> Đang kích hoạt <i class="fa fa-eye"></i></a></td>`;
    } else {
      strStt = `<td><a class="btn btn-sm btn-danger" title="Click để hiện bình luận" onclick="updateStateUser('${i.username}','${i.accountStatus}',event)"> Đang bị khóa <i class="fa fa-eye-slash"></i></a></td>`;
    }

    let String = `
    <tr>
       <td>${stt}</td>
       <td>${username}</td>
       <td>${name}</td>
       <td>${email}</td>
       <td>${phoneNumber}</td>
       ${strStt}
       <td><a href="#" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editUser-${i.username}"><i class="fa fa-edit"></i></a></td>
       <td><a href="#" class="delete-button" data-bs-toggle="modal" data-bs-target="#deleteUser-${i.username}"><i class="fa fa-trash"></i>Xóa</a></td>
    </tr>
          
      `;
    let String1 = `
    <div class="modal fade" id="deleteUser-${i.username}" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Xóa người dùng</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Bạn có chắc muốn xóa người dùng này?
                <br>
                Mã người dùng: ${i.username}
                <br>
                Tên người dùng: ${i.name}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                <button type="button" data-bs-dismiss="modal" class="btn btn-danger btn-confirm-delete" onclick="deleteByID('${i.username}')">Xóa</button>
            </div>
        </div>
    </div>
</div>

      `;
    let String2 = `
    <div class="modal fade" id="editUser-${
      i.username
    }" tabindex="-1" aria-labelledby="editModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Sửa thông tin người dùng</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editForm">
                    <div class="mb-3">
                        <label for="name" class="form-label">Tên đăng nhập</label>
                        <input type="text" class="form-control" id="${
                          i.username
                        }" value="${i.username}"
                            name="codeSupplier" placeholder="NCC001" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">Mật khấu</label>
                        <div class="input-group">
                        <input type="password" class="form-control" id="${
                          i.username
                        }-${i.passWord}"
                            value="${
                              i.passWord
                            }" name="passWord" aria-describedby="togglePassword">
                          <div class="input-group-append">
                            <button class="btn btn-outline-secondary" type="button" class="togglePassword" onclick="togglePasswordVisibility('${
                              i.username
                            }-${i.passWord}')">Show</button>
                          </div>
                        
                        </div>
                    </div>
                    <input type="hidden" class="form-control" id="${
                      i.username
                    }-${i.dateCreated}"
                        value="${i.dateCreated}" name="dateCreated">
                    <div class="mb-3">
                        <label for="name" class="form-label">Họ và tên</label>
                        <input type="text" class="form-control" id="${
                          i.username
                        }-${i.name}" value="${i.name}"
                            name="name">
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label">Địa chỉ</label>
                        <input type="text" class="form-control" id="${
                          i.username
                        }-${i.address}"
                            value="${i.address}" name="address">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="${
                          i.username
                        }-${i.email}"
                            value="${i.email}" name="email">
                    </div>
                    <div class="mb-3">
                        <label for="phoneNumber" class="form-label">Số điện thoại</label>
                        <input class="form-control" id="${i.username}-${
      i.phoneNumber
    }" value="${i.phoneNumber}"
                            name="phoneNumber">
                    </div>
                    <div class="mb-3">
                        <label for="brandsuppliers" class="form-label">Ngày sinh</label>
                        <input type="date" class="form-control" id="${
                          i.username
                        }-${i.birth}" value="${i.birth}"
                            name="birth">
                    </div>
                    <div class="mb-3">
                        <label for="brandsuppliers" class="form-label">Giới tính</label>
                        ${stringSelectorSex(sex, username)}
                    </div>
                    <div class="mb-3">
                        <label for="brandsuppliers" class="form-label">Nhóm người dùng</label>
                        ${stringSelectorPermission(
                          dataPermission,
                          codePermissions,
                          username
                        )}
                    </div>
                    <div class="mb-3">
                        <label for="brandsuppliers" class="form-label">Trạng thái</label>
                        ${stringSelectorStatus(accountStatus, username)}
                    </div>
                    <div style="text-align:right;">
                        <button type="submit" data-bs-dismiss="modal" class="btn btn-primary"
                            onclick="updateObj('${i.username}', '${
      i.username
    }-${i.passWord}', '${i.username}-${i.dateCreated}','${i.username}-${
      i.accountStatus
    }','${i.username}-${i.name}','${i.username}-${i.address}','${i.username}-${
      i.email
    }','${i.username}-${i.phoneNumber}','${i.username}-${i.birth}','${
      i.username
    }-${i.sex}','${i.username}-${i.codePermissions}',event)">Sửa
                            người dùng</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
    
      `;
    // console.log(String);
    result += String;
    result1 += String1;
    result2 += String2;
    stt++;
  }
  // console.log(result);
  container.innerHTML = result;
  container1.innerHTML = result1;
  // console.log(result1);
  container2.innerHTML = result2;
  // console.log(result2);
}
// hiển thị password
function togglePasswordVisibility(inputId) {
  var passwordInput = document.getElementById(inputId);
  var toggleButton = document.getElementById("togglePassword");

  if (passwordInput.type === "password") {
    passwordInput.type = "text";
    toggleButton.textContent = "Hide";
  } else {
    passwordInput.type = "password";
    toggleButton.textContent = "Show";
  }
}

async function getListUserGr() {
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

function stringSelectorPermission(dataPermission, codePermission, username) {
  console.log(dataPermission);
  var string1 = `<select style="border-radius: 5px;
  border: 1px solid #d1c9c9;
  padding: 13px 7px;
  width: 100%;
  display: block;" id="${username}-${codePermission}" name="${username}-${codePermission}">`;
  for (let i of dataPermission) {
    if (i.codePermission === codePermission) {
      string1 += `<option selected value="${i.codePermission}">${i.namePermission}</option>`;
    } else {
      string1 += `<option  value="${i.codePermission}">${i.namePermission}</option>`;
    }
  }
  string1 += `</select>`;
  // console.log("KOKOKOKOKO");
  // console.log(string1);
  return string1;
}

function stringSelectorSex(sex, username) {
  var string = `<select style="border-radius: 5px;
  border: 1px solid #d1c9c9;
  padding: 13px 7px;
  width: 100%;
  display: block;" id="${username}-${sex}" name="${username}-${sex}">`;
  if (sex === "nam" || sex === "Nam" || sex === "Male" || sex === "male") {
    string += `<option selected value="Nam">Nam</option> <option  value="Nữ">Nữ</option>`;
  } else {
    string += `<option selected value="Nữ">Nữ</option> <option  value="Nam">Nam</option>`;
  }
  string += `</select>`;
  return string;
}

function stringSelectorStatus(accountStatus, username) {
  var string = `<select style="border-radius: 5px;
  border: 1px solid #d1c9c9;
  padding: 13px 7px;
  width: 100%;
  display: block;" id="${username}-${accountStatus}" name="${username}-${accountStatus}">`;
  if (accountStatus === "1") {
    string += `<option selected value="1">Kích hoạt</option> <option  value="0">Chưa kích hoạt</option>`;
  } else {
    string += `<option selected value="0">Chưa kích hoạt</option> <option  value="1">Kích hoạt</option>`;
  }
  string += `</select>`;
  return string;
}

// Lấy một đối tượng bằng id
async function getObj() {
  try {
    // Gọi AJAX để xóa payment

    let response = await fetch("../../../BLL/UserManagerBLL.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/x-www-form-urlencoded",
      },
      body:
        "function=" +
        encodeURIComponent("getObj") +
        "&username=" +
        encodeURIComponent(obj.username),
    });

    let data = await response.json();
    console.log(data);
  } catch (error) {
    console.error(error);
  }
}

//Xóa một đối tượng
async function deleteByID(code) {
  // lấy thông tin mã  codePermission của người đăng nhập
  let codePermission = await checkLogin_usermanager();
  // lấy mảng chi tiết phân quyền dựa theo mã phân quyền của người đăng nhập
  let data = await getDataPermission_usermanager(codePermission);
  // lấy thông tin có được phép làm chức ăng đó không
  let check = checkUpPermission_usermanager(data.permissionDetail, "delete");

  if (check == true) {
    try {
      // Gọi AJAX để xóa payment

      let response = await fetch("../../../BLL/UserManagerBLL.php", {
        method: "POST",
        headers: {
          "Content-Type": "application/x-www-form-urlencoded",
        },
        body:
          "function=" +
          encodeURIComponent("deleteByID") +
          "&username=" +
          encodeURIComponent(code),
      });
      let data = await response.json();
      console.log(data);

      if (data.mess === "success") {
        Swal.fire({
          position: "center",
          icon: "success",
          title: "Đã xóa tài khoản người dùng thành công",
          showConfirmButton: false,
          timer: 1500,
        });
        await getListObj();
      } else {
        Swal.fire({
          icon: "error",
          title: "Không cho phép xóa",
          text: "Bị ràng buộc dữ liệu",
          timer: 1500,
        });
      }
    } catch (error) {
      console.error(error);
    }
  } else {
    Swal.fire({
      icon: "error",
      title: "Xóa không thành công",
      text: "Không đủ quyền hàng",
    });
  }
}

// thêm một đối tương
async function addObj(event) {
  // lấy thông tin mã  codePermission của người đăng nhập
  let codePermission = await checkLogin_usermanager();
  // lấy mảng chi tiết phân quyền dựa theo mã phân quyền của người đăng nhập
  let data = await getDataPermission_usermanager(codePermission);
  // lấy thông tin có được phép làm chức ăng đó không
  let check = checkUpPermission_usermanager(data.permissionDetail, "add");

  if (check == true) {
    window.location.href = "../../../GUI/view/admin/tongquanthemQLND.php";
  } else {
    event.preventDefault();
    Swal.fire({
      icon: "error",
      title: "Thêm không thành công",
      text: "Không đủ quyền hàng",
    });
  }
}

//Sửa một đối tượng
async function updateObj(
  username,
  passWord,
  dateCreated,
  accountStatus,
  name,
  address,
  email,
  phoneNumber,
  birth,
  sex,
  codePermissions,
  event
) {
  event.preventDefault();

  // lấy thông tin mã  codePermission của người đăng nhập
  let codePermission = await checkLogin_usermanager();
  // lấy mảng chi tiết phân quyền dựa theo mã phân quyền của người đăng nhập
  let data = await getDataPermission_usermanager(codePermission);
  // lấy thông tin có được phép làm chức ăng đó không
  let check = checkUpPermission_usermanager(data.permissionDetail, "update");

  if (check == true) {
    let usernameValue = document.getElementById(username).value.trim();
    let passWordValue = document.getElementById(passWord).value.trim();
    let dateCreatedValue = document.getElementById(dateCreated).value.trim();
    let accountStatusValue = document
      .getElementById(accountStatus)
      .value.trim();
    let nameValue = document.getElementById(name).value.trim();
    let addressValue = document.getElementById(address).value.trim();
    let emailValue = document.getElementById(email).value.trim();
    let phoneNumberValue = document.getElementById(phoneNumber).value.trim();
    let birthValue = document.getElementById(birth).value.trim();
    let sexValue = document.getElementById(sex).value.trim();
    let codePermissionsValue = document
      .getElementById(codePermissions)
      .value.trim();
    console.log(usernameValue);
    console.log(passWordValue);
    console.log(phoneNumberValue);

    if (
      !usernameValue ||
      !passWordValue ||
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
        footer: '<a href="#"></a>',
      });
      await getListObj();
      return;
    }

    // Kiểm tra định dạng email
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(emailValue)) {
      Swal.fire({
        icon: "error",
        title: "Lỗi",
        text: "Email không hợp lệ",
        footer: '<a href="#"></a>',
      });
      await getListObj();
      return;
    }

    // Kiểm tra định dạng số điện thoại
    const phoneRegex = /^\d{10,11}$/;
    if (!phoneRegex.test(phoneNumberValue)) {
      Swal.fire({
        icon: "error",
        title: "Lỗi",
        text: "Số điện thoại phải có 10 chữ số",
        footer: '<a href="#"></a>',
      });
      await getListObj();
      return;
    }
    // Kiểm tra xem mật khẩu và mật khẩu nhập lại có khớp nhau không

    const usernameRegex = /^[^\s@+]+$/;
    if (!usernameRegex.test(usernameValue)) {
      Swal.fire({
        icon: "error",
        title: "Lỗi",
        text: "Tên đăng nhập không được chứa ký tự đặc biệt như '@' hoặc '+',...",
        footer: '<a href="#"></a>',
      });
      await getListObj();
      return;
    }

    try {
      // Gọi AJAX để sửa đối tượng
      let response = await fetch("../../../BLL/UserManagerBLL.php", {
        method: "POST",
        headers: {
          "Content-Type": "application/x-www-form-urlencoded",
        },
        body:
          "function=" +
          encodeURIComponent("updateObj") +
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
      if (data.mess === "success") {
        Swal.fire({
          position: "center",
          icon: "success",
          title: "Sửa thông tin người dùng thành công",
          showConfirmButton: false,
          timer: 1500,
        });
        await getListObj();
      }
    } catch (error) {
      console.error(error);
    }
  } else {
    Swal.fire({
      icon: "error",
      title: "Sửa không thành công",
      text: "Không đủ quyền hàng",
    });
  }
}
//Hàm thay đổi trạng thái
async function updateStateUser(userName, accountStatus, event) {
  event.preventDefault();

  // lấy thông tin mã  codePermission của người đăng nhập
  let codePermission = await checkLogin_usermanager();
  // lấy mảng chi tiết phân quyền dựa theo mã phân quyền của người đăng nhập
  let data = await getDataPermission_usermanager(codePermission);
  // lấy thông tin có được phép làm chức ăng đó không
  let check = checkUpPermission_usermanager(data.permissionDetail, "update");

  if (check == true) {
    try {
      const response = await fetch("../../../BLL/UserManagerBLL.php", {
        method: "POST",
        headers: {
          "Content-Type": "application/x-www-form-urlencoded",
        },
        body:
          "function=" +
          encodeURIComponent("updateStateUser") +
          "&userName=" +
          encodeURIComponent(userName) +
          "&accountStatus=" +
          encodeURIComponent(accountStatus),
      });

      const data = await response.json();
      console.log(data);
      if (data.mess === "success") {
        await getListObj();
      }
    } catch (error) {
      console.error("Error:", error);
    }
  } else {
    Swal.fire({
      icon: "error",
      title: "Sửa không thành công",
      text: "Không đủ quyền hàng",
    });
  }
}

//phần phân trang

function loadItem(thisPage, limit) {
  // tính vị trí bắt đầu và kêt thúc
  let beginGet = limit * (thisPage - 1);
  let endGet = limit * thisPage - 1;

  // lấy tất cả các dòng dữ liệu có trong bảng
  let all_data_rows = document.querySelectorAll("#danhsachUser > tr");

  all_data_rows.forEach((item, index) => {
    if (index >= beginGet && index <= endGet) {
      item.style.display = "table-row";
    } else {
      item.style.display = "none";
    }
  });

  // hàm tính có bao nhieu nút chuyển trang
  listPage(thisPage, limit, all_data_rows);
  // loadPage();
}

function listPage(thisPage, limit, all_data_rows) {
  let result = "";
  let count = Math.ceil(all_data_rows.length / limit);
  // thêm nút prev

  if (thisPage != 1) {
    let string = `<li class="page-item" onclick="loadItem(${
      Number(thisPage) - 1
    },${limit})"><a class="page-link">Previous</a></li>`;
    result += string;
  } else if (thisPage == 1) {
    let string = `<li class="page-item disabled" style="cursor: default;"><a class="page-link">Previous</a></li>`;
    result += string;
  }

  // tính xem có bao nhieu nút

  // lấy container chứa nút phân trang
  let container = document.getElementById("Pagination");

  for (let i = 1; i <= count; i++) {
    let string = `<li class="page-item" onclick="loadItem(${i},${limit})"><a class="page-link">${i}</a></li>`;
    if (i == thisPage) {
      string = `<li class="page-item active" onclick="loadItem(${i},${limit})"><a class="page-link">${i}</a></li>`;
    }
    result += string;
  }

  // thêm nút next

  if (thisPage != count) {
    let string1 = `<li class="page-item" onclick="loadItem(${
      Number(thisPage) + 1
    },${limit})"><a class="page-link">Next</a></li>`;
    result += string1;
  } else if (thisPage == count) {
    let string1 = `<li class="page-item disabled" style="cursor: default;"><a class="page-link">Next</a></li>`;
    result += string1;
  }

  container.innerHTML = result;
}

function loadPage() {
  // Lấy danh sách tất cả các thẻ <li> trong <ul> có id là "Panigation"
  var listItems = document.querySelectorAll("#Pagination li");

  // Duyệt qua từng phần tử trong danh sách
  listItems.forEach(function (item) {
    // Kiểm tra xem phần tử hiện tại có class là "active" hay không
    if (item.classList.contains("active")) {
      // Nếu có, lấy nội dung trong thẻ <a> bên trong và chuyển thành số
      var activePageText = item.querySelector("a").textContent.trim();
      var activePageNumber = parseInt(activePageText);
      console.log("Trang đang active: " + activePageNumber);
      loadItem(activePageNumber, 4);
    }
  });
}
window.addEventListener("load", async function () {
  // Thực hiện các hàm bạn muốn sau khi trang web đã tải hoàn toàn, bao gồm tất cả các tài nguyên như hình ảnh, stylesheet, v.v.
  console.log("Trang quản lý người dùng đã load hoàn toàn");
  await getListUserGr();
  await getListObj();
  loadItem(1, 4);
  searchAccount();
});
