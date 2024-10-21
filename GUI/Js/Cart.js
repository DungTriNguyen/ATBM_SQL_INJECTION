// AJAX

// tham số truyền qua đường dẫn: code sp và type sản phẩm, số lượng mua 
// Lấy các tham số code sp và type để lấy thông tin sản phẩm đó
function isValidBase64(str) {
       try {
              return btoa(atob(str)) == str;
       } catch (err) {
              return false;
       }
}

function isNumeric(value) {
       return !isNaN(parseFloat(value)) && isFinite(value);
}

async function addToCart() {
       // Tạo một đối tượng URLSearchParams từ đường dẫn URL hiện tại
       let urlParams = new URLSearchParams(window.location.search);

       // Lấy giá trị của tham số 'code', 'type', và 'quantityBuy' từ URL hiện tại
       let codeValue = urlParams.get('code');
       let typeValue = urlParams.get('type');
       let quantityBuyValue = urlParams.get('quantityBuy');
       let statusValue = urlParams.get('addCart');
       let sizeCodeValue = urlParams.get('sizeCode');



       // Kiểm tra xem ba biến có phải là mã base64 và quantityBuy có phải là số không
       if (isValidBase64(codeValue) && isValidBase64(typeValue) && isValidBase64(quantityBuyValue) && isValidBase64(statusValue) && isValidBase64(sizeCodeValue)) {
              // Giải mã chuỗi base64 thành string
              let code = atob(codeValue);
              let type = atob(typeValue);
              let sizeCode = atob(sizeCodeValue);
              // Chuyển đổi quantityBuy từ chuỗi thành số
              let quantityBuy = parseInt(atob(quantityBuyValue));

              // status giống như cờ hiệu. KHi thêm vào vỏ hàng thành công thì cờ hiệu này sẽ bật lên false để tránh người dùng load lại trang, nó tự cập nhật só lượng mua
              let status = atob(statusValue);

              // Kiểm tra kết quả
              console.log(code, type, quantityBuy, sizeCode, status);

              if (status == 'true') {
                     // goi ajax
                     try {
                            let response = await fetch('../../BLL/OrderBLL.php', {
                                   method: 'POST',
                                   headers: {
                                          'Content-Type': 'application/x-www-form-urlencoded'
                                   },
                                   body:
                                          'function=' + encodeURIComponent('addCartToSession') + '&code=' + encodeURIComponent(code) + '&type=' + encodeURIComponent(type) + '&quantityBuy=' + encodeURIComponent(quantityBuy) + '&sizeCode=' + encodeURIComponent(sizeCode)
                            });
                            let data = await response.json();
                            if (data != null) {

                                   console.log(data);
                                   warning_add_success_or_fail(data);
                                   // for (let i of data) {
                                   //        if (i.message == 'notEnoughQuantity') {
                                   //               alert('Sô lượng sản phẩm trong cửa hàng không đủ để đáp ứng như cầu mua của bạn');
                                   //        }
                                   // }

                                   status = 'false';    // thêm thành công thì bật cờ hiệu lên false
                                   // cập nhật lại đường dẫn với giá trị addCart = false
                                   history.pushState(null, '', `./Cart.php?code=${codeValue}&type=${typeValue}&quantityBuy=${quantityBuyValue}&addCart=${btoa(status)}&sizeCode=${sizeCodeValue}`);

                                   // kiểm tra xem có đăng nhập chưa, nếu không sẽ xóa hết giỏ hàng
                                   await clearCart();
                                   // xem danh sách giỏ hàng
                                   await showCart();


                            }
                            else {
                                   // window.location.href = "../../error.php";
                                   console.log('loi khong co du lieu truyen ve tu ham addToCart')
                            }
                     } catch (error) {
                            console.error('Error:', error);
                     }
              } else {
                     // kiểm tra xem có đăng nhập chưa, nếu không sẽ xóa hết giỏ hàng
                     await clearCart();
                     // xem danh sách giỏ hàng
                     await showCart();
              }

       } else {
              // Nếu không hợp lệ, chuyển hướng đến trang lỗi
              // window.location.href = "../../error.php";
              console.log('loi tham so tren duong dan');
       }
}

