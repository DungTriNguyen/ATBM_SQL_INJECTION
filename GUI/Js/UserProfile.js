// ----------------------------- AJAX load du lieu len
async function getInfor() {
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
        let result = data[0];
        console.log(result);

        if (result.result == 'success') {

            showInfor(result.userName, result.passWord, result.name, result.email, result.address, result.phoneNumber, result.dateCreate, result.birth, result.sex);

            save_change_password(result.userName, result.passWord, result.name, result.email, result.address, result.phoneNumber, result.dateCreate, result.birth, result.sex);
            

        } else {
            window.location.href = "../../GUI/view/Login.php";
        }
    } catch (error) {
        console.error('Error:', error);
    }
}


function showInfor(username, password, name, email, address, phone, dateCreate, dateBirth, sex) {
    console.log(username);
    // username
    let userNameElement = document.getElementById('user-name');
    if (userNameElement !== null) {
        userNameElement.innerHTML = `Hi, ${username}`;
    }

    let usernameInput = document.getElementById('username');
    if (usernameInput !== null) {
        usernameInput.value = `${username}`;
    }

    // name
    let nameInput = document.getElementById('name');
    if (nameInput !== null) {
        nameInput.value = `${name}`;
    }

    // email
    let emailInput = document.getElementById('email');
    if (emailInput !== null) {
        emailInput.value = `${email}`;
    }

    // address
    let addressInput = document.getElementById('address');
    if (addressInput !== null) {
        addressInput.value = `${address}`;
    }

    // phone
    let phoneInput = document.getElementById('phonenumber');
    if (phoneInput !== null) {
        phoneInput.value = `${phone}`;
    }

    // date birth
    let dateBirthInput = document.getElementById('datebirth');
    if (dateBirthInput !== null) {
        dateBirthInput.value = `${dateBirth}`;
    }

    // date create
    let dateCreateInput = document.getElementById('datecreate');
    if (dateCreateInput !== null) {
        console.log(dateCreate);
        dateCreateInput.value = `${dateCreate}`;
    }

    // sex
    let sexSelectElement = document.getElementById('sex-select');
    if (sexSelectElement !== null) {
        if (sex == "Female") {
            sexSelectElement.innerHTML = `
                        <div class="male-sex">
                            <input type="radio" value="Male" id="male" name="sex">
                            <label for="male">Male</label>
                        </div>
                        <div class="female-sex">
                            <input type="radio" id="female" value="Female" name="sex" checked>
                            <label for="female">Female</label>
                        </div>
            `;
        } else {
            sexSelectElement.innerHTML = `
                    <div class="male-sex">
                        <input type="radio" id="male" value="Male" name="sex" checked>
                        <label for="male">Male</label>
                    </div>
                    <div class="female-sex">
                        <input type="radio" id="female" value="Female" name="sex" >
                        <label for="female">Female</label>
                    </div>
            `;
        }
    }

    showPassWord(password);
    showOrder_view(username);
}

// khi mà click xuống phần đổi mật khẩu mới load
function showPassWord(passWord) {
    document.getElementById('change-password').onclick = function () {
        let currentPasswordInput = document.getElementById('currentpassword');
        if (currentPasswordInput !== null) {
            currentPasswordInput.value = passWord;
            console.log(passWord);
        }
    }
}

// khi mà click xuống order mới load
function showOrder_view(username) {
    document.getElementById('show-orders').onclick = async function () {
        let container = document.getElementById('content-order');
        container.innerHTML = `
                        <div class="spinner-border text-primary" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
        `;
        await Search_order(username);
        // await getArrOrder(username);
    }
}

// // hàm thoát đăng nhập khi tắt web
// window.addEventListener('unload', async function (event) {
//     try {
//         const response = await fetch('../../BLL/AccountBLL.php', {
//             method: 'POST',
//             headers: {
//                 'Content-Type': 'application/x-www-form-urlencoded'
//             },
//             body: 'function=' + encodeURIComponent('logout_whenExitPage')
//         });
//         const data = await response.json();
//         console.log(data);
//     } catch (error) {
//         console.error('Error:', error);
//     }
// });

