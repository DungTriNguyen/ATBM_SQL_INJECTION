// -------------------------------- AJAX để load dữ liệu lên --------------------------------

// hàm vừa lấy tham số mã sản phẩm từ đó  gửi yêu cầu đến file productBLL.php để lấy sản phẩm dó lên

async function getDetailProduct() {
  // cần lấy mã sản phẩm được mã hóa trên đường dẫn
  // sau đó giải mã mã sản phẩm đó ra
  // và gửi yêu cầu đến file productBLL.php để lấy sản phẩm đó lên

  // Tạo một đối tượng URLSearchParams từ đường dẫn URL hiện tại
  let urlParams = new URLSearchParams(window.location.search);

  // Lấy giá trị của tham số 'code' từ URL hiện tại
  let codeValue = urlParams.get("code");
  let typeValue = urlParams.get("type");

  if (isValidBase64(codeValue) == true && isValidBase64(typeValue) == true) {
    // giải mã mã sản phẩm
    let productCode = atob(codeValue);
    let type = atob(typeValue);

    activeLoadDataComment(productCode);

    if (type == "shirtProduct" || type == "handbagProduct") {
      console.log(productCode + type);

      // xử dụng ajax để lấy dữ liệu lên
      try {
        let response = await fetch("../../BLL/ProductBLL.php", {
          method: "POST",
          headers: {
            "Content-Type": "application/x-www-form-urlencoded",
          },
          body:
            "function=" +
            encodeURIComponent("getProductByCode_transToJson") +
            "&code=" +
            encodeURIComponent(productCode) +
            "&type=" +
            encodeURIComponent(type),
        });
        let data = await response.json();
        if (data != null) {
          if (type == "shirtProduct") {
            DetailShirtProduct(data);
          } else if (type == "handbagProduct") {
            DetailHangbagProduct(data);
          }
          await getRelatedProduct(productCode);

          console.log(data);
          // action();
        } else {
          window.location.href = "../../error.php";
        }
      } catch (error) {
        console.error("Error:", error);
      }
    } else {
      window.location.href = "../../error.php";
    }
  } else {
    window.location.href = "../../error.php";
  }
}
// getDetailProduct();