async function warning_add_success_or_fail(data) {
       // thong bao
       let warning_add_success = document.getElementById('warning-add-success');
       if (await checkLogin_toCart() == true) {
              warning_add_success.classList.remove('display_none');
       } else {
              warning_add_success.classList.add('display_none');
       }
       let string = '';
       for (let i of data) {
              if (i.message == 'notEnoughQuantity') {
                     // alert thông báo thêm không thành công
                     const Toast = await Swal.mixin({
                            toast: true,
                            position: "top-end",
                            showConfirmButton: false,
                            timer: 2000,
                            timerProgressBar: true,
                            didOpen: (toast) => {
                                   toast.onmouseenter = Swal.stopTimer;
                                   toast.onmouseleave = Swal.resumeTimer;
                            }
                     });
                     Toast.fire({
                            icon: "error",
                            title: "Add to cart failed"
                     });
                     string = `
                            <div class="cart_mess_icon">
                                   <i class="fas fa-times-circle" style="color: #e66565;"></i>
                            </div>
                            <span id="name-item" class="cart_mess_text">“${i.nameProduct}” was not successfully added to the cart due to insufficient quantity in the store.</span>
                     `;
              } else if (i.message == 'success') {
                     // alert thông báo thêm thành công 
                     const Toast = await Swal.mixin({
                            toast: true,
                            position: "top-end",
                            showConfirmButton: false,
                            timer: 2000,
                            timerProgressBar: true,
                            didOpen: (toast) => {
                                   toast.onmouseenter = Swal.stopTimer;
                                   toast.onmouseleave = Swal.resumeTimer;
                            }
                     });
                     Toast.fire({
                            icon: "success",
                            title: "Add to cart successfully"
                     });
                     string = `
                            <div class="cart_mess_icon">
                                   <i class="fa-solid fa-circle-check"></i>
                            </div>
                            <span id="name-item" class="cart_mess_text">“${i.nameProduct}” has been added to your cart.</span>
                     `;
              }
       }
       warning_add_success.innerHTML = string;
}



// Gọi hàm addToCart
// addToCart();

async function clearCart() {
       try {
              let response = await fetch('../../BLL/OrderBLL.php', {
                     method: 'POST',
                     headers: {
                            'Content-Type': 'application/x-www-form-urlencoded'
                     },
                     body:
                            'function=' + encodeURIComponent('clearCart')
              });
       } catch (error) {
              console.error('Error:', error);
       }
}


async function showCart() {
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
                     showProductItem(data);
                     if (count == 0) {
                            // nếu không có sản phẩm -> hiện thông báo vỏ hàng trống
                            let warning_empty_cart = document.getElementById('warning-empty');
                            warning_empty_cart.classList.remove('empty_status_off');

                            // nếu không có sản phẩm -> không cho qua trang checkout.php
                            
                            // hiện thông báo khi click vòa nút checkout
                            document.getElementById('check_out_action').onclick = async function (event){
                                   event.preventDefault();
                                   await Swal.fire({
                                          position: "center",
                                          icon: "info",
                                          title: "Cart is empty! You need to buy the product to go through checkout."
                                   });
                                   window.location.href = "../../GUI/view/Shop.php";
                            }
                            
                     } else {
                            let warning_empty_cart = document.getElementById('warning-empty');
                            warning_empty_cart.classList.add('empty_status_off');
                     }
              }
              else {
                     // window.location.href = "../../error.php";
                     console.log('loi khong co du lieu tra ve ben ham show')
              }
       } catch (error) {
              console.error('Error:', error);
       }
}


function isValidBase64(str) {
       try {
              return btoa(atob(str)) == str;
       } catch (err) {
              return false;
       }
}

