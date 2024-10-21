//----------------------- AJAX thong ke
async function ThongKe_shirt_and_handbag(dateStart, dateEnd) {
       try {
              // gọi AJAX để kiểm tra
              const response = await fetch('../../../BLL/StatisticalBLL.php', {
                     method: 'POST',
                     headers: {
                            'Content-Type': 'application/x-www-form-urlencoded'
                     },
                     body: 'function=' + encodeURIComponent('ThongKe_shirt_and_handbag') + '&dateStart=' + encodeURIComponent(dateStart) + '&dateEnd=' + encodeURIComponent(dateEnd)
              });

              const data = await response.json();
              console.log(data);
              return data;

       } catch (error) {
              console.error('Error:', error);
       }
}
async function ThongKe_handbag(dateStart, dateEnd) {
       try {
              // gọi AJAX để kiểm tra
              const response = await fetch('../../../BLL/StatisticalBLL.php', {
                     method: 'POST',
                     headers: {
                            'Content-Type': 'application/x-www-form-urlencoded'
                     },
                     body: 'function=' + encodeURIComponent('ThongKe_handbag') + '&dateStart=' + encodeURIComponent(dateStart) + '&dateEnd=' + encodeURIComponent(dateEnd)
              });

              const data = await response.json();
              console.log(data);
              return data;

       } catch (error) {
              console.error('Error:', error);
       }
}

async function ThongKe_shirt(dateStart, dateEnd) {
       try {
              // gọi AJAX để kiểm tra
              const response = await fetch('../../../BLL/StatisticalBLL.php', {
                     method: 'POST',
                     headers: {
                            'Content-Type': 'application/x-www-form-urlencoded'
                     },
                     body: 'function=' + encodeURIComponent('ThongKe_shirt') + '&dateStart=' + encodeURIComponent(dateStart) + '&dateEnd=' + encodeURIComponent(dateEnd)
              });

              const data = await response.json();
              console.log(data);
              return data;

       } catch (error) {
              console.error('Error:', error);
       }
}
// ThongKe_shirt()
async function ThongKe() {
       let type = document.getElementById('type-product').value;
       let dateStart = document.getElementById('toDate').value;
       let dateEnd = document.getElementById('endDate').value;

       if (dateStart == '') {
              dateStart = '2000-01-01';
       }
       if (dateEnd == '') {
              let currentDate = new Date();
              // Lấy ngày, tháng và năm hiện tại
              var ngay = currentDate.getDate();
              var thang = currentDate.getMonth() + 1; // Tháng bắt đầu từ 0, cần cộng thêm 1
              var nam = currentDate.getFullYear();

              // Định dạng lại ngày tháng năm thành chuỗi "dd/mm/yyyy"
              dateEnd = nam + "-" + thang + "-" + ngay;
       }
       console.log(type, dateStart, dateEnd);

       // thống kê cả 2 loại
       if (type == 0) {
              // let data = await ThongKe_shirt_and_handbag(dateStart,dateEnd);
              let data1 = await ThongKe_shirt(dateStart, dateEnd);
              let data2 = await ThongKe_handbag(dateStart, dateEnd);
              showThongKeChart(data1, data2);
              if (data1.length > 0 && data2.length > 0) {
                     let data = data1.concat(data2);
                     showDataTable(data);
                     loadPage();
              }else{
                     showDataTable([]);
                     loadPage();
              }
       }
       // thống kê áo
       else if (type == 1) {
              let data = await ThongKe_shirt(dateStart, dateEnd);
              showThongKeChart(data, null);
              showDataTable(data);
              loadPage();
       }
       // thống kê túi
       else if (type == 2) {
              let data = await ThongKe_handbag(dateStart, dateEnd);
              showThongKeChart(null, data);
              showDataTable(data);
              loadPage();
       }


}

function showThongKeChart(dataShirt, dataHandbag) {
       let percentHandbag = 0;
       let percentShirt = 0;
       let sumBuy_handbag = 0;
       let sumBuy_shirt = 0;

       if (dataShirt != null) {
              for (let item of dataShirt) {
                     sumBuy_shirt += Number(item.quantityBuy);
              }
       }
       if (dataHandbag != null) {
              for (let item of dataHandbag) {
                     sumBuy_handbag += Number(item.quantityBuy);
              }
       }
       // console.log(sumBuy_handbag, sumBuy_shirt);

       let tongProduct = sumBuy_handbag + sumBuy_shirt;
       if (tongProduct == 0) {
              showChart(0, 0);
       } else {
              percentHandbag = ((sumBuy_handbag / tongProduct) * 100).toFixed(2);
              percentShirt = ((sumBuy_shirt / tongProduct) * 100).toFixed(2);

              console.log(percentHandbag, percentShirt);

              showChart(percentHandbag, percentShirt);
       }
}

