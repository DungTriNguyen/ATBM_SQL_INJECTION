<?php

class PermissionsDetailDTO {
    private $codePermissions;
    private $functionCode;
    private $addPermission;
    private $seePermission;
    private $deletePermission;
    private $fixPermission;

    // Constructor
    public function __construct($codePermissions, $functionCode, $addPermission, $seePermission, $deletePermission, $fixPermission) {
        $this->codePermissions = $codePermissions;
        $this->functionCode = $functionCode;
        $this->addPermission = $addPermission;
        $this->seePermission = $seePermission;
        $this->deletePermission = $deletePermission;
        $this->fixPermission = $fixPermission;
    }

    // Getter và Setter cho $codePermissions
    public function getCodePermissions() {
        return $this->codePermissions;
    }

    public function setCodePermissions($codePermissions) {
        $this->codePermissions = $codePermissions;
    }

    // Getter và Setter cho $functionCode
    public function getFunctionCode() {
        return $this->functionCode;
    }

    public function setFunctionCode($functionCode) {
        $this->functionCode = $functionCode;
    }

    // Getter và Setter cho $addPermission
    public function getAddPermission() {
        return $this->addPermission;
    }

    public function setAddPermission($addPermission) {
        $this->addPermission = $addPermission;
    }

    // Getter và Setter cho $seePermission
    public function getSeePermission() {
        return $this->seePermission;
    }

    public function setSeePermission($seePermission) {
        $this->seePermission = $seePermission;
    }

    // Getter và Setter cho $deletePermission
    public function getDeletePermission() {
        return $this->deletePermission;
    }

    public function setDeletePermission($deletePermission) {
        $this->deletePermission = $deletePermission;
    }

    // Getter và Setter cho $fixPermission
    public function getFixPermission() {
        return $this->fixPermission;
    }

    public function setFixPermission($fixPermission) {
        $this->fixPermission = $fixPermission;
    }
}

?>
