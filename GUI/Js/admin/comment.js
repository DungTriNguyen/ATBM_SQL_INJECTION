// ------------------------------------------- AJAX kiểm tra đăng nhập -----------------------------------------------
async function checkLogin_comment() {
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

async function getDataPermission_comment(codePermission) {
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
function checkUpPermission_comment(dataPermissionDetail, functionPoint) {
  if (functionPoint == "") {
    return false;
  }

  for (let item of dataPermissionDetail) {
    if (item.functionCode == "comment") {
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
    const response = await fetch("../../../BLL/CommentBLL.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/x-www-form-urlencoded",
      },
      body: "function=" + encodeURIComponent("getArrObj"),
    });

    const data = await response.json();
    console.log(data);
    showComment(data);
    loadPage();
  } catch (error) {
    console.error("Error:", error);
  }
}

async function getArr1() {
  try {
    // gọi AJAX để kiểm tra
    const response = await fetch("../../../BLL/CommentBLL.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/x-www-form-urlencoded",
      },
      body: "function=" + encodeURIComponent("getArrObj"),
    });

    const data = await response.json();
    console.log(data);
    showComment(data);
    // loadPage();
  } catch (error) {
    console.error("Error:", error);
  }
}

async function showComment(data) {
  let container = document.getElementById("listComment");
  let container1 = document.getElementById("editState");
  let result = ``;
  let result1 = ``;

  for (let i of data) {
    //Check trạng thái
    let strStt = "";
    if (i.state == "1") {
      strStt = `<td><a class="btn btn-sm btn-primary" title="Click để ẩn bình luận" onclick="updateStateComment('${i.codeComment}','${i.state}',event)">Hiện <i class="fa fa-eye"></i></a></td>`;
    } else {
      strStt = `<td><a class="btn btn-sm btn-danger" title="Click để hiện bình luận" onclick="updateStateComment('${i.codeComment}','${i.state}',event)">Ẩn <i class="fa fa-eye-slash"></i></a></td>`;
    }

    //str container
    let str = `
         <tr>
             <td>${i.codeComment}</td>
             <td>${i.userNameComment}</td>
             <td>${i.productCode}</td>
             <td>${i.likeNumber}</td>
             <td>${i.content}</td>
             <td>${i.sentDate}</td>
             ${strStt}
             <td><a href="#" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteComment-${i.codeComment}">Xóa <i class="fa fa-trash"></i></a></td>
         </tr>
     `;

    // str xóa
    let str1 = `
         <div class="modal fade" id="deleteComment-${i.codeComment}" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
             <div class="modal-dialog">
                     <div class="modal-content">
                             <div class="modal-header">
                             <h5 class="modal-title" id="deleteModalLabel">Xóa bình luận</h5>
                             <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                             </div>
                             <div class="modal-body">
                             Bạn có chắc muốn xóa bình luận này?
                             <br>
                             Mã bình luận: <b>${i.codeComment}</b>
                             <br>
                             Tài khoản bình luận: <b>${i.userNameComment}</b>
                             <br>
                             Nội dung bình luận: <b>${i.content}</b>
                             </div>
                             <div class="modal-footer">
                                 <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                                 <button data-bs-dismiss="modal" type="button" class="btn btn-danger btn-confirm-delete" onclick="deleteComment('${i.codeComment}')">Xóa</button>
                             </div>
                     </div>
             </div>
         </div>
     `;

    result += str;
    result1 += str1;
  }
  container.innerHTML = result;
  container1.innerHTML = result1;
}

// Hàm tìm kiếm
function searchComments() {
  document.getElementById("input-search").oninput = async function () {
    try {
      let str = document.getElementById("input-search").value;
      // gọi AJAX để kiểm tra
      const response = await fetch("../../../BLL/CommentBLL.php", {
        method: "POST",
        headers: {
          "Content-Type": "application/x-www-form-urlencoded",
        },
        body:
          "function=" +
          encodeURIComponent("searchComments") +
          "&str=" +
          encodeURIComponent(str),
      });

      const data = await response.json();
      console.log(data);

      // Load lại cmt sau khi nhập ký tự
      if (data.length == 0) {
        console.log("Không có dữ liệu");

        document.querySelector("#Pagination").style.display = "none";
        showComment(data);
      } else {
        showComment(data);
        document.querySelector("#Pagination").style.display = "flex";
        loadItem(1, 4);
      }
    } catch (error) {
      console.error("Error:", error);
    }
  };
}