// Hàm lấy tất cả sản phẩm có liên quan
async function getRelatedProduct(exceptProduct) {
  // cần lấy mã sản phẩm được mã hóa trên đường dẫn
  // sau đó giải mã mã sản phẩm đó ra
  // và gửi yêu cầu đến file productBLL.php để lấy sản phẩm đó lên

  // Tạo một đối tượng URLSearchParams từ đường dẫn URL hiện tại
  let urlParams = new URLSearchParams(window.location.search);

  // Lấy giá trị của tham số 'code' từ URL hiện tại
  let codeValue = urlParams.get("code");
  let typeValue = urlParams.get("type");

  // giải mã mã sản phẩm
  let productCode = atob(codeValue);
  let type = atob(typeValue);

  if (type == "shirtProduct") {
    try {
      let response = await fetch("../../BLL/ProductBLL.php", {
        method: "POST",
        headers: {
          "Content-Type": "application/x-www-form-urlencoded",
        },
        body: "function=" + encodeURIComponent("transShirtProductToJson"),
      });
      let data = await response.json();

      console.log(data);
      await RelatedProduct(data, type, exceptProduct);
    } catch (error) {
      console.error("Error:", error);
    }
  } else if (type == "handbagProduct") {
    try {
      let response = await fetch("../../BLL/ProductBLL.php", {
        method: "POST",
        headers: {
          "Content-Type": "application/x-www-form-urlencoded",
        },
        body: "function=" + encodeURIComponent("transHandbagProductToJson"),
      });
      let data = await response.json();

      console.log(data);
      await RelatedProduct(data, type, exceptProduct);
    } catch (error) {
      console.error("Error:", error);
    }
  }
}
// getRelatedProduct();
// hàm lấy size
async function getArrSizeCodeByProductCode(productCode) {
  try {
    const response = await fetch("../../BLL/ProductBLL.php", {
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
    let data = await response.json();
    if (data != null) {
      // console.log(data);
      let first = data[0];
      return first;
    } else {
      console.log("khong co du lieu tra ve getArrSizeCodeByProductCode");
    }
  } catch (error) {
    console.log("loi ham getArrSizeCodeByProductCode");
  }
}

// kiểm tra mã hóa base64
function isValidBase64(str) {
  try {
    return btoa(atob(str)) == str;
  } catch (err) {
    return false;
  }
}

//

// xử lý đường dẫn product (xử lý sau)
function pathProduct(data) {
  let string = `
    
        <div class="container"><a href="#!">Home</a>
        /
        <a href="#!">Woment</a>
        /
        <a href="#!">Jumpsuits</a>
        /
        <a href="#!">Super-soft wrap jumpsuit</a>
        </div>
    `;
}

// xử lý ảnh chi tiết sản phẩm áo
function DetailShirtProduct(data) {
  // console.log('trong ham chi tiet');
  // lấy chuỗi đường dẫn link ảnh
  let stringImg = data.imgProduct;
  // tách đường dẫn
  let arrImg = stringImg.split(" ");
  console.log(arrImg);

  // ảnh đại diện
  let showImg = document.querySelector(
    ".main-content .container .img-product .show-img"
  );
  let string_1 = `<img src="${arrImg[0]}" alt="">`;
  showImg.innerHTML = string_1;

  // ảnh chi tiết sản phẩm
  let listImg = document.querySelector(
    ".main-content .container .img-product .list-img"
  );
  let listContainer = [];

  for (let i of arrImg) {
    let temp = `<img src="${i}" alt="">`;
    listContainer.push(temp);
  }
  listContainer[0] = `<img src="${arrImg[0]}" alt="" class="opacity">`;
  let string_2 = listContainer.join("");
  listImg.innerHTML = string_2;

  // các thuộc tính sản phẩm
  // tên sản phẩm
  let nameProduct = document.querySelector(
    ".main-content .container .desc-product .name-product"
  );
  let string_3 = data.nameProduct;
  nameProduct.innerHTML = string_3;

  // giá sản phẩm
  let priceProduct = document.querySelector(
    ".main-content .container .desc-product .price"
  );
  // nếu sản phẩm có giảm giá, tính giá giảm giá
  if (data.promotion != 0) {
    let price_after_promotion =
      data.price - (data.price * data.promotion) / 100;
    let string_4 =
      `<del style="opacity:0.5;">$${data.price}</del>` +
      ` $${price_after_promotion.toFixed(2)}`;
    priceProduct.innerHTML = string_4;
  } else {
    let string_4 = "$" + data.price;
    priceProduct.innerHTML = string_4;
  }

  // chất liệu sản phẩm áo
  let composition = document.querySelector(
    ".main-content .container .desc-product .composition"
  );
  let string_5 = data.shirtMaterial;
  composition.innerHTML = string_5;

  // style ao
  let sytle = document.querySelector(
    ".main-content .container .desc-product .sytle"
  );
  let string_6 = data.shirtStyle;
  sytle.innerHTML = string_6;

  // mo ta ve chat lieu
  let descriptionMaterial = document.querySelector(
    ".main-content .container .desc-product .descriptionMaterial"
  );
  let string_7 = data.descriptionMaterial;
  descriptionMaterial.innerHTML = string_7;

  // mo ta ve san pham
  let description = document.querySelector(
    ".main-content .container .desc-and-review .container-des-re .content-desc .description"
  );
  let string_8 = data.describeProduct;
  description.innerHTML = string_8;

  // quantity product
  let quantity = document.querySelector(".main-content .container .quantity");

  // xử lý phần số lượng theo size
  let stringShirtSize = data.quantitySize;
  let arrShirtSize = stringShirtSize.split(" ");
  let string_size_option = "";
  let quantity_first_size = "";
  let flag = 0;
  for (let i of arrShirtSize) {
    let arrI = i.split("-");
    let codeSize = arrI[0];
    let nameSize = arrI[1];
    let quantitySize = arrI[2];
    let temp = `
            <option value="${codeSize}">${nameSize}</option>
        `;
    string_size_option += temp;
    if (flag == 0) {
      quantity_first_size = quantitySize;
      flag = 1;
    }
  }

  let string_9 = ` 
                <div>
                    <label for="cars">Size:</label>
                        <select id="size" name="size">
                            ${string_size_option}
                        </select>
                </div>
                <label style="margin-top:30px;" >Quantity</label>
                <input id="quantityBuy" type="number" step="1" min="1" max="${
                  quantity_first_size - 1
                }" name="quantity" value="1" size="4" pattern="[0-9]*" inputmode="numeric">
                <div id="show-quantity-size" style="margin-top:10px;">(Quantity left in store: ${quantity_first_size})</div>
                
    `;
  quantity.innerHTML = string_9;

  addToCart();
}

async function getQuantityBySizeCodeAndProductCode(sizeCode) {
  // Tạo một đối tượng URLSearchParams từ đường dẫn URL hiện tại
  let urlParams = new URLSearchParams(window.location.search);

  // Lấy giá trị của tham số 'code' từ URL hiện tại

  //hacker
  let codeValue = urlParams.get("code");

  if (isValidBase64(codeValue)) {
    let productCode = atob(codeValue);
    try {
      let response = await fetch("../../BLL/ProductBLL.php", {
        method: "POST",
        headers: {
          "Content-Type": "application/x-www-form-urlencoded",
        },
        body:
          "function=" +
          encodeURIComponent("getQuantityByProductCodeAndSizeCode") +
          "&code=" +
          encodeURIComponent(productCode) +
          "&sizeCode=" +
          encodeURIComponent(sizeCode),
      });
      let data = await response.json();

      console.log(data);

      if (data != null) {
        let quantityBuy = document.getElementById("quantityBuy");
        quantityBuy.max = data.quantitySize - 1;
        let show_quantity_size = document.getElementById("show-quantity-size");
        show_quantity_size.innerHTML = `(Quantity left in store:${data.quantitySize})`;
      } else {
        console.log("loi ham getQuantityBySizeCodeAndProductCode");
      }
    } catch (error) {
      console.error("Error:", error);
    }
  }
}

// xử lý chi tiết sản phẩm túi sách
function DetailHangbagProduct(data) {
  // console.log('trong ham chi tiet');
  // lấy chuỗi đường dẫn link ảnh
  let stringImg = data.imgProduct;
  // tách đường dẫn
  let arrImg = stringImg.split(" ");
  console.log(arrImg);

  // ảnh đại diện
  let showImg = document.querySelector(
    ".main-content .container .img-product .show-img"
  );
  let string_1 = `<img src="${arrImg[0]}" alt="">`;
  showImg.innerHTML = string_1;

  // ảnh chi tiết sản phẩm
  let listImg = document.querySelector(
    ".main-content .container .img-product .list-img"
  );
  let listContainer = [];

  for (let i of arrImg) {
    let temp = `<img src="${i}" alt="">`;
    listContainer.push(temp);
  }
  listContainer[0] = `<img src="${arrImg[0]}" alt="" class="opacity">`;
  let string_2 = listContainer.join("");
  listImg.innerHTML = string_2;

  // các thuộc tính sản phẩm
  // tên sản phẩm
  let nameProduct = document.querySelector(
    ".main-content .container .desc-product .name-product"
  );
  let string_3 = data.nameProduct;
  nameProduct.innerHTML = string_3;

  // giá sản phẩm
  let priceProduct = document.querySelector(
    ".main-content .container .desc-product .price"
  );
  // nếu sản phẩm có giảm giá, tính giá giảm giá
  if (data.promotion != 0) {
    let price_after_promotion =
      data.price - (data.price * data.promotion) / 100;
    let string_4 =
      `<del style="opacity:0.5;">$${data.price}</del>` +
      ` $${price_after_promotion.toFixed(2)}`;
    priceProduct.innerHTML = string_4;
  } else {
    let string_4 = "$" + data.price;
    priceProduct.innerHTML = string_4;
  }

  // chất liệu sản phẩm túi
  let composition = document.querySelector(
    ".main-content .container .desc-product .composition"
  );
  let string_5 = data.bagMaterial;
  composition.innerHTML = string_5;

  //
  let titleStyle = document.querySelector(
    ".main-content .container .desc-product .style-title"
  );
  let sytle = document.querySelector(
    ".main-content .container .desc-product .sytle"
  );
  titleStyle.innerHTML = "";
  sytle.innerHTML = "";

  // mo ta ve chat lieu
  let descriptionMaterial = document.querySelector(
    ".main-content .container .desc-product .descriptionMaterial"
  );
  let string_7 = data.descriptionMaterial;
  descriptionMaterial.innerHTML = string_7;

  // mo ta ve san pham
  let description = document.querySelector(
    ".main-content .container .desc-and-review .container-des-re .content-desc .description"
  );
  let string_8 = data.describeProduct;
  description.innerHTML = string_8;

  // quantity product
  let quantity = document.querySelector(".main-content .container .quantity");
  let string_9 = ` 
                <label>Quantity</label>
                <input id="quantityBuy" type="number" step="1" min="1" max="${
                  data.quantity - 1
                }" name="quantity" value="1" size="4" pattern="[0-9]*" inputmode="numeric">
                <div style="margin-top:10px;">(Quantity left in store: ${
                  data.quantity
                })</div>
    `;
  quantity.innerHTML = string_9;
  addToCart();
}

// xử lý các sản phẩm có liên quan
async function RelatedProduct(data, type, exceptProduct) {
  let container = document.querySelector(
    ".main-content .container .list-item-related"
  );
  let result = "";
  let numberProduct; // số lượng hiển thị
  if (data.length - 1 > 6) {
    numberProduct = 6;
  } else {
    numberProduct = data.length - 1;
  }
  // chọn ngẫu nhiên các sản phẩm
  let arrRandomNumber = [];
  do {
    let randomNumber = Math.random() * data.length;
    // Làm tròn xuống để nhận số nguyên từ 0 đến 10
    randomNumber = Math.floor(randomNumber);
    if (arrRandomNumber.includes(randomNumber) == false) {
      arrRandomNumber.push(randomNumber);
    }
  } while (arrRandomNumber.length < numberProduct);

  for (let x = 0; x < arrRandomNumber.length; x++) {
    let i = arrRandomNumber[x];
    // xu ly ma san pham
    let productCode = data[i].productCode;
    // nếu mà sãn phẩm ngẫu  nhiên không trùng với sản phẩm đang xem
    if (productCode != exceptProduct) {
      // mã hóa
      let mahoaProduct = btoa(productCode);
      let mahoaType = btoa(type);
      // xu ly anh
      let listImg = data[i].imgProduct;
      let arrImg = listImg.split(" ");
      let firstImg = arrImg[0];
      // xu ly ten san pham
      let nameProduct = data[i].nameProduct;
      // xu lys giam gia
      let priceProduct_afterPromotion;
      if (data[i].promotion != 0) {
        priceProduct_afterPromotion =
          data[i].price - (data[i].price * data[i].promotion) / 100;
        priceProduct_afterPromotion = priceProduct_afterPromotion.toFixed(2);
      }
      // ma sizeCode, phan biet giua shirt va bag
      let sizeCodeValue = "";
      if (type == "shirtProduct") {
        let item = await getArrSizeCodeByProductCode(productCode);
        let sizeCode = item.sizeCode;
        // console.log(sizeCode);
        sizeCodeValue = btoa(sizeCode);
      } else {
        sizeCodeValue = btoa("null");
      }
      // xu ly duong dan chi tiet san pham
      let pathDetailProdutc = `./ProductDetail.php?code=${mahoaProduct}&type=${mahoaType}`;
      // xu ly duong dan them vao vo hang
      let pathAddtoCart = `./Cart.php?code=${mahoaProduct}&type=${mahoaType}&quantityBuy=${btoa(
        "1"
      )}&addCart=${btoa("true")}&sizeCode=${sizeCodeValue}`;

      // format
      if (data[i].promotion == 0) {
        let string = `
            <div class="item-product">
                <a href="${pathDetailProdutc}">
                    <div class="img-product-related">
                        <img src="${firstImg}" alt="">
                    </div>
                    <p class="title-product">${nameProduct}</p>
                    <p class="price-product">
                        $${data[i].price}
                    </p>
                </a>
                <a href="${pathAddtoCart}" class="add-product">Add to cart</a>
            </div>    
        `;
        result += string;
      } else {
        let string = `
            <div class="item-product">
                <a href="${pathDetailProdutc}">
                    <div class="img-product-related">
                        <img src="${firstImg}" alt="">
                        <p>Sale!</p>
                    </div>
                    <p class="title-product">${nameProduct}</p>
                    <p class="price-product">
                        <span class="sale-price">$${data[i].price}</span> 
                        $${priceProduct_afterPromotion}
                    </p>
                </a>
                <a href="${pathAddtoCart}" class="add-product">Add to cart</a>
            </div>    
        `;
        result += string;
      }
    }
  }
  container.innerHTML = result;
}

function addToCart() {
  let quantityBuy = document.getElementById("quantityBuy");
  let sizeCode = document.getElementById("size");

  // Tạo một đối tượng URLSearchParams từ đường dẫn URL hiện tại
  let urlParams = new URLSearchParams(window.location.search);

  // Lấy giá trị của tham số 'code' từ URL hiện tại
  let codeValue = urlParams.get("code");
  let typeValue = urlParams.get("type");
  let quantityBuyCode = btoa(quantityBuy.value);

  let addCartCode = btoa("true");

  if (isValidBase64(codeValue) && isValidBase64(typeValue)) {
    // giải mã mã sản phẩm
    // let productCode = atob(codeValue);
    // let type = atob(typeValue);

    // add to cart
    let button = document.getElementById("cart");
    if (atob(typeValue) == "shirtProduct") {
      let mahoaSize = btoa(sizeCode.value);
      let string_10 = `
                <a href="./Cart.php?code=${codeValue}&type=${typeValue}&quantityBuy=${quantityBuyCode}&addCart=${addCartCode}&sizeCode=${mahoaSize}">Add to cart</a>
            `;
      button.innerHTML = string_10;
    } else {
      let string_10 = `
                <a href="./Cart.php?code=${codeValue}&type=${typeValue}&quantityBuy=${quantityBuyCode}&addCart=${addCartCode}&sizeCode=${btoa(
        "null"
      )}">Add to cart</a>
            `;
      button.innerHTML = string_10;
    }
  }

  quantityBuy.addEventListener("change", function () {
    console.log(quantityBuy.value);

    let quantityBuyCode = btoa(quantityBuy.value);

    // Tạo một đối tượng URLSearchParams từ đường dẫn URL hiện tại
    let urlParams = new URLSearchParams(window.location.search);

    // Lấy giá trị của tham số 'code' từ URL hiện tại
    let codeValue = urlParams.get("code");
    let typeValue = urlParams.get("type");

    if (isValidBase64(codeValue) && isValidBase64(typeValue)) {
      // giải mã mã sản phẩm
      // let productCode = atob(codeValue);
      // let type = atob(typeValue);

      // add to cart
      let button = document.getElementById("cart");

      if (atob(typeValue) == "shirtProduct") {
        console.log(sizeCode.value);
        let mahoaSize = btoa(sizeCode.value);
        let string_10 = `
                    <a href="./Cart.php?code=${codeValue}&type=${typeValue}&quantityBuy=${quantityBuyCode}&addCart=${addCartCode}&sizeCode=${mahoaSize}">Add to cart</a>
                `;
        button.innerHTML = string_10;
      } else {
        let string_10 = `
                    <a href="./Cart.php?code=${codeValue}&type=${typeValue}&quantityBuy=${quantityBuyCode}&addCart=${addCartCode}&sizeCode=${btoa(
          "null"
        )}">Add to cart</a>
                `;
        button.innerHTML = string_10;
      }
    }
  });
}

// hàm kích hoạt láy dữ liệu bình luận khi click qua mục review
function activeLoadDataComment(producCode) {
  document.getElementById("rev").onclick = async function () {
    await getCommentData(producCode);

    // let listPostReview = document.querySelectorAll(".item-review-container");
    // let buttonReadMore = document.querySelector(".read-more");

    // // neu nhieu hon 3 cai review thi hien xem them

    // if (listPostReview.length > 2) {
    //     buttonReadMore.classList.remove("hide-readmore");
    //     console.log(listPostReview.length);
    //     listPostReview.forEach((current, i) => {
    //         if (i > 2) {
    //             current.classList.add("hide-readmore");
    //         }
    //     })
    // }
  };
}

// hàm lấy dữ liệu bình luận về sản phẩm
async function getCommentData(productCode) {
  try {
    let response = await fetch("../../BLL/CommentBLL.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/x-www-form-urlencoded",
      },
      body:
        "function=" +
        encodeURIComponent("getArrObj_by_productCode") +
        "&productCode=" +
        encodeURIComponent(productCode),
    });
    let data = await response.json();

    if (data != null) {
      console.log(data);
      await showDataCommentHTML(data);
    } else {
      document.getElementById(
        "review"
      ).innerHTML = `<span>There are no reviews for this product yet, be the first to buy the product and review it.</span>`;
    }
  } catch (error) {
    console.error("Error:", error);
  }
}