// lấy password cũ
async function getPassWord() {
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
        let result = data[0];
        // console.log(result);

        if (result.result == 'success') {
            return result.passWord;
        } else {
            window.location.href = "../../GUI/view/Login.php";
        }
    } catch (error) {
        console.error('Error:', error);
    }
}

// lấy password cũ
async function getCodePermission() {
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
        let result = data[0];
        // console.log(result);

        if (result.result == 'success') {
            return result.codePermission;
        } else {
            window.location.href = "../../GUI/view/Login.php";
        }
    } catch (error) {
        console.error('Error:', error);
    }
}

// hàm save thông tin khi thay đổi
async function save_change_infor(event) {
    event.preventDefault();

    try {

        let userName = document.getElementById('username').value;
        let passWord = await getPassWord();
        let name = document.getElementById('name').value;
        let email = document.getElementById('email').value;
        let address = document.getElementById('address').value;
        let phoneNumber = document.getElementById('phonenumber').value;
        let datebirth = document.getElementById('datebirth').value;
        let dateCreate = document.getElementById('datecreate').value;

        // quyen
        let codePermission = await getCodePermission();

        // lấy lựa chọn giới tính
        // Lấy tất cả các radio button trong nhóm 'sex'
        let radios = document.querySelectorAll('input[name="sex"]');

        // Duyệt qua từng radio button và kiểm tra xem nó có được chọn không
        let sex = '';
        radios.forEach(radio => {
            if (radio.checked) {
                // Nếu radio button được chọn, lấy giá trị của label tương ứng
                sex = radio.value;
            }
        });

        if (name != '' && address != '' && isValidGmail(email) == true && isValidPhoneNumber(phoneNumber) == true) {
            console.log(userName, passWord, email, address, phoneNumber, dateCreate, sex);

            const response = await fetch('../../BLL/AccountBLL.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body:
                    'function=' + encodeURIComponent('updateAccount') + '&userName=' + encodeURIComponent(userName) + '&passWord=' + encodeURIComponent(passWord) + '&dateCreate=' + encodeURIComponent(dateCreate) + '&accountStatus=' + encodeURIComponent('1') + '&name=' + encodeURIComponent(name) + '&address=' + encodeURIComponent(address) + '&email=' + encodeURIComponent(email) + '&phoneNumber=' + encodeURIComponent(phoneNumber) + '&birth=' + encodeURIComponent(datebirth) + '&sex=' + encodeURIComponent(sex) + '&codePermission=' + encodeURIComponent(codePermission)
            });
            const data = await response.json();

            // thiết lập thông tin mới cho bên thay đổi mật khẩu.
            save_change_password(userName, passWord, name, email, address, phoneNumber, dateCreate, datebirth, sex);
            // console.log(result);

            if (data.mess == 'success') {
                await Swal.fire({
                    position: "center",
                    icon: "success",
                    title: "Successful change! You need to log back in so the information displayed can be updated.",
                });
                // gọi đăng xuất
                try {
                    const response = await fetch('../../BLL/AccountBLL.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded'
                        },
                        body: 'function=' + encodeURIComponent('logout_whenExitPage')
                    });
                    const data = await response.json();

                    if (data.length == 0) {
                        window.location.href = "../../GUI/view/login.php";
                    }

                } catch (error) {
                    console.error('Error:', error);
                }

            } else {
                await Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: "Update failed!",
                });
            }
        } else {
            await Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "Need to enter the correct required format!",
            });
        }



    } catch (error) {
        console.error('Error:', error);
    }
}

