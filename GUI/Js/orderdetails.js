async function getInfor_1() {
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

                        // showInfor(result.userName, result.passWord, result.name, result.email, result.address, result.phoneNumber, result.dateCreate, result.sex);
                        // await getArrOrder(result.userName);
                        return result.userName;
                } else {
                        window.location.href = "../../GUI/view/Login.php";
                }
        } catch (error) {
                console.error('Error:', error);
        }
}

async function getArrOrderDetail_1() {
        try {
                // Tạo một đối tượng URLSearchParams từ đường dẫn URL hiện tại
                let urlParams = new URLSearchParams(window.location.search);

                // Lấy giá trị của tham số 'code' từ URL hiện tại
                let codeOrderValue = urlParams.get('orderCode');
                let status = urlParams.get('status');
                if (codeOrderValue != null && codeOrderValue != '' && (status == 'processing' || status == 'completed' || status == 'rejected')) {
                        const response = await fetch('../../BLL/OrderBLL.php', {
                                method: 'POST',
                                headers: {
                                        'Content-Type': 'application/x-www-form-urlencoded'
                                },
                                body: 'function=' + encodeURIComponent('getArrOrderDetail_by_orderCode') + '&orderCode=' + encodeURIComponent(codeOrderValue)
                        });
                        const data = await response.json();
                        if (data.length > 0) {
                                for (let i of data) {
                                        console.log(data);
                                        // await getProductDetail(i.productCode);

                                }
                                await showDataTable(data, codeOrderValue, status);

                        } else {
                                await Swal.fire({
                                        icon: "error",
                                        title: "Oops...",
                                        text: "SoMe ThInG WrOnG !!",
                                });
                                window.location.href = "../../GUI/view/UserProfile.php";
                        }
                } else {
                        window.location.href = "../../GUI/view/UserProfile.php";
                }

        } catch (error) {
                console.error('Error:', error);
        }
}

async function getProductDetail_1(productCode) {
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
                        console.log(data);
                        let obj = data[0];
                        return obj;
                        // return data;
                } else {
                        return null
                }


        } catch (error) {
                console.error('Error:', error);
        }
}

async function showDataTable(data, orderCode, status) {
        let count = 0;
        let username = await getInfor_1();
        let container = document.getElementById('content-data-orderDetail');
        let container2 = document.querySelector('.box-review');
        let container3 = document.querySelector('.head-order');
        container3.innerHTML = `
                <p>#${orderCode}</p>
                <p>${status}</p>
        `;
        let result = '';
        let result2 = '';
        for (let item of data) {
                count += 1;
                let productCode = item.productCode;
                let quantity = item.quantity;
                let totalMoney = item.totalMoney;
                let price = item.priceProduct;
                // lấy chi tiết sản phẩm
                let obj = await getProductDetail_1(productCode);

                if (obj != null) {
                        let nameProduct = obj.nameProduct;
                        let stringImg = obj.imgProduct
                        let arrImg = stringImg.split(' ');
                        let firstImg = arrImg[0];

                        let string = `
                                <tr>
                                        <td>${count}</td>
                                        <td>${nameProduct}</td>
                                        <td><img src="${firstImg}" alt=""></td>
                                        <td>${price}$</td>
                                        <td>${quantity}</td>
                                        <td>${totalMoney}$</td>
                                        <td><a href="#!">Review</a></td>
                                </tr>
                        `;
                        result += string;

                        let string2 = `
                                <div id="container-${orderCode}-${productCode}">
                                        <h2>Review</h2>
                                        <div class="box-product-review">
                                                <div class="product-img-name">
                                                        <p>${nameProduct}</p>
                                                        <img src="${firstImg}" alt="">
                                                </div>
                                                <div class="input-review">
                                                        <textarea id="${orderCode}-${productCode}" rows="10" cols="60" placeholder="Write something....."></textarea>
                                                        <div><a href="#!" onclick = "sendComment(event,'${productCode}','${username}','${orderCode}-${productCode}')">Send</a></div>
                                                </div>
                                        </div>
                                </div>
                        `;
                        result2 += string2;
                }
        }
        container.innerHTML = result;
        container2.innerHTML = result2;
}

async function sendComment(event,productCode, username, idTextArea) {
        event.preventDefault();
        try {
                let content = document.getElementById(idTextArea).value;

                if (content != '') {
                        const response = await fetch('../../BLL/CommentBLL.php', {
                                method: 'POST',
                                headers: {
                                        'Content-Type': 'application/x-www-form-urlencoded'
                                },
                                body: 'function=' + encodeURIComponent('addObj') + '&producCode=' + encodeURIComponent(productCode) + '&username=' + encodeURIComponent(username) + '&usernameRep=' + encodeURIComponent("null") + '&content=' + encodeURIComponent(content) + '&state=' + encodeURIComponent("1") + '&dislikeNumber=' + encodeURIComponent(0) + '&likeNumber=' + encodeURIComponent(0)
                        });
                        const data = await response.json();
                        if (data.mess == "success") {
                                await Swal.fire({
                                        position: "center",
                                        icon: "success",
                                        title: "Thank you for your review of the product",
                                        showConfirmButton: false,
                                        timer: 2000
                                });
                                document.getElementById("container-" + idTextArea).style.display = 'none';
                        } else {
                                await Swal.fire({
                                        position: "center",
                                        icon: "error",
                                        title: "Submit review failed",
                                });
                        }
                } else {
                        await Swal.fire({
                                position: "center",
                                icon: "info",
                                title: "You must fill out a product review",
                        });
                }
        } catch (error) {
                console.error(error)
        }


}







function action() {
        const buttonReview = document.querySelectorAll('tbody tr td a ');
        const boxReviewItem = document.querySelectorAll(".box-review > div");
        // Lặp qua mỗi buttonReview
        buttonReview.forEach((button, index) => {
                boxReviewItem.forEach(box => {
                        box.style.display = "none";
                });
                // Thêm sự kiện "click"
                button.addEventListener("click", (event) => {
                        event.preventDefault();
                        // Ẩn tất cả các boxReviewItem
                        boxReviewItem.forEach(box => {
                                box.style.display = "none";
                        });

                        // Hiển thị boxReviewItem tương ứng với buttonReview được click
                        boxReviewItem[index].style.display = "block";
                });
        });
}

window.addEventListener('load', async function () {
        // Thực hiện các hàm bạn muốn sau khi trang web đã tải hoàn toàn, bao gồm tất cả các tài nguyên như hình ảnh, stylesheet, v.v.
        console.log('Trang chi tiết hóa đơn đã load hoàn toàn');
        // await getInfor();
        await getArrOrderDetail_1();
        action();

});



