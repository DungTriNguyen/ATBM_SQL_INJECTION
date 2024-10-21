async function checkMail_and_sendCode(event) {
    event.preventDefault();

    let username = document.getElementById('username').value;
    let mail = document.getElementById('email').value;

    if (username != '' && isValidGmail(mail)) {

        Swal.fire({
            position: "center",
            icon: "info",
            title: "Processing !!",
            showConfirmButton: false,
            timer: 4000
        });

        const response = await fetch('../../BLL/AccountBLL.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: 'function=' + encodeURIComponent('resetPass') + '&userName=' + encodeURIComponent(username) + '&email=' + encodeURIComponent(mail)
        });

        const data = await response.json();
        console.log(data);

        // kiem tra cac truong hop
        if (data.mess == "wrongMail") {
            await Swal.fire({
                position: "center",
                icon: "error",
                title: "You need to enter the correct email in your registered account !!",
                
            });
            return false;
        }
        else if (data.mess == "notFound") {
            await Swal.fire({
                position: "center",
                icon: "warning",
                title: "Account not found !!",
                
            });
            return false;
        } else {

            document.getElementById('emailForm').style.display = 'none';
            document.getElementById('codeForm').style.display = 'flex';
            document.getElementById('codeForm').classList.remove('hidden');

            document.getElementById('btn1').innerHTML = `
                <a id="accuracy" onclick="XacThuc(event,'${data.username}','${data.codeReset}')" href="#!" style="text-decoration:none; color:black;">ACCURACY</a>
            `;


            // await XacThuc(data.username, data.codeReset);
            return true;
        }
    } else {
        await Swal.fire({
            position: "center",
            icon: "error",
            title: "Must enter correct format !!",
            
        });
    }
}

// xac thuc
async function XacThuc(event,username, code) {

    

        event.preventDefault();

        // Lấy ra tất cả các phần tử input
        var inputs = document.querySelectorAll('.input');

        // Khởi tạo một biến để lưu giá trị
        var number = '';

        // Lặp qua từng phần tử input và ghép giá trị của chúng vào biến number
        inputs.forEach(function (input) {
            number += input.value;
        });

        // Chuyển đổi biến number thành một số nguyên
        var result = parseInt(number);

        

        if (result == code) {
            window.location.href = `../../GUI/view/resetPassword.php?username=${username}`;
        } else {
            Swal.fire({
                position: "center",
                icon: "error",
                title: "The confirmation code is invalid !!",
                showConfirmButton: false,
                timer: 2000
            });
            // alert('wrong code');
        }
    
}


// check format email
function isValidGmail(email) {
    // Biểu thức chính quy để kiểm tra định dạng
    const gmailRegex = /^[a-zA-Z0-9._%+-]+@gmail.com$/;

    // Sử dụng test() để kiểm tra email với biểu thức chính quy
    return gmailRegex.test(email);
}

function action() {
    // document.getElementById('btnSendEmail').addEventListener('click', function (event) {
    //     event.preventDefault();
    //     document.getElementById('emailForm').style.display = 'none';
    //     document.getElementById('codeForm').style.display = 'flex';
    //     document.getElementById('codeForm').classList.remove('hidden');
    // });

    const inputs = document.querySelectorAll('#inputNumber input');

    // Lặp qua từng input để thêm sự kiện input
    inputs.forEach((input, index) => {
        input.addEventListener('input', function () {
            if (this.value.length === 1) { // Nếu đã nhập đủ 1 ký tự
                if (index < inputs.length - 1) { // Nếu input không phải là input cuối cùng
                    inputs[index + 1].focus(); // Chuyển focus sang input tiếp theo
                } else { // Nếu input là input cuối cùng
                    // Thực hiện hành động mà bạn muốn khi đã nhập đủ tất cả các input
                    // Ví dụ: Submit form hoặc kiểm tra mã OTP
                }
            }
        });
    });
}




window.addEventListener('load', async function () {
    action();
});