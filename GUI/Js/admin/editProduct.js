async function getData() {

       // // Tạo một đối tượng URLSearchParams từ đường dẫn URL hiện tại
       // let urlParams = new URLSearchParams(window.location.search);

       // Lấy giá trị của tham số 'code' từ URL hiện tại
       let urlParams = new URLSearchParams(window.location.search);

       let productCode = urlParams.get('productCode');
       let typeValue = urlParams.get('type');
       // kiem tra

       try {
              const response = await fetch('../../../BLL/ProductBLL.php', {
                     method: 'POST',
                     headers: {
                            'Content-Type': 'application/x-www-form-urlencoded'
                     },
                     body:
                            'function=' + encodeURIComponent('getProductByCode_transToJson') + '&code=' + encodeURIComponent(productCode) + '&type=' + encodeURIComponent(typeValue)
              });


              const data = await response.json();
              console.log(data);

              if (typeValue == 'handbagProduct') { await showHandbag(data); }
              else if (typeValue == 'shirtProduct') {
                     // await loadSize(data);
                     await showShirt(data);
              }
              await getSupplierList(data.supplierCode);

       } catch (error) {
              console.error('Error:', error);
       }
}

async function showHandbag(data) {
       let productCode = data.productCode;
       let nameProduct = data.nameProduct;
       let supplierCode = data.supplierCode;
       let price = data.price;
       let describeProduct = data.describeProduct;
       let status = data.status;
       let promotion = data.promotion;
       let quantity = data.quantity;
       let targetGender = data.targetGender;
       let color = data.color;
       let bagMaterial = data.bagMaterial;
       let descriptionMaterial = data.descriptionMaterial;

       //Xử lý ảnh
       let imgProduct = data.imgProduct;
       let arrImg = imgProduct.split(' ');
       let result_img = '';
       for (let item of arrImg) {
              let string = `
              <div class="d-flex flex-column align-items-center" id="${item}">       
                     <img class="img-thumbnail" src="../${item}" id="${productCode}-${item}"> 
                     <button class="btn btn-sm btn-danger" onclick="deleteSourceImageB('${item}')">Xóa</button>
              </div>
              `;
              result_img += string;
       }
       // document.getElementById('container').innerHTML = `ProductCode: ${productCode} <br> ${result_img}`;


       // Xử lý load nhà cung cấp

       document.getElementById('editContainer1').innerHTML = `
              <form id="editFormB">
                     <div class="mb-3">
                            <label for="productCode" class="form-label fw-bold">Mã sản phẩm</label>
                            <input type="text" class="form-control" id="productCode" name="productCode" disabled value="${productCode}">
                     </div>
                     <div class="mb-3">
                            <label for="nameProduct" class="form-label fw-bold">Tên sản phẩm</label>
                            <input type="text" class="form-control" id="nameProduct" name="nameProduct" value="${nameProduct}">
                     </div>
                     <div class="mb-3">
                            <label for="inputFileB" class="form-label fw-bold">Ảnh(PNG,JPG)</label>
                            <input type="file" class="form-control" id="inputFileB" name="imgProduct" accept="image/jpeg, image/png" multiple>
                            <input type="text" class="d-none" id="imgProduct" name="imgProduct" value="${imgProduct}">
                            <div id="imagePreviewB" style="padding-top:2px;" class="d-flex">${result_img}</div>
                            <button id="undoBtnB" class="btn btn-sm btn-secondary d-none mt-2">Hoàn tác</button>
                     </div>
                     <div class="mb-3">
                            <label for="quantity" class="form-label fw-bold">Số lượng</label>
                            <input type="number" class="form-control" id="quantity" name="quantity" value="${quantity}">
                     </div>
                     <div class="mb-3">
                            <label for="price" class="form-label fw-bold">Giá</label>
                            <input type="number" class="form-control" id="price" name="price" value="${price}">
                     </div>
                     <div class="mb-3">
                            <label for="category" class="form-label fw-bold">Danh mục</label>
                            <select disabled id="category" class="form-control">
                                <option value="shirtProduct">Quần áo</option>
                                <option value="handbagProduct" selected>Túi xách</option>
                            </select>
                     </div>
                     <div class="mb-3">
                            <label for="supplierCode" class="form-label fw-bold">Nhà cung cấp</label>
                            <select class="form-select" id="supplierCode" name="supplierCode">
                                   
                                   
                            </select>
                     </div>
                     <div class="mb-3">
                            <label for="describeProduct" class="form-label fw-bold">Mô tả sản phẩm</label>
                            <textarea class="form-control" id="describeProduct" name="describe">${describeProduct}</textarea>
                     </div>
                     <div class="mb-3">
                            <label for="targetGender" class="form-label fw-bold">Đối tượng sử dụng</label>
                            <select class="form-select" id="targetGender" name="targetGender">
                                   <option value="">Select Object</option>
                                   <option value="Male" ${targetGender === 'Male' ? 'selected' : ''}>Nam</option>
                                   <option value="Female" ${targetGender === 'Female' ? 'selected' : ''}>Nữ</option>
                                   <option value="Both" ${targetGender === 'Both' ? 'selected' : ''}>Tất cả</option>
                            </select>
                     </div>
                     <div class="mb-3">
                            <label for="status" class="form-label fw-bold">Trạng thái</label>
                            <select class="form-select" id="status" name="status">
                                   <option value="">Chọn trạng thái</option>
                                   <option value="1" ${status === '1' ? 'selected' : ''}>Mở bán</option>
                                   <option value="0" ${status === '0' ? 'selected' : ''}>Chưa bán</option>
                            </select>
                     </div>
                     <div class="mb-3">
                            <label for="color" class="form-label fw-bold">Màu sắc</label>
                            <input type="text" class="form-control" id="color" name="color" value="${color}">
                     </div>
                     <div class="mb-3">
                            <label for="bagMaterial" class="form-label fw-bold">Chất liệu</label>
                            <input type="text" class="form-control" id="bagMaterial" name="bagMaterial" value="${bagMaterial}">
                     </div>
                     <div class="mb-3">
                            <label for="descriptionMaterial" class="form-label fw-bold">Mô tả chất liệu</label>
                            <input type="text" class="form-control" id="descriptionMaterial" name="descriptionMaterial" value="${descriptionMaterial}">
                     </div>
                     <div class="mb-3">
                            <label for="promotion" class="form-label fw-bold">Giảm giá</label>
                            <input type="number" class="form-control" id="promotion" name="promotion" value="${promotion}">
                     </div>
                     <div class="mb-3 d-flex justify-content-between">
                            <button class="btn btn-secondary"><a href="./list-products.php" class="text-decoration-none text-white">Quay lại</a></button>
                            <button type="submit" class="btn btn-primary" onclick="updateHandbag(event)">Sửa sản phẩm</button>
                     </div>
                     
              </form>
       `;




}

