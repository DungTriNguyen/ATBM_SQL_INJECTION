// ---------------------------------- DÙNG AJAX LẤY DỮ LIỆU LÊN ---------------------------------------
// async function getProduct() {

//     // truyền một giá trị fillter thông qua đường dẫn: ./shop.php?filter = '<giá trị lọc>'
//     // dùng let filterValue = urlParams.get('filter'); để lấy giá trị
//     // nếu null thì phân trang như binh thường
//     // nếu != null thì sẽ dùng AJAX đọc mảng product với giá trị lọc 
//     // ban đầu từ trang homepage có các chức năng lọc theo Male Female Kid nên đường dẫn sẽ là ./shop.php?filter = 'Male' chẳng hạn
//     // về sau có nhiều giá trị lọc hơn nên dùng chuỗi với cấu trúc: "<giá trị lọc 1> - <giá trị lọc 2> - ... "
//     // tạo một function bên ProductBLL.php với tham số đầu vào là một chuỗi các giá trị lọc, từ đó tách chuỗi đó ra để biết mảng lọc qua những điều kiện gì, output sẽ là mảng product được lọc
//     try {

//         // let filterValue = null;
//         let urlParams = new URLSearchParams(window.location.search);
//         let filterValue = urlParams.get('filter');
//         // history.pushState({ page: page }, "", "?page=" + page);
//         console.log(isValueFilter());

//         if (isValueFilter() == true) {
//             if (filterValue == 'empty') {
//                 const response1 = await fetch('../../BLL/ProductBLL.php', {
//                     method: 'POST',
//                     headers: {
//                         'Content-Type': 'application/x-www-form-urlencoded'
//                     },
//                     body:
//                         'function=' + encodeURIComponent('transHandbagProductToJson')
//                 });
//                 const response2 = await fetch('../../BLL/ProductBLL.php', {
//                     method: 'POST',
//                     headers: {
//                         'Content-Type': 'application/x-www-form-urlencoded'
//                     },
//                     body:
//                         'function=' + encodeURIComponent('transShirtProductToJson')
//                 });
//                 const data2 = await response2.json();
//                 const data1 = await response1.json();
//                 let lengthProduct = data1.length + data2.length;

//                 console.log(data1);
//                 console.log(data2);

//                 Pagination_2(1, 12, lengthProduct, null);         // phân trang
//                 // showProductItem(data);
//             }
//             else {       // nếu != null thì sẽ dùng AJAX đọc mảng product với giá trị lọc 

//             }
//         } else {
//             window.location.href = "../../error.php";
//         }



//     } catch (error) {
//         console.error('Error:', error);
//     }
// }
// getProduct();
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

async function filter() {
    try {

        let stringFilter = getFilterValue();
        // console.log(stringFilter);
        const response = await fetch('../../BLL/ProductBLL.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body:
                'function=' + encodeURIComponent('filter_product_by_atributive') + '&filter=' + encodeURIComponent(stringFilter) + '&page=' + encodeURIComponent('1') + '&limit=' + encodeURIComponent('12')
        });

        let data = await response.json();
        if (data != null) {
            if (data.length > 0) {
                console.log(data);
                let lengthValue = null;
                for (let i of data) {
                    if (i.hasOwnProperty('lenghtData')) {
                        lengthValue = i.lenghtData;
                    }
                }
                Pagination_3(1, 12, lengthValue);
            } else {
                Pagination_3(1, 12, 0);
            }
        } else {
            console.log('khong co du lieu tra ve filter');

        }
    } catch (error) {
        console.log('loi ham filter')
        console.error(error);
    }
}

// load dữ liệu lọc lên
async function load_value_targetGender_filter() {
    try {
        // load targetGender
        const response = await fetch('../../BLL/ProductBLL.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body:
                'function=' + encodeURIComponent('getArrObj_targetGender')
        });
        let data = await response.json();
        // console.log(dataTargetGender);
        if (data != null) {
            let container = document.getElementById('filter-gender');
            let containerValue = container.querySelector('ul');
            if (data.length > 0) {
                let value = ``;
                for (let i of data) {
                    let string = `
                    <li>
                        <input type="radio" name="gender" value="${i}"> ${i}
                    </li>
                    `;
                    value += string;
                }
                containerValue.innerHTML = value;
            } else {
                container.innerHTML = '';
            }
        } else {
            console.error('Không có dữ liệu load_value_targetGender_filter trả về');
        }
    } catch (error) {
        console.error('Lỗi hàm load_value_targetGender_filter', error);
    }
}

