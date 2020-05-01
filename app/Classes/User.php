<?php

namespace App\Classes;

use Carbon\Carbon;
use App\Classes\UserException;

class User extends GenericClass
{

    private $name;
    private $lastName;
    private $userName;
    private $password;
    private $email;
    private $emailVerifiedAt;
    private $country;
    private $city;
    private $birthDate;
    private $profession;
    private $description;
    private $facebook;
    private $twitter;
    private $instagram;

    /**
     * @return mixed
     */
    public function getProfession()
    {
        return $this->profession;
    }

    /**
     * @param mixed $profession
     */
    public function setProfession($profession): void
    {
        $this->profession = $profession;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description): void
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getBirthDate()
    {
        return $this->birthDate;
    }

    /**
     * @param mixed $birthDate
     */
    public function setBirthDate($birthDate): void
    {
        $this->birthDate = $birthDate;
    }

    /**
     * @return mixed
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param mixed $city
     */
    public function setCity($city): void
    {
        $this->city = $city;
    }
    private $cellPhone;
    private $occupation;
    private $role;

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param $password
     * @throws \App\Classes\UserException
     */
    public function setPassword($password): void
    {
        $minLength = 8;
        if ($this->checkLength($password, 8)) {
            $this->password = password_hash($password, PASSWORD_DEFAULT);
            return;
        }
        throw new \App\Classes\UserException(
            UserException::getInvalidPasswordMessage(), 140
        );
    }


    /**
     * @return mixed
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @param mixed $country
     */
    public function setCountry($country): void
    {
        $this->country = $country;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param $name
     * @return User
     * @throws \App\Classes\UserException
     */
    public function setName($name): User
    {
        if ($this->checkLength($name)) {
            $this->name = $name;
            return $this;
        }

        throw new UserException(UserException::getInvalidLengthMessage(), 100);
    }

    /**
     * @return mixed
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @param $lastName
     * @return User
     * @throws \App\Classes\UserException
     */
    public function setLastName($lastName): User
    {
        if ($this->checkLength($lastName)) {
            $this->lastName = $lastName;
            return $this;
        }
        throw new UserException(UserException::getInvalidLengthMessage(), 110);
    }


    public function getUserName()
    {
        return $this->userName;
    }


    public function setUserName($userName): void
    {
        $this->userName = $userName;
    }


    public function getEmail()
    {
        return $this->email;
    }


    public function setEmail($email): User
    {
        if ($this->checkIfEmailIsValid($email)) {
            $this->email = $email;
            return $this;
        }
        throw new \App\Classes\UserException(
            UserException::getInvalidEmailMessage(), 130
        );
    }

    private function checkIfEmailIsValid($email)
    {
        return true;
    }




    public function getCellPhone()
    {
        return $this->cellPhone;
    }


    public function setCellPhone($cellPhone): User
    {
        if ($this->checkCellPhone($cellPhone)) {
            $this->cellPhone = $cellPhone;
            return $this;
        }
        throw new \App\Classes\UserException(
            UserException::getInvalidCellPhoneMessage(), 120
        );
    }

    private function checkCellPhone($cellPhone)
    {
        return preg_match('/^[0-9 +-]*$/', $cellPhone);;
    }


    public function getOccupation()
    {
        return $this->occupation;
    }

    /**
     * @param mixed $occupation
     */
    public function setOccupation($occupation): void
    {
        $this->occupation = $occupation;
    }

    /**
     * @return mixed
     */
    public function getTwitter()
    {
        return $this->twitter;
    }

    /**
     * @param mixed $twitter
     */
    public function setTwitter($twitter): void
    {
        $this->twitter = $twitter;
    }

    /**
     * @return mixed
     */
    public function getInstagram()
    {
        return $this->instagram;
    }

    /**
     * @param mixed $instagram
     */
    public function setInstagram($instagram): void
    {
        $this->instagram = $instagram;
    }

    /**
     * @return mixed
     */
    public function getFacebook()
    {
        return $this->facebook;
    }

    /**
     * @param mixed $facebook
     */
    public function setFacebook($facebook): void
    {
        $this->facebook = $facebook;
    }

    /**
     * @return mixed
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * @param mixed $role
     */
    public function setRole($role): void
    {
        $this->role = $role;
    }

    /**
     * @param $word
     * @param int $minLength
     * @return bool
     */
    private function checkLength($word, $minLength = 3): bool
    {
        if (strlen($word) >= $minLength) {
            return true;
        }
        return false;
    }

    public function isRequiredDataComplete()
    {
        $hasFoundIncompleteData = array_search(
            null,
            [
                $this->getName(),
                $this->getLastName(),
                $this->getUserName(),
                $this->getCountry(),
                $this->getEmail(),
                $this->getPassword(),
            ]
        );
        return $hasFoundIncompleteData > 0 ? false : true;
    }

    public function updateData($userData)
    {
        $this->setName($userData['name']);
        $this->setLastName($userData['lastName']);
        $this->setUserName($userData['userName']);
        $this->setCountry($userData['country']);
        $this->setEmail($userData['email']);
        $this->setEmailVerifiedAt($userData['email_verified_at']);
        $this->password = $userData['password'];
        $this->setCreatedAt($userData['created_at']);
        $this->setUpdatedAt($userData['updated_at']);
        $this->setId($userData['id']);
        $this->setCreatedAt($userData['created_at']);
        $this->setUpdatedAt($userData['updated_at']);
        $this->setRole($userData['role']);
    }

    public function hasBeenActivated()
    {
        return $this->emailVerifiedAt != null;
    }

    public function activateUser()
    {
        $this->setEmailVerifiedAt(now());
    }


    /**
     * @return mixed
     */
    public function getEmailVerifiedAt()
    {
        return $this->emailVerifiedAt;
    }

    /**
     * @param mixed $emailVerifiedAt
     */
    public function setEmailVerifiedAt($emailVerifiedAt): void
    {
        $this->emailVerifiedAt = $emailVerifiedAt;
    }

    public function can($action)
    {
        if (strtolower($this->role) == "admin") {
            return true;
        }
        return false;
    }


}
