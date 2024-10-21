<?php
// gọi các lớp liên quan
require('../DAL/connectionDatabase.php');
require('../DAL/AbstractionDAL.php');

require('../DTO/CommentDTO.php');

require('../DAL/CommentDAL.php');

class CommentBLL
{
       private $CommentDAL;

       function __construct()
       {
              $this->CommentDAL = new CommentDAL();
       }

       // thêm một bình luận
       // input: các thuộc tính cần thiết
       // ouput: mảng chứa thông tin đối tượng kèm thông báo
       function addObj($productCode, $userNameComment, $userNameRepComment, $content, $state, $dislikeNumber, $likeNumber)
       {
              // tạo mã hóa đơn ngẫu nhiên
              // Tạo chuỗi 'ORD' cố định
              $commentPrefix = 'CM';

              // Tạo một số duy nhất dựa trên thời gian hiện tại và số ngẫu nhiên
              $commentNumber = uniqid();

              // Kết hợp chuỗi 'ORD' với số duy nhất để tạo ra chuỗi hoàn chỉnh
              $commentCode = $commentPrefix . $commentNumber;

              // lấy các thông tin khác
              $dateSend = date('Y-m-d');

              $obj = new CommentDTO($commentCode, $productCode, $userNameComment, $userNameRepComment, $dateSend, $content, $state, $likeNumber, $dislikeNumber);
              $check = $this->CommentDAL->addObj($obj);

              if ($check == true) {
                     return array(
                            "mess" => "success"
                     );
              } else {
                     return array(
                            "mess" => "failed"
                     );
              }
       }

       // lấy mảng đối tượng Comment
       function getArrObj()
       {
              $arr = $this->CommentDAL->getListObj();
              $result = array();
              if (count($arr) > 0) {
                     foreach ($arr as $item) {
                            // if($item->getState() == "1"){
                            $codeComment = $item->getCodeComment();
                            $productCode = $item->getProductCode();
                            $userNameComment = $item->getUserNameComment();
                            $userNameRepComment = $item->getUserNameRepComment();
                            $sentDate = $item->getSentDate();
                            $content = $item->getContent();
                            $state = $item->getState();
                            $likeNumber = $item->getLikeNumber();
                            $dislikeNumber = $item->getDislikeNumber();

                            $obj = array(
                                   "codeComment" => $codeComment,
                                   "productCode" => $productCode,
                                   "userNameComment" => $userNameComment,
                                   "userNameRepComment" => $userNameRepComment,
                                   "sentDate" => $sentDate,
                                   "content" => $content,
                                   "state" => $state,
                                   "likeNumber" => $likeNumber,
                                   "dislikeNumber" => $dislikeNumber
                            );
                            array_push($result, $obj);
                            // }
                     }
                     return $result;
              } else {
                     return array(
                            "mess" => "empty"
                     );
              }
       }

       // lấy mảng đối tượng bình luận theo mã sản phẩm
       function getArrObj_by_productCode($productCode)
       {
              $arr = $this->CommentDAL->getArr_by_productCode($productCode);
              $result = array();
              if ($arr != null && count($arr) > 0) {
                     foreach ($arr as $item) {
                            // if($item->getState() == "1"){
                            $codeComment = $item->getCodeComment();
                            $productCode = $item->getProductCode();
                            $userNameComment = $item->getUserNameComment();
                            $userNameRepComment = $item->getUserNameRepComment();
                            $sentDate = $item->getSentDate();
                            $content = $item->getContent();
                            $state = $item->getState();
                            $likeNumber = $item->getLikeNumber();
                            $dislikeNumber = $item->getDislikeNumber();

                            $obj = array(
                                   "codeComment" => $codeComment,
                                   "productCode" => $productCode,
                                   "userNameComment" => $userNameComment,
                                   "userNameRepComment" => $userNameRepComment,
                                   "sentDate" => $sentDate,
                                   "content" => $content,
                                   "state" => $state,
                                   "likeNumber" => $likeNumber,
                                   "dislikeNumber" => $dislikeNumber
                            );
                            array_push($result, $obj);
                            // }
                     }
                     return $result;
              } else {
                     return null;
              }
       }


       //Lấy 1 đối tượng Comment thông qua codeComment
       function getObj($code)
       {
              $result = $this->CommentDAL->getObj($code);
              if ($result != null) {
                     $productCode = $result->getProductCode();
                     $codeComment = $result->getCodeComment();
                     $userNameComment = $result->getUserNameComment();
                     $userNameRepComment = $result->getUserNameRepComment();
                     $sentDate = $result->getSentDate();
                     $content = $result->getContent();
                     $state = $result->getState();
                     $likeNumber = $result->getLikeNumber();
                     $dislikeNumber = $result->getDislikeNumber();

                     $obj = array(
                            "productCode" => $productCode,
                            "codeComment" => $codeComment,
                            "userNameComment" => $userNameComment,
                            "userNameRepComment" => $userNameRepComment,
                            "sentDate" => $sentDate,
                            "content" => $content,
                            "state" => $state,
                            "likeNumber" => $likeNumber,
                            "dislikeNumber" => $dislikeNumber
                     );
                     return $obj;
              } else {
                     return array("mess" => "Not Found");
              }
       }

