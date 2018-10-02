<?php declare(strict_types=1);


namespace Modules\CsvImport\Helpers;


trait DateTimeTrait
{
    /** @var \DateTime */
    private $dateCreated;
    /** @var \DateTime */
    private $dateUpdated;

    /**
     * Product constructor.
     */
    public function __construct()
    {
        $this->dateCreated = new \DateTime();
        $this->dateUpdated = new \DateTime();
    }

    /**
     * @return \DateTime
     */
    public function getDateCreated(): \DateTime
    {
        return $this->dateCreated;
    }

    /**
     * @param \DateTime $dateCreated
     *
     * @return $this;
     */
    public function setDateCreated(\DateTime $dateCreated): self
    {
        $this->dateCreated = $dateCreated;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getDateUpdated(): \DateTime
    {
        return $this->dateUpdated;
    }

    /**
     * @param \DateTime $dateUpdated
     *
     * @return $this;
     */
    public function setDateUpdated(\DateTime $dateUpdated): self
    {
        $this->dateUpdated = $dateUpdated;

        return $this;
    }
}
