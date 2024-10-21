<?php

// gọi các lớp liên quan
require('../DAL/connectionDatabase.php');
require('../DAL/AbstractionDAL.php');

require('../DTO/FeedbackDTO.php');
require('../DAL/FeedbackDAL.php');

// các thử viện liên quan gửi nhận mail.
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require('../PHPMailer-master/PHPMailer-master/src/PHPMailer.php');
require('../PHPMailer-master/PHPMailer-master/src/Exception.php');
require('../PHPMailer-master/PHPMailer-master/src/SMTP.php');



class FeedbackBLL
{

       private $FeedbackDAL;

       function __construct()
       {
              $this->FeedbackDAL = new FeedbackDAL();
       }

       // thêm phản hồi bên phía user
       // input: username,email,content
       // output: thong bao 
       function addFeedbackUser($userName, $email, $content)
       {

              // Tạo chuỗi 'FB' cố định
              $feedbackPrefix = 'FB';

              // Tạo một số duy nhất dựa trên thời gian hiện tại và số micro giây
              $feedbackNumber = uniqid('');

              // Kết hợp chuỗi 'FB' với số duy nhất để tạo ra chuỗi hoàn chỉnh
              $feedbackID = $feedbackPrefix . $feedbackNumber;

              $dateCreated = date('Y-m-d');


              $objFeedback = new FeedbackDTO($feedbackID, $userName, $dateCreated, $email, $content, 'null');

              $result = $this->FeedbackDAL->addObj($objFeedback);

              if ($result == true) {
                     // Tạo một đối tượng PHPMailer
                     $mail = new PHPMailer(true);

                     try {
                            // Cài đặt thông tin máy chủ SMTP
                            $mail->isSMTP();
                            $mail->Host = 'smtp.gmail.com';  // SMTP server của Gmail
                            $mail->SMTPAuth = true;
                            $mail->Username = 'truongphuc056@gmail.com'; // Địa chỉ email của bạn
                            $mail->Password = 'ppgkknqsnqztvuuf'; // Mật khẩu email của bạn
                            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Sử dụng SSL hoặc TLS
                            $mail->Port = 587; // Cổng SMTP của Gmail

                            // Thiết lập thông tin người gửi và người nhận
                            $mail->setFrom('truongphuc056@gmail.com', 'MINIMAL'); // Địa chỉ email và tên người gửi
                            $mail->addAddress($email, $userName); // Địa chỉ email và tên người nhận

                            // Thiết lập tiêu đề và nội dung email
                            $mail->Subject = 'Thank you for your response';
                            $mail->Body = 'We will respond as quickly as possible, your contributions help the website become more and more complete.';

                            // Gửi email
                            if ($mail->send()) {
                                   return array(
                                          "codeFeedback" => $feedbackID,
                                          "userName" => $userName,
                                          "senDate" => $dateCreated,
                                          "content" => $content,
                                          "replay" => 'null',
                                          "mess" => "success"
                                   );
                            } else {
                                   return array(
                                          "mess" => "failus to send mail"
                                   );
                            }
                     } catch (Exception $e) {
                            return array(
                                   "mess" => "failus to send mail ! Exception"
                            );
                     }
              } else {
                     return array("mess" => "failus to add feedback");
              }
       }

       //Xóa đối tượng Feedback
       function deleteObjByID($code)
       {
              $result = $this->FeedbackDAL->deleteByID($code);
              if ($result) {
                     return array("mess" => "success");
              } else {
                     return array("mess" => "failed");
              }
       }

       //Xóa đối tượng Feedback truyển vào 
       function deleteObj($obj)
       {
              if ($obj != null) {
                     $result = $this->FeedbackDAL->delete($obj);
                     if ($result) {
                            return array("mess" => "Success");
                     } else {
                            return array("mess" => "Failed");
                     }
              }
              return array("mess" => "Not Found");
       }

       //Cập nhật đối tượng Feedback
       function updateObj($obj)
       {
              if ($obj != null) {
                     $result = $this->FeedbackDAL->upadateObj($obj);
                     if ($result) {
                            return array("mess" => "success");
                     } else {
                            return array("mess" => "failed");
                     }
              }
              return array("mess" => "Not Found");
       }

       //Lấy 1 đối tượng Feedback
       function getObj($code)
       {
              $result = $this->FeedbackDAL->getObj($code);
              if ($result != null) {
                     $codeFeedback = $result->getCodeFeedback();
                     $userName = $result->getUserName();
                     $sentDate = $result->getSentDate();
                     $email = $result->getEmail();
                     $content = $result->getContent();
                     $replay = $result->getReplay();

                     $obj = array(
                            "codeFeedback" => $codeFeedback,
                            "userName" => $userName,
                            "sentDate" => $sentDate,
                            "email" => $email,
                            "content" => $content,
                            "replay" => $replay
                     );
                     return $obj;
              } else {
                     return array("mess" => "Not Found");
              }
       }

