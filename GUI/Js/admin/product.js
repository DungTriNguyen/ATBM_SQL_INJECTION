// async function getArr() {
//     try {
//            // gọi AJAX để kiểm tra
//            const response = await fetch('../../../BLL/ProductBLL.php', {
//                   method: 'POST',
//                   headers: {
//                          'Content-Type': 'application/x-www-form-urlencoded'
//                   },
//                   body: 'function=' + encodeURIComponent('getArrObj')
//            });

//            const data = await response.json();
//            console.log(data);

//            //     Display Transport
//            showDataTable(data);
//            loadPage();

//     } catch (error) {
//            console.error('Error:', error);
//     }
// }

// ------------------------------------------- AJAX kiểm tra đăng nhập -----------------------------------------------
async function checkLogin_product() {
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

async function getDataPermission_product(codePermission) {
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
function checkUpPermission_product(dataPermissionDetail, functionPoint) {
  if (functionPoint == "") {
    return false;
  }

  for (let item of dataPermissionDetail) {
    if (item.functionCode == "product") {
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

//---------- AJAX
async function Search(page, limit) {
  // lấy các thông tin search

  let valueSearch = document.getElementById("value-search").value;
  let category = document.getElementById("category").value;

  if (valueSearch == "") {
    valueSearch = "empty";
  }

  console.log(valueSearch, category);

  // goi ajax
  try {
    const response = await fetch("../../../BLL/ProductBLL.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/x-www-form-urlencoded",
      },
      body:
        "function=" +
        encodeURIComponent("Pagination_Search") +
        "&page=" +
        encodeURIComponent(page) +
        "&limit=" +
        encodeURIComponent(limit) +
        "&keyword=" +
        encodeURIComponent(valueSearch) +
        "&type=" +
        encodeURIComponent(category),
    });
    const data = await response.json();
    console.log(data);

    if (data != null) {
      let dataLength = 0;
      for (let i of data) {
        if (i.lengthProduct !== undefined) {
          dataLength = i.lengthProduct;
        }
      }
      listPage(page, limit, dataLength);
      let conatiner = document.getElementById("listProduct");

      conatiner.innerHTML = `
                <div class="spinner-border text-primary" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            `;

      await showDataTable(data);
    } else {
      Swal.fire({
        icon: "error",
        title: "Không tìm thấy sản phẩm",
      });
    }
  } catch (error) {
    console.error("Error:", error);
  }
}

// size
async function getDataSize(productCode) {
  // goi ajax
  try {
    const response = await fetch("../../../BLL/ProductBLL.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/x-www-form-urlencoded",
      },
      body:
        "function=" +
        encodeURIComponent("getArrSizeCodeByProductCode") +
        "&code=" +
        encodeURIComponent(productCode),
    });
    const data = await response.json();
    console.log(data);

    return data;
  } catch (error) {
    console.error("Error:", error);
  }
}

function listPage(thisPage, limit, all_data_rows) {
  let result = "";
  let count = Math.ceil(all_data_rows / limit);
  // thêm nút prev
  if (thisPage != 1) {
    let string = `<li class="page-item" onclick="Search(${
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

  for (let i = 1; i <= count; i++) {
    let string = `<li class="page-item" onclick="Search(${i},${limit})"><a class="page-link">${i}</a></li>`;
    if (i == thisPage) {
      string = `<li class="page-item active" onclick="Search(${i},${limit})"><a class="page-link">${i}</a></li>`;
    }
    result += string;
  }

  // thêm nút next
  if (thisPage != count) {
    let string = `<li class="page-item" onclick="Search(${
      Number(thisPage) + 1
    },${limit})"><a class="page-link">Next</a></li>`;
    result += string;
  } else if (thisPage == count) {
    let string = `<li class="page-item disabled" style="cursor: default;"><a class="page-link">Next</a></li>`;
    result += string;
  }

  container.innerHTML = result;
}

// function loadPage() {
//     // Lấy danh sách tất cả các thẻ <li> trong <ul> có id là "Panigation"
//     var listItems = document.querySelectorAll('#Pagination li');

//     // Duyệt qua từng phần tử trong danh sách
//     listItems.forEach(function (item) {
//            // Kiểm tra xem phần tử hiện tại có class là "active" hay không
//            if (item.classList.contains('active')) {
//                   // Nếu có, lấy nội dung trong thẻ <a> bên trong và chuyển thành số
//                   var activePageText = item.querySelector('a').textContent.trim();
//                   var activePageNumber = parseInt(activePageText);
//                   console.log("Trang đang active: " + activePageNumber);
//                   Search(activePageNumber, 5);
//            }
//     });

// }

