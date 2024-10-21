// Kiểm tra dữu liệu trước khi truyền vào
function validatePayment(namePayment, codePayments, affiliatedBank) {
       // Kiểm tra xem có bất kỳ trường nào để trống không
       if (!namePayment || !codePayments || !affiliatedBank) {
              Swal.fire({
                     icon: "error",
                     title: "Lỗi",
                     text: "Vui lòng điền đầy đủ thông tin",
                     footer: '<a href="#">Need help?</a>',
              });
              return false;
       }

       // Kiểm tra các điều kiện khác nếu cần

       // Nếu tất cả điều kiện đều được đáp ứng, trả về true
       return true;
}

//Thêm đối tượng
async function add_PaymentsObj(event) {
       event.preventDefault();
       let namePayment = document.getElementById("namePaymentInput").value.trim();
       let codePayments = document.getElementById("codePaymentsInput").value.trim();
       let affiliatedBank = document
              .getElementById("affiliatedBankInput")
              .value.trim();
       // Validate dữ liệu trước khi thêm
       if (!validatePayment(namePayment, codePayments, affiliatedBank)) {
              return; // Dừng việc thực hiện thêm nếu dữ liệu không hợp lệ
       }
       try {
              // Gọi AJAX để xóa payment

              let response = await fetch("../../../BLL/PaymentBLL.php", {
                     method: "POST",
                     headers: {
                            "Content-Type": "application/x-www-form-urlencoded",
                     },
                     body:
                            "function=" +
                            encodeURIComponent("addPaymentByObj") +
                            "&namePayment=" +
                            encodeURIComponent(namePayment) +
                            "&codePayments=" +
                            encodeURIComponent(codePayments) +
                            "&affiliatedBank=" +
                            encodeURIComponent(affiliatedBank),
              });

              let data = await response.json();
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
              } else {
                     Swal.fire({
                            icon: "error",
                            title: "Thêm không thành công",
                            text: "Bị trùng dữ liệu",
                            footer: '<a href="#"></a>',
                     });
              }
       } catch (error) {
              console.error(error);
       }
}