//hàm save mật khẩu thay đổi
function save_change_password(username, password, name, email, address, phone, dateCreate, dateBirth, sex) {
    document.getElementById('save-password-change').onclick = async function (event) {
        event.preventDefault();
        let newpassword = document.getElementById('newpassword').value;
        let confirmpassword = document.getElementById('confirmpassword').value;

        // quyen
        let codePermission = await getCodePermission();

        if (isVaidPassword(newpassword) == true && isVaidPassword(confirmpassword) == true) {
            if (newpassword === confirmpassword) {

                const response = await fetch('../../BLL/AccountBLL.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    },
                    body:
                        'function=' + encodeURIComponent('updateAccount') + '&userName=' + encodeURIComponent(username) + '&passWord=' + encodeURIComponent(newpassword) + '&dateCreate=' + encodeURIComponent(dateCreate) + '&accountStatus=' + encodeURIComponent('1') + '&name=' + encodeURIComponent(name) + '&address=' + encodeURIComponent(address) + '&email=' + encodeURIComponent(email) + '&phoneNumber=' + encodeURIComponent(phone) + '&birth=' + encodeURIComponent(dateBirth) + '&sex=' + encodeURIComponent(sex) + '&codePermission=' + encodeURIComponent(codePermission)
                });
                const data = await response.json();
                if (data.mess == 'success') {
                    await Swal.fire({
                        position: "center",
                        icon: "success",
                        title: "Successful change! You need to log back in so the information displayed can be updated.",
                    });
                    // gọi đăng xuất
                    try {
                        const response = await fetch('../../BLL/AccountBLL.php', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/x-www-form-urlencoded'
                            },
                            body: 'function=' + encodeURIComponent('logout_whenExitPage')
                        });
                        const data = await response.json();

                        if (data.length == 0) {
                            window.location.href = "../../GUI/view/login.php";
                        }

                    } catch (error) {
                        console.error('Error:', error);
                    }

                } else {
                    await Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "Update failed!",
                    });
                }


            } else {
                await Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: "Confirmation password does not match !",
                });
            }
        } else {
            await Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "Need to enter the correct required format!",
            });
        }
    }
}

// kiểm tra mật khẩu
function isVaidPassword(passWord) {
    var passwordRegex = /^[a-zA-Z\d@_-]{6,20}$/;
    return passwordRegex.test(passWord);
}

// check format email
function isValidGmail(email) {
    // Biểu thức chính quy để kiểm tra định dạng
    const gmailRegex = /^[a-zA-Z0-9._%+-]+@gmail.com$/;

    // Sử dụng test() để kiểm tra email với biểu thức chính quy
    return gmailRegex.test(email);
}
// check phonenumber
function isValidPhoneNumber(phoneNumber) {
    // Sử dụng biểu thức chính quy để kiểm tra số điện thoại
    const isVNPhoneMobile =
        /^(0|\+84)(\s|\.)?((3[2-9])|(5[689])|(7[06-9])|(8[1-689])|(9[0-46-9]))(\d)(\s|\.)?(\d{3})(\s|\.)?(\d{3})$/;

    // Kiểm tra xem số điện thoại phù hợp với biểu thức chính quy không
    return isVNPhoneMobile.test(phoneNumber);
}


// get hóa đơn của người dùng đó
async function getArrOrder(username) {
    try {
        const response = await fetch('../../BLL/OrderBLL.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: 'function=' + encodeURIComponent('getArrOrder_by_Username') + '&username=' + encodeURIComponent(username)
        });
        const data = await response.json();
        if (data.length > 0) {

            for (let item of data) {
                // console.log(data);
                // await getArrOrderDetail(i.orderCode, data);
            }
            await getArrOrderDetail(data);
            // return data;
        } else {
            return null;
        }


    } catch (error) {
        console.error('Error:', error);
    }
}