// show dữ liệu lên bảng
async function showDataTable(data) {
  let conatiner = document.getElementById("listProduct");
  let containerDetail = document.getElementById("content-product-detail");
  let formDelete = document.getElementById("deleteForm");

  formDelete.innerHTML = "";

  if (data != null) {
    let result_table = "";
    let result_delete = "";
    let result_modal_detail = "";

    for (let item of data) {
      if (item.lengthProduct === undefined) {
        let productCode = item.productCode;
        let nameProduct = item.nameProduct;
        let stringImg = item.imgProduct;
        let arrImg = stringImg.split(" ");
        let firstImg = arrImg[0];
        let supplierCode = item.supplierCode;
        let targetGender = item.targetGender;
        let describeProduct = item.describeProduct;
        let state = item.status;
        let quantity = item.quantity;
        let price = item.price;
        let type = item.type;

        // show chung
        let stringTable = `
                    <tr>
                        <td>${nameProduct}</td>
                        <td>${productCode}</td>
                        <td><img src="../${firstImg}" width="60px"></td>
                        <td>${quantity}</td>
                        <td>${price}$</td>
                        <td>${state}</td>
                        <td>
                             
                            <a class="btn btn-sm btn-warning" href="#" onclick="updateObj(event,'${productCode}','${type}')"><i class="fa fa-edit"></i>Sửa</a>
                            <a href="#" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal-${productCode}"><i class="fa fa-trash"> </i>Xóa</a>
                            <a href="#" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#${productCode}"><i class="fa fa-eye"> </i>Xem</a>
                        </td>
                    </tr>
                `;

        // form xóa
        let strDelete = `
                <div class="modal fade" id="deleteModal-${productCode}" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="deleteModalLabel">Xóa sản phẩm</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            Bạn có chắc chắn muốn xóa sản phẩm này?
                            <br>
                            Mã sản phẩm: <b>${productCode}</b>
                            <br>
                            Tên sản phẩm: <b>${nameProduct}</b>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                            <button type="button" class="btn btn-danger btn-confirm-delete" data-bs-dismiss="modal" onclick="deleteProduct('${productCode}','${type}')">Xóa</button>
                        </div>
                    </div>
                    </div>
                 </div>
                `;

        if (item.type == "shirtProduct") {
          // lấy thông tin size
          // let container_detail = document.getElementById('');
          let dataSize = await getDataSize(productCode);
          let shirtMaterial = item.shirtMaterial;
          let shirtStyle = item.shirtStyle;
          let promotion = item.promotion;
          let descriptionMaterial = item.descriptionMaterial;

          // xu ly size

          let resultSize = "";
          for (let item of dataSize) {
            let nameSize = item.sizeName;
            let quantitySize = item.quantitySize;

            let string = `
                            <tr>
                                <td>${nameSize}</td>
                                <td>${quantitySize}</td>
                            </tr>
                        `;
            resultSize += string;
          }

          // xu ly anh chi tiet
          let result_img = ``;
          for (let item of arrImg) {
            let string = `
                            <img src="../${item}" id="imgProduct" width="50px">
                        `;
            result_img += string;
          }

          let string_final = `
                    
                    <div class="modal fade" id="${productCode}" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="detailModalLabel">Chi tiết sản phẩm</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div id="content-picture-product" class="col-md-4">
                                        <div id="main-picture-product">
                                            <img src="../${firstImg}" id="imgProduct" width="210px">
                                        </div>
                                        <div id="detail-picture-product" class="img-category mt-2">
                                            ${result_img}
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <table class="table table-bordered">
                                            <tbody>
                                                <!-- Field chung -->
                                                <tr>
                                                    <th class="fw-bold">Tên sản phẩm</th>
                                                    <td id="nameProduct">${nameProduct}</td>
                                                </tr>
                                                <tr>
                                                    <th class="fw-bold">Mã sản phẩm</th>
                                                    <td id="productCode">${productCode}</td>
                                                </tr>
                                                <tr>
                                                    <th class="fw-bold">Giá</th>
                                                    <td id="price">${price}$</td>
                                                </tr>
                                                <tr>
                                                    <th class="fw-bold">Giảm giá:</th>
                                                    <td id="price">${promotion}%</td>
                                                </tr>
                                                <tr>
                                                    <th class="fw-bold">Danh mục</th>
                                                    <td id="category">${type}</td>
                                                </tr>
                                                <tr>
                                                    <th class="fw-bold">Mã nhà cung cấp</th>
                                                    <td id="codeSupplier">${supplierCode}</td>
                                                </tr>
                                                <tr>
                                                    <th class="fw-bold">Mô tả</th>
                                                    <td id="describe">${describeProduct}</td>
                                                </tr>
                                                <tr>
                                                    <th class="fw-bold">Đối tượng</th>
                                                    <td id="targetGender">${targetGender}</th>
                                                </tr>
                                                <tr>
                                                    <th class="fw-bold">Trạng thái</th>
                                                    <td id="status">${state}</td>
                                                </tr>

                                                <!-- Field riêng quần áo -->
                                                <tr>
                                                    <th class="fw-bold">Phong cách</th>
                                                    <td id="shirtStyle">${shirtStyle}</td>
                                                </tr>
                                                <tr>
                                                    <th class="fw-bold">Chất liệu</th>
                                                    <td id="shirtMaterial">${shirtMaterial}</td>
                                                </tr>
                                                <tr>
                                                    <th class="fw-bold">Mô tả chất liệu</th>
                                                    <td id="descriptionMaterial">${descriptionMaterial}</td>
                                                </tr>
                                                <!-- Size số lượng -->
                                                <tr style="border-top:2px solid black;">
                                                    <th class="fw-bold">Size</th>
                                                    <th id="descriptionMaterial" class="fw-bold">Số lượng</th>
                                                </tr>
                                                <div id="content-size-detail">
                                                    ${resultSize}
                                                </div>

                                                <tr id="quantity-infor">
                                                    <th class="fw-bold">Tổng</th>
                                                    <td id="quantity">${quantity}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                    
                    `;
          result_modal_detail += string_final;
        } else if (item.type == "handbagProduct") {
          let bagMaterial = item.bagMaterial;
          let promotion = item.promotion;
          let descriptionMaterial = item.descriptionMaterial;

          // xu ly anh chi tiet
          let result_img = ``;
          for (let item of arrImg) {
            let string = `
                            <img src="../${item}" id="imgProduct" width="50px">
                        `;
            result_img += string;
          }

          let string_final = `
                    
                        <div class="modal fade" id="${productCode}" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="detailModalLabel">Chi tiết sản phẩm</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div id="content-picture-product" class="col-md-4">
                                                <div id="main-picture-product">
                                                    <img src="../${firstImg}" id="imgProduct" width="210px">
                                                </div>
                                                <div id="detail-picture-product" class="img-category mt-2">
                                                    ${result_img}
                                                </div>
                                            </div>
                                            <div class="col-md-8">
                                                <table class="table table-bordered">
                                                    <tbody>
                                                        <!-- Field chung -->
                                                        <tr>
                                                            <th>Tên sản phẩm</th>
                                                            <td id="nameProduct">${nameProduct}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Mã sản phẩm</th>
                                                            <td id="productCode">${productCode}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Giá</th>
                                                            <td id="price">${price}$</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Giảm giá:</th>
                                                            <td id="price">${promotion}%</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Danh mục</th>
                                                            <td id="category">${type}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Mã nhà cung cấp</th>
                                                            <td id="codeSupplier">${supplierCode}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Mô tả</th>
                                                            <td id="describe">${describeProduct}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Đối tượng</th>
                                                            <td id="targetGender">${targetGender}</th>
                                                        </tr>
                                                        <tr>
                                                            <th>Trạng thái</th>
                                                            <td id="status">${state}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Chất liệu</th>
                                                            <td id="shirtMaterial">${bagMaterial}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Mô tả chất liệu</th>
                                                            <td id="descriptionMaterial">${descriptionMaterial}</td>
                                                        </tr>

                                                        <tr id="quantity-infor">
                                                            <th>Tổng</th>
                                                            <td id="quantity">${quantity}</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    
                    `;
          result_modal_detail += string_final;
        }
        result_delete += strDelete;
        result_table += stringTable;
      }
    }
    formDelete.innerHTML = result_delete;
    conatiner.innerHTML = result_table;
    containerDetail.innerHTML = result_modal_detail;
  }
}

