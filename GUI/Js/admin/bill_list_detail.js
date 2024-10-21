// ----------------------- AJAX
async function getDataOrder() {

       // Tạo một đối tượng URLSearchParams từ đường dẫn URL hiện tại
       let urlParams = new URLSearchParams(window.location.search);

       // Lấy giá trị của tham số 'code' từ URL hiện tại
       let orderCode = urlParams.get('orderCode');

       if (orderCode != null && orderCode != '') {
              console.log(orderCode);
              try {
                     // gọi AJAX để kiểm tra
                     const response = await fetch('../../../BLL/OrderBLL.php', {
                            method: 'POST',
                            headers: {
                                   'Content-Type': 'application/x-www-form-urlencoded'
                            },
                            body: 'function=' + encodeURIComponent('getObjOrder') + '&orderCode=' + encodeURIComponent(orderCode)
                     });

                     const data = await response.json();
                     console.log(data);
                     await getDataOrderDetail(orderCode,data);

              } catch (error) {
                     console.error('Error:', error);
              }
       } else {
              window.location.href = "../../../GUI/view/admin/bill_list.php";
       }
}

async function getDataOrderDetail(orderCode,dataOrder){
       try {
              // gọi AJAX để kiểm tra
              const response = await fetch('../../../BLL/OrderBLL.php', {
                     method: 'POST',
                     headers: {
                            'Content-Type': 'application/x-www-form-urlencoded'
                     },
                     body: 'function=' + encodeURIComponent('getArrOrderDetail_by_orderCode') + '&orderCode=' + encodeURIComponent(orderCode)
              });

              const data = await response.json();
              console.log(data);
              showData(dataOrder,data);

       } catch (error) {
              console.error('Error:', error);
       }
}

function showData(dataOrder,dataOrderDetail){
       let container_order = document.getElementById('data-order');
       let container_orderDetail = document.getElementById('data-orderdetail-table');
       container_orderDetail.innerHTML = `
              <div class="spinner-border text-primary" role="status">
                     <span class="visually-hidden">Loading...</span>
              </div>
       `;
       if(dataOrder != null && dataOrderDetail.length > 0){
              // thong tin nguoi dat hang
              let string_1 = `
                     <div><span>Mã hóa đơn: </span>${dataOrder.orderCode}</div>
                     <div><span>Họ tên: </span>${dataOrder.userName}</div>
                     <div><span>Địa chỉ giao hàng: </span>${dataOrder.deliveryAddress}</div>
                     <div><span>Ghi chú: </span>${dataOrder.note}</div>
                     <div><span>Trạng thái: </span>${dataOrder.status}</div>
                     <div><span>Tổng tiền: </span>${dataOrder.totalMoney}</div>
                     <div><span>Ngày đặt: </span>${dataOrder.dateCreated}</div>
                     <div><span>Mã hình thức thanh toán: </span>${dataOrder.codePayments}</div>
                     <div><span>Mã hình thức vận chuyển: </span>${dataOrder.codeTransport}</div>
              `;
              container_order.innerHTML = string_1;
              let result = '';
              for( let item of dataOrderDetail){
                     let productCode = item.productCode;
                     let nameProduct = item.nameProduct;
                     let sizeCode = item.sizeCode;
                     let price = item.priceProduct;
                     let quantity = item.quantity;
                     let totalMoney = item.totalMoney;

                     let string_2 = `
                            <tr>
                                   <td>${productCode}</td>
                                   <td>${nameProduct}</td>
                                   <td>${sizeCode}</td>
                                   <td>${price}</td>
                                   <td>${quantity}</td>
                                   <td>${totalMoney}</td>
                            </tr>
                     `;
                     result += string_2;
              }
              container_orderDetail.innerHTML = result;
       }
}




window.addEventListener('load', async function () {
       console.log('Trang list order đã load hoàn toàn');
       await getDataOrder();
});