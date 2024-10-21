<?php

// import
// require('../DAL/AbstractionDAL.php');
// require('../DTO/CommentDTO.php');

class CommentDAL extends AbstractionDAL
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
              $string = "DELETE FROM Comment WHERE codeComment = '$code'";
              // Thực hiện truy vấn
              return $this->actionSQL->query($string);
       }

       // xóa một đối tượng bằng cách truyền đối tượng vào
       function delete($obj)
       {
              if ($obj != null) {
                     $code = $obj->getCodeFeedback();
                     $string = "DELETE FROM feedback WHERE codeFeedback = '$code'";
                     // Thực hiện truy vấn
                     return $this->actionSQL->query($string);
              } else {
                     return false;
              }
       }

       // lấy ra mảng các đối tượng
       function getListObj()
       {
              // Mảng để lưu trữ các đối tượng
              $array_list = array();

              // Câu lệnh truy vấn
              $string = 'SELECT * FROM Comment';

              // Thực hiện truy vấn
              $result = $this->actionSQL->query($string);

              // Kiểm tra số hàng được trả về
              if ($result->num_rows > 0) {
                     // Lặp qua các dòng kết quả và thêm vào mảng
                     while ($data = $result->fetch_assoc()) {
                            $codeComment = $data['codeComment'];
                            $productCode = $data['productCode'];
                            $userNameComment = $data['userNameComment'];
                            $userNameRepComment = $data['userNameRepComment'];
                            $sentDate = $data['sentDate'];
                            $content = $data['content'];
                            $state = $data['state'];
                            $likeNumber = $data['likeNumber'];
                            $dislikeNumber = $data['dislikeNumber'];

                            // giải mã username
                            $userNameCommentValue = base64_decode($userNameComment);

                            // Tạo đối tượng CommentDTO và thêm vào mảng
                            $comment = new CommentDTO($codeComment, $productCode, $userNameCommentValue, $userNameRepComment, $sentDate, $content, $state, $likeNumber, $dislikeNumber);
                            array_push($array_list, $comment);
                     }
                     return $array_list;
              } else {
                     // Trường hợp không có dữ liệu trả về
                     // echo "Không có dữ liệu được trả về từ truy vấn.";
                     return null;
              }
       }

       // lấy ra một đối tượng dựa theo mã đối tượng
       function getObj($code)
       {
              // Câu lệnh truy vấn
              $string = "SELECT * FROM Comment WHERE codeComment = '$code'";

              // Thực hiện truy vấn
              $result = $this->actionSQL->query($string);

              if ($result->num_rows > 0) {
                     $data = $result->fetch_assoc();
                     $codeComment = $data['codeComment'];
                     $productCode = $data['productCode'];
                     $userNameComment = $data['userNameComment'];
                     $userNameRepComment = $data['userNameRepComment'];
                     $sentDate = $data['sentDate'];
                     $content = $data['content'];
                     $state = $data['state'];
                     $likeNumber = $data['likeNumber'];
                     $dislikeNumber = $data['dislikeNumber'];

                     // giải mã username
                     $userNameCommentValue = base64_decode($userNameComment);

                     // Tạo đối tượng CommentDTO và trả về
                     $comment = new CommentDTO($codeComment, $productCode, $userNameCommentValue, $userNameRepComment, $sentDate, $content, $state, $likeNumber, $dislikeNumber);
                     return $comment;
              } else {
                     // Trường hợp không có dữ liệu trả về
                     // echo "Không có dữ liệu được trả về từ truy vấn.";
                     return null;
              }
       }

       // lấy một mảng đối tượng dựa theo mã người dùng
       function getArr_by_username($code)
       {
              // mã hóa username
              $userNameComment_encode = base64_encode($code);
              // Câu lệnh truy vấn
              $string = "SELECT * FROM Comment WHERE userNameComment = '$userNameComment_encode'";
              $arr = array();
              // Thực hiện truy vấn
              $result = $this->actionSQL->query($string);

              if ($result->num_rows > 0) {
                     while ($data = $result->fetch_assoc()) {
                            $codeComment = $data['codeComment'];
                            $productCode = $data['productCode'];
                            $userNameComment = $data['userNameComment'];
                            $userNameRepComment = $data['userNameRepComment'];
                            $sentDate = $data['sentDate'];
                            $content = $data['content'];
                            $state = $data['state'];
                            $likeNumber = $data['likeNumber'];
                            $dislikeNumber = $data['dislikeNumber'];

                            // giải mã username
                            $userNameCommentValue = base64_decode($userNameComment);

                            // Tạo đối tượng CommentDTO và trả về
                            $comment = new CommentDTO($codeComment, $productCode, $userNameCommentValue, $userNameRepComment, $sentDate, $content, $state, $likeNumber, $dislikeNumber);

                            //
                            array_push($arr, $comment);
                     }

                     return $arr;
              } else {
                     // Trường hợp không có dữ liệu trả về
                     // echo "Không có dữ liệu được trả về từ truy vấn.";
                     return null;
              }
       }

       // lấy một mảng đối tượng dựa theo mã sản phẩm
       function getArr_by_productCode($productCode)
       {
              
              // Câu lệnh truy vấn
              $string = "SELECT * FROM Comment WHERE productCode = '$productCode'";
              $arr = array();
              // Thực hiện truy vấn
              $result = $this->actionSQL->query($string);

              if ($result->num_rows > 0) {
                     while ($data = $result->fetch_assoc()) {
                            $codeComment = $data['codeComment'];
                            $productCode = $data['productCode'];
                            $userNameComment = $data['userNameComment'];
                            $userNameRepComment = $data['userNameRepComment'];
                            $sentDate = $data['sentDate'];
                            $content = $data['content'];
                            $state = $data['state'];
                            $likeNumber = $data['likeNumber'];
                            $dislikeNumber = $data['dislikeNumber'];

                            // giải mã username
                            $userNameCommentValue = base64_decode($userNameComment);

                            // Tạo đối tượng CommentDTO và trả về
                            $comment = new CommentDTO($codeComment, $productCode, $userNameCommentValue, $userNameRepComment, $sentDate, $content, $state, $likeNumber, $dislikeNumber);

                            //
                            array_push($arr, $comment);
                     }

                     return $arr;
              } else {
                     // Trường hợp không có dữ liệu trả về
                     // echo "Không có dữ liệu được trả về từ truy vấn.";
                     return null;
              }
       }


       // thêm một đối tượng 
       function addObj($obj)
       {
              if ($obj != null) {
                     $codeComment = $obj->getCodeComment();
                     // Kiểm tra xem có bị trùng thuộc tính khóa không
                     $check = "SELECT * FROM comment WHERE codeComment = '$codeComment'";
                     $resultCheck = $this->actionSQL->query($check);

                     if ($resultCheck->num_rows < 1) {
                            $productCode = $obj->getProductCode();
                            $userNameComment = $obj->getUserNameComment();
                            $userNameRepComment = $obj->getUserNameRepComment();
                            $sentDate = $obj->getSentDate();
                            $content = $obj->getContent();
                            $state = $obj->getState();
                            $likeNumber = $obj->getLikeNumber();
                            $dislikeNumber = $obj->getDislikeNumber();

                            // mã hóa username
                            $userNameComment_encode = base64_encode($userNameComment);

                            // Câu lệnh truy vấn
                            $string = "INSERT INTO Comment (codeComment, productCode, userNameComment, userNameRepComment, sentDate, content, state, likeNumber, dislikeNumber) 
                              VALUES ('$codeComment', '$productCode', '$userNameComment_encode', '$userNameRepComment', '$sentDate', '$content', '$state', $likeNumber, $dislikeNumber)";

                            return $this->actionSQL->query($string);
                     } else {
                            return false;
                     }
              } else {
                     return false;
              }
       }

       // sửa một đối tượng
       function upadateObj($obj)
       {
              if ($obj != null) {
                     $codeComment = $obj->getCodeComment();
                     $productCode = $obj->getProductCode();
                     $userNameComment = $obj->getUserNameComment();
                     $userNameRepComment = $obj->getUserNameRepComment();
                     $sentDate = $obj->getSentDate();
                     $content = $obj->getContent();
                     $state = $obj->getState();
                     $likeNumber = $obj->getLikeNumber();
                     $dislikeNumber = $obj->getDislikeNumber();

                     // mã hóa username
                     $userNameComment_encode = base64_encode($userNameComment);

                     // Câu lệnh UPDATE
                     $string = "UPDATE Comment 
                                SET productCode = '$productCode', 
                                    userNameComment = '$userNameComment_encode', 
                                    userNameRepComment = '$userNameRepComment', 
                                    sentDate = '$sentDate', 
                                    content = '$content', 
                                    state = '$state', 
                                    likeNumber = $likeNumber, 
                                    dislikeNumber = $dislikeNumber
                                WHERE codeComment = '$codeComment'";

                     return $this->actionSQL->query($string);
              } else {
                     return false;
              }
       }

       function updateState($codeComment, $state)
       {
              // Câu lệnh UPDATE
              if ($state == '1') {
                     $string = "UPDATE Comment 
                                SET 
                                   state = '0'
                                WHERE codeComment = '$codeComment'";
              } else {
                     $string = "UPDATE Comment 
                                SET 
                                   state = '1'
                                WHERE codeComment = '$codeComment'";
              }

              return $this->actionSQL->query($string);
       }
}

// check

// $check = new CommentDAL();

// $data = $check->getListobj();

// print_r($data);

// $dataobj = $check->getobj('CM001');
// echo $dataobj->getCodeComment();

// $comment = new CommentDTO('123', 'P001', 'JaneSmith', 'user_rep123', '2024-03-21', 'This is a ', 'active', 10, 5);
// echo $check->addobj($comment);

// echo $check->upadateobj($comment);

// echo $check->deleteByID('123');