// tìm kiến hóa đơn của người dùng
async function Search_order(username) {

    let keyword = document.getElementById('search-order').value;

    if (keyword != '') {
        try {
            const response = await fetch('../../BLL/OrderBLL.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: 'function=' + encodeURIComponent('SearchOrder_by_key') + '&username=' + encodeURIComponent(username) + '&keyword=' + encodeURIComponent(keyword)
            });
            const data = await response.json();
            console.log(data);
            let container = document.getElementById('content-order');
            container.innerHTML = `
                        <div class="spinner-border text-primary" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    `;
            if (data.length > 0) {
                await getArrOrderDetail(data);
                // return data;
            } else {
                container.innerHTML = `
                        <h1>NOT FOUND</h1>
                    `;
                return null;
            }


        } catch (error) {
            console.error('Error:', error);
        }
    } else {
        let container = document.getElementById('content-order');
        container.innerHTML = `
                        <div class="spinner-border text-primary" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    `;
        await getArrOrder(username);
    }

    document.getElementById('search-order').oninput = async function () {
        // lấy giá trị của keyword
        let keyword = document.getElementById('search-order').value;

        if (keyword != '') {
            try {
                const response = await fetch('../../BLL/OrderBLL.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    },
                    body: 'function=' + encodeURIComponent('SearchOrder_by_key') + '&username=' + encodeURIComponent(username) + '&keyword=' + encodeURIComponent(keyword)
                });
                const data = await response.json();
                console.log(data);
                let container = document.getElementById('content-order');
                container.innerHTML = `
                        <div class="spinner-border text-primary" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    `;
                if (data.length > 0) {
                    await getArrOrderDetail(data);
                    // return data;
                } else {
                    await getArrOrder(username);
                    return null;
                }


            } catch (error) {
                console.error('Error:', error);
            }
        } else {
            let container = document.getElementById('content-order');
            container.innerHTML = `
                        <div class="spinner-border text-primary" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    `;
            await getArrOrder(username);
        }
    }

}

async function getArrOrderDetail(dataOrders) {
    let dataOrderDetails = [];
    for (let i of dataOrders) {
        try {
            const response = await fetch('../../BLL/OrderBLL.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: 'function=' + encodeURIComponent('getArrOrderDetail_by_orderCode') + '&orderCode=' + encodeURIComponent(i.orderCode)
            });
            const data = await response.json();
            if (data.length > 0) {
                for (let item of data) {
                    // console.log(data);
                    // await getProductDetail(i.productCode, dataOrders, data);
                    dataOrderDetails.push(item);
                }

                // return data;
            } else {
                return null;
            }
        } catch (error) {
            console.error('Error:', error);
        }
    }
    await getProductDetail(dataOrders, dataOrderDetails);

}
async function getProductDetail(dataOrders, dataOrderDetails) {
    let dataProducts = [];
    for (let i of dataOrderDetails) {
        let productCode = i.productCode;
        try {
            const response = await fetch('../../BLL/ProductBLL.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: 'function=' + encodeURIComponent('getArrObjProduct_by_ArrCodeProduct') + '&code=' + encodeURIComponent(productCode)
            });
            const data = await response.json();

            if (data != null) {
                // console.log(data);
                // showOrder(dataOrders, dataOrderDetails, data);
                for (let item of data) {
                    dataProducts.push(item);
                }
                // return data;
            } else {
                return null
            }


        } catch (error) {
            console.error('Error:', error);
        }
    }
    showOrder(dataOrders, dataOrderDetails, dataProducts);

}