// load dữ liệu lọc lên
async function load_value_color_filter() {
    try {
        // load targetGender
        const response = await fetch('../../BLL/ProductBLL.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body:
                'function=' + encodeURIComponent('getArrObj_color')
        });
        let data = await response.json();
        // console.log(dataTargetGender);
        if (data != null) {
            let container = document.getElementById('filter-color');
            let containerValue = container.querySelector('ul');
            if (data.length > 0) {
                let value = ``;
                for (let i of data) {
                    let string = `
                    <li>
                        <input type="radio" name="color" value="${i}"> ${i}
                    </li>
                    `;
                    value += string;
                }
                containerValue.innerHTML = value;
            } else {
                container.innerHTML = '';
            }
        } else {
            console.error('Không có dữ liệu load_value_color_filter trả về');
        }
    } catch (error) {
        console.error('Lỗi hàm load_value_color_filter', error);
    }
}

// load dữ liệu lọc lên
async function load_value_bagMaterial_filter() {
    try {
        // load targetGender
        const response = await fetch('../../BLL/ProductBLL.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body:
                'function=' + encodeURIComponent('getArrObj_bagMaterial')
        });
        let data = await response.json();
        // console.log(dataTargetGender);
        if (data != null) {
            let container = document.getElementById('filter-bagMaterial');
            let containerValue = container.querySelector('ul');
            if (data.length > 0) {
                let value = ``;
                for (let i of data) {
                    let string = `
                    <li>
                        <input type="radio" name="bagMaterial" value="${i}"> ${i}
                    </li>
                    `;
                    value += string;
                }
                containerValue.innerHTML = value;
            } else {
                container.innerHTML = '';
            }
        } else {
            console.error('Không có dữ liệu load_value_bagMaterial_filter trả về');
        }
    } catch (error) {
        console.error('Lỗi hàm load_value_bagMaterial_filter', error);
    }
}

// load dữ liệu lọc lên
async function load_value_shirtMaterial_filter() {
    try {
        // load targetGender
        const response = await fetch('../../BLL/ProductBLL.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body:
                'function=' + encodeURIComponent('getArrObj_shirtMaterial')
        });
        let data = await response.json();
        // console.log(dataTargetGender);
        if (data != null) {
            let container = document.getElementById('filter-shirtMaterial');
            let containerValue = container.querySelector('ul');
            if (data.length > 0) {
                let value = ``;
                for (let i of data) {
                    let string = `
                    <li>
                        <input type="radio" name="shirtMaterial" value="${i}"> ${i}
                    </li>
                    `;
                    value += string;
                }
                containerValue.innerHTML = value;
            } else {
                container.innerHTML = '';
            }
        } else {
            console.error('Không có dữ liệu load_value_shirtMaterial_filter trả về');
        }
    } catch (error) {
        console.error('Lỗi hàm load_value_shirtMaterial_filter', error);
    }
}

// load dữ liệu lọc lên
async function load_value_shirtStyle_filter() {
    try {
        // load targetGender
        const response = await fetch('../../BLL/ProductBLL.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body:
                'function=' + encodeURIComponent('getArrObj_shirtStyle')
        });
        let data = await response.json();
        // console.log(dataTargetGender);
        if (data != null) {
            let container = document.getElementById('filter-shirtStyle');
            let containerValue = container.querySelector('ul');
            if (data.length > 0) {
                let value = ``;
                for (let i of data) {
                    let string = `
                    <li>
                        <input type="radio" name="shirtStyle" value="${i}"> ${i}
                    </li>
                    `;
                    value += string;
                }
                containerValue.innerHTML = value;
            } else {
                container.innerHTML = '';
            }
        } else {
            console.error('Không có dữ liệu load_value_shirtStyle_filter trả về');
        }
    } catch (error) {
        console.error('Lỗi hàm load_value_shirtStyle_filter', error);
    }
}

