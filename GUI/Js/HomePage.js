
// ------------------------------------------- AJAX nạp dữ liệu ------------------------------------------------
async function getHandbagProduct() {
       try {
              const response = await fetch('../../BLL/ProductBLL.php', {
                     method: 'POST',
                     headers: {
                            'Content-Type': 'application/x-www-form-urlencoded'
                     },
                     body:
                            'function=' + encodeURIComponent('transHandbagProductToJson')
              });
              const data = await response.json();

              // for (let i of data) {
              //        console.log(i);
              // }
              // showProductItem(data);
       } catch (error) {
              console.error('Error:', error);
       }
}
// getHandbagProduct();

async function getShirtProduct() {
       try {
              const response = await fetch('../../BLL/ProductBLL.php', {
                     method: 'POST',
                     headers: {
                            'Content-Type': 'application/x-www-form-urlencoded'
                     },
                     body:
                            'function=' + encodeURIComponent('transShirtProductToJson')
              });
              const data = await response.json();

              // for (let i of data) {
              //        console.log(i);
              // }
              if (data != null) {
                     return data;
              }
              // await showSlideProductItem(data);
              // await showRecomendedProductItem(data);
              // slideProduct();

       } catch (error) {
              console.log('Lỗi hàm getShirtProduct');
              console.error('Error:', error);
       }
}
async function getProduct_filter_best_selling() {
       try {
              const response = await fetch('../../BLL/ProductBLL.php', {
                     method: 'POST',
                     headers: {
                            'Content-Type': 'application/x-www-form-urlencoded'
                     },
                     body:
                            'function=' + encodeURIComponent('filter_product_best_selling')
              });
              const data = await response.json();

              // console.log(data);
              if (data != null) {
                     return data;
              }
              // await showSlideProductItem(data);
              // await showRecomendedProductItem(data);
              // slideProduct();

       } catch (error) {
              console.log('Lỗi hàm getProduct_filter_best_selling');
              console.error('Error:', error);
       }
}
async function getProduct_filter_best_promotion() {
       try {
              const response = await fetch('../../BLL/ProductBLL.php', {
                     method: 'POST',
                     headers: {
                            'Content-Type': 'application/x-www-form-urlencoded'
                     },
                     body:
                            'function=' + encodeURIComponent('filter_product_best_promotion')
              });
              const data = await response.json();

              // console.log(data);
              if (data != null) {
                     return data;
              }
              // await showSlideProductItem(data);
              // await showRecomendedProductItem(data);
              // slideProduct();

       } catch (error) {
              console.log('Lỗi hàm getProduct_filter_best_promotion');
              console.error('Error:', error);
       }
}

// getShirtProduct();
async function getArrSizeCodeByProductCode(productCode) {
       try {
              const response = await fetch('../../BLL/ProductBLL.php', {
                     method: 'POST',
                     headers: {
                            'Content-Type': 'application/x-www-form-urlencoded'
                     },
                     body:
                            'function=' + encodeURIComponent('getArrSizeCodeByProductCode') + '&code=' + encodeURIComponent(productCode)
              });
              let data = await response.json();
              if (data != null) {
                     // console.log(data);
                     let first = data[0];
                     return first;
              } else {
                     console.log('khong co du lieu tra ve getArrSizeCodeByProductCode');
              }
       } catch (error) {
              console.log('loi ham getArrSizeCodeByProductCode')
       }
}

// ------------------------------------------ show dữ liệu lên phần slide product

let string = `
<div class="product-item">
       <div class="image-item">
              <a href='./ProductDetail.php'>
                     <img src="../image/product/product1/product-detail-1.png" alt="">
                     <a href="./Cart.php">
                            <div class="add-to-cart">
                                   <span><i class="fas fa-shopping-bag"></i></span>
                            </div>
                     </a>
                     <a href="./ProductDetail.php">
                            <div class="see-more">
                                   <span><i class="far fa-eye"></i></span>
                            </div>
                     </a>
                     <div class="discount">
                            <span>20%</span>
                     </div>
              </a>
       </div>
       <div class="name-item">
              <a href="">
                     <span>Conton T-shirt</span>
              </a>
       </div>
       <div class="price-item">
              <span>$ 9.99</span>
       </div>
</div>

`;

