<?php

namespace App\Http\Dto\Api;

class GetProductsDto
{
    const ORDER = 'desc';
    const BY = 'created_at';
    const PAGE = 1;

    /**
     * @var string|null
     */
    protected ?string $order;

    /**
     * @var string|null
     */
    protected ?string $by;

    /**
     * @var int|null
     */
    protected ?int $page;

    /**
     * Get the value of order
     */
    public function getOrder(): ?string
    {
        return $this->order;
    }

    /**
     * Set the value of order
     */
    public function setOrder(?string $order): self
    {
        $this->order = $order ?? self::ORDER;

        return $this;
    }

    /**
     * Get the value of by
     */
    public function getBy(): ?string
    {
        return $this->by;
    }

    /**
     * Set the value of by
     */
    public function setBy(?string $by): self
    {
        $this->by = $by ?? self::BY;

        return $this;
    }

    /**
     * Get the value of page
     */
    public function getPage(): ?int
    {
        return $this->page;
    }

    /**
     * Set the value of page
     */
    public function setPage(?int $page): self
    {
        $this->page = $page ?? self::PAGE;

        return $this;
    }
}
