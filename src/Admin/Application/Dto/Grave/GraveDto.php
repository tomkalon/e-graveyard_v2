<?php

namespace App\Admin\Application\Dto\Grave;

use App\Core\Domain\Entity\Grave;
use App\Core\Domain\Entity\Graveyard;
use App\Core\Domain\Entity\PaymentGrave;
use DateTimeImmutable;
use Doctrine\Common\Collections\Criteria;
use Exception;

class GraveDto
{
    public ?int $sector;
    public ?int $row;
    public ?int $number;
    public ?string $positionX;
    public ?string $positionY;
    public ?Graveyard $graveyard;
    public ?array $people;
    public ?array $payments;

    public function __construct(
        ?int $sector = null,
        ?int $row = null,
        ?int $number = null,
        ?string $positionX = null,
        ?string $positionY = null,
        ?Graveyard $graveyard = null,
        ?array $people = null,
        ?array $payments = null
    ) {
        $this->sector = $sector;
        $this->row = $row;
        $this->number = $number;
        $this->positionX = $positionX;
        $this->positionY = $positionY;
        $this->graveyard = $graveyard;
        $this->people = $people;
        $this->payments = $payments;
    }

    public static function fromEntity(Grave $grave): self
    {
        $payments = $grave->getPayments();
        $criteria = Criteria::create()->orderBy(['validity_time' => 'DESC']);
        $payments = array_values($payments->matching($criteria)->toArray());

        return new self(
            $grave->getSector(),
            $grave->getRow(),
            $grave->getNumber(),
            $grave->getPositionX(),
            $grave->getPositionY(),
            $grave->getGraveyard(),
            $grave->getPeople()->toArray(),
            $payments
        );
    }

    /**
     * @throws Exception
     */
    public function isItPaid(): bool
    {
        /** @var PaymentGrave $lastFee */
        $lastFee = reset($this->payments);
        $now = new DateTimeImmutable();

        if ($now < $lastFee->getValidityTime()) {
            return true;
        } else {
            return false;
        }
    }
}
