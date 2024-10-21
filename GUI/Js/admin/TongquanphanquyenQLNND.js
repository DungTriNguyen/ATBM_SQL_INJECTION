// ------------------------------------------- AJAX kiểm tra đăng nhập -----------------------------------------------
async function getDataPermission_tongquanphanquyen(justData) {
  // Tạo một đối tượng URLSearchParams từ đường dẫn URL hiện tại
  let urlParams = new URLSearchParams(window.location.search);

  // Lấy giá trị của tham số 'code' từ URL hiện tại
  let codePermission = urlParams.get("codePermission");

  if (codePermission != "" && codePermission != null) {
    try {
      const response = await fetch("../../../BLL/ManagerUserGroupBLL.php", {
        method: "POST",
        headers: {
          "Content-Type": "application/x-www-form-urlencoded",
        },
        body:
          "function=" +
          encodeURIComponent("getArrPermissionDetail") +
          "&codePermission=" +
          encodeURIComponent(codePermission),
      });
      const data = await response.json();
      // console.log(data);

      if (data != null) {
        // console.log(data);
        // checkUpPermission_payment(data.permissionDetail,codePermission,"");
        if (justData == true) {
          return data;
        } else {
          showData(codePermission, data.permissionDetail, data.function);
        }
      } else {
        window.location.href = "../../../GUI/view/admin/tongquanQLNND.php";
      }
    } catch (error) {
      console.error("Error:", error);
      window.location.href = "../../../GUI/view/admin/tongquanQLNND.php";
    }
  } else {
    window.location.href = "../../../GUI/view/admin/tongquanQLNND.php";
  }
}

function showData(codePermission, dataPermissionDetail, dataFunction) {
  let container = document.getElementById("content-data-table");
  let functionObj = {};
  for (let item of dataFunction) {
    functionObj[item.functionCode] = item.functionName;
  }
  // console.log(functionObj);

  let result = "";
  for (let item of dataPermissionDetail) {
    let string = "";
    let functionName = functionObj[item.functionCode];
    let seePermission = item.seePermission;
    let addPermission = item.addPermission;
    let deletePermission = item.deletePermission;
    let fixPermission = item.fixPermission;

    let stringNameFunction = `<td>${functionName}</td>`;

    let stringSeePermission = "";
    let stringAddPermission = "";
    let stringdeletePermission = "";
    let stringfixPermission = "";
    // xem
    if (seePermission == "1") {
      stringSeePermission = `
                     <td><input type="checkbox" name="" value="" id = "${codePermission}-${item.functionCode}-seePermission" checked></td>`;
    } else if (seePermission != "1") {
      stringSeePermission = `
                     <td><input type="checkbox" name="" value="" id = "${codePermission}-${item.functionCode}-seePermission"></td>`;
    }

    // them
    if (addPermission == "1") {
      stringAddPermission = `
                     <td><input type="checkbox" name="" value="" id = "${codePermission}-${item.functionCode}-addPermission" checked></td>`;
    } else if (addPermission != "1") {
      stringAddPermission = `
                     <td><input type="checkbox" name="" value="" id = "${codePermission}-${item.functionCode}-addPermission"></td>`;
    }

    // xoa
    if (deletePermission == "1") {
      stringdeletePermission = `
                     <td><input type="checkbox" name="" value="" id = "${codePermission}-${item.functionCode}-deletePermission" checked></td>`;
    } else if (deletePermission != "1") {
      stringdeletePermission = `
                     <td><input type="checkbox" name="" value="" id = "${codePermission}-${item.functionCode}-deletePermission"></td>`;
    }

    // update
    if (fixPermission == "1") {
      stringfixPermission = `
                     <td><input type="checkbox" name="" value="" id = "${codePermission}-${item.functionCode}-fixPermission" checked></td>`;
    } else if (fixPermission != "1") {
      stringfixPermission = `
                     <td><input type="checkbox" name="" value="" id = "${codePermission}-${item.functionCode}-fixPermission"></td>`;
    }

    // string
    string = `
                     <tr>
                            ${stringNameFunction}
                            ${stringSeePermission}
                            ${stringAddPermission}
                            ${stringdeletePermission}
                            ${stringfixPermission}
                     </tr>
              `;
    result += string;
  }
  container.innerHTML = result;
}
//

async function PhanQuyen() {
  let data = await getDataPermission_tongquanphanquyen(true);

  let codePermission = data.codePermission;
  let dataFunction = data.function;

  let arrObjPermissionDetail = [];
  for (let item of dataFunction) {
    // functionCodeArr.push(item.functionCode);

    // lấy các giá trị check box
    let seePermission_value = "0";
    let addPermission_value = "0";
    let deletePermission_value = "0";
    let fixPermission_value = "0";

    let checkBox_seePermission = document.getElementById(
      `${codePermission}-${item.functionCode}-seePermission`
    );
    let checkBox_addPermission = document.getElementById(
      `${codePermission}-${item.functionCode}-addPermission`
    );
    let checkBox_deletePermission = document.getElementById(
      `${codePermission}-${item.functionCode}-deletePermission`
    );
    let checkBox_fixPermission = document.getElementById(
      `${codePermission}-${item.functionCode}-fixPermission`
    );

    if (checkBox_seePermission.checked) {
      seePermission_value = "1";
    }

    if (checkBox_addPermission.checked) {
      addPermission_value = "1";
    }

    if (checkBox_deletePermission.checked) {
      deletePermission_value = "1";
    }

    if (checkBox_fixPermission.checked) {
      fixPermission_value = "1";
    }

    let obj = {
      codePermission: codePermission,
      functionCode: item.functionCode,
      seePermission: seePermission_value,
      addPermission: addPermission_value,
      deletePermission: deletePermission_value,
      fixPermission: fixPermission_value,
    };

    arrObjPermissionDetail.push(obj);
  }

  // console.log(arrObjPermissionDetail);

  try {
    const response = await fetch("../../../BLL/ManagerUserGroupBLL.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/x-www-form-urlencoded",
      },
      body:
        "function=" +
        encodeURIComponent("updatePermissionDetail") +
        "&arr=" +
        encodeURIComponent(JSON.stringify(arrObjPermissionDetail)),
    });
    const data = await response.json();
    // console.log(data);

    if (data.mess == "success") {
      Swal.fire({
        title: "Phân quyền thành công!",
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
        title: "Phân quyền không thành công",
        text: "Bị trùng dữ liệu",
      });
    }
  } catch (error) {
    console.error("Error:", error);
  }
}

window.addEventListener("load", async function () {
  // Thực hiện các hàm bạn muốn sau khi trang web đã tải hoàn toàn, bao gồm tất cả các tài nguyên như hình ảnh,

  getDataPermission_tongquanphanquyen(false);
});
