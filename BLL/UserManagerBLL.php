<?php



require('../DAL/connectionDatabase.php');
require('../DAL/AbstractionDAL.php');
require('../DTO/AccountDTO.php');
require('../DAL/AccountDAL.php');

class UserManagerBLL
{
    private $UserManagerDAL;
    function __construct()
    {
        $this->UserManagerDAL = new AccountDAL();
    }
    // Xóa một đối tượng khi lấy được id của đối tượng
    function deleteByID($code)
    {

        //lấy thông tin 
        $result = $this->UserManagerDAL->deleteByID($code);

        if ($result) {
            return array("mess" => "success");
        } else {
            return array("mess" => "Failed");
        }
    }

    //Lấy danh sách 
    function getList()
    {
        //mảng dữ liệu lấy được từ DAL
        $arr = $this->UserManagerDAL->getListobj();
        //mảng chứa các obj lấy được từ DAL ở trên
        $result = array();
        if (count($arr) > 0) {
            foreach ($arr as $item) {
                $username = $item->getUsername();
                $passWord = $item->getPassword();
                $dateCreated = $item->getDateCreate();
                $accountStatus = $item->getAccountStatus();
                $name = $item->getName();
                $address = $item->getAddress();
                $email = $item->getEmail();
                $phoneNumber = $item->getPhoneNumber();
                $birth = $item->getBirth();
                $sex = $item->getSex();
                $codePermissions = $item->getCodePermission();
                $obj = array(
                    "username" => $username,
                    "passWord" => $passWord,
                    "dateCreated" => $dateCreated,
                    "accountStatus" => $accountStatus,
                    "name" => $name,
                    "address" => $address,
                    "email" => $email,
                    "phoneNumber" => $phoneNumber,
                    "birth" => $birth,
                    "sex" => $sex,
                    "codePermissions" => $codePermissions,
                    "mess" => "success"
                );
                array_push($result, $obj);
            }
            return $result;
        } else {
            return array("mess" => "Failed");
        }
    }

    //Lấy một đối tượng bằng khóa chính của đối tượng đó
    function getObj($code)
    {
        //Lấy kết quả từ DAL
        $result = $this->UserManagerDAL->getobj($code);
        if ($result != null) {
            $username = $result->getUsername();
            $passWord = $result->getPassword();
            $dateCreated = $result->getDateCreate();
            $accountStatus = $result->getAccountStatus();
            $name = $result->getName();
            $address = $result->getAddress();
            $email = $result->getEmail();
            $phoneNumber = $result->getPhoneNumber();
            $birth = $result->getBirth();
            $sex = $result->getSex();
            $codePermissions = $result->getCodePermission();
            $obj = array(
                "username" => $username,
                "passWord" => $passWord,
                "dateCreated" => $dateCreated,
                "accountStatus" => $accountStatus,
                "name" => $name,
                "address" => $address,
                "email" => $email,
                "phoneNumber" => $phoneNumber,
                "birth" => $birth,
                "sex" => $sex,
                "codePermissions" => $codePermissions,
                "mess" => "success"
            );
            return $obj;
        } else {
            return array("mess" => "Failed");
        }
    }

    //Thêm vào đối tượng obj 
    function addObj($obj)
    {
        if ($obj != null) {
            //Lấy thông tin từ đối tượng 
            $username = $obj->getUsername();
            $passWord = $obj->getPassword();
            $dateCreated = $obj->getDateCreate();
            $accountStatus = $obj->getAccountStatus();
            $name = $obj->getName();
            $address = $obj->getAddress();
            $email = $obj->getEmail();
            $phoneNumber = $obj->getPhoneNumber();
            $birth = $obj->getBirth();
            $sex = $obj->getSex();
            $codePermissions = $obj->getCodePermission();

            //Thực hiện thêm đối tượng vào Database
            $result = $this->UserManagerDAL->addobj($obj);

            if ($result != null) {
                return  array(
                    "username" => $username,
                    "passWord" => $passWord,
                    "dateCreated" => $dateCreated,
                    "accountStatus" => $accountStatus,
                    "name" => $name,
                    "address" => $address,
                    "email" => $email,
                    "phoneNumber" => $phoneNumber,
                    "birth" => $birth,
                    "sex" => $sex,
                    "codePermissions" => $codePermissions,
                    "mess" => "success"
                );
            } else {
                return array("mess" => "failed");
            }
        } else {
            return array("mess" => "failed");
        }
    }


    //Cập nhật đối tượng 
    function updateObj($obj)
    {
        $result = $this->UserManagerDAL->upadateObj($obj);
        if ($result) {
            // Lấy thông tin từ đối tượng cập nhật
            $username = $obj->getUsername();
            $passWord = $obj->getPassword();
            $dateCreated = $obj->getDateCreate();
            $accountStatus = $obj->getAccountStatus();
            $name = $obj->getName();
            $address = $obj->getAddress();
            $email = $obj->getEmail();
            $phoneNumber = $obj->getPhoneNumber();
            $birth = $obj->getBirth();
            $sex = $obj->getSex();
            $codePermissions = $obj->getCodePermission();

            // Trả về mảng chứa thông báo thành công và thông tin cập nhật
            return array(
                "username" => $username,
                "passWord" => $passWord,
                "dateCreated" => $dateCreated,
                "accountStatus" => $accountStatus,
                "name" => $name,
                "address" => $address,
                "email" => $email,
                "phoneNumber" => $phoneNumber,
                "birth" => $birth,
                "sex" => $sex,
                "codePermissions" => $codePermissions,
                "mess" => "success"
            );
        } else {
            return array("mess" => "Failed");
        }
    }