// hàm show dữ liệu lên người dùng xem
async function showDataCommentHTML(data) {
  let container = document.getElementById("review");
  let result = "";
  document.getElementById("count-review").innerHTML = `Review (${data.length})`;
  for (let i = data.length - 1; i >= 0; i--) {
    let item = data[i];
    let productCode = item.productCode;
    let userName = item.userNameComment;
    let senDate = item.sentDate;
    let codeComment = item.codeComment;
    let content = item.content;
    let likeNumber = item.likeNumber;
    let dislikeNumber = item.dislikeNumber;
    let state = item.state;
    if (state == "1") {
      let sex = "";
      try {
        let response = await fetch("../../BLL/AccountBLL.php", {
          method: "POST",
          headers: {
            "Content-Type": "application/x-www-form-urlencoded",
          },
          body:
            "function=" +
            encodeURIComponent("getObjAccount") +
            "&userName=" +
            encodeURIComponent(userName),
        });
        let data = await response.json();
        if (data.result == "success") {
          sex = data.sex;
        }
      } catch (error) {
        console.error("Error:", error);
      }
      if (sex == "Male") {
        let string = `
                <div class="item-review-container">
                    <div class="item-review">
                        <img src="../image/avt-review/male.png" alt="" class="avt">
                        <div class="main-review">
                            <div class="content-review">
                                <p class="name-user">${userName} - ${senDate}</p>
                                <div class="text-review">
                                    <p>${content}</p>
                                </div>
                            </div>
                            <div class="behavior">
                                <div onclick="updateLikeAndDislikeNumber('${codeComment}','${productCode}','${userName}','null','${senDate}','${content}','${state}','like')">
                                    <i class="fa-solid fa-thumbs-up"></i>
                                    <span id="${codeComment}-likeNumber">${likeNumber}</span>
                                </div>
                                <div onclick="updateLikeAndDislikeNumber('${codeComment}','${productCode}','${userName}','null','${senDate}','${content}','${state}','dislike')">
                                    <i class="fa-solid fa-thumbs-down"></i>
                                    <span id="${codeComment}-dislikeNumber">${dislikeNumber}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                </div>
            `;
        result += string;
      } else {
        let string = `
                <div class="item-review-container">
                    <div class="item-review">
                        <img src="../image/avt-review/female.png" alt="" class="avt">
                        <div class="main-review">
                            <div class="content-review">
                                <p class="name-user">${userName} - ${senDate}</p>
                                <div class="text-review">
                                    <p>${content}</p>
                                </div>
                            </div>
                            <div class="behavior">
                                <div onclick="updateLikeAndDislikeNumber('${codeComment}','${productCode}','${userName}','null','${senDate}','${content}','${state}','like')">
                                    <i class="fa-solid fa-thumbs-up"></i>
                                    <span id="${codeComment}-likeNumber">${likeNumber}</span>
                                </div>
                                <div onclick="updateLikeAndDislikeNumber('${codeComment}','${productCode}','${userName}','null','${senDate}','${content}','${state}','dislike')">
                                    <i class="fa-solid fa-thumbs-down"></i>
                                    <span id="${codeComment}-dislikeNumber">${dislikeNumber}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                </div>
            `;
        result += string;
      }
    }
  }
  container.innerHTML = result;
}

