async function setUserName() {
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
              console.log(data);
              let result = data[0];
              if (result.result == 'success') {
                     let container = document.getElementById('name');
                     container.value = result.userName;
                     return result.userName;
              } else {
                     Swal.fire({
                            icon: "info",
                            title: "Oops...",
                            text: "You need to log in to send us feedback. !",
                     });
              }
       } catch (error) {
              console.error('Error:', error);
       }
}
setUserName();

function isValidGmail(email) {
       // Biểu thức chính quy để kiểm tra định dạng
       const gmailRegex = /^[a-zA-Z0-9._%+-]+@gmail.com$/;

       // Sử dụng test() để kiểm tra email với biểu thức chính quy
       return gmailRegex.test(email);
}

async function sendFeedback(event) {
       event.preventDefault();
       try {
              let userName = await setUserName();
              let email = document.getElementById('email').value;
              let content = document.getElementById('message').value;
              if (isValidGmail(email) == true && content != '') {
                     const response = await fetch('../../BLL/FeedbackBLL.php', {
                            method: 'POST',
                            headers: {
                                   'Content-Type': 'application/x-www-form-urlencoded'
                            },
                            body:
                                   'function=' + encodeURIComponent('addFeedbackUser') + '&username=' + encodeURIComponent(userName) + '&email=' + encodeURIComponent(email) + '&content=' + encodeURIComponent(content)
                     });
                     const data = await response.json();
                     console.log(data);
                     // console.log(userName,email,content);
                     if(data.mess == 'success'){
                            await Swal.fire({
                                   position: "center",
                                   icon: "success",
                                   title: "Send Success",
                                   showConfirmButton: false,
                                   timer: 2000
                            });
                     }
              } else {
                     Swal.fire({
                            icon: "info",
                            title: "Oops...",
                            text: "You need to fill in the correct gmail format and do not leave the sent content blank !",
                     });
              }

       } catch (error) {
              console.error('Error:', error);
       }
}