function showOrder(dataOrders, dataOrderDetails, dataProducts) {

    console.log(dataOrders, dataOrderDetails, dataProducts);
    let container = document.getElementById('content-order');
    let result = '';
    for (let i = dataOrders.length - 1; i >=0 ; i--) {
        let order = dataOrders[i];
        let orderCode = order.orderCode;
        let status = order.status;
        let totalMoney = order.totalMoney;
        let dateCreate = order.dateCreated;
        let dataFinish = order.dateFinish;
        let first_orderDetail_productCode = '';
        let first_orderDetail_quantity = '';
        for (let orderDetail of dataOrderDetails) {
            if (orderDetail.orderCode == orderCode) {
                first_orderDetail_productCode = orderDetail.productCode;
                first_orderDetail_quantity = orderDetail.quantity;
                break;
            }
        }
        let nameProduct = '';
        let img = '';
        let price = '';
        let promotion = '';
        for (let product of dataProducts) {
            if (product.productCode == first_orderDetail_productCode) {
                nameProduct = product.nameProduct;
                let stringImg = product.imgProduct;
                let arrImg = stringImg.split(' ');
                img = arrImg[0];
                price = product.price;
                promotion = product.promotion;
                break;
            }
        }
        if (promotion > 0) {
            let string = `
                    <div class="item-order">
                    <div class="order-start">
                        <div class="head-order">
                                <p>#${orderCode}</p>
                                <p>${status}</p>
                        </div>
                        <hr>
                        <div class="box-order">
                                <img src="${img}" alt="">
                                <div class="product-name-and-quantity">
                                        <p>${nameProduct}</p>
                                        <span>X${first_orderDetail_quantity}</span>
                                </div>
                                <div class="price-product">
                                        <span>${price}$</span>
                                        <span>${(price - price * promotion / 100).toFixed(2)}$</span>
                                </div>
                        </div>
                    </div>

                    <div class="order-end">
                        <div class="detail">
                                <p>Total: <span>${totalMoney}$</span></p>
                                <div>
                                        <p>Order date: <span>${dateCreate}</span>
                                        </p>
                                        <p><a href="./OrderDetail.php?orderCode=${orderCode}&status=${status}">Detail</a></p>
                                </div>
                        </div>
                    </div>
                </div>
                `;
            result += string;
        } else {
            let string = `
                    <div class="item-order">
                    <div class="order-start">
                        <div class="head-order">
                                <p>#${orderCode}</p>
                                <p>${status}</p>
                        </div>
                        <hr>
                        <div class="box-order">
                                <img src="${img}" alt="">
                                <div class="product-name-and-quantity">
                                        <p>${nameProduct}</p>
                                        <span>X${first_orderDetail_quantity}</span>
                                </div>
                                <div class="price-product">
                                        <span></span>
                                        <span>${price}$</span>
                                </div>
                        </div>
                    </div>

                    <div class="order-end">
                        <div class="detail">
                                <p>Total: <span>${totalMoney}$</span></p>
                                <div>
                                        <p>Order date: <span>${dateCreate}</span>
                                        </p>
                                        <p><a href="./OrderDetail.php?orderCode=${orderCode}&status=${status}">Detail</a></p>
                                </div>
                        </div>
                    </div>
                </div>
                `;
            result += string;
        }

    }
    container.innerHTML = result;
}













function action() {

    const list_menu = document.querySelectorAll('.user-menu-main li');

    const rightContent = document.querySelectorAll('.content-right');
    function hideContentRight() {
        rightContent.forEach((current, i) => {
            current.classList.add('display_none');
        })
    }
    function activeMenu() {
        list_menu.forEach((current, i) => {
            if (current.classList.contains('menu-active')) {
                current.classList.remove('menu-active');
            }
        })
    }

    list_menu.forEach((current, i) => {
        current.addEventListener('click', () => {
            activeMenu();
            hideContentRight();
            if (i == 0) {
                list_menu[i].classList.add('menu-active');
                rightContent[i].classList.remove('display_none');
            }
            else if (i == 1) {
                list_menu[i].classList.add('menu-active');
                rightContent[i].classList.remove('display_none');
            }
            else if (i == 2) {
                list_menu[i].classList.add('menu-active');
                rightContent[i].classList.remove('display_none');
            }
        })
    })

}



window.addEventListener('load', async function () {
    // Thực hiện các hàm bạn muốn sau khi trang web đã tải hoàn toàn, bao gồm tất cả các tài nguyên như hình ảnh, stylesheet, v.v.
    console.log('Trang User Profile đã load hoàn toàn');
    await getInfor();
    action();
});