// load dữ liệu lọc lên
async function load_value_priceMax_filter() {
    try {
        // load targetGender
        const response = await fetch('../../BLL/ProductBLL.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body:
                'function=' + encodeURIComponent('getArrObj_price')
        });
        let data = await response.json();
        // console.log(dataTargetGender);
        if (data != null) {
            let container = document.getElementById('filter-price');
            let containerValue = container.querySelector('ul');
            if (data.length > 0) {
                let value = ``;
                for (let i of data) {
                    let string = `
                        <li>
                            <input style="width: 200px;" type="range" min="0" step="1" max="${Math.ceil(i)}" value="${Math.ceil(i)}">
                        </li>
                        <li>
                            <span id="show-price">0$ - ${Math.ceil(i)}$</span>
                        </li>
                    `;
                    value += string;
                }
                containerValue.innerHTML = value;
            } else {
                container.innerHTML = '';
            }
        } else {
            console.error('Không có dữ liệu load_value_priceMax_filter trả về');
        }
    } catch (error) {
        console.error('Lỗi hàm load_value_priceMax_filter', error);
    }
}

// hàm lấy kết quả lọc khi ấn nút filter , trả lại chuỗi kết quả lọc để gọi AJAX
function getFilterValue() {
    // lấy giá trị
    let targetGenders = document.querySelectorAll('#filter-gender input');
    let targetGenderValue = 'null';
    for (let i of targetGenders) {
        if (i.checked) {
            targetGenderValue = i.value;
        }
    }

    let colors = document.querySelectorAll('#filter-color input');
    let colorValue = 'null';
    for (let i of colors) {
        if (i.checked) {
            colorValue = i.value;
        }
    }

    let bagMaterials = document.querySelectorAll('#filter-bagMaterial input');
    let bagMaterialValue = 'null';
    for (let i of bagMaterials) {
        if (i.checked) {
            bagMaterialValue = i.value;
        }
    }


    let shirtMaterials = document.querySelectorAll('#filter-shirtMaterial input');
    let shirtMaterialValue = 'null';
    for (let i of shirtMaterials) {
        if (i.checked) {
            shirtMaterialValue = i.value;
        }
    }
    let shirtStyles = document.querySelectorAll('#filter-shirtStyle input');
    let shirtStyleValue = 'null';
    for (let i of shirtStyles) {
        if (i.checked) {
            shirtStyleValue = i.value;
        }
    }
    let price = document.querySelector('#filter-price input').value;

    let sortPriceValue = document.getElementById('sort-price').value;
    if (sortPriceValue == '') {
        sortPriceValue = 'null';
    }

    // console.log(targetGenderValue,colorValue,bagMaterialValue,shirtMaterialValue,shirtStyleValue,price);
    let string = `targetGender=${targetGenderValue}+color=${colorValue}+bagMaterial=${bagMaterialValue}+shirtMaterial=${shirtMaterialValue}+shirtStyle=${shirtStyleValue}+sortPrice=${sortPriceValue}+price=0-${price}`;
    console.log(string);

    return string;

}

function sendFilter() {
    document.getElementById('filter-button').onclick = function () {
        filter();
    }
    // sắp xếp theo giá
    document.getElementById('sort-price').onchange = function () {
        filter();
    }
}

function resetFilter() {
    document.getElementById('reset-filter-button').onclick = async function () {
        await load_value_targetGender_filter();
        await load_value_color_filter();
        await load_value_bagMaterial_filter();
        await load_value_shirtMaterial_filter();
        await load_value_shirtStyle_filter();
        await load_value_priceMax_filter();
        await filter();
    }
}

function showResultFilter(page, lengthData) {
    let container = document.getElementById('number-product-show');
    let containerListProduct = document.querySelectorAll('.container-path .product-list .product-container');
    let lengthItem = containerListProduct.length;
    let start = (page - 1) * 12 + 1;
    let string = `Show ${start}–${start + lengthItem - 1} of ${lengthData} result`;
    container.innerHTML = string;
}









// async function getShirtProduct() {
//     try {
//         const response = await fetch('../../BLL/ProductBLL.php', {
//             method: 'POST',
//             headers: {
//                 'Content-Type': 'application/x-www-form-urlencoded'
//             },
//             body:
//                 'function=' + encodeURIComponent('transShirtProductToJson')
//         });
//         const data = await response.json();
//         console.log(data);


//     } catch (error) {
//         console.error('Error:', error);
//     }
// }
// getShirtProduct();