// sua
async function updateObj(event, productCode, type) {
  // lấy thông tin mã  codePermission của người đăng nhập
  let codePermission = await checkLogin_product();
  // lấy mảng chi tiết phân quyền dựa theo mã phân quyền của người đăng nhập
  let data = await getDataPermission_product(codePermission);
  // lấy thông tin có được phép làm chức ăng đó không
  let check = checkUpPermission_product(data.permissionDetail, "update");

  if (check == true) {
    window.location.href = `../../../GUI/view/admin/editProduct.php?productCode=${productCode}&type=${type}`;
  } else {
    event.preventDefault();
    Swal.fire({
      icon: "error",
      title: "Thêm không thành công",
      text: "Không đủ quyền hàng",
    });
  }
}

//
// thêm một đối tương
async function addObj(event) {
  // lấy thông tin mã  codePermission của người đăng nhập
  let codePermission = await checkLogin_product();
  // lấy mảng chi tiết phân quyền dựa theo mã phân quyền của người đăng nhập
  let data = await getDataPermission_product(codePermission);
  // lấy thông tin có được phép làm chức ăng đó không
  let check = checkUpPermission_product(data.permissionDetail, "add");

  if (check == true) {
    window.location.href = "../../../GUI/view/admin/addproduct.php";
  } else {
    event.preventDefault();
    Swal.fire({
      icon: "error",
      title: "Thêm không thành công",
      text: "Không đủ quyền hàng",
    });
  }
}

