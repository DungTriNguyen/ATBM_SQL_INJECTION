// ------------------------------------------- AJAX kiểm tra đăng nhập -----------------------------------------------
async function checkLogin_order() {
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
              console.log(data);
              let result = data[0];
              if (result.result == 'success' && result.codePermission != 'user') {

                     // getDataPermission_payment(result.codePermission);
                     return result.codePermission;
              }
              // for (let i of data) {
              //        console.log(i);
              // }
              // showProductItem(data);
       } catch (error) {
              console.error('Error:', error);
       }
}
// checkLogin();

async function getDataPermission_order(codePermission) {
       try {
              const response = await fetch('../../../BLL/ManagerUserGroupBLL.php', {
                     method: 'POST',
                     headers: {
                            'Content-Type': 'application/x-www-form-urlencoded'
                     },
                     body:
                            'function=' + encodeURIComponent('getArrPermissionDetail') + '&codePermission=' + encodeURIComponent(codePermission)
              });
              const data = await response.json();
              console.log(data);

              if (data != null) {
                     // checkUpPermission_payment(data.permissionDetail,codePermission,"");
                     return data;
              }

       } catch (error) {
              console.error('Error:', error);
       }
}

// setup các chức năng được truy cập
function checkUpPermission_order(dataPermissionDetail, functionPoint) {

       if (functionPoint == "") {
              return false;
       }

       for (let item of dataPermissionDetail) {
              if (item.functionCode == "order") {
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









// --------------- AJAX
async function loadData(dateStart, dateEnd, keyword, stateNeed) {
       try {
              // gọi AJAX để kiểm tra
              const response = await fetch('../../../BLL/OrderBLL.php', {
                     method: 'POST',
                     headers: {
                            'Content-Type': 'application/x-www-form-urlencoded'
                     },
                     body: 'function=' + encodeURIComponent('getArrOrder_by_Date_State_UserName') + '&dateStart=' + encodeURIComponent(dateStart) + '&dateEnd=' + encodeURIComponent(dateEnd) + '&keyword=' + encodeURIComponent(keyword) + '&stateNeed=' + encodeURIComponent(stateNeed)
              });

              const data = await response.json();
              console.log(data);

              showDataTable(data);
              loadPage();

       } catch (error) {
              console.error('Error:', error);
       }
}

// show data table
function showDataTable(data) {
       let container = document.getElementById('data-table');
       container.innerHTML = `
              <div class="spinner-border text-primary" role="status">
                     <span class="visually-hidden">Loading...</span>
              </div>
       `;
       let container_modal_fix = document.getElementById('modal-fix-order');
       if (data.length > 0) {
              let result = '';
              let result_2 = '';
              for (let item of data) {
                     let orderCode = item.orderCode;
                     let userName = item.userName;
                     let deliveryAddress = item.deliveryAddress;
                     let note = item.note;
                     let totalMoney = item.totalMoney;
                     let status = item.status;
                     let dateCreated = item.dateCreated;

                     let string = `
                            <tr>
                                   <td>${orderCode}</td>
                                   <td>${userName}</td>
                                   <td>${deliveryAddress}</td>
                                   <td>${note}</td>
                                   <td>${totalMoney}</td>
                                   <td>${status}</td>
                                   <td>${dateCreated}</td>

                                   <td><a href="./bill_list_detail.php?orderCode=${orderCode}" class="btn-table-billDetail"> <i class="fa-solid fa-eye"></i> Chi tiết</a></td>
                                   <td>
                                          <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#${orderCode}">
                                                 <i class="fa-solid fa-wrench"></i> Sửa
                                          </button>
                                   </td>
                            </tr>
                     `;
                     result += string;

                     let string_1 = `
                     <div class="modal fade" id="${orderCode}" tabindex="-1" aria-labelledby="${orderCode}" aria-hidden="true">
                     <div class="modal-dialog">
                       <div class="modal-content">
                         <div class="modal-header">
                           <h1 class="modal-title fs-5" id="${orderCode}">Modal title</h1>
                           <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                         </div>
                         <div class="modal-body">
                           <span>Trạng thái đơn hàng: </span> 
                           <select id="${orderCode}-status" class="form-select" aria-label="Default select example">
                                   <option value="${status}" selected>${status}</option>
                                   <option value="completed">Completed</option>
                                   <option value="processing">Processing</option>
                                   <option value="cancelled">Cancelled</option>
                            </select>
                         </div>
                         <div class="modal-footer">
                           <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                           <button onclick="updateStatus('${orderCode}','${orderCode}-status')" type="button" class="btn btn-primary" data-bs-dismiss="modal">Save changes</button>
                         </div>
                       </div>
                     </div>
                   </div>
                     `;
                     result_2 += string_1;

              }
              container.innerHTML = result;
              container_modal_fix.innerHTML = result_2;
       } else {
              Swal.fire({
                     position: "center",
                     icon: "error",
                     title: "Không có dữ liệu trong khoảng thời gian này !!",
              });
       }
}

async function TimKiem() {
       let dateStart = document.getElementById('date-start').value;
       let dateEnd = document.getElementById('date-end').value;
       let state = document.getElementById('state-order').value;
       let keyword = document.getElementById('keyword-search').value;

       if (dateStart == '') {
              dateStart = '2000-01-01';
       }
       if (dateEnd == '') {
              let currentDate = new Date();
              // Lấy ngày, tháng và năm hiện tại
              var ngay = currentDate.getDate();
              var thang = currentDate.getMonth() + 1; // Tháng bắt đầu từ 0, cần cộng thêm 1
              var nam = currentDate.getFullYear();

              // Định dạng lại ngày tháng năm thành chuỗi "dd/mm/yyyy"
              dateEnd = nam + "-" + thang + "-" + ngay;
       }

       if (keyword == '') {
              keyword = 'empty';
       }

       console.log(dateStart, dateEnd, state, keyword);

       await loadData(dateStart, dateEnd, keyword, state);
       loadItem(1,5);
}

async function updateStatus(orderCode, id) {

       // lấy thông tin mã  codePermission của người đăng nhập
       let codePermission = await checkLogin_order();
       // lấy mảng chi tiết phân quyền dựa theo mã phân quyền của người đăng nhập
       let data = await getDataPermission_order(codePermission);
       // lấy thông tin có được phép làm chức ăng đó không
       let check = checkUpPermission_order(data.permissionDetail, "update");

       if (check == true) {
              let state = document.getElementById(id).value;
              console.log(orderCode, state);

              try {
                     // gọi AJAX để kiểm tra
                     const response = await fetch('../../../BLL/OrderBLL.php', {
                            method: 'POST',
                            headers: {
                                   'Content-Type': 'application/x-www-form-urlencoded'
                            },
                            body: 'function=' + encodeURIComponent('updateStateOrder') + '&orderCode=' + encodeURIComponent(orderCode) + '&state=' + encodeURIComponent(state)
                     });

                     const data = await response.json();
                     console.log(data);

                     if (data.mess == 'success') {
                            await Swal.fire({
                                   position: "center",
                                   icon: "success",
                                   title: "Cập nhật thành công !",
                                   showConfirmButton: false,
                                   timer: 2000
                            });
                            await TimKiem();
                     } else {
                            await Swal.fire({
                                   position: "center",
                                   icon: "error",
                                   title: "Cập nhật thất bại !",
                                   showConfirmButton: false,
                                   timer: 2000
                            });
                     }

              } catch (error) {
                     console.error('Error:', error);
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
       let all_data_rows = document.querySelectorAll('#data-table > tr');

       all_data_rows.forEach((item, index) => {
              if (index >= beginGet && index <= endGet) {
                     item.style.display = 'table-row';
              }
              else {
                     item.style.display = 'none';
              }
       });

       // hàm tính có bao nhieu nút chuyển trang
       listPage(thisPage, limit, all_data_rows);
       // loadPage();
}

function listPage(thisPage, limit, all_data_rows) {
       let result = '';
       let count = Math.ceil(all_data_rows.length / limit);
       // thêm nút prev

       if (thisPage != 1) {

              let string = `<li class="page-item" onclick="loadItem(${Number(thisPage) - 1},${limit})"><a class="page-link">Previous</a></li>`;
              result += string;
       } else if (thisPage == 1) {
              let string = `<li class="page-item disabled" style="cursor: default;"><a class="page-link">Previous</a></li>`;
              result += string;
       }

       // tính xem có bao nhieu nút

       // lấy container chứa nút phân trang
       let container = document.getElementById('Pagination');

       for (let i = 1; i <= count; i++) {
              let string = `<li class="page-item" onclick="loadItem(${i},${limit})"><a class="page-link">${i}</a></li>`;
              if (i == thisPage) {
                     string = `<li class="page-item active" onclick="loadItem(${i},${limit})"><a class="page-link">${i}</a></li>`;
              }
              result += string;
       }

       // thêm nút next

       if (thisPage != count) {
              let string1 = `<li class="page-item" onclick="loadItem(${Number(thisPage) + 1},${limit})"><a class="page-link">Next</a></li>`;
              result += string1;
       }
       else if (thisPage == count) {
              let string1 = `<li class="page-item disabled" style="cursor: default;"><a class="page-link">Next</a></li>`;
              result += string1;
       }

       container.innerHTML = result;
}

function loadPage() {
       // Lấy danh sách tất cả các thẻ <li> trong <ul> có id là "Panigation"
       var listItems = document.querySelectorAll('#Pagination li');

       // Duyệt qua từng phần tử trong danh sách
       listItems.forEach(function (item) {
              // Kiểm tra xem phần tử hiện tại có class là "active" hay không
              if (item.classList.contains('active')) {
                     // Nếu có, lấy nội dung trong thẻ <a> bên trong và chuyển thành số
                     var activePageText = item.querySelector('a').textContent.trim();
                     var activePageNumber = parseInt(activePageText);
                     console.log("Trang đang active: " + activePageNumber);
                     loadItem(activePageNumber, 4);
              }
       });

}








window.addEventListener('load', async function () {
       console.log('Trang list order đã load hoàn toàn');
       await TimKiem();
       loadItem(1,4);
});