let string = `

<div class="product-container">
                                    <!--khung chứa ảnh-->
                                    <div class="image">
                                        <a href="" class="">
                                            <img src="../image/product/product7/product-detail-1.png" alt="">
                                        </a>
                                        <!-- discount -->
                                        <div class="discount">
                                            <span>25%</span>
                                        </div>
                                        <!--cart và xem chi tiết sp trong ảnh-->
                                        <div class="action-custom">
                                            <!--cart-->
                                            <div class="add-to-cart">
                                                <a href="" class="" title="add cart">
                                                    <i class="fa fa-shopping-bag" aria-hidden="true"></i>
                                                </a>
                                            </div>
                                            <!--read-more-->
                                            <div class="readmore">
                                                <a href="" title="Detail">
                                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- thong tin san pham -->
                                    <div class="product-meta">
                                        <div class="name">
                                            <a href="">Printed T-shirt</a>
                                        </div>

                                    </div>
                                    <!-- thong tin gia san pham -->
                                    <div class="price">
                                        <div itemprop="offers" class="pricelist"></div>
                                        <ins class="giamoi"><span class="price-sale">$20.00</span> $14.99</ins>
                                    </div>
                                </div>


`;

// function loadItemonHTML(data1, data2) {

//     let result = '';
//     let containerListProduct = document.querySelector('.container-path .product-list');
//     console.log(containerListProduct);

//     // sản phẩm áo
//     for (let i of data2) {

//         // ma product
//         let productCode = i.productCode;
//         let type = 'shirtProduct';
//         // ma hoa
//         let mahoaProductCode = btoa(productCode);
//         let mahoaType = btoa(type);
//         // name
//         let nameProduct = i.nameProduct;
//         // anh
//         let imgString = i.imgProduct;
//         let arrImg = imgString.split(' ');
//         let firstImg = arrImg[0];
//         // giam gia
//         let promotionPrice;
//         if (i.promotion != 0) {
//             promotionPrice = i.price - (i.price * i.promotion / 100);
//             promotionPrice = promotionPrice.toFixed(2);
//         }

//         // path chi tiet san pham
//         let pathDetailProdutc = `./ProductDetail.php?code=${mahoaProductCode}&type=${mahoaType}`;

//         // format HTML
//         if (i.promotion != 0) {
//             let temp = `
//             <div class="product-container">
//                 <!--khung chứa ảnh-->
//                 <div class="image">
//                     <a href="${pathDetailProdutc}" class="">
//                         <img src="${firstImg}" alt="">
//                     </a>
//                     <!-- discount -->
//                     <div class="discount">
//                         <span>${i.promotion}%</span>
//                     </div>
//                     <!--cart và xem chi tiết sp trong ảnh-->
//                     <div class="action-custom">
//                         <!--cart-->
//                         <div class="add-to-cart">
//                             <a href="./Cart.php?code=${mahoaProductCode}&type=${mahoaType}&quantityBuy=${btoa('1')}&addCart=${btoa('true')}" class="" title="add cart">
//                                 <i class="fa fa-shopping-bag" aria-hidden="true"></i>
//                             </a>
//                         </div>
//                         <!--read-more-->
//                         <div class="readmore">
//                             <a href="${pathDetailProdutc}" title="Detail">
//                                 <i class="fa fa-eye" aria-hidden="true"></i>
//                             </a>
//                         </div>
//                     </div>
//                 </div>
//                 <!-- thong tin san pham -->
//                 <div class="product-meta">
//                     <div class="name">
//                         <a href="">${nameProduct}</a>
//                     </div>

//                 </div>
//                 <!-- thong tin gia san pham -->
//                 <div class="price">
//                     <div itemprop="offers" class="pricelist"></div>
//                     <ins class="giamoi"><span class="price-sale">$${i.price}</span> $${promotionPrice}</ins>
//                 </div>
//             </div>

//             `;
//             result += temp;
//         } else {
//             let temp = `
//             <div class="product-container">
//                 <!--khung chứa ảnh-->
//                 <div class="image">
//                     <a href="${pathDetailProdutc}" class="">
//                         <img src="${firstImg}" alt="">
//                     </a>
//                     <!--cart và xem chi tiết sp trong ảnh-->
//                     <div class="action-custom">
//                         <!--cart-->
//                         <div class="add-to-cart">
//                             <a href="./Cart.php?code=${mahoaProductCode}&type=${mahoaType}&quantityBuy=${btoa('1')}&addCart=${btoa('true')}" class="" title="add cart">
//                                 <i class="fa fa-shopping-bag" aria-hidden="true"></i>
//                             </a>
//                         </div>
//                         <!--read-more-->
//                         <div class="readmore">
//                             <a href="${pathDetailProdutc}" title="Detail">
//                                 <i class="fa fa-eye" aria-hidden="true"></i>
//                             </a>
//                         </div>
//                     </div>
//                 </div>
//                 <!-- thong tin san pham -->
//                 <div class="product-meta">
//                     <div class="name">
//                         <a href="">${nameProduct}</a>
//                     </div>

