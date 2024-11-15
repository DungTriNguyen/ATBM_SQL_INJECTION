<?php
// import
// require('../DAL/AbstractionDAL.php');
// require('../DTO/AccountDTO.php');

class AccountDAL extends AbstractionDAL
{
       private $actionSQL = null;
       public function __construct()
       {
              parent::__construct();
              $this->actionSQL = parent::getConn();

              // if ($this->actionSQL != null) {
              //        echo 'thanh cong';
              // }
       }
       // xóa một đối tượng bởi mã đối tượng 
       function deleteByID($code)
       {
              // mã hóa
              $userName_encode = base64_encode($code);

              // do bảng FeedBack, Comment, Orders, EnterBallot có liên kết khóa ngoại đến thuộc tính userName của bảng Accounts. Nên khi xóa bảng phải kiểm tra dữ liệu của các khóa ngoại trước. Nếu thỏa các bảng kia không có tham chiếu đến dữ liệu đang được xóa thì mới cho phép xóa. Còn không sẽ báo lỗi.

              // kiểm tra dữ liệu các bảng có khóa ngoại tham chiếu
              $check_data_Feedback = "SELECT * FROM feedback WHERE userName = '$userName_encode'";
              $check_data_Comment = "SELECT * FROM comment WHERE userNameComment = '$userName_encode'";
              $check_data_Orders = "SELECT * FROM orders WHERE userName = '$userName_encode'";
              // $check_data_EnterBallot = "SELECT * FROM enterballot WHERE userName = '$code'";

              $resutl_1 = $this->actionSQL->query($check_data_Feedback);
              $resutl_2 = $this->actionSQL->query($check_data_Comment);
              $resutl_3 = $this->actionSQL->query($check_data_Orders);
              // $resutl_4 = $this->actionSQL->query($check_data_EnterBallot);

              // nếu tất cả các câu lệnh truy suất cho ra số dòng truy suất đều = 0 --> thỏa
              if ($resutl_1->num_rows < 1 && $resutl_2->num_rows < 1 && $resutl_3->num_rows < 1) {

                     $string = "DELETE FROM accounts WHERE userName = '$userName_encode' ";
                     // thuc hien truy suat

                     return $this->actionSQL->query($string) === true;
              } else {
                     return false;
              }
       }

       // xóa một đối tượng bằng cách truyền đối tượng vào
       function delete($obj)
       {
              if ($obj != null) {
                     $code = $obj->getUsername();
                     // do bảng FeedBack, Comment, Orders, EnterBallot có liên kết khóa ngoại đến thuộc tính userName của bảng Accounts. Nên khi xóa bảng phải kiểm tra dữ liệu của các khóa ngoại trước. Nếu thỏa các bảng kia không có tham chiếu đến dữ liệu đang được xóa thì mới cho phép xóa. Còn không sẽ báo lỗi.

                     // kiểm tra dữ liệu các bảng có khóa ngoại tham chiếu
                     $check_data_Feedback = "SELECT * FROM feedback WHERE userName = '$code'";
                     $check_data_Comment = "SELECT * FROM comment WHERE userNameComment = '$code'";
                     $check_data_Orders = "SELECT * FROM orders WHERE userName = '$code'";


                     $resutl_1 = $this->actionSQL->query($check_data_Feedback);
                     $resutl_2 = $this->actionSQL->query($check_data_Comment);
                     $resutl_3 = $this->actionSQL->query($check_data_Orders);


                     // nếu tất cả các câu lệnh truy suất cho ra số dòng truy suất đều = 0 --> thỏa
                     if ($resutl_1->num_rows < 1 && $resutl_2->num_rows < 1 && $resutl_3->num_rows < 1) {

                            $string = "DELETE FROM accounts WHERE userName = '$code' ";
                            // thuc hien truy suat
                            return $this->actionSQL->query($string);
                     } else {
                            return false;
                     }
              } else {
                     return false;
              }
       }