function showDataTable(data) {
       let container = document.getElementById('data-table');
       container.innerHTML = `
       <div class="spinner-border text-primary" role="status">
              <span class="visually-hidden">Loading...</span>
       </div>
       `;
       let doanh_thu_da_ban = document.getElementById('revenue');
       doanh_thu_da_ban.innerHTML = 0;
       let numberProductBuy = document.getElementById('number-buy');
       numberProductBuy.innerHTML = 0;
       if (data.length > 0) {
              let count = 0;
              let Revenue = 0;
              let totalBuy = 0;
              let result = '';
              for (let item of data) {
                     count++;
                     let nameProduct = item.nameProduct;
                     let stringImg = item.imgProduct;
                     let arrImg = stringImg.split(' ');
                     let firstImg = '../' + arrImg[0];
                     let price = item.price;
                     let type = item.type;
                     let quantityBuy = item.quantityBuy;
                     totalBuy += Number(quantityBuy);
                     let quantityStore = item.quantityStore;
                     let sumMoney = Math.ceil(Number(quantityBuy) * Number(price));
                     Revenue += sumMoney;
                     let string = `
                            <tr>
                                   <td>${count}</td>
                                   <td>${nameProduct}</td>
                                   <td><img src="${firstImg}" alt=""></td>
                                   <td>${price}</td>
                                   <td>${type}</td>
                                   <td>${quantityBuy}</td>
                                   <td>${quantityStore}</td>
                                   <td>${sumMoney}</td>
                            </tr>
                     `;
                     result += string;
              }
              container.innerHTML = result;
              doanh_thu_da_ban.innerHTML = Revenue + ' $';

              numberProductBuy.innerHTML = totalBuy;


              loadItem(1,5);
       }else{
              Swal.fire({
                     position: "center",
                     icon: "error",
                     title: "Không có dữ liệu thông kê trong khoảng thời gian này !!",
              });
       }

}


function showChart(percentHandbag, percentShirt) {
       var chart = new CanvasJS.Chart("chartContainer", {
              exportEnabled: true,
              animationEnabled: true,
              title: {
                     text: "Theo danh mục sản phẩm: 295"
              },
              legend: {
                     cursor: "pointer",
                     itemclick: explodePie
              },
              data: [{
                     type: "pie",
                     showInLegend: true,
                     toolTipContent: "{name}: <strong>{y}</strong>",
                     indexLabel: "{name} - {y}",
                     dataPoints: [
                            { y: percentShirt, name: "Áo", exploded: true },
                            { y: percentHandbag, name: "Túi sách" }
                     ]
              }]
       });
       chart.render();
}

function explodePie(e) {
       if (typeof (e.dataSeries.dataPoints[e.dataPointIndex].exploded) === "undefined" || !e.dataSeries.dataPoints[e.dataPointIndex].exploded) {
              e.dataSeries.dataPoints[e.dataPointIndex].exploded = true;
       } else {
              e.dataSeries.dataPoints[e.dataPointIndex].exploded = false;
       }
       e.chart.render();
}

const click = document.querySelectorAll(".list-button p");

function clearClickButton() {
       click.forEach((current, i) => {
              if (current.classList.contains("click-button")) {
                     current.classList.remove("click-button");
              }
       });
}

click.forEach((current, i) => {
       current.addEventListener("click", () => {
              clearClickButton();
              current.classList.add("click-button");
       });
});

function loadItem(thisPage, limit) {

       // tính vị trí bắt đầu và kêt thúc
       let beginGet = limit * (thisPage - 1);
       let endGet = limit * thisPage - 1;

       // lấy tất cả các dòng dữ liệu có trong bảng
       let all_data_rows = document.querySelectorAll('#data-table > tr');

       all_data_rows.forEach((item, index) => {
              if (index >= beginGet && index <= endGet) {
                     item.style.display = 'table-row';
              }
              else {
                     item.style.display = 'none';
              }
       });

       // hàm tính có bao nhieu nút chuyển trang
       listPage(thisPage, limit, all_data_rows);
       // loadPage();
}

function listPage(thisPage, limit, all_data_rows) {
       let result = '';
       let count = Math.ceil(all_data_rows.length / limit);
       // thêm nút prev
       
       if (thisPage != 1) {

              let string = `<li class="page-item" onclick="loadItem(${Number(thisPage) - 1},${limit})"><a class="page-link">Previous</a></li>`;
              result += string;
       } else if(thisPage == 1){
              let string = `<li class="page-item disabled" style="cursor: default;"><a class="page-link">Previous</a></li>`;
              result += string;
       }
       
       // tính xem có bao nhieu nút

       // lấy container chứa nút phân trang
       let container = document.getElementById('Pagination');

       for (let i = 1; i <= count; i++) {
              let string = `<li class="page-item" onclick="loadItem(${i},${limit})"><a class="page-link">${i}</a></li>`;
              if (i == thisPage) {
                     string = `<li class="page-item active" onclick="loadItem(${i},${limit})"><a class="page-link">${i}</a></li>`;
              }
              result += string;
       }

       // thêm nút next
       
       if (thisPage != count) {
              let string1 = `<li class="page-item" onclick="loadItem(${Number(thisPage) + 1},${limit})"><a class="page-link">Next</a></li>`;
              result += string1; 
       }
       else if(thisPage == count){
              let string1 = `<li class="page-item disabled" style="cursor: default;"><a class="page-link">Next</a></li>`;
              result += string1;
       }

       container.innerHTML = result;
}

function loadPage() {
       // Lấy danh sách tất cả các thẻ <li> trong <ul> có id là "Panigation"
       var listItems = document.querySelectorAll('#Pagination li');

       // Duyệt qua từng phần tử trong danh sách
       listItems.forEach(function (item) {
              // Kiểm tra xem phần tử hiện tại có class là "active" hay không
              if (item.classList.contains('active')) {
                     // Nếu có, lấy nội dung trong thẻ <a> bên trong và chuyển thành số
                     var activePageText = item.querySelector('a').textContent.trim();
                     var activePageNumber = parseInt(activePageText);
                     console.log("Trang đang active: " + activePageNumber);
                     loadItem(activePageNumber, 5);
              }
       });

}


window.addEventListener('load', async function () {
       console.log('Trang Tổng quan đã load hoàn toàn');
       await ThongKe();
       loadItem(1,5)
});