       //Cập nhật đối tượng thông qua đối tượng
       function updateObj($obj)
       {
              if ($obj != null) {
                     $result = $this->CommentDAL->upadateObj($obj);
                     if ($result) {
                            return array("mess" => "success");
                     } else {
                            return array("mess" => "failed");
                     }
              }
              return array("mess" => "Not Found");
       }

       function updateStateObj($code, $state)
       {
              $result = $this->CommentDAL->updateState($code, $state);
              if ($result) {
                     return array("mess" => "success");
              } else {
                     return array("mess" => "failed");
              }
       }


       //Xóa đối tượng thông qua codeComment
       function deleteObjByID($code)
       {
              $result = $this->CommentDAL->deleteByID($code);
              if ($result) {
                     return array("mess" => "success");
              } else {
                     return array("mess" => "failed");
              }
       }

       //Xóa đối tượng thông qua chính đối tượng truyền vào
       function deleteObj($obj)
       {
              if ($obj != null) {
                     $result = $this->CommentDAL->delete($obj);
                     if ($result) {
                            return array("mess" => "Success");
                     } else {
                            return array("mess" => "Failed");
                     }
              }
              return array("mess" => "Not Found");
       }

       //Thêm đối tượng

       function searchComments($str)
       {
              $arr = $this->CommentDAL->getListObj();

              $result = array();
              if (count($arr) > 0) {
                     foreach ($arr as $item) {
                            $productCode = $item->getproductCode();
                            $codeComment = $item->getCodeComment();
                            $userNameComment = $item->getUserNameComment();
                            $userNameRepComment = $item->getUserNameRepComment();
                            $likeNumber = $item->getLikeNumber();
                            $dislikeNumber = $item->getDislikeNumber();
                            $content = $item->getContent();
                            $sentDate = $item->getSentDate();
                            $state = $item->getState();

                            if (
                                   strpos(strtolower($productCode), $str) !== false ||
                                   strpos(strtolower($codeComment), $str) !== false ||
                                   strpos(strtolower($userNameComment), $str) !== false ||
                                   strpos(strtolower($likeNumber), $str) !== false ||
                                   strpos(strtolower($content), $str) !== false ||
                                   strpos(strtolower($sentDate), $str) !== false ||
                                   strpos(strtolower($state), $str) !== false
                            ) {

                                   $obj = array(
                                          "productCode" => $productCode,
                                          "codeComment" => $codeComment,
                                          "userNameComment" => $userNameComment,
                                          "userNameRepComment" => $userNameRepComment,
                                          "sentDate" => $sentDate,
                                          "content" => $content,
                                          "state" => $state,
                                          "likeNumber" => $likeNumber,
                                          "dislikeNumber" => $dislikeNumber,
                                          "mess" => "success"
                                   );
                                   array_push($result, $obj);
                            }
                     }
                     return $result;
              } else {
                     return $result;
              }
       }
}



// mục lục
header('Content-Type: application/json');


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
       $check = new CommentBLL();

       $function = $_POST['function'];
       // menu
       switch ($function) {
              case 'getArrObj':
                     $temp = $check->getArrObj();
                     echo json_encode($temp);
                     break;

              case 'getObj':
                     $code = $_POST['codeComment'];
                     $temp = $check->getObj($code);
                     echo json_encode($temp);
                     break;

              case 'deleteObjByID':
                     $code = $_POST['codeComment'];
                     $temp = $check->deleteObjByID($code);
                     echo json_encode($temp);
                     break;

              case 'updateObj':
                     $codeComment = $_POST['codeComment'];
                     $productCode = $_POST['productCode'];
                     $userNameComment = $_POST['userNameComment'];
                     $userNameRepComment = $_POST['userNameRepComment'];
                     $sentDate = $_POST['sentDate'];
                     $content = $_POST['content'];
                     $state = $_POST['state'];
                     $numberLike = $_POST['numberLike'];
                     $numberDislike = $_POST['numberDislike'];

                     $obj = new CommentDTO($codeComment, $productCode, $userNameComment, $userNameRepComment, $sentDate, $content, $state, $numberLike, $numberDislike);
                     $temp = $check->updateObj($obj);
                     echo json_encode($temp);
                     break;

              case 'updateStateObj':
                     $codeComment = $_POST['codeComment'];
                     $state = $_POST['state'];

                     $temp = $check->updateStateObj($codeComment, $state);
                     echo json_encode($temp);
                     break;

              case 'searchComments':
                     $str = strtolower($_POST['str']);
                     $temp = $check->searchComments($str);
                     echo json_encode($temp);
                     break;
              case 'addObj':
                     $productCode = $_POST['producCode'];
                     $userNameComment = $_POST['username'];
                     $userNameRepComment = $_POST['usernameRep'];
                     $content = $_POST['content'];
                     $state = $_POST['state'];
                     $dislikeNumber = $_POST['dislikeNumber'];
                     $likeNumber = $_POST['likeNumber'];
                     $temp = $check->addObj($productCode, $userNameComment, $userNameRepComment, $content, $state, $dislikeNumber, $likeNumber);
                     echo json_encode($temp);
                     break;
              case 'getArrObj_by_productCode':
                     $productCode = $_POST['productCode'];
                     $temp = $check->getArrObj_by_productCode($productCode);
                     echo json_encode($temp);
                     break;
       }
}