       // lấy ra mảng các đối tượng
       function getListobj()
       {
              //array return
              $array_list = array();
              // cau lenh truy suat
              $string = 'SELECT * FROM accounts ';

              // thuc hien truy suat
              $result = $this->actionSQL->query($string);


              // Kiểm tra số hàng được trả về
              if ($result->num_rows > 0) {
                     // Lấy dữ liệu và đưa vào mảng
                     while ($data = $result->fetch_assoc()) {
                            $userName = $data["userName"];
                            $passWord = $data["passWord"];
                            $dateCreated = $data["dateCreated"];
                            $accountStatus = $data["accountStatus"];
                            $name = $data["name"];
                            $address = $data["address"];
                            $email = $data["email"];
                            $phoneNumber = $data["phoneNumber"];
                            $birth = $data["birth"];
                            $sex = $data["sex"];
                            $codePermission = $data["codePermissions"];

                            // giải mã hóa username và password
                            $userNameValue = base64_decode($userName);
                            $passWordValue = base64_decode($passWord);

                            $account = new AccountDTO($userNameValue, $passWordValue, $dateCreated, $accountStatus, $name, $address, $email, $phoneNumber, $birth, $sex, $codePermission);
                            array_push($array_list, $account);
                     }
                     return $array_list;
              } else {
                     // Trường hợp không có dữ liệu trả về
                     // echo "Không có dữ liệu được trả về từ truy vấn.";
                     return null;
              }
       }

       // lấy ra một đối tượng dựa theo mã đối tượng
       function getobj($code)
       {
              // mã hóa rồi mới truy suất
              $userName_encode = base64_encode($code);

              // cau lenh truy vấn
              $string = "SELECT * FROM accounts WHERE userName = '$userName_encode'";
              // thuc hien truy suat
              $result = $this->actionSQL->query($string);

              if ($result->num_rows > 0) {
                     $data = $result->fetch_assoc();
                     $userName = $data["userName"];
                     $passWord = $data["passWord"];
                     $dateCreated = $data["dateCreated"];
                     $accountStatus = $data["accountStatus"];
                     $name = $data["name"];
                     $address = $data["address"];
                     $email = $data["email"];
                     $phoneNumber = $data["phoneNumber"];
                     $birth = $data["birth"];
                     $sex = $data["sex"];
                     $codePermission = $data["codePermissions"];

                     // giải mã hóa username và password
                     $userNameValue = base64_decode($userName);
                     $passWordValue = base64_decode($passWord);

                     $account = new AccountDTO($userNameValue, $passWordValue, $dateCreated, $accountStatus, $name, $address, $email, $phoneNumber, $birth, $sex, $codePermission);

                     return $account;
              } else {
                     // Trường hợp không có dữ liệu trả về
                     // echo "Không có dữ liệu được trả về từ truy vấn.";
                     return null;
              }
       }





       // thêm một đối tượng 
       function addobj($obj)
       {
              if ($obj != null) {
                     $userName = $obj->getUsername();

                     // mã hóa rồi mới truy suất
                     $userName_encode = base64_encode($userName);


                     // kiểm tra xem có bị trùng thuọc tính khóa không
                     $check = "SELECT * FROM accounts WHERE userName = '$userName_encode'";



                     "SELECT * FROM website_sells_clothes_and_bags.accounts WHERE userName = '' 
                     OR (SELECT COUNT(*) FROM website_sells_clothes_and_bags.accounts) > 0; -- ' AND passWord = 'anything'";

                     $resultCheck = $this->actionSQL->query($check);

                     if ($resultCheck->num_rows < 1) {
                            $passWord = $obj->getPassword();
                            $dateCreate = $obj->getDateCreate();
                            $accountStatus = $obj->getAccountStatus();
                            $name = $obj->getName();
                            $address = $obj->getAddress();
                            $email = $obj->getEmail();
                            $phoneNumber = $obj->getPhoneNumber();
                            $birth = $obj->getBirth();
                            $sex = $obj->getSex();
                            $codePermission = $obj->getCodePermission();

                            // mã hóa password
                            $passWord_encode = base64_encode($passWord);

                            // cau lenh truy vấn
                            // INSERT IGNORE: nếu gặp trùng lắp khóa chính thì nó sẽ không thêm dữ liệu vào 
                            $string = "INSERT INTO accounts (userName, passWord, dateCreated, accountStatus, name, address, email, phoneNumber, birth, sex, codePermissions) VALUES ('$userName_encode', '$passWord_encode', '$dateCreate', '$accountStatus', '$name', '$address', '$email', '$phoneNumber', '$birth', '$sex', '$codePermission')";

                            return $this->actionSQL->query($string);
                     } else {
                            return false;
                     }
              } else {
                     return false;
              }
       }

