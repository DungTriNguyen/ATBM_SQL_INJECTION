function showInputCheckbox() {
  const checkboxes = document.querySelectorAll(".form-check-input");
  const inputs = document.querySelectorAll(".form-control");

  checkboxes.forEach((checkbox) => {
    checkbox.addEventListener("change", () => {
      const target = document.querySelector(checkbox.dataset.target);
      if (checkbox.checked) {
        target.classList.remove("d-none");
      } else {
        target.classList.add("d-none");
      }
    });
  });
}

$(document).ready(function () {
  $("#category").change(function () {
    const selectedCategory = $(this).val();
    if (selectedCategory === "none") {
      $("#form-quan-ao").addClass("d-none");
      $("#form-tui-xach").addClass("d-none");
    }
    if (selectedCategory === "quan-ao") {
      $("#form-quan-ao").removeClass("d-none");
      $("#form-tui-xach").addClass("d-none");
    } else if (selectedCategory === "tui-xach") {
      $("#form-quan-ao").addClass("d-none");
      $("#form-tui-xach").removeClass("d-none");
    }
  });

  // Load hình ảnh
  $("#inputFileB , #inputFileC").change(function () {
    const files = $(this)[0].files;
    if (files.length > 0) {
      const imagePreview = $("#imagePreviewC, #imagePreviewB");
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

//                                          Load Size
//-----------------------------------------------------------------------------------------
async function getDataSize() {
  // goi ajax
  try {
    const response = await fetch("../../../BLL/SizeBLL.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/x-www-form-urlencoded",
      },
      body: "function=" + encodeURIComponent("getArrObj"),
    });
    const data = await response.json();
    console.log(data);
    loadSize(data);
  } catch (error) {
    console.error("Error:", error);
  }
}

async function loadSize(data) {
  let container = document.getElementById("listSize");

  let result = ``;

  for (let i of data) {
    let str = `
        <div class="form-check">
            <div class="form-vis">
                <input type="checkbox" id="size" class="form-check-input" data-target="#inputSize-${i.sizeCode}" value="${i.sizeCode}">
                <label for="" class="form-check-label" id="${i.sizeCode}">${i.sizeName}</label>
            </div>
            <input type="number" id="inputSize-${i.sizeCode}" class="form-control d-none size-quantity" value="" placeholder="Nhập số lượng">
        </div>`;
    result += str;
  }
  container.innerHTML = result;
}
//-----------------------------------------------------------------------------------------

//                                      Load Supplier List
//-----------------------------------------------------------------------------------------
async function getSupplierList() {
  try {
    const response = await fetch("../../../BLL/SupplierBLL.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/x-www-form-urlencoded",
      },
      body: "function=" + encodeURIComponent("getList"),
    });
    const data = await response.json();
    console.log(data);
    await loadSupplierList(data);
  } catch (error) {
    console.error("Error:", error);
  }
}

async function loadSupplierList(data) {
  document.querySelectorAll("#supplierCode").forEach((element) => {
    element.innerHTML = "";
    let defaultOption = document.createElement("option");
    defaultOption.value = "none";
    defaultOption.text = "Chọn nhà cung cấp";
    element.appendChild(defaultOption);
    for (let supplier of data) {
      let option = document.createElement("option");
      option.value = supplier.codeSupplier;
      option.text = supplier.nameSupplier;
      element.appendChild(option);
    }
  });
}
//-----------------------------------------------------------------------------------------

//check data
function checkProductCode(code) {
  const codeMessage = document.getElementById("codeMessageC");
  if (!code.startsWith("P")) {
    codeMessage.textContent = "Mã sản phẩm phải bắt đầu bằng chữ P";
  } else {
    codeMessage.textContent = "";
  }
}

function checkProductCode1(code) {
  const codeMessage = document.getElementById("codeMessageB");
  if (!code.startsWith("P")) {
    codeMessage.textContent = "Mã sản phẩm phải bắt đầu bằng chữ P";
  } else {
    codeMessage.textContent = "";
  }
}

document.querySelectorAll("#productCode").forEach((element) => {
  element.addEventListener("input", function (event) {
    const code = event.target.value;
    checkProductCode(code);
    checkProductCode1(code);
  });
});

// Thêm sản phẩm
async function addProduct(event) {
  event.preventDefault();
  var type = document.getElementById("category").value;

  // Thêm sản phẩm túi xách
  if (type === "tui-xach") {
    let productCode = document
      .querySelector("#addFormBag #productCode")
      .value.toUpperCase();
    let nameProduct = document
      .querySelector("#addFormBag #nameProduct")
      .value.trim();
    let supplierCode = document
      .querySelector("#addFormBag #supplierCode")
      .value.trim();
    let price = document.querySelector("#addFormBag #price").value.trim();
    let quantity = document.querySelector("#addFormBag #quantity").value.trim();
    let description = document
      .querySelector("#addFormBag #describeProduct")
      .value.trim();
    let status = document.querySelector("#addFormBag #status").value.trim();
    let color = document.querySelector("#addFormBag #color").value.trim();
    let target = document
      .querySelector("#addFormBag #targetGender")
      .value.trim();
    let promotion = document
      .querySelector("#addFormBag #promotion")
      .value.trim();
    let bagMaterial = document
      .querySelector("#addFormBag #bagMaterial")
      .value.trim();
    let descriptionMaterial = document
      .querySelector("#addFormBag #descriptionMaterial")
      .value.trim();
    let files = document.querySelector("#addFormBag #inputFileB").files;
    let isValidate = true;
    let image = [];

    let imageCounter = 1; // Đếm biến từng ảnh
    var productFolderName = "product" + productCode; // Tạo tên thư mục mới cho album ảnh sản phẩm
    console.log(productFolderName);
    for (let i = 0; i < files.length; i++) {
      const file = files[i];
      const newFileName = "product-detail-" + imageCounter + ".jpg"; // Tạo tên mới cho file ảnh
      var destinationPath =
        "../../view/admin/upload.php?productFolder=" +
        encodeURIComponent(productFolderName);
      imageCounter++; // Tăng số thứ tự của ảnh trong sản phẩm

      let string = `../image/product/${productFolderName}/${newFileName}`;
      const reader = new FileReader();
      reader.onload = (function (file, newFileName) {
        return function (event) {
          const fileData = event.target.result;

          // Thực hiện việc copy file và đổi tên vào đường dẫn đích
          saveFile(destinationPath, newFileName, fileData, productFolderName);
        };
      })(file, newFileName, productFolderName);

      reader.readAsArrayBuffer(file);

      image.push(string);
    }
    if (
      productCode === "" ||
      nameProduct === "" ||
      supplierCode === "none" ||
      price === "" ||
      quantity === "" ||
      description === "" ||
      status === "" ||
      color === "" ||
      target === "" ||
      promotion === "" ||
      bagMaterial === "" ||
      descriptionMaterial === ""
    ) {
      Swal.fire({
        icon: "error",
        title: "Thêm thất bại!",
        text: "Nhập đầy đủ thông tin",
      });
      return;
    }
    if (!productCode.startsWith("P")) {
      Swal.fire({
        icon: "error",
        title: "Thêm thất bại!",
        text: "Mã sản phẩm bắt đầu bằng chữ P",
      });
      isValidate = false;
      return;
    }
    if (checkNumber(price, "Giá sản phẩm phải lớn hơn 0") == false) {
      isValidate = false;
      return;
    }
    if (checkNumber(quantity, "Số lượng sản phẩm phải lớn hơn 0") == false) {
      isValidate = false;
      return;
    }
    if (
      checkNumber(promotion, "Khuyến mãi phải lớn hơn hoặc bằng 0") == false
    ) {
      isValidate = false;
      return;
    }
    // else {
    if (isValidate == true) {
      try {
        // gọi AJAX để kiểm tra
        const response = await fetch("../../../BLL/ProductBLL.php", {
          method: "POST",
          headers: {
            "Content-Type": "application/x-www-form-urlencoded",
          },
          body:
            "function=" +
            encodeURIComponent("addHandBagProduct") +
            "&productCode=" +
            encodeURIComponent(productCode) +
            "&nameProduct=" +
            encodeURIComponent(nameProduct) +
            "&supplierCode=" +
            encodeURIComponent(supplierCode) +
            "&price=" +
            encodeURIComponent(price) +
            "&quantity=" +
            encodeURIComponent(quantity) +
            "&status=" +
            encodeURIComponent(status) +
            "&color=" +
            encodeURIComponent(color) +
            "&targetGender=" +
            encodeURIComponent(target) +
            "&describe=" +
            encodeURIComponent(description) +
            "&bagMaterial=" +
            encodeURIComponent(bagMaterial) +
            "&promotion=" +
            encodeURIComponent(promotion) +
            "&arrImg=" +
            encodeURIComponent(JSON.stringify(image)) +
            "&descriptionMaterial=" +
            encodeURIComponent(descriptionMaterial),
        });

        const data = await response.json();
        console.log(data);

        if (data.mess === "success") {
          Swal.fire({
            title: "Thêm thành công!",
            width: 600,
            padding: "3em",
            color: "#716add",
            background: "#fff url(../../image/trees.png)",
            backdrop: `
                            rgba(0,0,123,0.4)
                            url("../../image/nyan-cat.gif")
                            left top
                            no-repeat
            
                          `,
          });
        } else if (data.mess === "failed") {
          Swal.fire({
            icon: "error",
            title: "Thêm thất bại!",
            text: "Trùng mã hình thức vận chuyển",
          });
        }
      } catch (error) {
        console.error("Error:", error);
      }
    }
  }
  // Thêm sản phẩm quan ao
  else if (type === "quan-ao") {
    let productCode = document
      .querySelector("#addFormShirt #productCode")
      .value.toUpperCase();
    let nameProduct = document
      .querySelector("#addFormShirt #nameProduct")
      .value.trim();
    let supplierCode = document
      .querySelector("#addFormShirt #supplierCode")
      .value.trim();
    let price = document.querySelector("#addFormShirt #price").value.trim();
    let shirtStyle = document
      .querySelector("#addFormShirt #shirtStyle")
      .value.trim();
    let description = document
      .querySelector("#addFormShirt #describeProduct")
      .value.trim();
    let status = document.querySelector("#addFormShirt #status").value.trim();
    let color = document.querySelector("#addFormShirt #color").value.trim();
    let target = document
      .querySelector("#addFormShirt #targetGender")
      .value.trim();
    let promotion = document
      .querySelector("#addFormShirt #promotion")
      .value.trim();
    let shirtMaterial = document
      .querySelector("#addFormShirt #shirtMaterial")
      .value.trim();
    let descriptionMaterial = document
      .querySelector("#addFormShirt #descriptionMaterial")
      .value.trim();
    let isValidate = true;
    let sumQuantity = 0;
    let sizes = []; //Mang size
    document.querySelectorAll("#listSize .form-check").forEach((element) => {
      let size = element.querySelector("input").value.trim();
      let quantity = element.querySelector(".size-quantity").value;
      if (checkNumber(quantity, "Số lượng sản phẩm phải lớn hơn 0") == false) {
        isValidate = false;
        return;
      } else if (quantity > 0) {
        sizes.push({ size, productCode, quantity });
        sumQuantity += parseInt(quantity);
      } else {
        Swal.fire({
          icon: "error",
          title: "Thêm thất bại!",
          text: "Số lượng sản phẩm phải lớn hơn 0",
        });
        isValidate = false;
        return;
      }
    });
    let sizesString = sizes
      .map((size) => `${size.size}-${productCode}-${size.quantity}`)
      .join("_");

    let files = document.querySelector("#addFormShirt #inputFileC").files;
    let image = [];
    let imageCounter = 1;
    var productFolderName = "product" + productCode;
    console.log(productFolderName);
    for (let i = 0; i < files.length; i++) {
      const file = files[i];
      const newFileName = "product-detail-" + imageCounter + ".jpg";
      var destinationPath =
        "../../view/admin/upload.php?productFolder=" +
        encodeURIComponent(productFolderName);
      imageCounter++;
      let string = `../image/product/${productFolderName}/${newFileName}`;
      const reader = new FileReader();
      reader.onload = (function (file, newFileName) {
        return function (event) {
          const fileData = event.target.result;
          saveFile(destinationPath, newFileName, fileData, productFolderName);
        };
      })(file, newFileName, productFolderName);
      reader.readAsArrayBuffer(file);
      image.push(string);
    }
    // console.log(type);
    // console.log(productCode);
    // console.log(nameProduct);
    // console.log(price);
    // console.log(description);
    // console.log(status);
    // console.log(target);
    // console.log(promotion);
    // console.log(sizes);
    // console.log(shirtMaterial);
    // console.log(descriptionMaterial);
    // console.log(sumQuantity);
    // console.log(shirtStyle);
    // console.log(sizesString);
    // console.log('Image: ' + image);

    if (
      productCode === "" ||
      nameProduct === "" ||
      supplierCode === "none" ||
      price === "" ||
      quantity === "" ||
      description === "" ||
      status === "" ||
      color === "" ||
      target === "" ||
      shirtStyle === "" ||
      promotion === "" ||
      shirtMaterial === "" ||
      descriptionMaterial === ""
    ) {
      Swal.fire({
        icon: "error",
        title: "Thêm thất bại!",
        text: "Nhập đầy đủ thông tin",
      });
      isValidate = false;
      return;
    }
    if (!productCode.startsWith("P")) {
      Swal.fire({
        icon: "error",
        title: "Thêm thất bại!",
        text: "Mã sản phẩm bắt đầu bằng chữ P",
      });
      isValidate = false;
      return;
    }
    if (checkNumber(price, "Giá sản phẩm phải lớn hơn 0") == false) {
      isValidate = false;
      return;
    }
    if (checkNumber(quantity, "Số lượng sản phẩm phải lớn hơn 0") == false) {
      isValidate = false;
      return;
    }
    if (
      checkNumber(promotion, "Khuyến mãi phải lớn hơn hoặc bằng 0") == false
    ) {
      isValidate = false;
      return;
    }
    if (isValidate == true) {
      try {
        const response = await fetch("../../../BLL/ProductBLL.php", {
          method: "POST",
          headers: {
            "Content-Type": "application/x-www-form-urlencoded",
          },
          body:
            "function=" +
            encodeURIComponent("addShirtProduct") +
            "&productCode=" +
            encodeURIComponent(productCode) +
            "&nameProduct=" +
            encodeURIComponent(nameProduct) +
            "&supplierCode=" +
            encodeURIComponent(supplierCode) +
            "&price=" +
            encodeURIComponent(price) +
            "&quantity=" +
            encodeURIComponent(sumQuantity) +
            "&status=" +
            encodeURIComponent(status) +
            "&color=" +
            encodeURIComponent(color) +
            "&targetGender=" +
            encodeURIComponent(target) +
            "&describe=" +
            encodeURIComponent(description) +
            "&shirtMaterial=" +
            encodeURIComponent(shirtMaterial) +
            "&promotion=" +
            encodeURIComponent(promotion) +
            "&arrImg=" +
            encodeURIComponent(JSON.stringify(image)) +
            "&descriptionMaterial=" +
            encodeURIComponent(descriptionMaterial) +
            "&shirtStyle=" +
            encodeURIComponent(shirtStyle) +
            "&shirtSizeString=" +
            encodeURIComponent(sizesString),
        });
        const data = await response.json();
        console.log(data);
        if (data.mess === "success") {
          Swal.fire({
            title: "Thêm thành công!",
            width: 600,
            padding: "3em",
            color: "#716add",
            background: "#fff url(../../image/trees.png)",
            backdrop: `
                                rgba(0,0,123,0.4)
                                url("../../image/nyan-cat.gif")
                                left top
                                no-repeat
                
                              `,
          });
        } else if (data.mess === "failed") {
          Swal.fire({
            icon: "error",
            title: "Thêm thất bại!",
            text: "Trùng mã sản phẩm",
          });
        }
      } catch (error) {
        console.error("Error:", error);
      }
    }
  }
}

function saveFile(destinationPath, fileName, fileData, productFolderName) {
  const url = destinationPath + "&newFileName=" + encodeURIComponent(fileName); // Chuyển tên mới của file qua truy vấn URL

  const formData = new FormData();
  formData.append(
    "file",
    new Blob([fileData], { type: "application/octet-stream" }),
    fileName
  );

  fetch(url, {
    method: "POST",
    body: formData,
  })
    .then((response) => {
      if (!response.ok) {
        throw new Error("Network response was not ok");
      }
      console.log("File copied and renamed successfully.");
      console.log(
        "File path: ../image/product/" + productFolderName + "/" + fileName
      ); // In ra đường dẫn của file ảnh
      imageCounter = 1;
    })
    .catch((error) => {
      console.error("There was a problem with your fetch operation:", error);
    });
}

function checkNumber(number, str) {
  if (number < 0) {
    Swal.fire({
      icon: "error",
      title: "Thêm thất bại!",
      text: str,
    });
    return false;
  }
  return true;
}

// Lắng nghe sự kiện khi người dùng nhập vào trường codeTransport
document.querySelectorAll("#productCode").forEach((element) => {
  element.addEventListener("input", function (event) {
    // Kiểm tra xem giá trị nhập vào có chứa dấu cách không
    if (event.target.value.includes(" ")) {
      // Nếu có, loại bỏ dấu cách
      event.target.value = event.target.value.replace(/\s/g, "");
    }
  });
});

// Lắng nghe sự kiện khi người dùng nhấn phím trong trường codeTransport
document
  .getElementById("productCode")
  .addEventListener("keypress", function (event) {
    // Kiểm tra xem phím được nhấn có phải là dấu cách không
    if (event.key === " ") {
      // Nếu là dấu cách, ngăn chặn hành động mặc định của trình duyệt
      event.preventDefault();
    }
  });

window.addEventListener("load", async function () {
  // Thực hiện các hàm bạn muốn sau khi trang web đã tải hoàn toàn, bao gồm tất cả các tài nguyên như hình ảnh, stylesheet, v.v.
  await getDataSize();
  await getSupplierList();
  showInputCheckbox();
  console.log("Trang thêm sản phẩm đã load hoàn toàn");
});
