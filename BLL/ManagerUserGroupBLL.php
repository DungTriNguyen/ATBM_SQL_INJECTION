<?php


require('../DAL/connectionDatabase.php');
require('../DAL/AbstractionDAL.php');

require('../DTO/PermissionDTO.php');
require('../DTO/PermissionsDetailDTO.php');
require('../DTO/FunctionsDTO.php');

require('../DAL/PermissionDAL.php');
require('../DAL/PermissionsDetailDAL.php');
require('../DAL/FunctionsDAL.php');


class ManagerUserGroupBLL
{
    private $PermissionDAL;
    private $PermissionsDetailDAL;
    private $FunctionsDAL;
    function __construct()
    {
        $this->PermissionDAL = new PermissionDAL();
        $this->PermissionsDetailDAL = new PermissionsDetailDAL();
        $this->FunctionsDAL = new FunctionsDAL();
    }
    // Xóa một đối tượng khi lấy được id của đối tượng
    function deleteByID($code)
    {

        //lấy thông tin 
        $result = $this->PermissionDAL->deleteByID($code);

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
        $arr = $this->PermissionDAL->getListObj();
        //mảng chứa các obj lấy được từ DAL ở trên
        $result = array();
        if (count($arr) > 0) {
            foreach ($arr as $item) {
                $codePermission = $item->getCodePermission();
                $namePermission = $item->getNamePermission();

                $obj = array(
                    "codePermission" => $codePermission,
                    "namePermission" => $namePermission,
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
        $result = $this->PermissionDAL->getObj($code);
        if ($result != null) {
            $codePermission = $result->getCodePermission();
            $namePermission = $result->getNamePermission();

            $obj = array(
                "codePermission" => $codePermission,
                "namePermission" => $namePermission,
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
            $codePermission = $obj->getCodePermission();
            $namePermission = $obj->getNamePermission();

            //Thực hiện thêm đối tượng vào Database
            $result = $this->PermissionDAL->addObj($obj);

            if ($result) {
                return array(
                    "codePermission" => $codePermission,
                    "namePermission" => $namePermission,
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
        $result = $this->PermissionDAL->upadateObj($obj);
        if ($result) {
            // Lấy thông tin từ đối tượng cập nhật
            $codePermission = $obj->getCodePermission();
            $namePermission = $obj->getNamePermission();


            // Trả về mảng chứa thông báo thành công và thông tin cập nhật
            return array(
                "codePermission" => $codePermission,
                "namePermission" => $namePermission,
                "mess" => "success"
            );
        } else {
            return array("mess" => "Failed");
        }
    }


    // Tìm kiếm
    function searchAccountGroup($str)
    {
        $arr = $this->PermissionDAL->getListObj();
        $result = array();
        if (count($arr) > 0) {
            foreach ($arr as $item) {
                $codePermission = $item->getCodePermission();
                $namePermission = $item->getNamePermission();
                // Kiểm tra nếu chuỗi $str xuất hiện trong bất kỳ trường nào của đối tượng
                if (
                    strpos($codePermission, $str) !== false || strpos($namePermission, $str) !== false
                ) {
                    $obj = array(
                        "codePermission" => $codePermission,
                        "namePermission" => $namePermission,
                        "mess" => "success"
                    );
                    array_push($result, $obj);
                }
            }
        }
        return $result;
    }

    // lấy mảng chứa permissionDAL
    function getArrPermissionDetail($codePermission)
    {
        $permissionObj = $this->PermissionDAL->getObj($codePermission);
        $arrPermissionDetail = $this->PermissionsDetailDAL->getArrByPermission($codePermission);
        $arrFunction = $this->FunctionsDAL->getListObj();

        $result = array();

        // lấy đối tượng permission
        // $codePermission = $permissionObj->getCodePermission();
        $namePermission = $permissionObj->getNamePermission();

        $result['codePermission'] = $codePermission;
        $result['namePermission'] = $namePermission;

        $dataPermissonDetail = array();
        foreach ($arrPermissionDetail as $item) {
            $obj = array(
                "codePermissions" => $codePermission,
                "functionCode" => $item->getFunctionCode(),
                "addPermission" => $item->getAddPermission(),
                "seePermission" => $item->getSeePermission(),
                "deletePermission" => $item->getDeletePermission(),
                "fixPermission" => $item->getFixPermission()
            );
            array_push($dataPermissonDetail, $obj);
        }
        $result['permissionDetail'] = $dataPermissonDetail;

        $dataFunction = array();
        foreach ($arrFunction as $item) {
            $obj = array(
                "functionCode" => $item->getFunctionCode(),
                "functionName" => $item->getFunctionName()
            );
            array_push($dataFunction, $obj);
        }
        $result['function'] = $dataFunction;

        return $result;
    }

    // phân quyền
    // input: mang chua cac obj permissionDetail
    // output: mess cap nhat
    function updatePermissionDetail($arr){
        if($arr != null){
            $check = 'success';
            foreach($arr as $item){
                $codePermission = $item['codePermission'];
                $functionCode = $item['functionCode'];
                $seePermission = $item['seePermission'];
                $addPermission = $item['addPermission'];
                $fixPermission = $item['fixPermission'];
                $deletePermission = $item['deletePermission'];

                $obj = new PermissionsDetailDTO($codePermission,$functionCode,$addPermission,$seePermission,$deletePermission,$fixPermission);

                // cập nhật
                if($this->PermissionsDetailDAL->upadateObj($obj) != true){
                    $check = 'failed';
                }
            }
            return array(
                "mess" => $check
            );
        }else{
            return array(
                "mess" => "failed"
            );
        }
        
    }

    // lấy dữ liệu function
    function getArrFunction(){
        $arr = $this->FunctionsDAL->getListObj();
        if($arr != null){
            $result = array();
            foreach($arr as $item){
                $functionCode = $item->getFunctionCode();
                $functionName = $item->getFunctionName();

                $obj = array(
                    "functionCode" => $functionCode,
                    "functionName" => $functionName
                );

                array_push($result,$obj);
            }
            return $result;
        }
        return array();
    }

    // thêm đối tượng permissionDetail
    // input: arr permissionDetail
    // output: mess
    function addArrPermisstionDetail($arr){
        if($arr != null){
            $check = 'success';
            foreach($arr as $item){
                $codePermission = $item['codePermission'];
                $functionCode = $item['functionCode'];
                $seePermission = $item['seePermission'];
                $addPermission = $item['addPermission'];
                $fixPermission = $item['fixPermission'];
                $deletePermission = $item['deletePermission'];

                $obj = new PermissionsDetailDTO($codePermission,$functionCode,$addPermission,$seePermission,$deletePermission,$fixPermission);

                // cập nhật
                if($this->PermissionsDetailDAL->addObj($obj) != true){
                    $check = 'failed';
                }
            }
            return array(
                "mess" => $check
            );
        }else{
            return array(
                "mess" => "failed"
            );
        }
    }

    // xoa mang permissionDetail
    function deletePermissionDetail_by_codePermission($codePermission){
        
        if($this->PermissionsDetailDAL->deleteObj_by_codePermission($codePermission) == true)
        {
            return array(
                "mess" => "success"
            );
        }else{
            return array(
                "mess" => "failed"
            );
        }
    }
}


header('Content-Type: application/json');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $check = new ManagerUserGroupBLL();

    $function = $_POST['function'];
    // checkLogin
    // menu
    switch ($function) {
        case 'getList':
            $temp = $check->getList();
            echo json_encode($temp);
            break;
        case 'getObj':
            $codePermission = $_POST['codePermission'];
            $temp = $check->getObj($codePermission);
            echo json_encode($temp);
            break;
        case 'deleteByID':
            $codePermission = $_POST['codePermission'];
            $temp = $check->deleteByID($codePermission);
            echo json_encode($temp);
            break;
        case 'addObj':
            // Lấy dữ liệu đối tượng từ POST request
            $codePermission = $_POST['codePermission'];
            $namePermission = $_POST['namePermission'];

            // Tạo một đối tượng PermissionDTO từ dữ liệu POST
            $obj = new PermissionDTO($codePermission, $namePermission);
            $temp = $check->addObj($obj);
            echo json_encode($temp);
            break;
        case 'updateObj':
            // Lấy dữ liệu đối tượng từ POST request
            $codePermission = $_POST['codePermission'];
            $namePermission = $_POST['namePermission'];
            // Tạo một đối tượng PaymentDTO từ dữ liệu POST
            $obj = new PermissionDTO($codePermission, $namePermission);
            $temp = $check->updateObj($obj);
            echo json_encode($temp);
            break;
        case 'searchAccountGroup':
            // Lấy dữ liệu đối tượng từ POST request
            $str = $_POST['str'];
            $temp = $check->searchAccountGroup($str);
            echo json_encode($temp);
            break;
        case 'getArrPermissionDetail':
            $codePermission = $_POST['codePermission'];
            $temp = $check->getArrPermissionDetail($codePermission);
            echo json_encode($temp);
            break;
        case 'updatePermissionDetail':
            $jsonStr = $_POST['arr'];
            $array = json_decode($jsonStr, true);
            $temp = $check->updatePermissionDetail($array);
            echo json_encode($temp);
            break;
        case 'addArrPermisstionDetail':
            $jsonStr = $_POST['arr'];
            $array = json_decode($jsonStr, true);
            $temp = $check->addArrPermisstionDetail($array);
            echo json_encode($temp);
            break;
        case 'getArrFunction':
            $temp = $check->getArrFunction();
            echo json_encode($temp);
            break;
        case 'deletePermissionDetail_by_codePermission':
            $codePermission = $_POST['codePermission'];
            $temp = $check->deletePermissionDetail_by_codePermission($codePermission);
            echo json_encode($temp);
            break;
    }
}