// hàm tăng số lượt thích
async function updateLikeAndDislikeNumber(
  codeComment,
  producCode,
  userNameComment,
  userNameRepComment,
  senDate,
  content,
  state,
  likeOrdislike
) {
  let numberLike = document.getElementById(
    codeComment + "-likeNumber"
  ).innerText;
  let numberDisLike = document.getElementById(
    codeComment + "-dislikeNumber"
  ).innerText;

  if (likeOrdislike == "like") {
    numberLike = Number(numberLike) + 1;
  } else if (likeOrdislike == "dislike") {
    numberDisLike = Number(numberDisLike) + 1;
  }
  try {
    let response = await fetch("../../BLL/CommentBLL.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/x-www-form-urlencoded",
      },
      body:
        "function=" +
        encodeURIComponent("updateObj") +
        "&codeComment=" +
        encodeURIComponent(codeComment) +
        "&productCode=" +
        encodeURIComponent(producCode) +
        "&userNameComment=" +
        encodeURIComponent(userNameComment) +
        "&userNameRepComment=" +
        encodeURIComponent(userNameRepComment) +
        "&sentDate=" +
        encodeURIComponent(senDate) +
        "&content=" +
        encodeURIComponent(content) +
        "&state=" +
        encodeURIComponent(state) +
        "&numberLike=" +
        encodeURIComponent(numberLike) +
        "&numberDislike=" +
        encodeURIComponent(numberDisLike),
    });
    let data = await response.json();
    console.log(data);
    if (data.mess == "success") {
      if (likeOrdislike == "like") {
        document.getElementById(codeComment + "-likeNumber").innerHTML =
          numberLike;
      } else if (likeOrdislike == "dislike") {
        document.getElementById(codeComment + "-dislikeNumber").innerHTML =
          numberDisLike;
      }
    }
  } catch (error) {
    console.error("Error:", error);
  }
}

