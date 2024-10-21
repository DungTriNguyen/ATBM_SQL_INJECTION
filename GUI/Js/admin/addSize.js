async function addSize(event) {
       event.preventDefault();
       try {



              let str1 = document.getElementById('sizeCode').value.trim();
              let str2 = document.getElementById('nameSize').value.trim();
              if (str1 === '' || str2 === '') {

                     await Swal.fire({
                            position: "center",
                            icon: "error",
                            title: "Thêm Thất Bại",
                            showConfirmButton: false,
                            timer: 1500
                     });
              }
              else {

                     // gọi AJAX để kiểm tra

                     let response = await fetch('../../../BLL/SizeBLL.php', {
                            method: 'POST',
                            headers: {
                                   'Content-Type': 'application/x-www-form-urlencoded'
                            },
                            body: 'function=' + encodeURIComponent('addSize') + '&nameSize=' + encodeURIComponent(str2) + '&sizeCode=' + encodeURIComponent(str1)
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
                                  
                                `
                            });
                     }
                     else if (data.mess === "error") {
                            Swal.fire({
                                   icon: "error",
                                   title: "Thêm thất bại!",
                                   text: "Trùng mã kích thước !"
                            });
                     }
              }


       } catch (error) {
              console.error(error);
       }
}