async function showShirt(data) {
       let productCode = data.productCode;
       let nameProduct = data.nameProduct;
       let supplierCode = data.supplierCode;
       let price = data.price;
       let describeProduct = data.describeProduct;
       let status = data.status;
       let promotion = data.promotion;
       let quantity = data.quantity;
       let targetGender = data.targetGender;
       let color = data.color;
       let shirtMaterial = data.shirtMaterial;
       let descriptionMaterial = data.descriptionMaterial;
       let shirtStyle = data.shirtStyle;
       let quantitySize = data.quantitySize;

       //Xử lý ảnh
       let imgProduct = data.imgProduct;
       let arrImg = imgProduct.split(' ');
       let result_img = '';
       for (let item of arrImg) {
              let string = `
                     <div class="d-flex flex-column align-items-center" id="${item}">       
                            <img class="img-thumbnail" src="../${item}" id="${productCode}-${item}"> 
                            <button class="btn btn-sm btn-danger" onclick="deleteSourceImageC('${item}')">Xóa</button>
                     </div>
                     `;
              result_img += string;
       }
       // document.getElementById('container').innerHTML = `ProductCode: ${productCode} <br> ${result_img}`;

       document.getElementById('editContainer').innerHTML = `
                     <form id="editForm">
                            <div class="mb-3">
                                   <label for="productCode" class="form-label fw-bold">Mã sản phẩm</label>
                                   <input type="text" class="form-control" id="productCode" name="productCode" disabled value="${productCode}">
                            </div>
                            <div class="mb-3">
                                   <label for="nameProduct" class="form-label fw-bold">Tên sản phẩm</label>
                                   <input type="text" class="form-control" id="nameProduct" name="nameProduct" value="${nameProduct}">
                            </div>
                            <div class="mb-3">
                                   <label for="inputFileC" class="form-label fw-bold">Ảnh(PNG,JPG)</label>
                                   <input type="file" class="form-control" id="inputFileC" name="imgProduct" accept="image/jpeg, image/png" multiple>
                                   <input type="text" class="d-none" id="imgProduct" name="imgProduct" value="${imgProduct}">
                                   <div id="imagePreviewC" style="padding-top:2px;" class="d-flex">${result_img}</div>
                                   <button id="undoBtnC" class="btn btn-sm btn-secondary d-none mt-2">Hoàn tác</button>
                            </div>
                            <div class="mb-3">
                                   <label for="listSize" class="form-label fw-bold">Số lượng</label>
                                   <div class="row">
                                        <div class="col-md-6" id="listSize">
                                            
                                        </div>
                                   </div>
                                   <input type="text" class="d-none" id="quantitySize" name="quantitySize" value="${quantitySize}">
                            </div>
                            
                            <div class="mb-3">
                                   <label for="price" class="form-label fw-bold">Giá</label>
                                   <input type="number" class="form-control" id="price" name="price" value="${price}">
                            </div>
                            <div class="mb-3">
                                   <label for="category" class="form-label fw-bold">Danh mục</label>
                                   <select disabled id="category" class="form-control">
                                       <option value="shirtProduct" selected>Quần áo</option>
                                       <option value="handbagProduct">Túi xách</option>
                                   </select>
                            </div>
                            <div class="mb-3">
                                   <label for="supplierCode" class="form-label fw-bold">Nhà cung cấp</label>
                                   <select class="form-select" id="supplierCode" name="supplierCode">
                                          
                                          
                                   </select>
                            </div>
                            <div class="mb-3">
                                   <label for="describeProduct" class="form-label fw-bold">Mô tả sản phẩm</label>
                                   <textarea class="form-control" id="describeProduct" name="describeProduct">${describeProduct}</textarea>
                            </div>
                            <div class="mb-3">
                                   <label for="targetGender" class="form-label fw-bold">Đối tượng sử dụng</label>
                                   <select class="form-select" id="targetGender" name="targetGender">
                                          <option value="">Select Object</option>
                                          <option value="Male" ${targetGender === 'Male' ? 'selected' : ''}>Nam</option>
                                          <option value="Female" ${targetGender === 'Female' ? 'selected' : ''}>Nữ</option>
                                          <option value="Both" ${targetGender === 'Both' ? 'selected' : ''}>Tất cả</option>
                                   </select>
                            </div>
                            <div class="mb-3">
                                   <label for="status" class="form-label fw-bold">Trạng thái</label>
                                   <select class="form-select" id="status" name="status">
                                          <option value="">Chọn trạng thái</option>
                                          <option value="1" ${status === '1' ? 'selected' : ''}>Mở bán</option>
                                          <option value="0" ${status === '0' ? 'selected' : ''}>Chưa bán</option>
                                   </select>
                            </div>
                            <div class="mb-3">
                                   <label for="promotion" class="form-label fw-bold">Giảm giá</label>
                                   <input type="number" class="form-control" id="promotion" name="promotion" value="${promotion}">
                            </div>
                            <div class="mb-3">
                                   <label for="color" class="form-label fw-bold">Màu sắc</label>
                                   <input type="text" class="form-control" id="color" name="color" value="${color}">
                            </div>
                            <div class="mb-3">
                                   <label for="shirtStyle" class="form-label fw-bold">Phong cách</label>
                                   <input type="text" class="form-control" id="shirtStyle" name="shirtStyle" value="${shirtStyle}">
                            </div>
                            <div class="mb-3">
                                   <label for="shirtMaterial" class="form-label fw-bold">Chất liệu</label>
                                   <input type="text" class="form-control" id="shirtMaterial" name="shirtMaterial" value="${shirtMaterial}">
                            </div>
                            <div class="mb-3">
                                   <label for="descriptionMaterial" class="form-label fw-bold">Mô tả chất liệu</label>
                                   <input type="text" class="form-control" id="descriptionMaterial" name="descriptionMaterial" value="${descriptionMaterial}">
                            </div>
                            <div class="mb-3 d-flex justify-content-between">
                                   <button class="btn btn-secondary"><a href="./list-products.php" class="text-decoration-none text-white">Quay lại</a></button>
                                   <button type="submit" class="btn btn-primary" onclick="updateShirt(event)">Sửa sản phẩm</button>
                            </div>
                     </form>
              `;
       await loadSize(data);
}



