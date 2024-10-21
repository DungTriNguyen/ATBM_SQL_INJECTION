//Ràng buộc dữ liệu nhập vào
function validateUserGroup(codePermission, namePermission) {
  // Kiểm tra xem có bất kỳ trường nào để trống không
  if (!codePermission || !namePermission) {
    Swal.fire({
      icon: "error",
      title: "Lỗi",
      text: "Vui lòng điền đầy đủ thông tin",
    });
    return false;
  }

  // Nếu tất cả điều kiện đều được đáp ứng, trả về true
  return true;
}

// lấy code function
async function getDataFunction() {
  try {
    const response = await fetch("../../../BLL/ManagerUserGroupBLL.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/x-www-form-urlencoded",
      },
      body: "function=" + encodeURIComponent("getArrFunction"),
    });
    const data = await response.json();
    console.log(data);

    if (data != null) {
      return data;
    }
  } catch (error) {
    console.error("Error:", error);
  }
}
// getDataFunction();

// Thêm chi tiết phân quyền
async function addPermissionDetail(codePermission) {
  let arrDataFunction = await getDataFunction();
  let arrObjPermissionDetail = [];
  for (let item of arrDataFunction) {
    let obj = {
      codePermission: codePermission,
      functionCode: item.functionCode,
      seePermission: "0",
      addPermission: "0",
      deletePermission: "0",
      fixPermission: "0",
    };

    arrObjPermissionDetail.push(obj);
  }

  try {
    const response = await fetch("../../../BLL/ManagerUserGroupBLL.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/x-www-form-urlencoded",
      },
      body:
        "function=" +
        encodeURIComponent("addArrPermisstionDetail") +
        "&arr=" +
        encodeURIComponent(JSON.stringify(arrObjPermissionDetail)),
    });
    const data = await response.json();
    console.log(data);

    return data.mess;
  } catch (error) {
    console.error("Error:", error);
  }
}

//Thêm đối tượng
async function addObj(event) {
  event.preventDefault();
  try {
    let codePermission = document.getElementById("codePermission").value.trim();
    let namePermission = document.getElementById("namePermission").value.trim();
    // Validate dữ liệu trước khi thêm
    if (!validateUserGroup(codePermission, namePermission)) {
      return; // Dừng việc thực hiện thêm nếu dữ liệu không hợp lệ
    }

    let response = await fetch("../../../BLL/ManagerUserGroupBLL.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/x-www-form-urlencoded",
      },
      body:
        "function=" +
        encodeURIComponent("addObj") +
        "&codePermission=" +
        encodeURIComponent(codePermission) +
        "&namePermission=" +
        encodeURIComponent(namePermission),
    });

    let data = await response.json();
    console.log(data);
    let messPermissionDetail = await addPermissionDetail(codePermission);
    if (data.mess == "success" && messPermissionDetail == "success") {
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