//                 </div>
//                 <!-- thong tin gia san pham -->
//                 <div class="price">
//                     <div itemprop="offers" class="pricelist"></div>
//                     <ins class="giamoi">$${i.price}</ins>
//                 </div>
//             </div>

//             `;
//             result += temp;
//         }

//     }

//     // sản phẩm túi
//     for (let i of data1) {

//         // ma product
//         let productCode = i.productCode;
//         let type = 'handbagProduct';
//         // ma hoa
//         let mahoaProductCode = btoa(productCode);
//         let mahoaType = btoa(type);
//         // name
//         let nameProduct = i.nameProduct;
//         // anh
//         let imgString = i.imgProduct;
//         let arrImg = imgString.split(' ');
//         let firstImg = arrImg[0];
//         // giam gia
//         let promotionPrice;
//         if (i.promotion != 0) {
//             promotionPrice = i.price - (i.price * i.promotion / 100);
//             promotionPrice = promotionPrice.toFixed(2);
//         }

//         // path chi tiet san pham
//         let pathDetailProdutc = `./ProductDetail.php?code=${mahoaProductCode}&type=${mahoaType}`;

//         // format HTML
//         if (i.promotion != 0) {
//             let temp = `
//             <div class="product-container">
//                 <!--khung chứa ảnh-->
//                 <div class="image">
//                     <a href="${pathDetailProdutc}" class="">
//                         <img src="${firstImg}" alt="">
//                     </a>
//                     <!-- discount -->
//                     <div class="discount">
//                         <span>${i.promotion}%</span>
//                     </div>
//                     <!--cart và xem chi tiết sp trong ảnh-->
//                     <div class="action-custom">
//                         <!--cart-->
//                         <div class="add-to-cart">
//                             <a href="./Cart.php?code=${mahoaProductCode}&type=${mahoaType}&quantityBuy=${btoa('1')}&addCart=${btoa('true')}" class="" title="add cart">
//                                 <i class="fa fa-shopping-bag" aria-hidden="true"></i>
//                             </a>
//                         </div>
//                         <!--read-more-->
//                         <div class="readmore">
//                             <a href="${pathDetailProdutc}" title="Detail">
//                                 <i class="fa fa-eye" aria-hidden="true"></i>
//                             </a>
//                         </div>
//                     </div>
//                 </div>
//                 <!-- thong tin san pham -->
//                 <div class="product-meta">
//                     <div class="name">
//                         <a href="">${nameProduct}</a>
//                     </div>

//                 </div>
//                 <!-- thong tin gia san pham -->
//                 <div class="price">
//                     <div itemprop="offers" class="pricelist"></div>
//                     <ins class="giamoi"><span class="price-sale">$${i.price}</span> $${promotionPrice}</ins>
//                 </div>
//             </div>

//             `;
//             result += temp;
//         } else {
//             let temp = `
//             <div class="product-container">
//                 <!--khung chứa ảnh-->
//                 <div class="image">
//                     <a href="${pathDetailProdutc}" class="">
//                         <img src="${firstImg}" alt="">
//                     </a>
//                     <!--cart và xem chi tiết sp trong ảnh-->
//                     <div class="action-custom">
//                         <!--cart-->
//                         <div class="add-to-cart">
//                             <a href="./Cart.php?code=${mahoaProductCode}&type=${mahoaType}&quantityBuy=${btoa('1')}&addCart=${btoa('true')}" class="" title="add cart">
//                                 <i class="fa fa-shopping-bag" aria-hidden="true"></i>
//                             </a>
//                         </div>
//                         <!--read-more-->
//                         <div class="readmore">
//                             <a href="${pathDetailProdutc}" title="Detail">
//                                 <i class="fa fa-eye" aria-hidden="true"></i>
//                             </a>
//                         </div>
//                     </div>
//                 </div>
//                 <!-- thong tin san pham -->
//                 <div class="product-meta">
//                     <div class="name">
//                         <a href="">${nameProduct}</a>
//                     </div>