function deleteSourceImageC(linkImg) {
       let temp = document.getElementById(linkImg);
       console.log(temp);
       document.getElementById(linkImg).remove();

       let undoBtn = document.getElementById('undoBtnC');
       undoBtn.classList.remove('d-none');
       undoBtn.addEventListener('click', function (event) {
              document.querySelector('#imagePreviewC').appendChild(temp);
              undoBtn.classList.add('d-none');
              event.preventDefault();
       });
}

function deleteSourceImageB(linkImg) {
       let temp = document.getElementById(linkImg);
       console.log(temp);
       document.getElementById(linkImg).remove();

       let undoBtn = document.getElementById('undoBtnB');
       undoBtn.classList.remove('d-none');
       undoBtn.addEventListener('click', function (event) {
              event.preventDefault();
              document.querySelector('#imagePreviewB').appendChild(temp);
              undoBtn.classList.add('d-none');
       });
}
// let arrImg = imgProduct.split(' ');
// var newArr = arrImg.filter(item => item !== linkImg);

// let newStringImg = newArr.join(' ');

// imgProduct = newStringImg;
// console.log(imgProduct);

// let arr = [];

// return newArr;

// function addImg(linkImg) {

//        let arrImg = imgProduct.split(' ');
//        // Tạo một mảng mới không bao gồm phần tử có giá trị là 3
//        arrImg.push(linkImg);