// ------------------------------------- XỦ LÝ CÁC HÀNH ĐỘNG HIỆU ỨNG --------------------------------

function action() {
  const imgProductDetailList = document.querySelectorAll(".list-img img");
  const imgProductDetail = document.querySelector(".show-img");

  const currentImgCount = document.querySelector(".current-img");
  const totalImgCount = document.querySelector(".total-img");

  // Fulll screen
  let myDocument = document.documentElement;
  let btnFull = document.getElementById("fullscreen");
  let btnExit = document.getElementById("exitfullscreen");

  imgProductDetailList.forEach((item, index) => {
    item.addEventListener("click", () => {
      imgProductDetailList.forEach((item, index) => {
        item.classList.remove("opacity");
      });
      imgProductDetail.innerHTML = `<img src="${item.src}" alt="">`;
      item.classList.add("opacity");
    });
  });

  const selectDR = document.querySelectorAll(".title  h4");
  const desc = document.querySelector(".content-desc");
  const rev = document.querySelector(".content-rev");
  selectDR.forEach((item, index) => {
    item.addEventListener("click", () => {
      if (index === 0) {
        document.querySelector(".desc").classList.add("selected");
        document.querySelector(".rev").classList.remove("selected");
        rev.classList.add("hiddenP");
        desc.classList.remove("hiddenP");
        console.log("1");
      } else if (index === 1) {
        document.querySelector(".desc").classList.remove("selected");
        document.querySelector(".rev").classList.add("selected");
        desc.classList.add("hiddenP");
        rev.classList.remove("hiddenP");
      }
    });
  });

  const starList = document.querySelectorAll(".fa-star");
  starList.forEach((star, index) => {
    star.addEventListener("click", () => {
      for (let i = 0; i < index + 1; i++) {
        starList[i].classList.remove("far");
        starList[i].classList.add("fas");
      }
      for (let i = index + 1; i < starList.length; i++) {
        starList[i].classList.remove("fas");
        starList[i].classList.add("far");
      }
    });
  });

  const imgShow = document.querySelector(".show-img");
  const backgroundIMG = document.querySelector(".action-img");

  imgShow.addEventListener("click", () => {
    backgroundIMG.classList.remove("disappear");
    document.querySelector("body").classList.add("no-scroll");
    backgroundIMG.lastElementChild.src = imgShow.firstElementChild.currentSrc;
    let flag;
    for (let i = 0; i < imgProductDetailList.length; i++) {
      if (imgProductDetailList[i].src === backgroundIMG.lastElementChild.src) {
        flag = i;
      }
    }
    currentImgCount.innerHTML = flag + 1;
    totalImgCount.innerHTML = imgProductDetailList.length;
  });

  const close = document.querySelector(".fa-times");
  close.addEventListener("click", () => {
    backgroundIMG.classList.add("disappear");
    document.querySelector("body").classList.remove("no-scroll");
    if (document.exitFullscreen) {
      document.exitFullscreen();
    } else if (document.msexitFullscreen) {
      document.msexitFullscreen();
    } else if (document.mozexitFullscreen) {
      document.mozexitFullscreen();
    } else if (document.webkitexitFullscreen) {
      document.webkitexitFullscreen();
    }
    btnExit.classList.add("disappear");
    btnFull.classList.remove("disappear");
  });

  const arrowLeft = document.querySelector(".fa-arrow-left");
  arrowLeft.addEventListener("click", () => {
    let flag;
    for (let i = 0; i < imgProductDetailList.length; i++) {
      if (imgProductDetailList[i].src === backgroundIMG.lastElementChild.src) {
        flag = i;
      }
    }
    if (flag === 0) {
      backgroundIMG.lastElementChild.src =
        imgProductDetailList[imgProductDetailList.length - 1].src;
      currentImgCount.innerHTML = imgProductDetailList.length;
    } else {
      backgroundIMG.lastElementChild.src = imgProductDetailList[flag - 1].src;
      currentImgCount.innerHTML = flag;
    }
  });

  const arrowRight = document.querySelector(".fa-arrow-right");
  arrowRight.addEventListener("click", () => {
    let flag;
    for (let i = 0; i < imgProductDetailList.length; i++) {
      if (imgProductDetailList[i].src === backgroundIMG.lastElementChild.src) {
        flag = i;
      }
    }
    if (flag === imgProductDetailList.length - 1) {
      backgroundIMG.lastElementChild.src = imgProductDetailList[0].src;
      currentImgCount.innerHTML = 1;
    } else {
      backgroundIMG.lastElementChild.src = imgProductDetailList[flag + 1].src;
      currentImgCount.innerHTML = flag + 2;
    }
  });

  btnFull.addEventListener("click", () => {
    if (myDocument.requestFullscreen) {
      myDocument.requestFullscreen();
    } else if (myDocument.msRequestFullscreen) {
      myDocument.msRequestFullscreen();
    } else if (myDocument.mozRequestFullScreen) {
      myDocument.mozRequestFullScreen();
    } else if (myDocument.webkitRequestFullscreen) {
      myDocument.webkitRequestFullscreen();
    }
    btnExit.classList.remove("disappear");
    btnFull.classList.add("disappear");
  });
  btnExit.addEventListener("click", () => {
    if (document.exitFullscreen) {
      document.exitFullscreen();
    } else if (document.msexitFullscreen) {
      document.msexitFullscreen();
    } else if (document.mozexitFullscreen) {
      document.mozexitFullscreen();
    } else if (document.webkitexitFullscreen) {
      document.webkitexitFullscreen();
    }
    btnExit.classList.add("disappear");
    btnFull.classList.remove("disappear");
  });
  // else {
  //     if (document.exitFullscreen) {
  //         document.exitFullscreen();
  //     } else if (document.msexitFullscreen) {
  //         document.msexitFullscreen();
  //     } else if (document.mozexitFullscreen) {
  //         document.mozexitFullscreen();
  //     } else if (document.webkitexitFullscreen) {
  //         document.webkitexitFullscreen();
  //     }
  //     btn.textContent = "Go Fullscreen";
  // }
}

// chi thuc hien ham khi trang da load xong

window.addEventListener("load", async function () {
  // Thực hiện các hàm bạn muốn sau khi trang web đã tải hoàn toàn, bao gồm tất cả các tài nguyên như hình ảnh, stylesheet, v.v.
  console.log("Trang chi tiết sản phẩm đã load hoàn toàn");
  await getDetailProduct();

  let showSize = this.document.getElementById("size");
  if (showSize != null) {
    console.log(showSize);
    showSize.onchange = async function () {
      await getQuantityBySizeCodeAndProductCode(showSize.value);
      addToCart();
    };
  }

  action();
});
