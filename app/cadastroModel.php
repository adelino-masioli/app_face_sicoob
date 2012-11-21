<?php
//id photoCloud photoCoverGray photoCoverBlue photoCoverGreen photoCoverYellow textThink userFace nameFace uidFace locationFace status

    class cadastroModel{
	public  $id;
	public  $photoCloud;
	public  $photoCoverGray;
    public  $photoCoverBlue;
    public  $photoCoverGreen;
    public  $photoCoverYellow;
	public  $photoShare;
	public  $textThink;
	public  $userFace;
    public  $nameFace;
	public  $uidFace;
    public  $locationFace;
    public  $status;
	
 
    public function cadastroModel(){}
    
    public function setId($id) {
        $this->id = $id;
    }

    public function getId() {
        return $this->id;
    }

    public function setPhotoCloud($photoCloud) {
       $this->photoCloud = $photoCloud;
    }

    public function getPhotoCloud() {
        return $this->photoCloud;
    }

    public function setPhotoCoverGray($photoCoverGray) {
       $this->photoCoverGray = $photoCoverGray;
    }

    public function getPhotoCoverGray() {
        return $this->photoCoverGray;
    }

    public function setPhotoCoverBlue($photoCoverBlue) {
       $this->photoCoverBlue = $photoCoverBlue;
    }

    public function getPhotoCoverBlue() {
        return $this->photoCoverBlue;
    }

    public function setPhotoCoverGreen($photoCoverGreen) {
       $this->photoCoverGreen = $photoCoverGreen;
    }

    public function getPhotoCoverGreen() {
        return $this->photoCoverGreen;
    }

    public function setPhotoCoverYellow($photoCoverYellow) {
       $this->photoCoverYellow = $photoCoverYellow;
    }

    public function getPhotoCoverYellow() {
        return $this->photoCoverYellow;
    }
	
	public function setPhotoShare($photoShare) {
       $this->photoShare = $photoShare;
    }

    public function getPhotoShare() {
        return $this->photoShare;
    }


    public function setTextThink($textThink) {
       $this->textThink = $textThink;
    }

    public function getTextThink() {
        return $this->textThink;
    }

    public function setUserFace($userFace) {
       $this->userFace = $userFace;
    }

    public function getUserFace() {
        return $this->userFace;
    }

    public function setNameFace($nameFace) {
       $this->nameFace = $nameFace;
    }

    public function getNameFace() {
        return $this->nameFace;
    }

    public function setUidFace($uidFace) {
       $this->uidFace = $uidFace;
    }

    public function getUidFace() {
        return $this->uidFace;
    }

    public function setLocationFace($locationFace) {
       $this->locationFace = $locationFace;
    }

    public function getLocationFace() {
        return $this->locationFace;
    }

    public function setStatus($status) {
       $this->status = $status;
    }

    public function getStatus() {
        return $this->status;
    }
}