//        let newStringImg = newArr.join(' ');

//        imgProduct = newStringImg;


//        console.log(imgProduct);

//        // let arr = [];


//        // return newArr;
// }

async function getSupplierList(code) {

       try {
              const response = await fetch('../../../BLL/SupplierBLL.php', {
                     method: 'POST',
                     headers: {
                            'Content-Type': 'application/x-www-form-urlencoded'
                     },
                     body: 'function=' + encodeURIComponent('getList')
              });
              let data = await response.json();

              console.log(data);


              loadSupplierList(data, code);
       } catch (error) {
              console.error('Error:', error);
       }
}

function loadSupplierList(data, code) {
       let element = document.querySelector('#supplierCode');
       if (element) {
              element.innerHTML = '';
              let defaultOption = document.createElement('option');
              defaultOption.value = "";
              defaultOption.text = "Chọn nhà cung cấp";
              element.appendChild(defaultOption);
              for (let supplier of data) {
                     let option = document.createElement('option');
                     option.value = supplier.codeSupplier;
                     option.text = supplier.nameSupplier;
                     if (supplier.codeSupplier === code) {
                            option.selected = true;
                     }
                     element.appendChild(option);
              }
       } else {
              console.error('Element with id "supplierCode" not found');
       }
}


function showAddImageC() {
       $('#inputFileC').change(function () {
              const files = $(this)[0].files;
              if (files.length > 0) {
                     // const imagePreview = $('#imagePreviewC, #imagePreviewB');

                     let container = document.getElementById('imagePreviewC');
                     // let result = '';
                     for (let i = 0; i < files.length; i++) {
                            const file = files[i];
                            const reader = new FileReader();
                            let div = document.createElement('div');
                            div.classList.add('d-flex', 'flex-column', 'align-items-center');
                            let img = document.createElement('img');
                            img.src = URL.createObjectURL(file);
                            img.classList.add('img-thumbnail');
                            let button = document.createElement('button');
                            button.classList.add('btn', 'btn-danger', 'btn-sm', 'delete-btn');
                            button.textContent = 'Xóa';
                            button.addEventListener('click', function () {
                                   div.remove();
                            });
                            container.appendChild(div);
                            div.appendChild(img);
                            div.appendChild(button);

                            reader.readAsDataURL(file);
                     }
              }
       });
}

function showAddImageB() {
       $('#inputFileB').change(function () {
              const files = $(this)[0].files;
              if (files.length > 0) {
                     // const imagePreview = $('#imagePreviewC, #imagePreviewB');

                     let container = document.getElementById('imagePreviewB');
                     // let result = '';
                     for (let i = 0; i < files.length; i++) {
                            const file = files[i];
                            const reader = new FileReader();
                            let div = document.createElement('div');
                            div.classList.add('d-flex', 'flex-column', 'align-items-center');
                            let img = document.createElement('img');
                            img.src = URL.createObjectURL(file);
                            img.classList.add('img-thumbnail');
                            let button = document.createElement('button');
                            button.classList.add('btn', 'btn-danger', 'btn-sm', 'delete-btn');
                            button.textContent = 'Xóa';
                            button.addEventListener('click', function () {
                                   div.remove();
                            });
                            container.appendChild(div);
                            div.appendChild(img);
                            div.appendChild(button);

                            reader.readAsDataURL(file);
                     }
              }
       });
}