async function showSlideProductItem() {
       data = await getShirtProduct();
       if (data != null) {
              // slide product
              let container = document.querySelector('.content-product .product-feature .product');
              let result = '';
              for (let i of data) {
                     // trích suất từng giá trị thuôc tính product
                     if (i.status == '1' && i.quantity > 1) {
                            let productCode = i.productCode;
                            console.log(productCode);
                            // mã hóa
                            let mahoaProduct = btoa(productCode);

                            // xử lý mảng ảnh
                            let imgProduct = i.imgProduct;
                            let ArrimgProduct = imgProduct.split(' ');
                            let firstImgProduct = ArrimgProduct[0];

                            let nameProduct = i.nameProduct;

                            let price = i.price;
                            let promotion = i.promotion;

                            let sizeCodeValue = '';

                            let type = '';
                            // phân loại sản phẩm
                            if (i.bagMaterial == null) {
                                   type = 'shirtProduct';
                                   let item = await getArrSizeCodeByProductCode(productCode);
                                   let sizeCode = item.sizeCode;
                                   sizeCodeValue = btoa(sizeCode);
                            } else {
                                   type = 'handbagProduct';
                                   sizeCodeValue = btoa('null');
                            }

                            // mã hóa
                            let mahoatype = btoa(type);
                            let cardProduct = templateHTMLCartProduct(mahoaProduct, firstImgProduct, nameProduct, price, promotion, mahoatype, sizeCodeValue);
                            result += cardProduct;
                     }

              }
              container.innerHTML = result;


       }
}

async function showRecomendedProductItem() {
       let container = document.querySelector('.content-product .product-top .product');
       container.innerHTML = `
              <div style="margin: 0 auto;" class="spinner-border text-primary" role="status">
                     <span class="visually-hidden">Loading...</span>
              </div>`;
       data = await getShirtProduct();
       if (data != null) {
              // slide product
              // let container = document.querySelector('.content-product .product-top .product');
              let result = '';
              for (let i = 0; i < 8; i++) {
                     // trích suất từng giá trị thuôc tính product
                     let item = data[i];
                     if (item.status == '1' && item.quantity > 1) {
                            let productCode = item.productCode;
                            // console.log(productCode);
                            // mã hóa
                            let mahoaProduct = btoa(productCode);

                            // xử lý mảng ảnh
                            let imgProduct = item.imgProduct;
                            let ArrimgProduct = imgProduct.split(' ');
                            let firstImgProduct = ArrimgProduct[0];

                            let nameProduct = item.nameProduct;

                            let price = item.price;
                            let promotion = item.promotion;

                            let sizeCodeValue = '';

                            let type = '';
                            // phân loại sản phẩm
                            if (item.bagMaterial == null) {
                                   type = 'shirtProduct';
                                   let itemSizeCode = await getArrSizeCodeByProductCode(productCode);
                                   let sizeCode = itemSizeCode.sizeCode;
                                   sizeCodeValue = btoa(sizeCode);
                            } else {
                                   type = 'handbagProduct';
                                   sizeCodeValue = btoa('null');
                            }

                            // mã hóa
                            let mahoatype = btoa(type);
                            let cardProduct = templateHTMLCartProduct(mahoaProduct, firstImgProduct, nameProduct, price, promotion, mahoatype, sizeCodeValue);
                            result += cardProduct;
                     }
              }
              container.innerHTML = result;
       }
}

async function showBestSellProductItem() {
       let container = document.querySelector('.content-product .product-top .product');
       container.innerHTML = `
              <div style="margin: 0 auto;" class="spinner-border text-primary" role="status">
                     <span class="visually-hidden">Loading...</span>
              </div>`;
       data = await getProduct_filter_best_selling();
       if (data != null) {
              // slide product

              let result = '';
              for (let i = 0; i < 8; i++) {
                     // trích suất từng giá trị thuôc tính product
                     let item = data[i];
                     if (item.status == '1' && item.quantity > 1) {
                            let productCode = item.productCode;
                            // console.log(productCode);
                            // mã hóa
                            let mahoaProduct = btoa(productCode);

                            // xử lý mảng ảnh
                            let imgProduct = item.imgProduct;
                            let ArrimgProduct = imgProduct.split(' ');
                            let firstImgProduct = ArrimgProduct[0];

                            let nameProduct = item.nameProduct;

                            let price = item.price;
                            let promotion = item.promotion;

                            let sizeCodeValue = '';

                            let type = '';
                            // phân loại sản phẩm
                            if (item.bagMaterial == null) {
                                   type = 'shirtProduct';
                                   let itemSizeCode = await getArrSizeCodeByProductCode(productCode);
                                   let sizeCode = itemSizeCode.sizeCode;
                                   sizeCodeValue = btoa(sizeCode);
                            } else {
                                   type = 'handbagProduct';
                                   sizeCodeValue = btoa('null');
                            }

                            // mã hóa
                            let mahoatype = btoa(type);
                            let cardProduct = templateHTMLCartProduct(mahoaProduct, firstImgProduct, nameProduct, price, promotion, mahoatype, sizeCodeValue);
                            result += cardProduct;
                     }
              }
              container.innerHTML = result;


       }
}