async function deleteProduct(productCode, type) {
  // lấy thông tin mã  codePermission của người đăng nhập
  let codePermission = await checkLogin_product();
  // lấy mảng chi tiết phân quyền dựa theo mã phân quyền của người đăng nhập
  let data = await getDataPermission_product(codePermission);
  // lấy thông tin có được phép làm chức ăng đó không
  let check = checkUpPermission_product(data.permissionDetail, "delete");

  if (check == true) {
    try {
      const response = await fetch("../../../BLL/ProductBLL.php", {
        method: "POST",
        headers: {
          "Content-Type": "application/x-www-form-urlencoded",
        },
        body:
          "function=" +
          encodeURIComponent("deleteProduct") +
          "&code=" +
          encodeURIComponent(productCode) +
          "&type=" +
          encodeURIComponent(type),
      });
      const data = await response.json();
      console.log(data);
      let page = parseInt(getPageActive());
      if (data.mess === "success") {
        await Swal.fire({
          position: "center",
          icon: "success",
          title: "Xóa Sản phẩm thành công!",
          showConfirmButton: false,
          timer: 1500,
        });

        await Search(page, 5);
      }
      // handle the response data as needed
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

// Lấy trang đang kích hoạt
function getPageActive() {
  // Lấy danh sách tất cả các thẻ <li> trong <ul> có id là "Panigation"
  var listItems = document.querySelectorAll("#Pagination li");
  var page = 0;
  // Duyệt qua từng phần tử trong danh sách
  listItems.forEach(function (item) {
    // Kiểm tra xem phần tử hiện tại có class là "active" hay không
    if (item.classList.contains("active")) {
      // Nếu có, lấy nội dung trong thẻ <a> bên trong và chuyển thành số
      var activePageText = item.querySelector("a").textContent.trim();
      var activePageNumber = parseInt(activePageText);
      console.log("Trang đang active: " + activePageNumber);
      page = activePageNumber;
    }
  });
  return page;
}

// Hàm tìm kiếm sản phẩm
// function searchProduct() {
//     document.getElementById("input-search").oninput = async function () {
//         try {
//             let keyword = document.getElementById("input-search").value;
//             const response = await fetch('../../../BLL/ProductBLL.php', {
//                 method: 'POST',
//                 headers: {
//                     'Content-Type': 'application/x-www-form-urlencoded'
//                 },
//                 body: 'function=' + encodeURIComponent('searchProduct') + '&keyword=' + encodeURIComponent(keyword)
//             });
//             const data = await response.json();
//             console.log(data);

//             if (data.length == 0) {
//                 console.log('Không có dữ liệu');

//                 document.querySelector('#Pagination').style.display = 'none';
//                 showDataTable(data);
//             }
//             else {
//                 let conatiner = document.getElementById('listProduct');
//                 conatiner.innerHTML = `
//                 <div class="spinner-border text-primary" role="status">
//                     <span class="visually-hidden">Loading...</span>
//                 </div>
//             `;
//                 showDataTable(data);
//                 document.querySelector('#Pagination').style.display = 'flex';
//                 Search(1, 5);
//             }
//         } catch (error) {
//             console.error('Error:', error);
//         }
//     }
// }

function loadItem(thisPage, limit) {
  // tính vị trí bắt đầu và kêt thúc
  let beginGet = limit * (thisPage - 1);
  let endGet = limit * thisPage - 1;

  // lấy tất cả các dòng dữ liệu có trong bảng
  let all_data_rows = document.querySelectorAll("listProduct > tr");

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

$(document).ready(function () {
  $("#inputFile").change(function () {
    const files = $(this)[0].files;
    if (files.length > 0) {
      const imagePreview = $("#imagePreview");
      imagePreview.empty();

      for (let i = 0; i < files.length; i++) {
        const file = files[i];
        const reader = new FileReader();

        reader.onload = function (e) {
          const img = $("<img>")
            .attr("src", e.target.result)
            .addClass("img-thumbnail");
          imagePreview.append(img);
        };
        reader.readAsDataURL(file);
      }
    }
  });
});

// action();

window.addEventListener("load", async function () {
  // Thực hiện các hàm bạn muốn sau khi trang web đã tải hoàn toàn, bao gồm tất cả các tài nguyên như hình ảnh, stylesheet, v.v.
  console.log("Trang quản lý sản phẩm đã load hoàn toàn");
  await Search(1, 5);
  // searchProduct();
  // loadPage();
  // action();
});
