// ------------------------------------------- AJAX kiểm tra đăng nhập -----------------------------------------------
async function checkLogin() {
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
                     setLogin(result.userName);
                     getDataPermission(result.codePermission);
              } else {
                     setLogin('');
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

async function getDataPermission(codePermission) {
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
                     setUpPermission(data.permissionDetail,codePermission);
              }

       } catch (error) {
              console.error('Error:', error);
       }
}

// setup các chức năng được truy cập
function setUpPermission(dataPermissionDetail, codePermission) {
       let permision_Permission = document.getElementById('user-group-sidebar');
       let account_Permission = document.getElementById('user-management-sidebar');
       let comment_Permission = document.getElementById('comment-management-sidebar');
       let feedback_Permission = document.getElementById('contact-management-sidebar');
       let order_Permission = document.getElementById('bill-management-sidebar');
       let payment_Permission = document.getElementById('payment-management-sidebar');
       let product_Permission = document.getElementById('product-management-sidebar');
       let size_Permission = document.getElementById('size-management-sidebar');
       let supplier_Permission = document.getElementById('supplier-management-sidebar');
       let transport_Permission = document.getElementById('transportation-management-sidebar');

       // một số chức năng thêm
       let add_account_Permission = document.getElementById('add-user-management-sidebar');
       let add_product_Permission = document.getElementById('add-product-management-sidebar');
       let add_supplier_Permission = document.getElementById('add-supplier-management-sidebar');
       let add_payment_Permission = document.getElementById('add-payment-management-sidebar');
       let add_transport_Permission = document.getElementById('add-transportation-management-sidebar');
       






       for (let item of dataPermissionDetail) {

              // quản lý phân quyền (nhóm người dùng), chỉ có admin mới dc
              if (codePermission == 'admin') {
                     permision_Permission.style.display = 'block';
              } else if (codePermission != 'admin') {
                     permision_Permission.style.display = 'none';
              }

              // quản lý feedback
              if (item.functionCode == "feedback" && item.seePermission == '1') {
                     feedback_Permission.style.display = 'block';
              } else if (item.functionCode == "feedback" && item.seePermission != '1') {
                     feedback_Permission.style.display = 'none';
              }

              // quản lý comment
              if (item.functionCode == "comment" && item.seePermission == '1') {
                     comment_Permission.style.display = 'block';
              } else if (item.functionCode == "comment" && item.seePermission != '1') {
                     comment_Permission.style.display = 'none';
              }

              // quản lý tài khoản người dùng
              if (item.functionCode == "account" && item.seePermission == '1') {
                     account_Permission.style.display = 'block';

                     // them
                     if(item.functionCode == "account" && item.addPermission == '1'){
                            add_account_Permission.style.display = 'block';
                     }else if(item.functionCode == "account" && item.addPermission != '1'){
                            add_account_Permission.style.display = 'none';
                     }

              } else if (item.functionCode == "account" && item.seePermission != '1') {
                     account_Permission.style.display = 'none';
              }

              // quản lý đơn hàng
              if (item.functionCode == "order" && item.seePermission == '1') {
                     order_Permission.style.display = 'block';
              } else if (item.functionCode == "order" && item.seePermission != '1') {
                     order_Permission.style.display = 'none';
              }

              // quản lý payment
              if (item.functionCode == "payment" && item.seePermission == '1') {
                     payment_Permission.style.display = 'block';

                     // them
                     if (item.functionCode == "payment" && item.addPermission == '1'){
                            add_payment_Permission.style.display = 'block';
                     }else if (item.functionCode == "payment" && item.addPermission != '1'){
                            add_payment_Permission.style.display = 'none';
                     }

              } else if (item.functionCode == "payment" && item.seePermission != '1') {
                     payment_Permission.style.display = 'none';
              }

              // quản lý sản phẩm
              if (item.functionCode == "product" && item.seePermission == '1') {
                     product_Permission.style.display = 'block';

                     // them
                     if (item.functionCode == "product" && item.addPermission == '1'){
                            add_product_Permission.style.display = 'block';
                     }else if (item.functionCode == "product" && item.addPermission != '1'){
                            add_product_Permission.style.display = 'none';
                     }
              } else if (item.functionCode == "product" && item.seePermission != '1') {
                     product_Permission.style.display = 'none';
              }

              // quản lý size
              if (item.functionCode == "size" && item.seePermission == '1') {
                     size_Permission.style.display = 'block';
              } else if (item.functionCode == "size" && item.seePermission != '1') {
                     size_Permission.style.display = 'none';
              }

              // quản lý nhà cung cấp
              if (item.functionCode == "supplier" && item.seePermission == '1') {
                     supplier_Permission.style.display = 'block';
                     // them
                     if (item.functionCode == "supplier" && item.addPermission == '1'){
                            add_supplier_Permission.style.display = 'block';
                     }else if (item.functionCode == "supplier" && item.addPermission != '1'){
                            add_supplier_Permission.style.display = 'none';
                     }

              } else if (item.functionCode == "supplier" && item.seePermission != '1') {
                     supplier_Permission.style.display = 'none';
              }

              // quan ly transport
              if (item.functionCode == "transport" && item.seePermission == '1') {
                     transport_Permission.style.display = 'block';
                     // them
                     if (item.functionCode == "transport" && item.addPermission == '1'){
                            add_transport_Permission.style.display = 'block';
                     }else if (item.functionCode == "transport" && item.addPermission != '1'){
                            add_transport_Permission.style.display = 'none';
                     }
              } else if (item.functionCode == "transport" && item.seePermission != '1') {
                     transport_Permission.style.display = 'none';
              }


       }
}