    // Tìm kiếm
    function searchAccount($str)
    {
        $arr = $this->UserManagerDAL->getListobj();
        $result = array();
        if (count($arr) > 0) {
            foreach ($arr as $item) {
                $username = $item->getUsername();
                $passWord = $item->getPassword();
                $dateCreated = $item->getDateCreate();
                $accountStatus = $item->getAccountStatus();
                $name = $item->getName();
                $address = $item->getAddress();
                $email = $item->getEmail();
                $phoneNumber = $item->getPhoneNumber();
                $birth = $item->getBirth();
                $sex = $item->getSex();
                $codePermissions = $item->getCodePermission();
                // Kiểm tra nếu chuỗi $str xuất hiện trong bất kỳ trường nào của đối tượng
                if (
                    strpos(strtolower($username), $str) !== false || strpos(strtolower($name), $str) !== false  ||
                    strpos(strtolower($phoneNumber), $str) !== false || strpos(strtolower($address), $str) !== false || strpos(strtolower($email), $str) !== false || strpos(strtolower($accountStatus), $str) !== false
                ) {
                    $obj = array(
                        "username" => $username,
                        "passWord" => $passWord,
                        "dateCreated" => $dateCreated,
                        "accountStatus" => $accountStatus,
                        "name" => $name,
                        "address" => $address,
                        "email" => $email,
                        "phoneNumber" => $phoneNumber,
                        "birth" => $birth,
                        "sex" => $sex,
                        "codePermissions" => $codePermissions,
                        "mess" => "success"
                    );
                    array_push($result, $obj);
                }
            }
        }
        return $result;
    }
    function updateStateUser($userName, $accountStatus)
    {
        $result = $this->UserManagerDAL->updateStateUser($userName, $accountStatus);
        if ($result) {
            return array("mess" => "success");
        } else {
            return array("mess" => "failed");
        }
    }
}


header('Content-Type: application/json');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $check = new UserManagerBLL();

    $function = $_POST['function'];
    // checkLogin
    // menu
    switch ($function) {
        case 'getList':
            $temp = $check->getList();
            echo json_encode($temp);
            break;
        case 'getObj':
            $username = $_POST['username'];
            $temp = $check->getObj($username);
            echo json_encode($temp);
            break;
        case 'deleteByID':
            $username = $_POST['username'];
            $temp = $check->deleteByID($username);
            echo json_encode($temp);
            break;
        case 'addObj':
            // Lấy dữ liệu đối tượng từ POST request
            $username = $_POST['username'];
            $passWord = $_POST['passWord'];
            $dateCreated = $_POST['dateCreated'];
            $accountStatus = $_POST['accountStatus'];
            $name = $_POST['name'];
            $address = $_POST['address'];
            $email = $_POST['email'];
            $phoneNumber = $_POST['phoneNumber'];
            $birth = $_POST['birth'];
            $sex = $_POST['sex'];
            $codePermissions = $_POST['codePermissions'];
            // Tạo một đối tượng PaymentDTO từ dữ liệu POST
            $obj = new AccountDTO(
                $username,
                $passWord,
                $dateCreated,
                $accountStatus,
                $name,
                $address,
                $email,
                $phoneNumber,
                $birth,
                $sex,
                $codePermissions
            );
            $temp = $check->addObj($obj);
            echo json_encode($temp);
            break;
        case 'updateObj':
            // Lấy dữ liệu đối tượng từ POST request
            $username = $_POST['username'];
            $passWord = $_POST['passWord'];
            $dateCreated = $_POST['dateCreated'];
            $accountStatus = $_POST['accountStatus'];
            $name = $_POST['name'];
            $address = $_POST['address'];
            $email = $_POST['email'];
            $phoneNumber = $_POST['phoneNumber'];
            $birth = $_POST['birth'];
            $sex = $_POST['sex'];
            $codePermissions = $_POST['codePermissions'];
            // Tạo một đối tượng PaymentDTO từ dữ liệu POST
            $obj = new AccountDTO(
                $username,
                $passWord,
                $dateCreated,
                $accountStatus,
                $name,
                $address,
                $email,
                $phoneNumber,
                $birth,
                $sex,
                $codePermissions
            );
            $temp = $check->updateObj($obj);
            echo json_encode($temp);
            break;
        case 'searchAccount':
            // Lấy dữ liệu đối tượng từ POST request
            $str = $_POST['str'];
            $temp = $check->searchAccount($str);
            echo json_encode($temp);
            break;
        case 'updateStateUser':
            $userName = $_POST['userName'];
            $accountStatus = $_POST['accountStatus'];
            $temp = $check->updateStateUser($userName, $accountStatus);
            echo json_encode($temp);
            break;
    }
}