       // sửa một đối tượng
       function upadateobj($obj)
       {
              if ($obj != null) {
                     $userName = $obj->getUsername();
                     $passWord = $obj->getPassword();
                     $dateCreate = $obj->getDateCreate();
                     $accountStatus = $obj->getAccountStatus();
                     $name = $obj->getName();
                     $address = $obj->getAddress();
                     $email = $obj->getEmail();
                     $phoneNumber = $obj->getPhoneNumber();
                     $birth = $obj->getBirth();
                     $sex = $obj->getSex();
                     $codePermission = $obj->getCodePermission();

                     // mã hóa username và password
                     $userName_encode = base64_encode($userName);
                     $passWord_encode = base64_encode($passWord);

                     // Câu lệnh UPDATE
                     $string = "UPDATE accounts 
                                SET passWord = '$passWord_encode', 
                                    dateCreated = '$dateCreate', 
                                    accountStatus = '$accountStatus', 
                                    name = '$name', 
                                    address = '$address', 
                                    email = '$email', 
                                    phoneNumber = '$phoneNumber', 
                                    birth = '$birth', 
                                    sex = '$sex', 
                                    codePermissions = '$codePermission' 
                                WHERE userName = '$userName_encode'";

                     return $this->actionSQL->query($string);
              } else {
                     return false;
              }
       }

       function updateStateUser($userName, $accountStatus)
       {
              $userName_encode = base64_encode($userName);
              // Câu lệnh UPDATE
              if ($accountStatus == '1') {
                     $string = "UPDATE accounts 
                                SET 
                                accountStatus = '0'
                                WHERE userName = '$userName_encode'";
              } else {
                     $string = "UPDATE accounts 
                                SET 
                                accountStatus = '1'
                                WHERE userName = '$userName_encode'";
              }

              return $this->actionSQL->query($string);
       }





       // SQL INJECTION thành công
       public function checkLogin_always_true($userName, $passWord)
       {

              // SELECT * FROM accounts WHERE userName = '' OR '1'='1' -- ' AND passWord = 'MTIzNDU=';
              // Mã hóa username trước khi truy vấn
              // $userName_encode = base64_encode($userName);
              // $passWord_encode = base64_encode($passWord);

              // ' OR '1'='1' --

              $sql = "SELECT * FROM accounts WHERE userName = '$userName' AND passWord = '$passWord'";
              // $sql = "SELECT * FROM accounts WHERE userName = '' OR '1'='1' -- ' AND  passWord = '123'";
              // In truy vấn ra để xem chuỗi SQL khi tấn công
              // echo "Executing SQL query: " . $sql . "<br>";
              // Thực thi truy vấn
              $result = $this->conn->query($sql);
              // Kiểm tra nếu có bản ghi nào được trả về
              //result trả về kết quả truy vấn
              if ($result->num_rows > 0) {
                     // Lấy dữ liệu từ kết quả
                     $data = $result->fetch_assoc();

                     // Tạo đối tượng AccountDTO và gán giá trị
                     // $data['userName'] = base64_decode($data['userName']);
                     // $data['passWord'] = base64_decode($data['passWord']);
                     $userName = $data['userName']; // Gán username từ kết quả
                     $passWord = $data['passWord']; // Gán password từ kết quả (nếu cần)
                     $account = new AccountDTO($userName, $passWord, null, null, null, null, null, null, null, null, null);
                     // Trả về đối tượng AccountDTO
                     return $account;
              } else {
                     // Không tìm thấy người dùng
                     return null;
              }
       }

       // Gọi thủ tục đã tạo trên Xampp để lấy thông tin tài khoản dựa trên username
       public function checkLogin_Procedure($userName, $passWord)
       {
              // Mã hóa username và password trước khi truy vấn
              // $userName_encode = base64_encode($userName);
              // $passWord_encode = base64_encode($passWord);

              // Tạo câu lệnh SQL gọi đến stored procedure
              // $sql = "CALL use_procedure_sql_injection('$userName', '$passWord')";


              $sql = "CALL attack_sql_logically_incorrect('$userName', '$passWord')";
              // $sql = "CALL secure_attack_sql('$userName', '$passWord')";

              // In truy vấn ra để xem chuỗi SQL khi tấn công
              // echo "Executing SQL query: " . $sql . "<br>";

              // Thực thi truy vấn
              $result = $this->conn->query($sql);
              // $result = mysqli_query($this->conn, $sql);
              // Kiểm tra nếu có bản ghi nào được trả về
              if ($result->num_rows > 0) {

                     // Lấy dữ liệu từ kết quả
                     // var_dump($result->fetch_assoc());
                     $data = $result->fetch_assoc();
                     // var_dump($data);
                     // Giải mã username và password
                     // $data['userName'] = base64_decode($data['userName']);
                     // $data['passWord'] = base64_decode($data['passWord']);
                     // $userName = isset($data['userName']) ? $data['userName'] : null;
                     // $passWord = isset($data['passWord']) ? $data['passWord'] : null;
                     $userName = $data['userName']; // Gán username từ kết quả
                     $passWord = $data['passWord']; // Gán password từ kết quả (nếu cần)
                     // Tạo đối tượng AccountDTO và gán giá trị
                     $account = new AccountDTO(
                            $userName,
                            $passWord,
                            null,
                            null,
                            null,
                            null,
                            null,
                            null,
                            null,
                            null,
                            null
                     );
                     // $data['dateCreated'],
                     // $data['accountStatus'],
                     // $data['name'],
                     // $data['address'],
                     // $data['email'],
                     // $data['phoneNumber'],
                     // $data['birth'],
                     // $data['sex'],
                     // $data['codePermissions']
                     return $account;
              } else {
                     // Không tìm thấy người dùng
                     return null;
              }
       }



