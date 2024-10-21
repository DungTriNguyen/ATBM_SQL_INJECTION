//Ràng buộc các thông tin nhập vào
function validateSupplier(
  codeSupplier,
  nameSupplier,
  address,
  email,
  brandSupplier,
  phoneNumber
) {
  // Kiểm tra xem có bất kỳ trường nào để trống không
  if (
    !codeSupplier ||
    !nameSupplier ||
    !address ||
    !email ||
    !brandSupplier ||
    !phoneNumber
  ) {
    Swal.fire({
      icon: "error",
      title: "Lỗi",
      text: "Vui lòng điền đầy đủ thông tin",
      footer: '<a href="#"></a>',
    });
    return false;
  }

  // Kiểm tra định dạng email
  let emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$-=_/;
  if (!emailRegex.test(email)) {
    Swal.fire({
      icon: "error",
      title: "Lỗi",
      text: "Email không hợp lệ",
      footer: '<a href="#"></a>',
    });
    return false;
  }

  // Kiểm tra số điện thoại
  let phoneRegex = /^0\d{10,11}$/;
  if (!phoneRegex.test(phoneNumber)) {
    Swal.fire({
      icon: "error",
      title: "Lỗi",
      text: "Số điện thoại phải có 10 chữ số và bắt đầu bằng số 0",
      footer: '<a href="#"></a>',
    });
    return false;
  }

  // Nếu tất cả điều kiện đều được đáp ứng, trả về true
  return true;
}

//Thêm đối tượng
async function addObj(event) {
  event.preventDefault();
  try {
    let codeSupplier = document.getElementById("supplierCode").value.trim();
    let nameSupplier = document.getElementById("nameSupplier").value.trim();
    let address = document.getElementById("address").value.trim();
    let email = document.getElementById("email").value.trim();
    let brandSupplier = document.getElementById("brandSupplier").value.trim();
    let phoneNumber = document.getElementById("phoneNumber").value.trim();

    // Validate dữ liệu trước khi thêm
    if (
      !validateSupplier(
        codeSupplier,
        nameSupplier,
        address,
        email,
        brandSupplier,
        phoneNumber
      )
    ) {
      return; // Dừng việc thực hiện thêm nếu dữ liệu không hợp lệ
    }
    let response = await fetch("../../../BLL/SupplierBLL.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/x-www-form-urlencoded",
      },
      body:
        "function=" +
        encodeURIComponent("addObj") +
        "&codeSupplier=" +
        encodeURIComponent(codeSupplier) +
        "&nameSupplier=" +
        encodeURIComponent(nameSupplier) +
        "&address=" +
        encodeURIComponent(address) +
        "&email=" +
        encodeURIComponent(email) +
        "&brandSupplier=" +
        encodeURIComponent(brandSupplier) +
        "&phoneNumber=" +
        encodeURIComponent(phoneNumber),
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
      });
    }
  } catch (error) {
    console.error(error);
  }
}