function showProductItem(data) {

       let container = document.getElementById('show-cart');
       container.innerHTML = '';
       let total_price = 0;
       let string_final = '';

       let string_2 = `
       <tr class="product_main_cart">
              <td class="cart_list_btn" colspan="6">
                     <!-- <div class="btn_cart">Update cart</div> -->
                     <a href="./HomePage.php" class="btn_cart">Continue shopping</a>
              </td>
       </tr>
       `;
       let flag = 0;
       for (let i of data) {
              if (i.productCode != '') {
                     flag = 1;
                     let productName = i.nameProduct;
                     let productCode = i.productCode;

                     // lấy chuỗi đường dẫn link ảnh
                     let stringImg = i.imgProduct;
                     // tách đường dẫn
                     let arrImg = stringImg.split(' ');
                     let firstImg = arrImg[0];
                     //
                     let price = i.price;
                     let promotion = i.promotion;

                     let sizeName = i.sizeName;

                     let quantityBuy = i.quantityBuy;
                     let type = i.type;

                     // ma hoa
                     let mahoaProduct = btoa(productCode);
                     let mahoaType = btoa(type);

                     let sizeCode = i.sizeCode;

                     let pathDetailProdutc = `./ProductDetail.php?code=${mahoaProduct}&type=${mahoaType}`;

                     let name = '';
                     if (sizeName != 'null') {
                            name = `${productName} size ${sizeName}`;
                     } else {
                            name = `${productName}`;
                     }

                     if (promotion != 0) {
                            let string_1 = `
                            <tr class="product_main_cart">
                                   <td class="product_name" >
                                          <div class="product_name_img" >
                                                 
                                                 <a href="${pathDetailProdutc}">
                                                        <img src="${firstImg}" alt="Cart">
                                                 </a>
                                          </div>
                                          <div class="product_name_text">             
                                                 <a class="product_name_link" href="${pathDetailProdutc}">${name}</a>
                                                 <span class="product_name_price"> <del>$${price}</del> $${(price - price * promotion / 100).toFixed(2)} </span>
                                          </div>
                                   </td>
                                   <td class="product_quantity">
                                          <span>x ${quantityBuy}</span>
                                   </td>
                                   <td class="product_remove">
                                          <a class="product_remove_btn" href="#" onclick=removeItemCart(event,'${productCode}','${sizeCode}')>×</a>
                                   </td>
                            </tr>
                     `;
                            string_final += string_1;
                            total_price += (price - price * promotion / 100) * quantityBuy;
                     } else {
                            let string_1 = `
                            <tr class="product_main_cart">
                                   <td class="product_name" >
                                          <div class="product_name_img" >
                                                 
                                                 <a href="${pathDetailProdutc}">
                                                        <img src="${firstImg}" alt="Cart">
                                                 </a>
                                          </div>
                                          <div class="product_name_text">
                                                 
                                                 <a class="product_name_link" href="${pathDetailProdutc}">${name}</a>
                                                 <span class="product_name_price">$${price}</span>
                                          </div>
                                   </td>
                                   <td class="product_quantity">
                                          <span>x ${quantityBuy}</span>
                                   </td>
                                   <td class="product_remove">
                                          <a class="product_remove_btn" href="#" onclick=removeItemCart(event,'${productCode}','${sizeCode}')>×</a>
                                   </td>
                            </tr>
                     `;
                            string_final += string_1;
                            total_price += (price) * quantityBuy;
                     }
              }

       }
       string_final += string_2;
       container.innerHTML = string_final;

       // cập nhât tổng tiền
       let total_container = document.getElementById('total-price');
       total_container.innerHTML = `$${total_price.toFixed(2)}`;

       // thông báo thêm thành công vào vỏ hàng
       // let warning_add_success = document.getElementById('warning-add-success');
       // let name_item = document.getElementById('name-item');
       // if (flag == 0) {
       //        warning_add_success.classList.add('display_none');
       // }
       // else {
       //        warning_add_success.classList.remove('display_none');
       //        // console.log(data[0].);
       //        name_item.innerHTML = `“${data[data.length - 1].nameProduct}” has been added to your cart.`;
       // }


}
async function undo_afterRemoveItem(productCode, productName, type, quantityBuy, sizeCode) {

       let codeValue = btoa(productCode);
       let typeValue = btoa(type);
       let quantityBuyValue = btoa(quantityBuy);
       let sizeCodeValue = btoa(sizeCode);
       let status = btoa('true');
       // cập nhật lại đường dẫn với giá trị addCart = false
       history.pushState(null, '', `./Cart.php?code=${codeValue}&type=${typeValue}&quantityBuy=${quantityBuyValue}&addCart=${status}&sizeCode=${sizeCodeValue}`);
       console.log('helo');

       await addToCart();
}