// let DataSize = getDataSize();
// console.log(DataSize);
//
async function loadSize(data) {
       try {
              const response = await fetch('../../../BLL/SizeBLL.php', {
                     method: 'POST',
                     headers: {
                            'Content-Type': 'application/x-www-form-urlencoded'
                     },
                     body:
                            'function=' + encodeURIComponent('getArrObj')
              });
              const dataSize = await response.json();
              // console.log(dataSize);
              //  return data;
              let stringSize = data.quantitySize;
              let arrSize = stringSize.split(' ');
              let listSize = ``;
              // console.log(arrSize);

              let arrSizeEach = arrSize.flatMap(item => item.split('-'));
              // console.log(arrSizeEach);
              let result = ``;
              const arrSize1D = [];

              for (const item of dataSize) {
                     for (const value in item) {
                            arrSize1D.push(item[value]);
                     }
              }
              // console.log(arrSize1D);
              let containerSize = document.getElementById('listSize');
              // console.log(containerSize);
              containerSize.innerHTML = listSize;
              for (let i = 0; i < arrSize1D.length; i += 2) {
                     let codeSize = arrSize1D[i + 1];
                     let nameSize = arrSize1D[i];

                     let str = `
                     <div class="form-check" style="padding-left:0;">
                     <div class="form-vis">
                            <label for="${codeSize}" class="form-check-label" id="${codeSize}">${nameSize}</label>
                            <input type="number" id="inputSize-${codeSize}" class="form-control size-quantity" value="" placeholder="Nhập số lượng">
                     </div>
                     
                     </div>
              `;
                     listSize += str;

              }
              // console.log(containerSize);
              containerSize.innerHTML = listSize;


              // 012345678
              for (let i = 0; i < arrSizeEach.length; i += 3) {
                     let codeSize = arrSizeEach[i];
                     let nameSize = arrSizeEach[i + 1];
                     let quantitySize = arrSizeEach[i + 2];
                     let stringSize = `${codeSize}-${nameSize}-${quantitySize}`;
                     if (i < arrSize.length + 1) {
                            result += stringSize + ' ';
                     } else {
                            result += stringSize;
                     }
                     // console.log(result);
                     document.getElementById(`${codeSize}`).textContent = nameSize;
                     document.getElementById(`inputSize-${codeSize}`).value = quantitySize;
              }

       } catch (error) {
              console.error('Error:', error);
       }

}

