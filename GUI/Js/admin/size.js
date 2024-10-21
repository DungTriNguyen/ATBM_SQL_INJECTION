// ------------------------------------------- AJAX kiểm tra đăng nhập -----------------------------------------------
async function checkLogin_size() {
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

async function getDataPermission_size(codePermission) {
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
function checkUpPermission_size(dataPermissionDetail, functionPoint) {
  if (functionPoint == "") {
    return false;
  }

  for (let item of dataPermissionDetail) {
    if (item.functionCode == "size") {
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

async function getArr() {
  try {
    // gọi AJAX để kiểm tra

    let response = await fetch("../../../BLL/SizeBLL.php", {
      method: "POSt",
      headers: {
        "Content-Type": "application/x-www-form-urlencoded",
      },
      body: "function=" + encodeURIComponent("getArrObj"),
    });

    let data = await response.json();
    console.log(data);
    console.log(1);
    // console.log(data[0].nameSize);
    showData(data);
    loadPage();
  } catch (error) {
    console.error(error);
  }
}

function showData(data) {
  let container = document.getElementById("container-table");
  let editSizeContainer = document.getElementById("editSize-container");
  let result = ``;
  let result2 = ``;
  for (let i of data) {
    let nameSize = i.sizeName;
    let codeSize = i.sizeCode;

    let string = `
              <tr>
                                <td>${codeSize}</td>
                                <td>${nameSize}</td>
                                <td>
                                    <a href="#" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editSize-${codeSize}"><i class="fa fa-edit"></i> Sửa</a>
                                </td>
              </tr>
       
              `;

    let string2 = `
                     <div class="modal fade" id="editSize-${codeSize}" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                            <div class="modal-content">
                                   <div class="modal-header">
                                   <h5 class="modal-title" id="editModalLabel">Cập nhật thông tin Size</h5>
                                   <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                   </div>
                                   <div class="modal-body">
                                   <form id="editForm">
                                          <div class="mb-3">
                                          <label for="sizeCode" class="form-label">Mã size</label>
                                          <input type="text" class="form-control" id="${codeSize}" name="sizeCode" value="${codeSize}" disabled>
                                          </div>
                                          <div class="mb-3">
                                          <label for="sizeName" class="form-label">Tên kích thước</label>
                                          <input type="text" class="form-control" id="${codeSize}-${nameSize}" name="sizeName" value="${nameSize}">
                                          </div>
                                          <div style="text-align:right;">
                                                 <button data-bs-dismiss="modal" class="btn btn-primary" id="btn-update" onclick="updateSize('${codeSize}','${codeSize}-${nameSize}',event)">Cập nhật</button>
                                          </div>   
                                   </form>
                                   </div>
                            </div>
                            </div>
                     </div>

              `;
    result += string;
    result2 += string2;
  }
  container.innerHTML = result;
  // console.log(result);
  editSizeContainer.innerHTML = result2;
  // console.log(result2);
}

function searchSizes() {
  document.getElementById("inputSearch").oninput = async function () {
    try {
      // gọi AJAX để kiểm tra

      let str = document
        .getElementById("inputSearch")
        .value.trim()
        .toLowerCase();
      let response = await fetch("../../../BLL/SizeBLL.php", {
        method: "POST",
        headers: {
          "Content-Type": "application/x-www-form-urlencoded",
        },
        body:
          "function=" +
          encodeURIComponent("searchSizes") +
          "&str=" +
          encodeURIComponent(str),
      });

      const data = await response.json();
      if (data.length == 0) {
        console.log("Không có dữ liệu");

        document.querySelector("#Pagination").style.display = "none";
        showData(data);
      } else {
        showData(data);
        document.querySelector("#Pagination").style.display = "flex";
        loadItem(1, 4);
      }
      console.log(data);
      showData(data);
      loadPage();
    } catch (error) {
      console.error(error);
    }
  };
}

// thêm một đối tương
async function addObj(event) {
  // lấy thông tin mã  codePermission của người đăng nhập
  let codePermission = await checkLogin_size();
  // lấy mảng chi tiết phân quyền dựa theo mã phân quyền của người đăng nhập
  let data = await getDataPermission_size(codePermission);
  // lấy thông tin có được phép làm chức ăng đó không
  let check = checkUpPermission_size(data.permissionDetail, "add");

  if (check == true) {
    window.location.href = "../../../GUI/view/admin/addsize.php";
  } else {
    event.preventDefault();
    Swal.fire({
      icon: "error",
      title: "Thêm không thành công",
      text: "Không đủ quyền hàng",
    });
  }
}

async function updateSize(code, name, event) {
  event.preventDefault();

  // lấy thông tin mã  codePermission của người đăng nhập
  let codePermission = await checkLogin_size();
  // lấy mảng chi tiết phân quyền dựa theo mã phân quyền của người đăng nhập
  let data = await getDataPermission_size(codePermission);
  // lấy thông tin có được phép làm chức ăng đó không
  let check = checkUpPermission_size(data.permissionDetail, "update");

  if (check == true) {
    let codeSize = document.getElementById(code).value.trim();
    let nameSize = document.getElementById(name).value.trim();
    if (codeSize === "" || nameSize === "") {
      await Swal.fire({
        position: "center",
        icon: "error",
        title: "Sửa Thất Bại",
        showConfirmButton: false,
        timer: 1500,
      });
    } else {
      try {
        const response = await fetch("../../../BLL/SizeBLL.php", {
          method: "POST",
          headers: {
            "Content-Type": "application/x-www-form-urlencoded",
          },
          body:
            "function=" +
            encodeURIComponent("updateSize") +
            "&nameSize=" +
            encodeURIComponent(nameSize) +
            "&sizeCode=" +
            encodeURIComponent(codeSize),
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
          await getArr();
        }
      } catch (error) {
        console.error("Error:", error);
      }
    }
  } else {
    Swal.fire({
      icon: "error",
      title: "Sửa không thành công",
      text: "Không đủ quyền hàng",
    });
  }
}

function loadItem(thisPage, limit) {
  // tính vị trí bắt đầu và kêt thúc
  let beginGet = limit * (thisPage - 1);
  let endGet = limit * thisPage - 1;

  // lấy tất cả các dòng dữ liệu có trong bảng
  let all_data_rows = document.querySelectorAll("#container-table > tr");

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

  await getArr();
  searchSizes();
  loadItem(1, 4);
});