// xoa khoi gio hang
async function removeItemCart(event, productCode, sizeCode) {
       event.preventDefault();
       try {
              let response = await fetch('../../BLL/OrderBLL.php', {
                     method: 'POST',
                     headers: {
                            'Content-Type': 'application/x-www-form-urlencoded'
                     },
                     body:
                            'function=' + encodeURIComponent('deleteItemCartInSession') + '&code=' + encodeURIComponent(productCode) + '&sizeCode=' + encodeURIComponent(sizeCode)
              });
              let data = await response.json();
              if (data != null) {
                     console.log(data);
                     // thong bao xoa
                     let warning_add_success = document.getElementById('warning-add-success');
                     let string = '';
                     for (let i of data) {
                            if (i.message == 'success') {
                                   // alert('Xóa sản phẩm ra khỏi giỏ hàng thành công');
                                   // alert thông báo xóa thành công 
                                   const Toast = await Swal.mixin({
                                          toast: true,
                                          position: "top-end",
                                          showConfirmButton: false,
                                          timer: 2000,
                                          timerProgressBar: true,
                                          didOpen: (toast) => {
                                                 toast.onmouseenter = Swal.stopTimer;
                                                 toast.onmouseleave = Swal.resumeTimer;
                                          }
                                   });
                                   Toast.fire({
                                          icon: "success",
                                          title: "Successfully removed product from cart"
                                   });
                                   string = `
                                          <div class="cart_mess_icon">
                                                 <i class="fa-solid fa-circle-check"></i>
                                          </div>
                                          <span id="name-item" class="cart_mess_text">“${i.nameProduct}” removed!. <span style="cursor: pointer;" onclick = "undo_afterRemoveItem('${i.productCode}','${i.nameProduct}','${i.type}','${i.quantityBuy}','${i.sizeCode}')" >Undo ?</span></span>
                                   `;
                            } else {
                                   alert('Xóa sản phẩm ra khỏi giỏ hàng thất bại');
                                   // alert thông báo xóa không thành công 
                                   const Toast = await Swal.mixin({
                                          toast: true,
                                          position: "top-end",
                                          showConfirmButton: false,
                                          timer: 2000,
                                          timerProgressBar: true,
                                          didOpen: (toast) => {
                                                 toast.onmouseenter = Swal.stopTimer;
                                                 toast.onmouseleave = Swal.resumeTimer;
                                          }
                                   });
                                   Toast.fire({
                                          icon: "error",
                                          title: "Removing product from cart failed"
                                   });
                                   string = `
                                          <div class="cart_mess_icon">
                                                 <i class="fa-solid fa-circle-check"></i>
                                          </div>
                                          <span id="name-item" class="cart_mess_text">“${i.nameProduct}” cannot be removed from the cart.</span>
                                   `;
                            }
                     }

                     warning_add_success.innerHTML = string;
                     // gọi lại hàm show sản phẩm
                     await showCart();
              } else {
                     console.log('khong co du lieu tra ve hamf removeItemCart');
              }
       } catch (error) {
              console.error('Error:', error);
       }

}

// kiem tra xme nguoi dung dang nhap chua, neu chua hien thong  bao dang nhap moi dc mua hang
async function checkLogin_toCart() {
       // location.reload();
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
              if (result.result != 'success') {
                     // alert('You must log in to add products to your cart');
                     await Swal.fire({
                            position: "center",
                            icon: "warning",
                            title: "You must log in to add products to your cart",
                            timer: 2000
                     });
                     return false;
              }
              return true;
              // for (let i of data) {
              //        console.log(i); 
              // }
              // showProductItem(data);
       } catch (error) {
              console.error('Error:', error);
       }
}



window.addEventListener('load', async function () {
       // Thực hiện các hàm bạn muốn sau khi trang web đã tải hoàn toàn, bao gồm tất cả các tài nguyên như hình ảnh, stylesheet, v.v.
       console.log('Trang Cart đã load hoàn toàn');
       await addToCart();
       // checkLogin_toCart();
});