// Hàm xóa bình luận
async function deleteComment(code) {
  // lấy thông tin mã  codePermission của người đăng nhập
  let codePermission = await checkLogin_comment();
  // lấy mảng chi tiết phân quyền dựa theo mã phân quyền của người đăng nhập
  let data = await getDataPermission_comment(codePermission);
  // lấy thông tin có được phép làm chức ăng đó không
  let check = checkUpPermission_comment(data.permissionDetail, "delete");

  if (check == true) {
    try {
      // gọi AJAX để kiểm tra
      const response = await fetch("../../../BLL/CommentBLL.php", {
        method: "POST",
        headers: {
          "Content-Type": "application/x-www-form-urlencoded",
        },
        body:
          "function=" +
          encodeURIComponent("deleteObjByID") +
          "&codeComment=" +
          encodeURIComponent(code),
      });

      const data1 = await response.json();
      console.log(data1);
      if (data1.mess === "success") {
        await Swal.fire({
          position: "center",
          icon: "success",
          title: "Xóa bình luận thành công",
          showConfirmButton: false,
          timer: 1500,
        });
        await getArr();
      }
    } catch (error) {
      console.error("Error:", error);
    }
  } else {
    Swal.fire({
      icon: "error",
      title: "Xóa không thành công",
      text: "Không đủ quyền hàng",
    });
  }
}

//Hàm thay đổi trạng thái
async function updateStateComment(code, state, event) {
  event.preventDefault();

  // lấy thông tin mã  codePermission của người đăng nhập
  let codePermission = await checkLogin_comment();
  // lấy mảng chi tiết phân quyền dựa theo mã phân quyền của người đăng nhập
  let data = await getDataPermission_comment(codePermission);
  // lấy thông tin có được phép làm chức ăng đó không
  let check = checkUpPermission_comment(data.permissionDetail, "update");

  if (check == true) {
    try {
      const response = await fetch("../../../BLL/CommentBLL.php", {
        method: "POST",
        headers: {
          "Content-Type": "application/x-www-form-urlencoded",
        },
        body:
          "function=" +
          encodeURIComponent("updateStateObj") +
          "&codeComment=" +
          encodeURIComponent(code) +
          "&state=" +
          encodeURIComponent(state),
      });

      const data = await response.json();
      console.log(data);
      if (data.mess === "success") {
        await getArr();
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

// phân trang
// giới hạn mỗi trang là 3 dòng, limit = 3
// trang 1: 0 -> 2
// trang 2: 3 -> 5
// ....

// CÔng thức chung
// beginGet = limit * (thisPage - 1); -------------- 3 * (2-1) = 3
// endGet = limit * thisPage -1; ----------------------- 3 * 2 - 1 = 5

function loadItem(thisPage, limit) {
  // tính vị trí bắt đầu và kêt thúc
  let beginGet = limit * (thisPage - 1);
  let endGet = limit * thisPage - 1;

  // lấy tất cả các dòng dữ liệu có trong bảng
  let all_data_rows = document.querySelectorAll("#listComment > tr");

  // console.log(all_data_rows);

  // dùng dòng lặp duyệt qua các phần tử tr
  // Nếu mà data row nào mà nằm trong beginGet và endGet thì hiển thị (block), còn nằm thì ẩn đi (none).
  all_data_rows.forEach((item, index) => {
    if (index >= beginGet && index <= endGet) {
      item.style.display = "table-row";
    } else {
      item.style.display = "none";
    }
  });

  // hàm tính có bao nhieu nút chuyển trang
  listPage(thisPage, limit, all_data_rows);
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
    let string1 = `<li class="page-item disabled" style="cursor: default;"><a class="page-link">Previous</a></li>`;
    result += string1;
  }

  // tính xem có bao nhieu nút

  // lấy container chứa nút phân trang
  let container = document.getElementById("Pagination");
  console.log(container);

  for (let i = 1; i <= count; i++) {
    let string = `<li class="page-item" onclick="loadItem(${i},${limit})"><a class="page-link">${i}</a></li>`;
    if (i == thisPage) {
      string = `<li class="page-item active" onclick="loadItem(${i},${limit})"><a class="page-link">${i}</a></li>`;
    }
    result += string;
  }

  // thêm nút next
  if (thisPage != count) {
    let string = `<li class="page-item" onclick="loadItem(${
      Number(thisPage) + 1
    },${limit})"><a class="page-link">Next</a></li>`;
    result += string;
  } else if (thisPage == count) {
    let string = `<li class="page-item disabled" style="cursor: default;"><a class="page-link">Next</a></li>`;
    result += string;
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
  searchComments();
  loadItem(1, 4);

  console.log("Trang Comment đã load hoàn toàn");
});