async function updateHandbag(event) {
       event.preventDefault();
       var type = document.getElementById('category').value;

       // Thêm sản phẩm túi xách
       let productCode = document.querySelector('#editFormB #productCode').value;
       let nameProduct = document.querySelector('#editFormB #nameProduct').value.trim();
       let supplierCode = document.querySelector('#editFormB #supplierCode').value.trim();
       let price = document.querySelector('#editFormB #price').value.trim();
       let quantity = document.querySelector('#editFormB #quantity').value.trim();
       let description = document.querySelector('#editFormB #describeProduct').value.trim();
       let status = document.querySelector('#editFormB #status').value.trim();
       let color = document.querySelector('#editFormB #color').value.trim();
       let target = document.querySelector('#editFormB #targetGender').value.trim();
       let promotion = document.querySelector('#editFormB #promotion').value.trim();
       let bagMaterial = document.querySelector('#editFormB #bagMaterial').value.trim();
       let descriptionMaterial = document.querySelector('#editFormB #descriptionMaterial').value.trim();
       let filesNew = document.querySelector('#editFormB #inputFileB').files; //Ảnh chọn thêm
       let filesOld = document.querySelector('#editFormB #imgProduct').value; //String ảnh

       let text = filesOld.trim();

       var chuoiArr = text.split(" "); // text ảnh thành mảng ảnh
       console.log(chuoiArr);
       let imageCounter = chuoiArr.length + 1; // Đếm biến từng ảnh
       var productFolderName = "product" + productCode; // Tạo tên thư mục mới cho album ảnh sản phẩm
       console.log(productFolderName);
       var parentDiv = document.getElementById("imagePreviewB");
       // Lấy số lượng thẻ div con
       var soLuongDivCon = parentDiv.children.length;
       console.log("Số lượng thẻ div con là:", soLuongDivCon);
       var children = parentDiv.children;

       // Mảng để lưu trữ các id của các thẻ con
       var ids = [];

       // Duyệt qua các thẻ con và lấy giá trị của thuộc tính id
       for (var i = 0; i < children.length; i++) {
              var child = children[i];
              if (child.id === '') {
                     child.id = `../image/product/${productFolderName}/product-detail-${imageCounter}.jpg`;
              }
              ids.push(child.id);
       }

       console.log("ID của các thẻ con là:", ids);

       //Ban đầu có 5 ảnh
       //Case 1: chọn thêm ảnh(done)
       //Case 2: Xóa bớt ảnh, xóa hết báo lỗi k thêm thì báo lỗi
       //Case 3: Vừa chọn thêm vừa xóa nhưng số lượng ảnh không thay đổi
       if (filesNew.length + chuoiArr.length == 0) {
              Swal.fire({
                     icon: "error",
                     title: "Thêm thất bại!",
                     text: "Chọn ảnh"
              });
              return;
       }
       //Chỉ xóa ảnh, k chọn thêm
       else if (soLuongDivCon < chuoiArr.length && filesNew.length == 0) {
              chuoiArr = ids;
              filesOld = chuoiArr.join(' ');
       }
       //Có chọn thêm ảnh
       else if (filesNew.length > 0) {
              //xóa sau khi thêm

              // if(filesNew.length + chuoiArr.length < ){}
              for (let i = 0; i < filesNew.length; i++) {

                     const file = filesNew[i];
                     const newFileName = "product-detail-" + imageCounter + ".jpg"; // Tạo tên mới cho file ảnh
                     var destinationPath = "../../view/admin/upload.php?productFolder=" + encodeURIComponent(productFolderName);
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

                     chuoiArr.push(string);
                     filesOld = chuoiArr.join(' ');
              }
              if (soLuongDivCon < chuoiArr.length) {
                     chuoiArr = ids;
                     filesOld = chuoiArr.join(' ');
              }
       }

       console.log(productCode, nameProduct, supplierCode, price, quantity, description, status, color, target, promotion, bagMaterial, descriptionMaterial, chuoiArr, filesOld);
       console.log("-----------------------------------");
       let isValid = true;
       if ((checkNumber(quantity, 'Vui lòng nhập số lượng sản phẩm lớn hơn 0') === false)) {
              isValid = false;
              return;
       }
       if ((checkNumber(price, 'Vui lòng nhập giá sản phẩm lớn hơn 0') === false)) {
              isValid = false;
              return;
       }
       if ((checkNumber(promotion, 'Vui lòng nhập giảm giá sản phẩm lớn hơn 0') === false)) {
              isValid = false;
              return;
       }
       if (productCode === '' || nameProduct === '' || supplierCode === '' || price === '' || quantity === '' ||
              description === '' || status === '' || color === '' || target === '' || promotion === ''
              || bagMaterial === '' || descriptionMaterial === '' || chuoiArr.length == 0) {
              Swal.fire({
                     icon: "error",
                     title: "Thêm thất bại!",
                     text: "Nhập đầy đủ thông tin"
              });
              isValid = false;
              return;
       }

       else if (isValid) {
              try {
                     // gọi AJAX để kiểm tra
                     const response = await fetch('../../../BLL/ProductBLL.php', {
                            method: 'POST',
                            headers: {
                                   'Content-Type': 'application/x-www-form-urlencoded'
                            },
                            body: 'function=' + encodeURIComponent('updateHandbag') + '&productCode=' + encodeURIComponent(productCode) +
                                   '&nameProduct=' + encodeURIComponent(nameProduct) + '&supplierCode=' + encodeURIComponent(supplierCode) +
                                   '&price=' + encodeURIComponent(price) + '&quantity=' + encodeURIComponent(quantity) +
                                   '&status=' + encodeURIComponent(status) + '&color=' + encodeURIComponent(color) +
                                   '&targetGender=' + encodeURIComponent(target) + '&describe=' + encodeURIComponent(description) +
                                   '&bagMaterial=' + encodeURIComponent(bagMaterial) + '&promotion=' + encodeURIComponent(promotion) +
                                   '&arrImg=' + encodeURIComponent(JSON.stringify(chuoiArr)) + '&descriptionMaterial=' + encodeURIComponent(descriptionMaterial)
                     });

                     const data = await response.json();
                     console.log(data);

                     if (data.mess === "success") {
                            Swal.fire({
                                   title: "Sửa thành công!",
                                   width: 600,
                                   padding: "3em",
                                   color: "#716add",
                                   background: "#fff url(../../image/trees.png)",
                                   backdrop: `
                           rgba(0,0,123,0.4)
                           url("../../image/nyan-cat.gif")
                           left top
                           no-repeat

                         `
                            });

                     }
                     else if (data.mess === "failed") {
                            Swal.fire({
                                   icon: "error",
                                   title: "Thêm thất bại!",
                                   text: "Trùng mã hình thức vận chuyển"
                            });
                     }
              }
              catch (error) {
                     console.error('Error:', error);
              }
       }
}