//                 </div>
//                 <!-- thong tin gia san pham -->
//                 <div class="price">
//                     <div itemprop="offers" class="pricelist"></div>
//                     <ins class="giamoi">$${i.price}</ins>
//                 </div>
//             </div>

//             `;
//             result += temp;
//         }
//     }
//     containerListProduct.innerHTML = result;
// }


// async function Pagination_2(page, limit, lengthProduct, filter) {
//     try {
//         // ban đầu nếu chưa có mảng của lọc san phẩm
//         if (filter == null) {
//             const response = await fetch('../../BLL/ProductBLL.php', {
//                 method: 'POST',
//                 headers: {
//                     'Content-Type': 'application/x-www-form-urlencoded'
//                 },
//                 body:
//                     'function=' + encodeURIComponent('Pagination') + '&page=' + encodeURIComponent(page) + '&limit=' + encodeURIComponent(limit)
//             });
//             const data = await response.json();

//             console.log(data);
//             // let path = `./Shop.php?page=${page}`;

//             loadItemonHTML_forPagination_2(data);
//             listPage_2(lengthProduct, limit, page, null);

//         }
//         // có mảng lọc sản phẩm, dùng mảng đó làm dữ liệu để phân trang
//         else {

//             // console.log(arrProductFilter);
//             // // let path = `./Shop.php?page=${page}`;
//             // // history.pushState({ page: page }, "", "?page=" + page);
//             // loadItemonHTML_forPagination_2(arrProductFilter);
//             // listPage_2(lengthProduct, limit, page, arrProductFilter);
//         }


//     } catch (error) {
//         console.error('Error:', error);
//     }
// }
// function listPage_2(lengthProduct, limit, thisPage, filter) {
//     let count = Math.ceil(lengthProduct / limit);
//     console.log(count);
//     document.querySelector('.container-path .list-page').innerHTML = '';
//     console.log(document.querySelector('.container-path .list-page'));
//     for (let i = 1; i <= count; i++) {
//         let newPage = document.createElement('div');
//         newPage.innerText = i;
//         if (i == thisPage) {
//             newPage.classList.add('item-active');
//         }
//         newPage.setAttribute('onclick', "changePage_2(" + i + "," + limit + "," + lengthProduct + "," + filter + ")");
//         document.querySelector('.container-path .list-page').appendChild(newPage);

//     }
// }
// function changePage_2(i, limit, lengthProduct, filter) {
//     Pagination_2(i, limit, lengthProduct, filter);
// }
// function changePage_2(i, limit, lengthProduct, filter) {
//     Pagination_2(i, limit, lengthProduct, filter);
// }
async function Pagination_3(page, limit, lengthProduct) {
    // làm hình tượng load
    let containerListProduct = document.querySelector('.container-path .product-list');
    containerListProduct.innerHTML = `
        <div style="margin: 30% auto;" class="spinner-border text-primary" role="status">
                <span class="visually-hidden">Loading...</span>
        </div>
    `;
    try {
        let stringFilter = getFilterValue();

        const response = await fetch('../../BLL/ProductBLL.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body:
                'function=' + encodeURIComponent('filter_product_by_atributive') + '&filter=' + encodeURIComponent(stringFilter) + '&page=' + encodeURIComponent(page) + '&limit=' + encodeURIComponent(limit)
        });


        let data = await response.json();
        console.log(data);

        await loadItemonHTML_forPagination_2(data);
        await listPage_3(lengthProduct, limit, page);


    } catch (error) {
        console.error('Error:', error);
    }
}
async function listPage_3(lengthProduct, limit, thisPage) {
    let count = Math.ceil(lengthProduct / limit);
    console.log(count);
    showResultFilter(thisPage, lengthProduct);
    document.querySelector('.container-path .list-page').innerHTML = '';
    console.log(document.querySelector('.container-path .list-page'));
    for (let i = 1; i <= count; i++) {
        let newPage = document.createElement('div');
        newPage.innerText = i;
        if (i == thisPage) {
            newPage.classList.add('item-active');
        }
        newPage.setAttribute('onclick', "changePage_3(" + i + "," + limit + "," + lengthProduct + ")");
        document.querySelector('.container-path .list-page').appendChild(newPage);

    }
}
// 
function changePage_3(i, limit, lengthProduct) {
    Pagination_3(i, limit, lengthProduct);
}