       // Hàm trim() loại bỏ khoảng trắng (spaces) và các ký tự không cần thiết ở đầu và cuối chuỗi.
       // Ví dụ: nếu input = " Hello World! ", sau khi gọi trim($input), chuỗi trở thành "Hello World!".
       // strip_tags($input):

       // Hàm strip_tags() sẽ loại bỏ tất cả các thẻ HTML và PHP khỏi chuỗi đầu vào.
       // Ví dụ: nếu input = "<script>alert('Hacked!');</script> Hello World!", sau khi gọi strip_tags($input), chuỗi sẽ trở thành " Hello World!".
       // Điều này giúp ngăn chặn việc chèn mã JavaScript độc hại vào đầu vào (ví dụ như một cuộc tấn công XSS), mà kẻ tấn công có thể dùng để chèn mã vào trang web.
       // htmlspecialchars($input):

       // Hàm htmlspecialchars() chuyển các ký tự đặc biệt (như <, >, &, ", ') thành các ký tự HTML an toàn, ví dụ:
       // < sẽ trở thành &lt;
       // > sẽ trở thành &gt;
       // & sẽ trở thành &amp;
       // Điều này giúp ngăn chặn các cuộc tấn công XSS, nơi kẻ tấn công có thể cố gắng chèn mã HTML hoặc JavaScript vào ứng dụng của bạn.
       // Ví dụ: nếu input = "<h1>Title</h1>", sau khi gọi htmlspecialchars($input), chuỗi trở thành &lt;h1&gt;Title&lt;/h1&gt;.
       // Validate input to prevent SQL injection
       private function validateInput($input)
       {
              return htmlspecialchars(strip_tags(trim($input)));
       }
       // lấy obj từ database bằng userName
       function get_obj($userName)
       {
              // Xử lý đầu vào để tránh SQL Injection
              $userNameValidated = $this->validateInput($userName);

              // Truy vấn dữ liệu từ cơ sở dữ liệu dựa trên userName
              $query = "SELECT * FROM accounts WHERE userName = ?";
              $stmt = $this->actionSQL->prepare($query);

              // Liên kết tham số với truy vấn đã chuẩn bị
              $stmt->bind_param('s', $userNameValidated);
              $stmt->execute();
              $result = $stmt->get_result();

              // Kiểm tra và trả về thông tin người dùng nếu tồn tại
              if ($data = $result->fetch_assoc()) {
                     return new AccountDTO(
                            $data["userName"],
                            $data["passWord"], // PassWord sẽ được kiểm tra sau này trong hàm login_secure
                            $data["dateCreated"],
                            $data["accountStatus"],
                            $data["name"],
                            $data["address"],
                            $data["email"],
                            $data["phoneNumber"],
                            $data["birth"],
                            $data["sex"],
                            $data["codePermissions"]
                     );
              }
              // Đóng câu lệnh chuẩn bị và trả về null nếu không tìm thấy
              $stmt->close();
              return null;
       }
       // chặn sql injection
       function add_obj($obj)
       {
              if ($obj != null) {
                     $userNameValidated = $this->validateInput($obj->getUsername());

                     // Check if the username already exists
                     $checkQuery = "SELECT * FROM accounts WHERE userName = ?";
                     $stmt = $this->actionSQL->prepare($checkQuery);
                     $stmt->bind_param('s', $userNameValidated);
                     $stmt->execute();
                     $resultCheck = $stmt->get_result();

                     if ($resultCheck->num_rows < 1) {
                            $createDate = $obj->getDateCreate();
                            $passWord_hash = $obj->getPassword();
                            $accountStatus = $obj->getAccountStatus();
                            $name = $obj->getName();
                            $address = $obj->getAddress();
                            $email = $obj->getEmail();
                            $phoneNumber = $obj->getPhoneNumber();
                            $birthdate = $obj->getBirth();
                            $sex = $obj->getSex();
                            $codePermission = $obj->getCodePermission();

                            // Insert the new user
                            $insertQuery = "INSERT INTO accounts 
                                            (userName, passWord, dateCreated, accountStatus, name, address, email, phoneNumber, birth, sex, codePermissions) 
                                            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
                            $stmt = $this->actionSQL->prepare($insertQuery);
                            $stmt->bind_param(
                                   'sssssssssss',
                                   $userNameValidated,
                                   $passWord_hash,
                                   $createDate,
                                   $accountStatus,
                                   $name,
                                   $address,
                                   $email,
                                   $phoneNumber,
                                   $birthdate,
                                   $sex,
                                   $codePermission
                            );

                            if ($stmt->execute()) {
                                   return true;
                            }
                     }
                     $stmt->close();
              }
              return false;
       }
}

