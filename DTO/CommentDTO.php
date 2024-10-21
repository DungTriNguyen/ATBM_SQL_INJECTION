<?php

class CommentDTO
{

    // Thuộc tính
    private $codeComment;
    private $productCode;
    private $userNameComment;
    private $userNameRepComment;
    private $sentDate;
    private $content;
    private $state;
    private $likeNumber;
    private $dislikeNumber;

    // Hàm khởi tạo
    public function __construct($codeComment, $productCode, $userNameComment, $userNameRepComment, $sentDate, $content, $state, $likeNumber, $dislikeNumber)
    {
        $this->codeComment = $codeComment;
        $this->productCode = $productCode;
        $this->userNameComment = $userNameComment;
        $this->userNameRepComment = $userNameRepComment;
        $this->sentDate = $sentDate;
        $this->content = $content;
        $this->state = $state;
        $this->likeNumber = $likeNumber;
        $this->dislikeNumber = $dislikeNumber;
    }

    // Hàm lấy mã bình luận
    public function getCodeComment()
    {
        return $this->codeComment;
    }

    // Hàm đặt mã bình luận
    public function setCodeComment($codeComment)
    {
        $this->codeComment = $codeComment;
    }

    // Hàm lấy mã sản phẩm
    public function getProductCode()
    {
        return $this->productCode;
    }

    // Hàm đặt mã sản phẩm
    public function setProductCode($productCode)
    {
        $this->productCode = $productCode;
    }

    // Hàm lấy tên người bình luận
    public function getUserNameComment()
    {
        return $this->userNameComment;
    }

    // Hàm đặt tên người bình luận
    public function setUserNameComment($userNameComment)
    {
        $this->userNameComment = $userNameComment;
    }

    // Hàm lấy tên người trả lời bình luận
    public function getUserNameRepComment()
    {
        return $this->userNameRepComment;
    }

    // Hàm đặt tên người trả lời bình luận
    public function setUserNameRepComment($userNameRepComment)
    {
        $this->userNameRepComment = $userNameRepComment;
    }

    // Hàm lấy ngày gửi
    public function getSentDate()
    {
        return $this->sentDate;
    }

    // Hàm đặt ngày gửi
    public function setSentDate($sentDate)
    {
        $this->sentDate = $sentDate;
    }

    // Hàm lấy nội dung bình luận
    public function getContent()
    {
        return $this->content;
    }

    // Hàm đặt nội dung bình luận
    public function setContent($content)
    {
        $this->content = $content;
    }

    // Hàm lấy trạng thái bình luận
    public function getState()
    {
        return $this->state;
    }

    // Hàm đặt trạng thái bình luận
    public function setState($state)
    {
        $this->state = $state;
    }

    // Hàm lấy số lượt thích
    public function getLikeNumber()
    {
        return $this->likeNumber;
    }

    // Hàm lấy số lượt ko thích
    public function getDislikeNumber()
    {
        return $this->dislikeNumber;
    }

    // Phương thức tăng số lượt thích
    public function increaseLike()
    {
        $this->likeNumber++;
    }

    // Phương thức tăng số lượt không thích
    public function increaseDislike()
    {
        $this->dislikeNumber++;
    }

    // Phương thức tính tổng số lượt đánh giá (thích và không thích)
    public function getTotalRating()
    {
        return $this->likeNumber + $this->dislikeNumber;
    }
    public function __toString() {
        return "Bình luận: " . $this->content . "\n" .
            "Mã bình luận: " . $this->codeComment . "\n" .
            "Mã sản phẩm: " . $this->productCode . "\n" .
            "Người bình luận: " . $this->userNameComment . "\n" .
            "Ngày gửi: " . $this->sentDate . "\n" .
            "Trạng thái: " . $this->state . "\n" .
            "Số lượt thích: " . $this->likeNumber . "\n" .
            "Số lượt không thích: " . $this->dislikeNumber;
    }
    
}
