// Thêm transport
async function addTransports(event){
    event.preventDefault();
    let codeTransport = document.getElementById('codeTransport').value.trim();
    let nameTransport = document.getElementById('nameTransport').value.trim();
    let affiliatedCompany = document.getElementById('affiliatedCompany').value.trim();
    if (codeTransport === '' || nameTransport === '' || affiliatedCompany === ''){
      Swal.fire({
        icon: "error",
        title: "Thêm thất bại!",
        text: "Nhập đầy đủ thông tin"
      });
    }
    else {
      try {
        // gọi AJAX để kiểm tra
        const response = await fetch('../../../BLL/TransportBLL.php', {
               method: 'POST',
               headers: {
                      'Content-Type': 'application/x-www-form-urlencoded'
               },
               body: 'function=' + encodeURIComponent('addObj')+'&codeTransport=' + encodeURIComponent(codeTransport)+
               '&nameTransport=' + encodeURIComponent(nameTransport)+ '&affiliatedCompany=' + encodeURIComponent(affiliatedCompany)
        });
        
        const data = await response.json();
        console.log(data);

        if(data.mess === "success"){
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
        else if(data.mess === "failed"){
          Swal.fire({
            icon: "error",
            title: "Thêm thất bại!",
            text: "Trùng mã hình thức vận chuyển"
          });
        }
    
        // Display Transport
        } catch (error) {
                console.error('Error:', error);
        }
    }
    
}

function checkData(string){

}