// check

// $check = new AccountDAL();
// $data = $check->getListobj();

// print_r($data);
// foreach($data as $obj){
//        echo $obj . "<br>";
// }

// $dataobj = $check->getobj('PhucApuTruong');
// echo $dataobj;

// $account = new AccountDTO(
//        'username123',
//        'password111',
//        '2024-03-08',
//        'active',
//        'John Doe',
//        '123 Main St',
//        'john@example.com',
//        '0823072871',
//        '1990-01-01',
//        'Male',
//        'admin'
// );
// echo $check->addobj($account);
// echo $check->upadateobj($account);

// echo $check->deleteByID('JohnDoe');

// echo $check->delete($account);



// try {

//        $accountDAL = new AccountDAL();

//        // ' OR '1'='1 --
// $userName = "' OR '1'='1 -- ";
//        $passWord = '123456';
//        $result = $accountDAL->checkLogin_always_true($userName, $passWord);
//        // Hiển thị kết quả
//        if ($result) {
//               echo "Login Successful. User data: ";
//               echo $result;
//        } else {
//               echo "Login failed. Invalid credentials.";
//        }
// } catch (Exception $e) {
//        echo "An error occurred: " . $e->getMessage();
// }





// try {
//        // Create an instance of the AccountDAL class
//        $accountDAL = new AccountDAL();

//        // Test with some sample data
//        // ' OR '1'='1 --
// $userName = "MzEyMTU2MDAyMQ==";
// $passWord = 'MTIzNDU=';
       // $userName = "' OR '1'='1 -- ";
//        $passWord = "' OR '1'='1";

//        // Call the checkLogin method and get the result
// $result = $accountDAL->checkLogin_Procedure($userName, $passWord);

//        // Display the result
//        if ($result) {
//               echo "Login Successful. User data: ";
//               echo $result;
//        } else {
//               echo "Login failed. Invalid credentials.";
//        }
// } catch (Exception $e) {
//        echo "An error occurred: " . $e->getMessage();
// }
// CALL use_procedure_sql_injection('PhucApuTruong', '123456');






// try {
//        $accountDAL = new AccountDAL();

//        // Injected values for SQL Injection attack
//        // $userName = "'' OR ''1''=''1'' -- ";
//        // // // $userName = "";
//        // $passWord = "123"; // Có thể để trống hoặc bất kỳ giá trị nào
//        // ' OR '1'='1' --


       // $userName = "'' OR (SELECT COUNT(*) FROM website_sells_clothes_and_bags.accounts) > 0; -- ";
       // $passWord = "anything";

//        // SELECT * FROM accounts WHERE userName = '' OR '1'='1' -- ' AND passWord = '123';
//        // SELECT * FROM accounts WHERE userName = '' OR '1'='1' AND passWord = '' OR '1'='1';
//        // CALL use_procedure_sql_injection("' OR '1'='1", "' OR '1'='1");
//        // CALL attack_sql_cn("' OR '1'='1", "' OR '1'='1");
//        // CALL attack_sql_cn("admin", "123");
//        // CALL attack_sql_cn("' AND 1=1 --", "password123");
//        // $userName = "admin--";
//        // $passWord = "123";

//        // $userName = "' OR 'admin'='admin";
//        // $passWord = "' OR '1'='1";

//        $userName = "MzEyMTU2MDAyMQ==";
//        $passWord = "MTIzNDU=";
//        // MTIzNDU=

//        // Call the checkLogin_Procedure method and get the result
//        $result = $accountDAL->checkLogin_Procedure($userName, $passWord);

//        // Display the result
//        if ($result) {
//               echo "Login Successful. User data: ";
//               // var_dump($result);
//               echo $result;
//        } else {
//               echo "Login failed. Invalid credentials.";
//               var_dump($result);
//               // echo $result;
//        }
// } catch (Exception $e) {
//        echo "An error occurred: " . $e->getMessage();
// }