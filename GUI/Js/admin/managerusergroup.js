//Lấy danh sách đối tượng
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
    await loadData(data);
    loadPage();
  } catch (error) {
    console.error(error);
  }
}

//lấy dữ liệu từ kết quả  rearch
function searchAccountGroup() {
  document.getElementById("input-search-accountgroup").oninput =
    async function () {
      try {
        // Gọi AJAX để xóa payment
        let str = document
          .getElementById("input-search-accountgroup")
          .value.trim()
          .toLowerCase();
        // console.log(str);
        let response = await fetch("../../../BLL/ManagerUserGroupBLL.php", {
          method: "POST",
          headers: {
            "Content-Type": "application/x-www-form-urlencoded",
          },
          body:
            "function=" +
            encodeURIComponent("searchAccountGroup") +
            "&str=" +
            encodeURIComponent(str),
        });

        let data = await response.json();
        console.log(data);
        if (data.length == 0) {
          console.log("Không có dữ liệu");

          document.querySelector("#Pagination").style.display = "none";
          loadData(data);
        } else {
          loadData(data);
          document.querySelector("#Pagination").style.display = "flex";
          loadItem(1, 4);
        }

        loadPage();
      } catch (error) {
        console.error(error);
      }
    };
}

async function loadData(data) {
  let container = document.getElementById("danhsach");
  let container1 = document.getElementById("delete-AccountGroup");
  let container2 = document.getElementById("editNND-container");
  let result = ``;
  let result1 = ``;
  let result2 = ``;
  let stt = 1;
  for (let i of data) {
    let codePermission = i.codePermission;
    let namePermission = i.namePermission;
    let String = `
    <tr>
        <td>${stt}</td>
        <td>${namePermission}</td>
        <td><a href="./tongquanphanquyenQLNND.php?codePermission=${codePermission}" class="phanquyen">Phân quyền</a></td>
        <td>
           <a href="#" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editNND-${codePermission}"><i class="fa fa-edit"></i>Sửa</a>
        </td>
        <td><a href="#" class="delete-button" data-bs-toggle="modal" data-bs-target="#deleteAccountGroup-${i.codePermission}"><i class="fa fa-trash"></i></a></td>
    </tr>

      `;

    let String1 = `
    <div class="modal fade" id="deleteAccountGroup-${i.codePermission}" tabindex="-1" aria-labelledby="deleteModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteModalLabel">Xóa nhóm người dùng</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Bạn có chắc muốn xóa nhóm người dùng này?
                        <br>
                        Mã nhóm: ${i.codePermission}
                        <br>
                        Tên nhóm: ${i.namePermission}
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                        <button type="button" data-bs-dismiss="modal" class="btn btn-danger btn-confirm-delete"  onclick="deleteByID('${i.codePermission}')">Xóa</button>
                    </div>
                </div>
            </div>
        </div>
      `;
    let String2 = `
      <div class="modal fade" id="editNND-${codePermission}" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
             <div class="modal-dialog">
             <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Cập nhật thông tin Nhóm Người Dùng</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                    <form id="editForm">
                           <div class="mb-3">
                           <label for="nndCode" class="form-label">Mã nhóm người dùng</label>
                           <input type="text" class="form-control" id="${codePermission}" name="nndCode" value="${codePermission}" disabled>
                           </div>
                           <div class="mb-3">
                           <label for="nndName" class="form-label">Tên Nhóm Người Dùng</label>
                           <input type="text" class="form-control" id="${codePermission}-${namePermission}" name="nndName" value="${namePermission}">
                           </div>
                           <div style="text-align:right;">
                                  <button data-bs-dismiss="modal" class="btn btn-primary" id="btn-update" onclick="updateObj('${codePermission}','${codePermission}-${namePermission}',event)" >Cập nhật</button>
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
  console.log(result1);
  container2.innerHTML = result2;
  // console.log(result2);
}

// Lấy một đối tượng bằng id
async function getObj() {
  try {
    // Gọi AJAX để xóa payment

    let response = await fetch("../../../BLL/ManagerUserGroupBLL.php", {
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

// xóa mảng permissionDetail
async function deletePermissionDetail(codePermission) {
  let response = await fetch("../../../BLL/ManagerUserGroupBLL.php", {
    method: "POST",
    headers: {
      "Content-Type": "application/x-www-form-urlencoded",
    },
    body:
      "function=" +
      encodeURIComponent("deletePermissionDetail_by_codePermission") +
      "&codePermission=" +
      encodeURIComponent(codePermission),
  });
  let data = await response.json();
  console.log(data);
  return data.mess;
}

//Xóa một đối tượng
async function deleteByID(code) {
  let check = await deletePermissionDetail(code);
  if (check == "success") {
    try {
      // Gọi AJAX để xóa payment

      let response = await fetch("../../../BLL/ManagerUserGroupBLL.php", {
        method: "POST",
        headers: {
          "Content-Type": "application/x-www-form-urlencoded",
        },
        body:
          "function=" +
          encodeURIComponent("deleteByID") +
          "&codePermission=" +
          encodeURIComponent(code),
      });
      let data = await response.json();
      console.log(data);

      if (data.mess === "success") {
        Swal.fire({
          position: "center",
          icon: "success",
          title: "Đã xóa nhóm người dùng thành công",
          showConfirmButton: false,
          timer: 1500,
        });
        await getListObj();
      } else {
        Swal.fire({
          icon: "error",
          title: "Xóa không thành công",
          text: "Bị ràng buộc dữ liệu"
        });
      }
    } catch (error) {
      console.error(error);
    }
  }else{
    Swal.fire({
      icon: "error",
      title: "Xóa không thành công",
      text: "Bị ràng buộc dữ liệu"
    });
  }

}
//Sửa một đối tượng
async function updateObj(codePermission, namePermission, event) {
  event.preventDefault();

  let codePermissionValue = document
    .getElementById(codePermission)
    .value.trim();
  let namePermissionValue = document
    .getElementById(namePermission)
    .value.trim();

  console.log(codePermissionValue);
  console.log(namePermissionValue);

  if (codePermissionValue === "" || namePermissionValue === "") {
    await Swal.fire({
      position: "center",
      icon: "error",
      title: "Sửa Thất Bại",
      showConfirmButton: false,
      timer: 1500,
    });
    await getListObj();
  } else {
    try {
      const response = await fetch("../../../BLL/ManagerUserGroupBLL.php", {
        method: "POST",
        headers: {
          "Content-Type": "application/x-www-form-urlencoded",
        },
        body:
          "function=" +
          encodeURIComponent("updateObj") +
          "&codePermission=" +
          encodeURIComponent(codePermissionValue) +
          "&namePermission=" +
          encodeURIComponent(namePermissionValue),
      });
      const data = await response.json();
      console.log(data);
      if (data.mess === "success") {
        await Swal.fire({
          position: "center",
          icon: "success",
          title: "Cập nhật thành công",
          showConfirmButton: false,
          timer: 1500,
        });
        await getListObj();
      }
    } catch (error) {
      console.error("Error:", error);
    }
  }
}

//Phần phân trang
function loadItem(thisPage, limit) {
  // tính vị trí bắt đầu và kêt thúc
  let beginGet = limit * (thisPage - 1);
  let endGet = limit * thisPage - 1;

  // lấy tất cả các dòng dữ liệu có trong bảng
  let all_data_rows = document.querySelectorAll("#danhsach > tr");

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
    let string = `<li class="page-item" onclick="loadItem(${Number(thisPage) - 1
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
    let string1 = `<li class="page-item" onclick="loadItem(${Number(thisPage) + 1
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
  console.log("Trang quản lý nhóm người dùng đã load hoàn toàn");
  await getListObj();
  loadItem(1, 4);
  searchAccountGroup();
});