async function showBestPromotionProductItem() {
       let container = document.querySelector('.content-product .product-top .product');
       container.innerHTML = `
              <div style="margin: 0 auto;" class="spinner-border text-primary" role="status">
                     <span class="visually-hidden">Loading...</span>
              </div>`;
       data = await getProduct_filter_best_promotion();
       if (data != null) {
              // slide product
              let result = '';
              for (let i = 0; i < 8; i++) {
                     // trích suất từng giá trị thuôc tính product
                     let item = data[i];
                     if (item.status == '1' && item.quantity > 1) {
                            let productCode = item.productCode;
                            // console.log(productCode);
                            // mã hóa
                            let mahoaProduct = btoa(productCode);

                            // xử lý mảng ảnh
                            let imgProduct = item.imgProduct;
                            let ArrimgProduct = imgProduct.split(' ');
                            let firstImgProduct = ArrimgProduct[0];

                            let nameProduct = item.nameProduct;

                            let price = item.price;
                            let promotion = item.promotion;

                            let sizeCodeValue = '';

                            let type = '';
                            // phân loại sản phẩm
                            if (item.bagMaterial == null) {
                                   type = 'shirtProduct';
                                   let itemSizeCode = await getArrSizeCodeByProductCode(productCode);
                                   let sizeCode = itemSizeCode.sizeCode;
                                   sizeCodeValue = btoa(sizeCode);
                            } else {
                                   type = 'handbagProduct';
                                   sizeCodeValue = btoa('null');
                            }

                            // mã hóa
                            let mahoatype = btoa(type);
                            let cardProduct = templateHTMLCartProduct(mahoaProduct, firstImgProduct, nameProduct, price, promotion, mahoatype, sizeCodeValue);
                            result += cardProduct;
                     }
              }
              container.innerHTML = result;


       }
}

function templateHTMLCartProduct(productCode, imgProduct, nameProduct, price, promotion, type, sizeCodeValue) {
       if (promotion == 0) {
              let string = `
                     <div class="product-item">
                            <div class="image-item">
                                   <a href='./ProductDetail.php?code=${productCode}&type=${type}'>
                                          <img src="${imgProduct}" alt="">
                                          <a href="./Cart.php?code=${productCode}&type=${type}&quantityBuy=${btoa('1')}&addCart=${btoa('true')}&sizeCode=${sizeCodeValue}">
                                                 <div class="add-to-cart">
                                                        <span><i class="fas fa-shopping-bag"></i></span>
                                                 </div>
                                          </a>
                                          <a href="./ProductDetail.php?code=${productCode}&type=${type}">
                                                 <div class="see-more">
                                                        <span><i class="far fa-eye"></i></span>
                                                 </div>
                                          </a>
                                   </a>
                            </div>
                            <div class="name-item">
                                   <a href="">
                                          <span>${nameProduct}</span>
                                   </a>
                            </div>
                            <div class="price-item">
                                   <span>$ ${price}</span>
                            </div>
                     </div>
                     `;
              return string;
       } else {
              let string = `
                     <div class="product-item">
                            <div class="image-item">
                                   <a href='./ProductDetail.php?code=${productCode}&type=${type}'>
                                          <img src="${imgProduct}" alt="">
                                          <a href="./Cart.php?code=${productCode}&type=${type}&quantityBuy=${btoa('1')}&addCart=${btoa('true')}&sizeCode=${sizeCodeValue}">
                                                 <div class="add-to-cart">
                                                        <span><i class="fas fa-shopping-bag"></i></span>
                                                 </div>
                                          </a>
                                          <a href="./ProductDetail.php?code=${productCode}&type=${type}">
                                                 <div class="see-more">
                                                        <span><i class="far fa-eye"></i></span>
                                                 </div>
                                          </a>
                                          <div class="discount">
                                                 <span>${promotion}%</span>
                                          </div>
                                   </a>
                            </div>
                            <div class="name-item">
                                   <a href="">
                                          <span>${nameProduct}</span>
                                   </a>
                            </div>
                            <div class="price-item">
                                   <span>$ ${price}</span>
                            </div>
                     </div>
                     `;
              return string;
       }
}