async function updateShirt(event) {
       event.preventDefault();
       var type = document.getElementById('category').value;

       // Thêm sản phẩm túi xách
       let productCode = document.querySelector('#editForm #productCode').value;
       let nameProduct = document.querySelector('#editForm #nameProduct').value.trim();
       let supplierCode = document.querySelector('#editForm #supplierCode').value.trim();
       let price = document.querySelector('#editForm #price').value.trim();
       // let quantity = document.querySelector('#editForm #quantity').value.trim();
       let description = document.querySelector('#editForm #describeProduct').value.trim();
       let status = document.querySelector('#editForm #status').value.trim();
       let color = document.querySelector('#editForm #color').value.trim();
       let target = document.querySelector('#editForm #targetGender').value.trim();
       let promotion = document.querySelector('#editForm #promotion').value.trim();
       let shirtMaterial = document.querySelector('#editForm #shirtMaterial').value.trim();
       let shirtStyle = document.querySelector('#editForm #shirtStyle').value.trim();

       let descriptionMaterial = document.querySelector('#editForm #descriptionMaterial').value.trim();
       let quantitySize = document.querySelector('#editForm #quantitySize').value.trim();

       let filesNew = document.querySelector('#editForm #inputFileC').files; //Ảnh chọn thêm
       let filesOld = document.querySelector('#editForm #imgProduct').value; //String ảnh

       let text = filesOld.trim();

       var chuoiArr = text.split(" "); // text ảnh thành mảng ảnh
       console.log(chuoiArr);


       var productFolderName = "product" + productCode; // Tạo tên thư mục mới cho album ảnh sản phẩm
       console.log(productFolderName);
       var parentDiv = document.getElementById("imagePreviewC");
       // Lấy số lượng thẻ div con
       var soLuongDivCon = parentDiv.children.length;
       console.log("Số lượng thẻ div con là:", soLuongDivCon);
       var children = parentDiv.children;
       // if(){

       // }
       let imageCounter = chuoiArr.length + 1; // Đếm biến từng ảnh
       console.log(imageCounter);
       // Mảng để lưu trữ các id của các thẻ con
       var ids = [];

       // Duyệt qua các thẻ con và lấy giá trị của thuộc tính id
       for (var i = 0; i < children.length; i++) {
              var child = children[i];
              if (child.id === '') {
                     child.id = `../image/product/${productFolderName}/product-detail-${imageCounter}.jpg`;
              }
              ids.push(child.id);
       }

       console.log("ID của các thẻ con là:", ids);
       console.log(filesNew);

       if (filesNew.length + chuoiArr.length == 0) {
              Swal.fire({
                     icon: "error",
                     title: "Thêm thất bại!",
                     text: "Chọn ảnh"
              });
              return;
       }
       //Chỉ xóa ảnh, k chọn thêm
       else if (soLuongDivCon < chuoiArr.length && filesNew.length == 0) {
              chuoiArr = ids;
              filesOld = chuoiArr.join(' ');
       }
       //Có chọn thêm ảnh
       else if (filesNew.length > 0) {
              //xóa sau khi thêm
              // if(filesNew.length + chuoiArr.length < ){}
              for (let i = 0; i < filesNew.length; i++) {

                     const file = filesNew[i];
                     const newFileName = "product-detail-" + imageCounter + ".jpg"; // Tạo tên mới cho file ảnh
                     var destinationPath = "../../view/admin/upload.php?productFolder=" + encodeURIComponent(productFolderName);
                     imageCounter++; // Tăng số thứ tự của ảnh trong sản phẩm

                     let string = `../image/product/${productFolderName}/${newFileName}`;
                     // console.log(imageCounter);
                     // console.log(string);
                     // var newID = children[imageCounter].id
                     // newID.id = string;
                     
                     // ids.push(newID);


                     const reader = new FileReader();
                     reader.onload = (function (file, newFileName) {
                            return function (event) {
                                   const fileData = event.target.result;

                                   // Thực hiện việc copy file và đổi tên vào đường dẫn đích
                                   saveFile(destinationPath, newFileName, fileData, productFolderName);
                            };
                     })(file, newFileName, productFolderName);

                     reader.readAsArrayBuffer(file);

                     chuoiArr.push(string);
                     filesOld = chuoiArr.join(' ');
              }
              if (soLuongDivCon < chuoiArr.length) {
                     chuoiArr = ids;
                     filesOld = chuoiArr.join(' ');
              }
       }
       console.log(filesOld);

       let isQuantityValid = true; // Khởi tạo biến cờ
       let sumQuantity = 0;
       let sizes = []; //Mang size
       let sizesString = '';
       document.querySelectorAll('#listSize .form-check').forEach(element => {
              let size = element.querySelector('label').id;
              let quantity = element.querySelector('.size-quantity').value;
              if (quantity === '') {
                     quantity = 0;
              }
              if (checkNumber(quantity, 'Số lượng phải lớn hơn 0') === false) {
                     isQuantityValid = false;
                     return;
              }
              else {
                     sizes.push({ size, productCode, quantity });
                     sumQuantity += parseInt(quantity);
                     sizesString = sizes.map(size => `${size.size}-${productCode}-${size.quantity}`).join('_');
              }
       });
       console.log(sizes);
       console.log(sizesString);
       // console.log(productCode, nameProduct, supplierCode, price, sumQuantity, description, status, color, target,
       //        promotion, shirtMaterial, shirtStyle, descriptionMaterial, chuoiArr, filesOld);
       console.log(sumQuantity);

       console.log("-----------------------------------------------------");

       if (productCode === '' || nameProduct === '' || supplierCode === '' || price === '' || sumQuantity <= 0 ||
              description === '' || status === '' || color === '' || target === '' || promotion === ''
              || shirtMaterial === '' || descriptionMaterial === '' || shirtStyle === '' || chuoiArr.length == 0) {
              Swal.fire({
                     icon: "error",
                     title: "Thêm thất bại!",
                     text: "Nhập đầy đủ thông tin"
              });
              return;
       }
       else if(isQuantityValid){
              try {
                     // gọi AJAX để kiểm tra
                     const response = await fetch('../../../BLL/ProductBLL.php', {
                            method: 'POST',
                            headers: {
                                   'Content-Type': 'application/x-www-form-urlencoded'
                            },
                            body: 'function=' + encodeURIComponent('updateShirt') + '&productCode=' + encodeURIComponent(productCode) +
                                   '&nameProduct=' + encodeURIComponent(nameProduct) + '&supplierCode=' + encodeURIComponent(supplierCode) +
                                   '&price=' + encodeURIComponent(price) + '&quantity=' + encodeURIComponent(sumQuantity) +
                                   '&status=' + encodeURIComponent(status) + '&color=' + encodeURIComponent(color) +
                                   '&targetGender=' + encodeURIComponent(target) + '&describe=' + encodeURIComponent(description) +
                                   '&shirtMaterial=' + encodeURIComponent(shirtMaterial) + '&promotion=' + encodeURIComponent(promotion) +
                                   '&arrImg=' + encodeURIComponent(JSON.stringify(chuoiArr)) + '&descriptionMaterial=' + encodeURIComponent(descriptionMaterial) +
                                   '&shirtStyle=' + encodeURIComponent(shirtStyle) + '&shirtSizeString=' + encodeURIComponent(sizesString)
                     });

                     const data = await response.json();
                     console.log(data);

                     if (data.mess === "success") {
                            Swal.fire({
                                   title: "Sửa thành công!",
                                   width: 600,
                                   padding: "3em",
                                   color: "#716add",
                                   background: "#fff url(../../image/trees.png)",
                                   backdrop: `
                           rgba(0,0,123,0.4)
                           url("../../image/nyan-cat.gif")
                           left top
                           no-repeat

                         `
                            });

                     }
                     else if (data.mess === "failed") {
                            Swal.fire({
                                   icon: "error",
                                   title: "Thêm thất bại!",
                                   text: "Trùng mã hình thức vận chuyển"
                            });
                     }
              }
              catch (error) {
                     console.error('Error:', error);
              }
       }
}