async function loadItemonHTML_forPagination_2(data) {

    let result = '';
    let containerListProduct = document.querySelector('.container-path .product-list');
    // containerListProduct.innerHTML = '';

    if (data.length > 0) {
        // sản phẩm 
        for (let i of data) {
            if (i.productCode != null && i.status == '1' && i.quantity > 1) {
                // ma product
                let productCode = i.productCode;
                let type = i.type;
                // ma hoa
                let mahoaProductCode = btoa(productCode);
                let mahoaType = btoa(type);
                // name
                let nameProduct = i.nameProduct;
                // anh
                let imgString = i.imgProduct;
                let arrImg = imgString.split(' ');
                let firstImg = arrImg[0];
                // giam gia
                let promotionPrice;
                if (i.promotion != 0) {
                    promotionPrice = i.price - (i.price * i.promotion / 100);
                    promotionPrice = promotionPrice.toFixed(2);
                }

                // path chi tiet san pham
                let pathDetailProdutc = `./ProductDetail.php?code=${mahoaProductCode}&type=${mahoaType}`;

                // ma sizeCode, phan biet giua shirt va bag
                let sizeCodeValue = '';
                if (type == "shirtProduct") {

                    let item = await getArrSizeCodeByProductCode(productCode);
                    let sizeCode = item.sizeCode;
                    // console.log(sizeCode);
                    sizeCodeValue = btoa(sizeCode);
                }
                else {
                    sizeCodeValue = btoa('null');
                }

                // format HTML
                if (i.promotion != 0) {
                    let temp = `
            <div class="product-container">
                <!--khung chứa ảnh-->
                <div class="image">
                    <a href="${pathDetailProdutc}" class="">
                        <img src="${firstImg}" alt="">
                    </a>
                    <!-- discount -->
                    <div class="discount">
                        <span>${i.promotion}%</span>
                    </div>
                    <!--cart và xem chi tiết sp trong ảnh-->
                    <div class="action-custom">
                        <!--cart-->
                        <div class="add-to-cart">
                            <a href="./Cart.php?code=${mahoaProductCode}&type=${mahoaType}&quantityBuy=${btoa('1')}&addCart=${btoa('true')}&sizeCode=${sizeCodeValue}" class="" title="add cart">
                                <i class="fa fa-shopping-bag" aria-hidden="true"></i>
                            </a>
                        </div>
                        <!--read-more-->
                        <div class="readmore">
                            <a href="${pathDetailProdutc}" title="Detail">
                                <i class="fa fa-eye" aria-hidden="true"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- thong tin san pham -->
                <div class="product-meta">
                    <div class="name">
                        <a href="">${nameProduct}</a>
                    </div>
            
                </div>
                <!-- thong tin gia san pham -->
                <div class="price">
                    <div itemprop="offers" class="pricelist"></div>
                    <ins class="giamoi"><span class="price-sale">$${i.price}</span> $${promotionPrice}</ins>
                </div>
            </div>
            
            `;
                    result += temp;
                } else {
                    let temp = `
            <div class="product-container">
                <!--khung chứa ảnh-->
                <div class="image">
                    <a href="${pathDetailProdutc}" class="">
                        <img src="${firstImg}" alt="">
                    </a>
                    <!--cart và xem chi tiết sp trong ảnh-->
                    <div class="action-custom">
                        <!--cart-->
                        <div class="add-to-cart">
                            <a href="./Cart.php?code=${mahoaProductCode}&type=${mahoaType}&quantityBuy=${btoa('1')}&addCart=${btoa('true')}&sizeCode=${sizeCodeValue}" class="" title="add cart">
                                <i class="fa fa-shopping-bag" aria-hidden="true"></i>
                            </a>
                        </div>
                        <!--read-more-->
                        <div class="readmore">
                            <a href="${pathDetailProdutc}" title="Detail">
                                <i class="fa fa-eye" aria-hidden="true"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- thong tin san pham -->
                <div class="product-meta">
                    <div class="name">
                        <a href="">${nameProduct}</a>
                    </div>
            
                </div>
                <!-- thong tin gia san pham -->
                <div class="price">
                    <div itemprop="offers" class="pricelist"></div>
                    <ins class="giamoi">$${i.price}</ins>
                </div>
            </div>
            
            `;
                    result += temp;
                }
            }
        }
        containerListProduct.innerHTML = result;
    } else {
        containerListProduct.innerHTML = `<img width="50%" height="50%" src="../image/what-does-error-404-not-found-mean.svg" alt="">`;
    }

}











