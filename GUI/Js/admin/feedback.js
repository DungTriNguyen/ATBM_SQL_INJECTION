// ------------------------------------------- AJAX kiểm tra đăng nhập -----------------------------------------------
async function checkLogin_feedback() {
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

async function getDataPermission_feedback(codePermission) {
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
function checkUpPermission_feedback(dataPermissionDetail, functionPoint) {

       if (functionPoint == "") {
              return false;
       }

       for (let item of dataPermissionDetail) {
              if (item.functionCode == "feedback") {
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
              const response = await fetch('../../../BLL/FeedbackBLL.php', {
                     method: 'POST',
                     headers: {
                            'Content-Type': 'application/x-www-form-urlencoded'
                     },
                     body: 'function=' + encodeURIComponent('getArrObj')
              });

              const data = await response.json();
              console.log(data);
              showFeedback(data);
              loadPage();
       } catch (error) {
              console.error('Error:', error);
       }
}

document.getElementById("submit-contact").addEventListener("click", function () {
       searchFeedbacksByUsername();
       searchFeedbacksByEmail();
});

function loadItem(thisPage, limit) {

       // tính vị trí bắt đầu và kêt thúc
       let beginGet = limit * (thisPage - 1);
       let endGet = limit * thisPage - 1;

       // lấy tất cả các dòng dữ liệu có trong bảng
       let all_data_rows = document.querySelectorAll('#feedBackList > tr');

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

              let string = `<li class="admin-pageNav-item" onclick="loadItem(${Number(thisPage) - 1},${limit})"><a class="admin-pageNav-link">Previous</a></li>`;
              result += string;
       } else if (thisPage == 1) {
              let string = `<li class="admin-pageNav-item d-none-btn" style="cursor: default;"><a class="admin-pageNav-link">Previous</a></li>`;
              result += string;
       }

       // tính xem có bao nhieu nút

       // lấy container chứa nút phân trang
       let container = document.getElementById('list-page');

       for (let i = 1; i <= count; i++) {
              let string = `<li class="admin-pageNav-item" onclick="loadItem(${i},${limit})"><a class="admin-pageNav-link">${i}</a></li>`;
              if (i == thisPage) {
                     string = `<li class="admin-pageNav-item active" onclick="loadItem(${i},${limit})"><a class="admin-pageNav-link">${i}</a></li>`;
              }
              result += string;
       }

       // thêm nút next

       if (thisPage != count) {
              let string1 = `<li class="admin-pageNav-item" onclick="loadItem(${Number(thisPage) + 1},${limit})"><a class="admin-pageNav-link">Next</a></li>`;
              result += string1;
       }
       else if (thisPage == count) {
              let string1 = `<li class="admin-pageNav-item d-none-btn" style="cursor: default;"><a class="admin-pageNav-link">Next</a></li>`;
              result += string1;
       }

       container.innerHTML = result;
}

function loadPage() {

       var listItems = document.querySelectorAll('#list-page li');

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


// async function getObj(code) {
//        let codeFeedback = code;
//        try {
//               // gọi AJAX để kiểm tra
//               const response = await fetch('../../../BLL/FeedbackBLL.php', {
//                      method: 'POST',
//                      headers: {
//                             'Content-Type': 'application/x-www-form-urlencoded'
//                      },
//                      body: 'function=' + encodeURIComponent('getObj') + '&codeFeedback=' + encodeURIComponent(codeFeedback)
//               });

//               const data = await response.json();
//               console.log(data);

//        } catch (error) {
//               console.error('Error:', error);
//        }
// }

function showFeedback(data) {
       let container = document.getElementById('feedBackList');
       let container1 = document.getElementById('edit-feedback');
       let container2 = document.getElementById('delete-feedback');


       let result = ``;
       let result1 = ``;
       let result2 = ``;

       for (let i of data) {
              let str = `
              <tr>
                     <td>${i.codeFeedback}</td>
                     <td>${i.userName}</td>
                     <td>${i.email}</td>
                     <td>${i.content}</td>
                     <td>${i.replay}</td>
                     <td>${i.sentDate}</td>
                     <td><a href="#" class="btn-table-billUpdate" data-bs-toggle="modal" data-bs-target="#editFeedback-${i.codeFeedback}"><i class="fa fa-edit"></i> Sửa</a></td>
                     <td><a href="#" class="btn-table-warning" data-bs-toggle="modal" data-bs-target="#deleteFeedback-${i.codeFeedback}"><i class="fa fa-trash"></i>Xóa</a></td>
              </tr>
              `;


              // Str sửa
              let str1 = `
                     <div class="modal fade" id="editFeedback-${i.codeFeedback}" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                            <div class="modal-content">
                                   <div class="modal-header">
                                   <h5 class="modal-title" id="editModalLabel">Cập nhật feedback</h5>
                                   <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                   </div>
                                   <div class="modal-body">
                                   <form id="editForm">
                                   <div class="mb-3">
                                                 <label for="codeFeedback" class="form-label">Mã feedback</label>
                                                 <input type="text" class="form-control" id="${i.codeFeedback}" name="codeFeedback" value=${i.codeFeedback} disabled>
                                          </div>
                                          <div class="mb-3">
                                                 <label for="userName" class="form-label">Tên người dùng</label>
                                                 <input type="text" class="form-control" id="${i.codeFeedback}-${i.userName}" name="userName" value=${i.userName} disabled>
                                          </div>
                                          <div class="mb-3">
                                                 <label for="sentDate" class="form-label">Ngày gửi</label>
                                                 <input type="text" class="form-control" id="${i.codeFeedback}-${i.sentDate}" name="sentDate" value=${i.sentDate} disabled>
                                          </div>
                                          <div class="mb-3">
                                                 <label for="email" class="form-label">Email</label>
                                                 <input type="text" class="form-control" id="${i.codeFeedback}-${i.email}" name="email" value=${i.email} disabled>
                                          </div>
                                          <div class="mb-3">
                                                 <label for="content" class="form-label">Lời nhắn</label>
                                                 <input type="text" class="form-control" id="${i.codeFeedback}-${i.content}" name="content" value="${i.content}" disabled>
                                          </div>
                                          <div class="mb-3">
                                                 <label for="replay" class="form-label">Trả lời</label>
                                                 <input type="text" class="form-control" id="${i.codeFeedback}-${i.replay}" name="replay" value="${i.replay}">
                                          </div>
                                          <div style="text-align:right;">
                                                 <button data-bs-dismiss="modal" class="btn btn-primary" id="btn-update" onclick="updateFeedback('${i.codeFeedback}','${i.codeFeedback}-${i.userName}','${i.codeFeedback}-${i.sentDate}','${i.codeFeedback}-${i.email}','${i.codeFeedback}-${i.content}','${i.codeFeedback}-${i.replay}' ,event)">Cập nhật feedback</button>
                                          </div>   
                                   </form>
                                   </div>
                            </div>
                            </div>
                     </div>
              `;

              // // str xóa
              let str2 = `
                            <div class="modal fade" id="deleteFeedback-${i.codeFeedback}" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                   <div class="modal-dialog">
                                          <div class="modal-content">
                                                 <div class="modal-header">
                                                 <h5 class="modal-title" id="deleteModalLabel">Xóa feedback</h5>
                                                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                 </div>
                                                 <div class="modal-body">
                                                 Bạn có chắc muốn xóa feedback này?
                                                 <br>
                                                 Mã feedback: ${i.codeFeedback}
                                                 
                                                 </div>
                                                 <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                                                        <button data-bs-dismiss="modal" type="button" class="btn btn-danger btn-confirm-delete" onclick="deleteFeedback('${i.codeFeedback}')">Xóa</button>
                                                 </div>
                                          </div>
                                   </div>
                            </div>
              `;

              result += str;
              result1 += str1;
              result2 += str2;
       }
       container.innerHTML = result;
       container1.innerHTML = result1;
       container2.innerHTML = result2;
}

async function searchFeedbacksByUsername() {
       try {
              let str = document.getElementById("input-search-username").value;
              // gọi AJAX để kiểm tra
              const response = await fetch('../../../BLL/FeedbackBLL.php', {
                     method: 'POST',
                     headers: {
                            'Content-Type': 'application/x-www-form-urlencoded'
                     },
                     body: 'function=' + encodeURIComponent('searchFeedbacksByUsername') + '&str=' + encodeURIComponent(str)
              });
              const data = await response.json();
              if (data.length == 0) {

                     console.log('Không có dữ liệu');

                     document.querySelector('#list-page').style.display = 'none';
                     showFeedback(data);
              }
              else {

                     showFeedback(data);
                     document.querySelector('#list-page').style.display = 'flex';
                     loadItem(1, 4);

              }
              console.log(data);
              showFeedback(data);
              loadPage();
       } catch (error) {
              console.error('Error:', error);
       }
}

async function searchFeedbacksByEmail() {
       try {
              let str = document.getElementById("input-search-email").value;
              // gọi AJAX để kiểm tra
              const response = await fetch('../../../BLL/FeedbackBLL.php', {
                     method: 'POST',
                     headers: {
                            'Content-Type': 'application/x-www-form-urlencoded'
                     },
                     body: 'function=' + encodeURIComponent('searchFeedbacksByEmail') + '&str=' + encodeURIComponent(str)
              });
              const data = await response.json();
              if (data.length == 0) {

                     console.log('Không có dữ liệu');

                     document.querySelector('#list-page').style.display = 'none';
                     showFeedback(data);
                     loadPage();
              }
              else {

                     showFeedback(data);
                     document.querySelector('#list-page').style.display = 'flex';
                     loadItem(1, 4);

              }
              console.log(data);
              showFeedback(data);
              loadPage();
       } catch (error) {
              console.error('Error:', error);
       }
}

async function deleteFeedback(code) {

       // lấy thông tin mã  codePermission của người đăng nhập
       let codePermission = await checkLogin_feedback();
       // lấy mảng chi tiết phân quyền dựa theo mã phân quyền của người đăng nhập
       let data = await getDataPermission_feedback(codePermission);
       // lấy thông tin có được phép làm chức ăng đó không
       let check = checkUpPermission_feedback(data.permissionDetail, "delete");

       if (check == true) {
              try {
                     // gọi AJAX để kiểm tra
                     const response = await fetch('../../../BLL/FeedbackBLL.php', {
                            method: 'POST',
                            headers: {
                                   'Content-Type': 'application/x-www-form-urlencoded'
                            },
                            body: 'function=' + encodeURIComponent('deleteObjByID') + '&codeFeedback=' + encodeURIComponent(code)
                     });

                     const data1 = await response.json();
                     console.log(data1);
                     if (data1.mess === "success") {
                            await Swal.fire({
                                   position: "center",
                                   icon: "success",
                                   title: "Xóa feedback thành công",
                                   showConfirmButton: false,
                                   timer: 1500
                            });
                            await getArr();
                     }


              } catch (error) {
                     console.error('Error:', error);
              }
       } else {
              Swal.fire({
                     icon: "error",
                     title: "Xóa không thành công",
                     text: "Không đủ quyền hàng",
              });
       }


}

async function updateFeedback(code, userName, sentDate, email, content, replay, event) {
       event.preventDefault();

       // lấy thông tin mã  codePermission của người đăng nhập
       let codePermission = await checkLogin_feedback();
       // lấy mảng chi tiết phân quyền dựa theo mã phân quyền của người đăng nhập
       let data = await getDataPermission_feedback(codePermission);
       // lấy thông tin có được phép làm chức ăng đó không
       let check = checkUpPermission_feedback(data.permissionDetail, "update");

       if (check == true) {
              let codeFeedbackValue = document.getElementById(code).value;
              let userNameFeedbackValue = document.getElementById(userName).value;
              let sentDateFeedbackValue = document.getElementById(sentDate).value;
              let emailFeedbackValue = document.getElementById(email).value;
              let contentFeedbackValue = document.getElementById(content).value;
              let replayFeedbackValue = document.getElementById(replay).value;
              try {
                     const response = await fetch('../../../BLL/FeedbackBLL.php', {
                            method: 'POST',
                            headers: {
                                   'Content-Type': 'application/x-www-form-urlencoded'
                            },
                            body: 'function=' + encodeURIComponent('updateObj') + '&codeFeedback=' + encodeURIComponent(codeFeedbackValue) + '&userName=' + encodeURIComponent(userNameFeedbackValue) +
                                   '&sentDate=' + encodeURIComponent(sentDateFeedbackValue) + '&email=' + encodeURIComponent(emailFeedbackValue) +
                                   '&content=' + encodeURIComponent(contentFeedbackValue) + '&replay=' + encodeURIComponent(replayFeedbackValue)
                     });

                     const data = await response.json();
                     console.log(data);
                     if (data.mess === "success") {
                            await Swal.fire({
                                   position: "center",
                                   icon: "success",
                                   title: "Cập nhật thành công",
                                   showConfirmButton: false,
                                   timer: 1500
                            });
                            await getArr();
                     }


              } catch (error) {
                     console.error('Error:', error);
              };
       }else{
              Swal.fire({
                     icon: "error",
                     title: "Sửa không thành công",
                     text: "Không đủ quyền hàng",
              });
       }



}
window.addEventListener("load", async function () {
       console.log("Trang feedback đã load hoàn toàn");
       await getArr();

       loadItem(1, 4);
});