// ----------------------------show dữ liệu lên phần "RECOMMENDED - SALE PRODUCT - BEST SELLING PRODUCTS"

// RECOMMENDED
function getProductRecommended_Sale_BestSelling() {
       let reconmmended = document.getElementById('reconmmended');
       let sale_product = document.getElementById('sale-product');
       let best_selling_product = document.getElementById('best-selling-product');

       reconmmended.onclick = async function (event) {
              event.preventDefault();
              reconmmended.classList.add('is-active');
              sale_product.classList.remove('is-active');
              best_selling_product.classList.remove('is-active');
              await showRecomendedProductItem();
       }
       sale_product.onclick = async function (event) {
              event.preventDefault();
              sale_product.classList.add('is-active');
              reconmmended.classList.remove('is-active');
              best_selling_product.classList.remove('is-active');
              await showBestPromotionProductItem();

       }
       best_selling_product.onclick = async function (event) {
              event.preventDefault();
              best_selling_product.classList.add('is-active');
              reconmmended.classList.remove('is-active');
              sale_product.classList.remove('is-active');
              await showBestSellProductItem();

       }
}


// -------------------------------------------------------xử lý các hành động trên web ------------------------------------------------------

// slide sản phẩm
function slideProduct() {
       let products = document.querySelectorAll('body .content-product .product-feature .product .product-item');
       let product_position = []
       let width_product_item = 293;      // chiều width
       let numberNext = products.length - 4;     // số lượt next
       let numberPrevious = 0;          // số lượt pre

       for (let i = 0; i < products.length; i++) {
              product_position.push(0);
       }

       document.querySelector('.content-product .pre-button').onclick = function () {
              if (numberPrevious != 0) {
                     for (let i = 0; i < products.length; i++) {
                            console.log(i);
                            // console.log(products.item(i));
                            let item = products.item(i);
                            // Lấy vi tri phần tử cần di chuyển
                            let positionItem_current = product_position[i];

                            let positionItem_new = positionItem_current + width_product_item;

                            // Thiết lập giá trị translate
                            var translateValue = `translate(${positionItem_new}px, 0px)`;

                            // Áp dụng giá trị translate vào thuộc tính style.transform của phần tử
                            item.style.transform = translateValue;

                            // cap nhat lai vi tri item
                            product_position[i] = positionItem_new;
                            console.log(positionItem_new);
                     }
                     numberNext += 1;
                     numberPrevious -= 1;
              }
       }
       document.querySelector('.content-product .next-button').onclick = function () {
              if (numberNext != 0) {
                     for (let i = 0; i < products.length; i++) {
                            console.log(i);
                            // console.log(products.item(i));
                            let item = products.item(i);
                            // Lấy vi tri phần tử cần di chuyển
                            let positionItem_current = product_position[i];

                            let positionItem_new = positionItem_current - width_product_item;

                            // Thiết lập giá trị translate
                            var translateValue = `translate(${positionItem_new}px, 0px)`;

                            // Áp dụng giá trị translate vào thuộc tính style.transform của phần tử
                            item.style.transform = translateValue;

                            // cap nhat lai vi tri item
                            product_position[i] = positionItem_new;
                            console.log(positionItem_new);
                     }
                     numberNext -= 1;
                     numberPrevious += 1;
              }
       }


}

// function slideProduct() {
//        document.querySelector('.content-product .pre-button').onclick = function () {
//               let lists = document.querySelectorAll('.content-product .product .product-item');
//               console.log(lists);
//               document.querySelector('.content-product .product').appendChild(lists[0]);
//        }
//        document.querySelector('.content-product .next-button').onclick = function () {
//               let lists = document.querySelectorAll('.content-product .product .product-item');
//               console.log(lists);
//               document.querySelector('.content-product .product').prepend(lists[lists.length - 1]);
//        }
// }

// chỉ thực hiện các hàm khi trang load xong

window.addEventListener('load', async function () {
       // Thực hiện các hàm bạn muốn sau khi trang web đã tải hoàn toàn, bao gồm tất cả các tài nguyên như hình ảnh, stylesheet, v.v.
       console.log('Trang Homepage đã load hoàn toàn');
       await showSlideProductItem();
       slideProduct();
       await showRecomendedProductItem();
       getProductRecommended_Sale_BestSelling();
       // getHandbagProduct();
});