// ----------------------------------------- THỰC HIỆN CÁC HIỆU ỨNG ----------------------------------------

function action() {
    //     const priceSlider = document.getElementById("price-slider");
    //     const priceLabel = document.getElementById("price-label");

    //     priceSlider.addEventListener("input", () => {
    //         const price = priceSlider.value;
    //         priceLabel.textContent = `$${price}`;
    //     });

    //     const productListCont = document.querySelector(".product-list");
    //     let stringProductList = "";

    //     const buttonClick = document.querySelector(".item");
    //     buttonClick.addEventListener("click", () => {
    //         for (let i = 0; i < 12; i++) {
    //             stringProductList += `<div class="product-container">
    //     <!--khung chứa ảnh-->
    //     <div class="image">
    //         <a href="" class="">
    //             <img src="../image/shop-image/${i + 1}.png" alt="">
    //         </a>
    //         <!--cart và xem chi tiết sp trong ảnh-->
    //         <div class="action-custom">
    //             <!--cart-->
    //             <div class="add-to-cart">
    //                 <a href="" class="" title="add cart">
    //                     <i class="fa fa-shopping-bag" aria-hidden="true"></i>
    //                 </a>
    //             </div>
    //             <!--read-more-->
    //             <div class="readmore">
    //                 <a href="" title="Detail">
    //                     <i class="fa fa-eye" aria-hidden="true"></i>
    //                 </a>
    //             </div>
    //         </div>
    //     </div>
    //     <!-- thong tin san pham -->
    //     <div class="product-meta">
    //         <div class="name">
    //             <a href="">Super-soft wrap jumpsuit</a>
    //         </div>

    //     </div>
    //     <!-- thong tin gia san pham -->
    //     <div class="price">
    //         <div itemprop="offers" class="pricelist"></div>
    //         <ins class="giamoi">$39.99</ins>
    //     </div>
    // </div>`;
    //         }
    //         productListCont.innerHTML = stringProductList;
    //     });



    //     const buttonClick2 = document.querySelector(".item 2");
    //     buttonClick2.addEventListener("click", () => {
    //         for (let i = 0; i < 5; i++) {
    //             stringProductList += `<div class="product-container">
    //     <!--khung chứa ảnh-->
    //     <div class="image">
    //         <a href="" class="">
    //             <img src="../image/shop-image/${i + 1}.png" alt="">
    //         </a>
    //         <!--cart và xem chi tiết sp trong ảnh-->
    //         <div class="action-custom">
    //             <!--cart-->
    //             <div class="add-to-cart">
    //                 <a href="" class="" title="add cart">
    //                     <i class="fa fa-shopping-bag" aria-hidden="true"></i>
    //                 </a>
    //             </div>
    //             <!--read-more-->
    //             <div class="readmore">
    //                 <a href="" title="Detail">
    //                     <i class="fa fa-eye" aria-hidden="true"></i>
    //                 </a>
    //             </div>
    //         </div>
    //     </div>
    //     <!-- thong tin san pham -->
    //     <div class="product-meta">
    //         <div class="name">
    //             <a href="">Super-soft wrap jumpsuit</a>
    //         </div>

    //     </div>
    //     <!-- thong tin gia san pham -->
    //     <div class="price">
    //         <div itemprop="offers" class="pricelist"></div>
    //         <ins class="giamoi">$39.99</ins>
    //     </div>
    // </div>`;
    //         }
    //         productListCont.innerHTML = stringProductList;
    //     });

    // hien thi price range
    document.querySelector('#filter-price input').addEventListener('input', function () {
        let container = document.getElementById('show-price');
        let value = document.querySelector('#filter-price input').value;
        container.innerHTML = `0$ - ${value}$`;
    });

}

// chi thucj hien cac hanh dong khi load xong
window.addEventListener('load', async function () {
    // Thực hiện các hàm bạn muốn sau khi trang web đã tải hoàn toàn, bao gồm tất cả các tài nguyên như hình ảnh, stylesheet, v.v.
    console.log('Trang shop đã load hoàn toàn');
    await load_value_targetGender_filter();
    await load_value_color_filter();
    await load_value_bagMaterial_filter();
    await load_value_shirtMaterial_filter();
    await load_value_shirtStyle_filter();
    await load_value_priceMax_filter();
    // getProduct();
    await filter();
    sendFilter();
    resetFilter();
    action();
});