// ------------------------------------------- AJAX kiểm tra đăng nhập -----------------------------------------------
async function checkLogin_transport() {
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

async function getDataPermission_transport(codePermission) {
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
function checkUpPermission_transport(dataPermissionDetail, functionPoint) {

       if (functionPoint == "") {
              return false;
       }

       for (let item of dataPermissionDetail) {
              if (item.functionCode == "transport") {
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
              const response = await fetch('../../../BLL/TransportBLL.php', {
                     method: 'POST',
                     headers: {
                            'Content-Type': 'application/x-www-form-urlencoded'
                     },
                     body: 'function=' + encodeURIComponent('getArrObj')
              });
              
              const data = await response.json();
              console.log(data);
              console.log(data[0].codeTransport);
              
              //     Display Transport
              showTransport(data);
              loadPage();
              
              
       } catch (error) {
              console.error('Error:', error);
       }
}

async function getObj(code) {
       let codeTransport = code;
       try {
              // gọi AJAX để kiểm tra
              const response = await fetch('../../../BLL/TransportBLL.php', {
                     method: 'POST',
                     headers: {
                            'Content-Type': 'application/x-www-form-urlencoded'
                     },
                     body: 'function=' + encodeURIComponent('getObj') + '&codeTransport=' + encodeURIComponent(codeTransport)
              });
              
              const data = await response.json();
              console.log(data);

       } catch (error) {
              console.error('Error:', error);
       }
}




function showTransport(data){
       let container = document.getElementById('transportList');
       let container1 = document.getElementById('edit-transport');
       let container2 = document.getElementById('delete-transport');


       let result1 = ``;
       let result = ``;
       let result2 = ``;

       for(let i of data){
              let str = `
              <tr>
                     <td>${i.nameTransport}</td>
                     <td>${i.codeTransport}</td>
                     <td>${i.affiliatedCompany}</td>
                     <td>
                            <a href="#" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editTransport-${i.codeTransport}">Sửa <i class="fa fa-edit"></i></a>
                            <a href="#" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteTransport-${i.codeTransport}">Xóa <i class="fa fa-trash"></i></a>
                     </td>
              </tr>
              `;
              
              // Str sửa
              let str1 = `
                     <div class="modal fade" id="editTransport-${i.codeTransport}" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                            <div class="modal-content">
                                   <div class="modal-header">
                                          <h5 class="modal-title" id="editModalLabel">Cập nhật thông tin hình thức vận chuyển</h5>
                                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Đóng"></button>
                                   </div>
                                   <div class="modal-body">
                                   <form id="editForm">
                                          <div class="mb-3">
                                          <label for="codeTransport" class="form-label">Mã hình thức vận chuyển</label>
                                          <input type="text" class="form-control" id="${i.codeTransport}" name="codeTransport" value="${i.codeTransport}" disabled>
                                          </div>
                                          <div class="mb-3">
                                          <label for="nameTransport" class="form-label">Tên hình thức vận chuyển</label>
                                          <input type="text" class="form-control" id="${i.codeTransport}-${i.nameTransport}" name="nameTransport" value="${i.nameTransport}">
                                          </div>
                                          <div class="mb-3">
                                          <label for="affiliatedCompany" class="form-label">Công ty liên kết</label>
                                          <input type="text" class="form-control" id="${i.codeTransport}-${i.affiliatedCompany}" name="affiliatedCompany" value="${i.affiliatedCompany}">
                                          </div>
                                          <div style="text-align:right;">
                                                 <button data-bs-dismiss="modal" class="btn btn-primary" id="btn-update" onclick="updateTransport('${i.codeTransport}','${i.codeTransport}-${i.nameTransport}','${i.codeTransport}-${i.affiliatedCompany}',event)">Cập nhật</button>
                                          </div>   
                                   </form>
                                   </div>
                            </div>
                            </div>
                     </div>
              `;

              // str xóa
              let str2 = `
                            <div class="modal fade" id="deleteTransport-${i.codeTransport}" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                   <div class="modal-dialog">
                                          <div class="modal-content">
                                                 <div class="modal-header">
                                                 <h5 class="modal-title" id="deleteModalLabel">Xóa hình thức vận chuyển</h5>
                                                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                 </div>
                                                 <div class="modal-body">
                                                 Bạn có chắc muốn xóa hình thức vận chuyển này?
                                                 <br>
                                                 Mã hình thức vận chuyển: ${i.codeTransport}
                                                 
                                                 </div>
                                                 <div class="modal-footer">
                                                 <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                                                 <button data-bs-dismiss="modal" type="button" class="btn btn-danger btn-confirm-delete" onclick="deleteTransport('${i.codeTransport}')">Xóa</button>
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

function searchTransports(){
       document.getElementById("input-search").oninput = async function(){
              try {
                     let str = document.getElementById("input-search").value;
                     // gọi AJAX để kiểm tra
                     const response = await fetch('../../../BLL/TransportBLL.php', {
                            method: 'POST',
                            headers: {
                                   'Content-Type': 'application/x-www-form-urlencoded'
                            },
                            body: 'function=' + encodeURIComponent('searchTransports')+'&str=' + encodeURIComponent(str)
                     });
                     
                     const data = await response.json();
                     console.log(data);
                     
                     if(data.length == 0){
                            
                            console.log('Không có dữ liệu');
                            
                            document.querySelector('#Pagination').style.display = 'none';
                            showTransport(data);
                     }
                     else { 
                            
                            showTransport(data);
                            document.querySelector('#Pagination').style.display = 'flex';
                            loadItem(1,4);
                            
                     }
                     
              } catch (error) {
                     console.error('Error:', error);
              }
              
       };
}

async function addObj(event){
       
       // lấy thông tin mã  codePermission của người đăng nhập
       let codePermission = await checkLogin_transport();
       // lấy mảng chi tiết phân quyền dựa theo mã phân quyền của người đăng nhập
       let data = await getDataPermission_transport(codePermission);
       // lấy thông tin có được phép làm chức ăng đó không
       let check = checkUpPermission_transport(data.permissionDetail, "add");

       if(check == true){
              window.location.href = "../../../GUI/view/admin/addtransport.php";
       }else{
              event.preventDefault();
              Swal.fire({
                     icon: "error",
                     title: "Thêm không thành công",
                     text: "Không đủ quyền hàng",
              });
       }
}

       async function updateTransport(code,name,company,event){

              // lấy thông tin mã  codePermission của người đăng nhập
              let codePermission = await checkLogin_transport();
              // lấy mảng chi tiết phân quyền dựa theo mã phân quyền của người đăng nhập
              let data = await getDataPermission_transport(codePermission);
              // lấy thông tin có được phép làm chức ăng đó không
              let check = checkUpPermission_transport(data.permissionDetail, "update");

              if(check == true){
                     event.preventDefault();
                     let codeTransportValue = document.getElementById(code).value;
                     let nameTransportValue = document.getElementById(name).value;
                     let affiliatedCompanyValue = document.getElementById(company).value;


                     if(nameTransportValue.trim() === '' || affiliatedCompanyValue.trim() === ''){
                            Swal.fire({
                                   icon: "error",
                                   title: "Sửa thất bại!",
                                   text: "Không bỏ trống thông tin"
                            });
                     } else {
                            try{
                                   const response = await fetch('../../../BLL/TransportBLL.php', {
                                          method: 'POST',
                                          headers: {
                                                 'Content-Type': 'application/x-www-form-urlencoded'
                                          },
                                          body: 'function=' + encodeURIComponent('updateObj')+'&codeTransport=' + encodeURIComponent(codeTransportValue)+
                                          '&nameTransport=' + encodeURIComponent(nameTransportValue)+ '&affiliatedCompany=' + encodeURIComponent(affiliatedCompanyValue)
                                   });
                                   
                                   const data = await response.json();
                                   console.log(data);
                                   if(data.mess === "success"){
                                          await Swal.fire({
                                                 position: "center",
                                                 icon: "success",
                                                 title: "Cập nhật thành công!",
                                                 showConfirmButton: false,
                                                 timer: 1500
                                          });
                                          await getArr();
                                          console.log(data);
                                   }
                                   
                                   
                            } catch (error) {
                                   console.error('Error:', error);
                            };
                     }
              }else{
                     Swal.fire({
                            icon: "error",
                            title: "Sửa không thành công",
                            text: "Không đủ quyền hàng",
                     });
              }
              
                    
       }

       //Xóa transport
       async function deleteTransport(code){

              // lấy thông tin mã  codePermission của người đăng nhập
              let codePermission = await checkLogin_transport();
              // lấy mảng chi tiết phân quyền dựa theo mã phân quyền của người đăng nhập
              let data = await getDataPermission_transport(codePermission);
              // lấy thông tin có được phép làm chức ăng đó không
              let check = checkUpPermission_transport(data.permissionDetail, "delete");

              if(check == true){
                     try {
                            // gọi AJAX để kiểm tra
                            const response = await fetch('../../../BLL/TransportBLL.php', {
                                   method: 'POST',
                                   headers: {
                                          'Content-Type': 'application/x-www-form-urlencoded'
                                   },
                                   body: 'function=' + encodeURIComponent('deleteObjByID')+'&codeTransport=' + encodeURIComponent(code)
                            });
                            
                            const data1 = await response.json();
                            console.log(data1);
                            if(data1.mess === "success"){
                                   await Swal.fire({
                                          position: "center",
                                          icon: "success",
                                          title: "Xóa hình thức vận chuyển thành công",
                                          showConfirmButton: false,
                                          timer: 1500
                                        });
                                   await getArr();
                            }
              
              
                            } catch (error) {
                                   console.error('Error:', error);
                            }
              }else{
                     Swal.fire({
                            icon: "error",
                            title: "Xóa không thành công",
                            text: "Không đủ quyền hàng",
                     });
              }
       
              

       }

function loadItem(thisPage, limit) {

       // tính vị trí bắt đầu và kêt thúc
       let beginGet = limit * (thisPage - 1);
       let endGet = limit * thisPage - 1;

       // lấy tất cả các dòng dữ liệu có trong bảng
       let all_data_rows = document.querySelectorAll('#transportList > tr');

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
}
       
function listPage(thisPage, limit, all_data_rows) {
       let result = '';
       let count = Math.ceil(all_data_rows.length / limit);
       // thêm nút prev
       
       if (thisPage != 1) {

              let string = `<li class="page-item" onclick="loadItem(${Number(thisPage) - 1},${limit})"><a class="page-link">Previous</a></li>`;
              result += string;
       } else if(thisPage == 1){
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
       else if(thisPage == count){
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


window.addEventListener("load", async function () {
       // Thực hiện các hàm bạn muốn sau khi trang web đã tải hoàn toàn, bao gồm tất cả các tài nguyên như hình ảnh, stylesheet, v.v.
       await getArr();
       searchTransports();
       loadItem(1,4);
       console.log("Trang transport đã load hoàn toàn");
});


// async function getTransportByCode(data){
//        try {
              
//        } catch (error) {
//               console.error('Error:', error);
//        }
// }

