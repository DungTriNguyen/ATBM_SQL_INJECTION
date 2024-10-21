// ------------------------------------------- AJAX kiểm tra đăng nhập -----------------------------------------------
async function checkLogin() {
       try {
              const response = await fetch('../../BLL/AccountBLL.php', {
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
              if (result.result == 'success') {
                     setLogin(result.userName);
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
// hàm tự động xóa thông tin đăng nhập khi thoát trang bất ngờ
window.addEventListener('unload', async function (event) {
       try {
              const response = await fetch('../../BLL/AccountBLL.php', {
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
});

// hàm đăng xuất
async function logOut(event) {
       event.preventDefault();
       try {
              const response = await fetch('../../BLL/AccountBLL.php', {
                     method: 'POST',
                     headers: {
                            'Content-Type': 'application/x-www-form-urlencoded'
                     },
                     body: 'function=' + encodeURIComponent('logout_whenExitPage')
              });
              const data = await response.json();
              console.log(data);
              if (data.length == 0) {
                     await Swal.fire({
                            position: "center",
                            icon: "success",
                            title: "Logout Success",
                            showConfirmButton: false,
                            timer: 2000
                     });
                     window.location.href = "../../GUI/view/login.php";
              }
       } catch (error) {
              console.error('Error:', error);
       }
}

function setLogin(username) {
       let loginContainer = document.querySelector('header .menubar .user');
       if (username != '') {
              let string = `
                     <a href="./UserProfile.php">
                            <div class="user-infor">
                                   <i class="fas fa-user"></i>
                                   <span class="user-name">Hi, ${username}</span>
                            </div>
                     </a>
                     <div class="menu-user">
                                   <a href="../view/UserProfile.php" style="display:block;">My account</a>
                                   <a href="#" onclick = "logOut(event)" style="display:block;">Log out</a>
                     </div>
                     `;
              loginContainer.innerHTML = string;
       } else {
              let string = `
                     <a href="./login.php">
                            <div class="user-infor">
                                   <i class="fas fa-user"></i>
                            </div>
                     </a>
                     `;
              loginContainer.innerHTML = string;

       }
}

// logout


// ------------------------------------------- DÙNG AJAX ĐỂ LOAD DỮ LIỆU LÊN -------------------------

// load du lieu trong ô tiềm kiếm 
function searchProduct() {
       let search = document.querySelector('header .search .box-search input');
       // khi người dùng gõ ký tự thì nó sẽ tự động gọi AJAX
       search.oninput = async function getProduct() {
              console.log(search.value);
              try {
                     let keyword = 'null';
                     if (search.value !== '') {
                            keyword = search.value;
                     }
                     const response = await fetch('../../BLL/ProductBLL.php', {
                            method: 'POST',
                            headers: {
                                   'Content-Type': 'application/x-www-form-urlencoded'
                            },
                            body:
                                   'function=' + encodeURIComponent('searchProduct') + '&keyword=' + encodeURIComponent(keyword)
                     });
                     const data = await response.json();
                     console.log(data);
                     showSearchResult(data);
                     showSearchBox();

                     // showProductItem(data);
              } catch (error) {
                     console.error('Error:', error);
              }
       }
}
// searchProduct();

// show kết quả truy suất
function showSearchResult(data) {
       let result = '';
       let container = document.querySelector('header .search .box-search .result-search');
       for (let item of data) {
              // tim thay san pham
              if (item.productCode != '' && item.status == '1' && item.quantity > 1) {

                     let productCode = item.productCode;
                     let type = item.type;
                     // ma hoa
                     let mahoaProductCode = btoa(productCode);
                     let mahoaType = btoa(type);

                     // img
                     let stringImg = item.imgProduct;
                     let arrImg = stringImg.split(' ');
                     let firstImg = arrImg[0];

                     // name product
                     let nameProduct = item.nameProduct;

                     // path DetailProduct
                     let pathDetaiProduct = `./ProductDetail.php?code=${mahoaProductCode}&type=${mahoaType}`;

                     let string = `
                     <div class="item">
                            <a href="${pathDetaiProduct}">
                                   <img src="${firstImg}" alt="">
                                   <span>${nameProduct}</span>
                            </a>
                     </div>
                     
                     `;
                     result += string;
              }
       }
       // khong tim thay san pham
       if (result === '') {
              let string = `
              <div class="not-found-item">
                     <span>NOT FOUND</span>
                     <span><i class="fas fa-search"></i></span>
              </div>
              `;
              result += string;
       }
       container.innerHTML = result;
}


function showSearchBox() {
       let box = document.querySelector('header .search .box-search .result-search');
       let itemSearch = document.querySelectorAll('header .search .box-search .result-search .item');

       // neu ket qua tra ve > 2 product
       if (itemSearch.length > 2) {
              box.style.height = '140px';
       }
       else {
              box.style.height = 'auto'; // Sử dụng giá trị mặc định cho height
       }
}
// showSearchBox();

function search() {
       let box = document.querySelector('header .search .box-search');
       let icon_search = document.getElementById('search-icon');
       let input_search = document.querySelector('header .search .box-search input');

       // Thêm sự kiện click cho icon_search
       icon_search.addEventListener('click', function (event) {
              // Ngăn chặn sự lan truyền của sự kiện click để tránh kích hoạt sự kiện click của document
              event.preventDefault();
              event.stopPropagation();

              // Hiển thị phần tử box
              box.style.display = 'block';

              // Tự động focus vào input_search
              input_search.focus();
       });

       // Thêm sự kiện click cho toàn bộ tài liệu (document)
       document.addEventListener('click', function (event) {
              // Ẩn box nếu người dùng click ra ngoài box hoặc icon_search
              if (event.target !== box && event.target !== icon_search) {
                     box.style.display = 'none';
              }
       });

       // Ngăn chặn sự kiện click từ việc lan truyền đến document khi click vào box
       box.addEventListener('click', function (event) {
              event.stopPropagation();
       });


}
// search();
function cart() {
       let cartContainer = document.getElementById('cart-icon');

       // Lấy giá trị của tham số 'code' từ URL hiện tại
       let codeValue = btoa('P000');
       let typeValue = btoa('handbagProduct');
       let quantityBuyCode = btoa('0');
       let addCartCode = btoa('true');
       let sizeCode = btoa('S000');


       let string = `
       <a href="./Cart.php?code=${codeValue}&type=${typeValue}&quantityBuy=${quantityBuyCode}&addCart=${addCartCode}&sizeCode=${sizeCode}">
              <div class="cart">
                     <i class="fas fa-shopping-bag"></i>
                     <span id="number-cart" class="number-cart">0</span>
              </div>
       </a>
       `;
       cartContainer.innerHTML = string;
}

async function showCart_header() {
       try {
              let response = await fetch('../../BLL/OrderBLL.php', {
                     method: 'POST',
                     headers: {
                            'Content-Type': 'application/x-www-form-urlencoded'
                     },
                     body:
                            'function=' + encodeURIComponent('getArrCart')
              });
              let data = await response.json();
              if (data != null) {
                     console.log(data);
                     let count = 0;
                     for (let i of data) {
                            if (i.productCode != '') {
                                   count++;
                            }
                     }
                     let numberItemCart = document.getElementById('number-cart');
                     console.log(numberItemCart);
                     numberItemCart.innerHTML = count;
              }
              else {
                     // window.location.href = "../../error.php";
                     console.log('loi khong co du lieu tra ve ben ham show')
              }
       } catch (error) {
              console.error('Error:', error);
       }
}

window.addEventListener('load', function () {
       // Thực hiện các hàm bạn muốn sau khi trang web đã tải hoàn toàn, bao gồm tất cả các tài nguyên như hình ảnh, stylesheet, v.v.
       console.log('Header đã load hoàn toàn');
       search();
       searchProduct();
       cart();
       checkLogin();
       showCart_header();
});