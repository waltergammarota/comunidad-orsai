<?php


namespace App\Classes;

use Carbon\Carbon;

class ContestApplication extends GenericClass
{
    private $title;
    private $description;
    private $logo;
    private $images;
    private $pdf;
    private $link;
    private $contest;
    private $user;
    private $approved;
    private $approvedBy;
    private $approvedIn;
    private $isWinner;


    public function __construct(Array $args = [])
    {
        if (is_array($args) > 0 && count($args) > 0) {
            $this->title = $args['title'];
            $this->description = $args['description'];
            $this->logo = $args['logo'];
            $this->images = $args['images'];
            $this->pdf = $args['pdf'];
            $this->link = $args['link'];
            $this->contest = $args['contest'];
            $this->user = $args['user'];
        }
    }

    /**
     * @return Contest
     */
    public function getContest()
    {
        return $this->contest;
    }

    /**
     * @param Contest $contest
     */
    public function setContest($contest): void
    {
        $this->contest = $contest;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title): void
    {
        $this->title = $title;
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
     * @return ApplicationFile[]
     */
    public function getLogo()
    {
        return $this->logo;
    }

    /**
     * @param mixed $logo
     */
    public function setLogo($logo): void
    {
        $this->logo = $logo;
    }

    /**
     * @return ApplicationFile[]
     */
    public function getImages()
    {
        return $this->images;
    }

    /**
     * @param mixed $images
     */
    public function setImages($images): void
    {
        $this->images = $images;
    }

    /**
     * @return ApplicationFile[]
     */
    public function getPdf()
    {
        return $this->pdf;
    }

    /**
     * @param mixed $pdf
     */
    public function setPdf($pdf): void
    {
        $this->pdf = $pdf;
    }

    /**
     * @return mixed
     */
    public function getLink()
    {
        return $this->link;
    }

    /**
     * @param mixed $link
     */
    public function setLink($link): void
    {
        $this->link = $link;
    }

    /**
     * @return User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user): void
    {
        $this->user = $user;
    }

    public function setAsApprovedBy(User $user)
    {
        $this->approved = true;
        $this->approvedBy = $user;
        $this->approvedIn = Carbon::now();
    }

    public function getApprovedBy(): User
    {
        return $this->approvedBy;
    }

    /**
     * @return mixed
     */
    public function getApproved()
    {
        return $this->approved;
    }

    /**
     * @param mixed $approved
     */
    public function setApproved($approved): void
    {
        $this->approved = $approved;
    }

    /**
     * @return mixed
     */
    public function getApprovedIn()
    {
        return $this->approvedIn;
    }

    /**
     * @param mixed $approvedIn
     */
    public function setApprovedIn($approvedIn): void
    {
        $this->approvedIn = $approvedIn;
    }

    /**
     * @return mixed
     */
    public function getIsWinner()
    {
        return $this->isWinner;
    }

    /**
     * @param mixed $isWinner
     */
    public function setIsWinner($isWinner): void
    {
        $this->isWinner = $isWinner;
    }



}