function setLogin(username) {
       let loginContainer1 = document.getElementById('info');
       let loginContainer2 = document.getElementById('info-header');

       if (username != '') {
              let string = `
                     <img src="../../image/avt.jpg" alt="" class="avt">
                     <span class="name">${username}</span>
              `;
              loginContainer1.innerHTML = string;
              let string2 = `
                     <i class="far fa-user fa-sm"></i>
                     <span>Hi, ${username}</span>
              `;
              loginContainer2.innerHTML = string2;
       } else {
              let string = `
                     <img src="../../image/avt.jpg" alt="" class="avt">
                     <span class="name"> Admin</span>
                     `;
              loginContainer1.innerHTML = string;
              let string2 = `<i class="far fa-user fa-sm"></i>`;
              loginContainer2.innerHTML = string2;
              window.location.href = "../../../GUI/view/login.php";
       }
}

// hàm tự động xóa thông tin đăng nhập khi thoát trang bất ngờ và đăng xuất.

async function logOutWhenExitingPage() {
       try {
              const response = await fetch('../../../BLL/AccountBLL.php', {
                     method: 'POST',
                     headers: {
                            'Content-Type': 'application/x-www-form-urlencoded'
                     },
                     body: 'function=' + encodeURIComponent('logout_whenExitPage')
              });
              const data = await response.json();
              console.log(data);
       } catch (error) {
              console.error('Error:', error);
       }
}

window.addEventListener('unload', function (event) {
       logOutWhenExitingPage();
});
document.getElementById('logout').onclick = function (event) {
       logOutWhenExitingPage();
       setLogin('');
}


// hàm được dùng để hiện các chứcc năng phân quyền
async function permisions() {

}

// --------------------------------
function action() {
       const itemMenu = document.querySelectorAll(".sub-menu > ul > li ");
       const itemSubMenu = document.querySelectorAll(".sub-menu > ul > li > ul > li");
       const arrow = document.querySelectorAll(".nav > li > a > i")
       itemMenu.forEach((current, i) => {

              current.addEventListener("click", () => {
                     if (i == 0) {
                            checkFlag();
                            current.firstElementChild.classList.add("active");
                            checkDisplayItem();
                     }
                     else if (current.lastElementChild.classList.contains("ele-sub")) {
                            current.lastElementChild.classList.remove("ele-sub");
                            if (!current.firstElementChild.classList.contains("active")) {
                                   current.firstElementChild.classList.add("active-sub");
                            }
                            arrow[i - 1].style.transform = "rotate(-91deg)";
                     } else {
                            current.lastElementChild.classList.add("ele-sub");
                            arrow[i - 1].style.transform = "rotate(0)";

                     }
              });
              const child = current.lastElementChild.querySelectorAll("ul > li");
              child.forEach((currentChild, i) => {
                     currentChild.addEventListener("click", () => {
                            checkFlag();
                            current.firstElementChild.classList.add("active");
                            current.firstElementChild.classList.remove("active-sub");
                            checkDisplayItem();
                     });
              });
       });

       function checkFlag() {
              itemMenu.forEach((item, i) => {
                     if (item.firstElementChild.classList.contains("active")) {
                            item.firstElementChild.classList.remove("active");
                     }
                     if (item.firstElementChild.classList.contains("active-sub")) {
                            item.firstElementChild.classList.remove("active-sub");
                     }
              });
       }

       function checkDisplayItem() {
              itemMenu.forEach((item, i) => {
                     if (i == 0) {
                     }
                     else if (!item.lastElementChild.classList.contains("ele-sub")) {
                            item.lastElementChild.classList.add("ele-sub");
                     }
              });
       }



       // JS HEADERRRRRRR 


       const infoHeader = document.querySelector(".info-header");
       const menuHeader = document.querySelector(".menu-header");



       let i = 0;


       infoHeader.addEventListener("click", () => {
              i++;
              if (i % 2 == 0) {
                     menuHeader.classList.remove("show");

              } else {
                     menuHeader.classList.add("show");
              }
       });


}


window.addEventListener('load', async function () {
       console.log('sidebar da load xong');
       await checkLogin();


       action();
})