function removeElement(array, condition) {
       return array.filter(item => !condition(item));
}
function saveFile(destinationPath, fileName, fileData, productFolderName) {
       const url = destinationPath + '&newFileName=' + encodeURIComponent(fileName); // Chuyển tên mới của file qua truy vấn URL

       const formData = new FormData();
       formData.append('file', new Blob([fileData], { type: 'application/octet-stream' }), fileName);

       fetch(url, {
              method: 'POST',
              body: formData
       })
              .then(response => {
                     if (!response.ok) {
                            throw new Error('Network response was not ok');

                     }
                     console.log("File copied and renamed successfully.");
                     console.log("File path: ../image/product/" + productFolderName + "/" + fileName); // In ra đường dẫn của file ảnh
                     imageCounter = 1;
              })
              .catch(error => {
                     console.error('There was a problem with your fetch operation:', error);
              });
}

function checkNumber(number, str) {
       if (number < 0) {
              Swal.fire({
                     icon: "error",
                     title: "Thêm thất bại!",
                     text: str
              });
              return false;
       }
       return true;

}

window.addEventListener("load", async function () {
       // Thực hiện các hàm bạn muốn sau khi trang web đã tải hoàn toàn, bao gồm tất cả các tài nguyên như hình ảnh, stylesheet, v.v.
       // await getDataSize();
       await getData();
       // await loadSize();
       // await getSupplierList();
       // showInputCheckbox();
       console.log("Trang sửa sản phẩm đã load hoàn toàn");
       showAddImageC();
       showAddImageB();
});