       //Lấy mảng đối tượng Feedback
       function getArrObj()
       {

              $arr = $this->FeedbackDAL->getListObj();

              $result = array();
              if (count($arr) > 0) {
                     foreach ($arr as $item) {
                            $codeFeedback = $item->getCodeFeedback();
                            $userName = $item->getUserName();
                            $sentDate = $item->getSentDate();
                            $email = $item->getEmail();
                            $content = $item->getContent();
                            $replay = $item->getReplay();
                            $obj = array(
                                   "codeFeedback" => $codeFeedback,
                                   "userName" => $userName,
                                   "sentDate" => $sentDate,
                                   "email" => $email,
                                   "content" => $content,
                                   "replay" => $replay
                            );
                            array_push($result, $obj);
                     }
                     return $result;
              } else {
                     return array(
                            "mess" => "empty"
                     );
              }
       }

       //Tìm đối tượng Feedback bằng username
       function searchFeedbacksByUsername($str)
       {
              $arr = $this->FeedbackDAL->getListObj();
              $result = array();
              if (count($arr) > 0) {
                     foreach ($arr as $item) {
                            $codeFeedback = $item->getCodeFeedback();
                            $userName = $item->getUserName();
                            $sentDate = $item->getSentDate();
                            $email = $item->getEmail();
                            $content = $item->getContent();
                            $replay = $item->getReplay();

                            if (strpos($userName, $str) !== false) {
                                   $obj = array(
                                          "codeFeedback" => $codeFeedback,
                                          "userName" => $userName,
                                          "sentDate" => $sentDate,
                                          "email" => $email,
                                          "content" => $content,
                                          "replay" => $replay,
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

       //Tìm đối tượng Feedback bằng email
       function searchFeedbacksByEmail($str)
       {
              $arr = $this->FeedbackDAL->getListObj();
              $result = array();
              if (count($arr) > 0) {
                     foreach ($arr as $item) {
                            $codeFeedback = $item->getCodeFeedback();
                            $userName = $item->getUserName();
                            $sentDate = $item->getSentDate();
                            $email = $item->getEmail();
                            $content = $item->getContent();
                            $replay = $item->getReplay();
                            if (strpos($email, $str) !== false) {
                                   $obj = array(
                                          "codeFeedback" => $codeFeedback,
                                          "userName" => $userName,
                                          "sentDate" => $sentDate,
                                          "email" => $email,
                                          "content" => $content,
                                          "replay" => $replay,
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

header('Content-Type: application/json');


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
       $check = new FeedbackBLL();

       $function = $_POST['function'];

       switch ($function) {
              case 'addFeedbackUser':
                     $username = $_POST['username'];
                     $email = $_POST['email'];
                     $content = $_POST['content'];
                     $temp = $check->addFeedbackUser($username, $email, $content);
                     echo json_encode($temp);
                     break;
              case 'getArrObj':
                     $temp = $check->getArrObj();
                     echo json_encode($temp);
                     break;
              case 'getObj':
                     $code = $_POST['codeFeedback'];
                     $temp = $check->getObj($code);
                     echo json_encode($temp);
                     break;
              case 'deleteObj':
                     $code = $_POST['codeFeedback'];
                     $userName = $_POST['userName'];
                     $sentDate = $_POST['sentDate'];
                     $email = $_POST['email'];
                     $content = $_POST['content'];
                     $replay = $_POST['replay'];
                     $obj = new FeedbackDTO($code, $userName, $sentDate, $email, $content, $replay);
                     $temp = $check->deleteObj($obj);
                     echo json_encode($temp);
                     break;
              case 'deleteObjByID':
                     $code = $_POST['codeFeedback'];
                     $temp = $check->deleteObjByID($code);
                     echo json_encode($temp);
                     break;
              case 'updateObj':
                     $code = $_POST['codeFeedback'];
                     $userName = $_POST['userName'];
                     $sentDate = $_POST['sentDate'];
                     $email = $_POST['email'];
                     $content = $_POST['content'];
                     $replay = $_POST['replay'];

                     $obj = new FeedbackDTO($code, $userName, $sentDate, $email, $content, $replay);
                     $temp = $check->updateObj($obj);
                     echo json_encode($temp);
                     break;
              case 'searchFeedbacksByUsername':
                     $str = $_POST['str'];
                     $temp = $check->searchFeedbacksByUsername($str);
                     echo json_encode($temp);
                     break;
              case 'searchFeedbacksByEmail':
                     $str = $_POST['str'];
                     $temp = $check->searchFeedbacksByEmail($str);
                     echo json_encode($temp);
                     break;
       }
}
