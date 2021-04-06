<?php
declare(strict_types=1);

namespace Zarchivarius\ArchiveBundle\Contract\Entity;

use DateTime;
use JsonSerializable;

/**
 * Interface ArchiveRecordInterface
 * @package App\Contract\Entity
 */
interface ArchiveRecordInterface extends JsonSerializable
{
    public function getId(): ?string;

    public function setId(string $id): void;

    public function getTitle(): string;

    public function setTitle(string $title): void;

    public function getTags(): array;

    public function setTags(array $tags): void;

    public function getDescription(): string;

    public function setDescription(string $desc): void;

    /**
     * List of paths to the docs
     * @return array
     */
    public function getDocuments(): array;

    public function setDocuments(array $docs): void;

    /**
     * Summarized value
     * @return float
     */
    public function getFloatVal(): float;

    public function setFloatVal(float $val): void;

    public function setCreatedBy(string $createdBy): void;

    public function getCreatedBy(): string;

    public function getCreatedAt(): DateTime;

    public function getUpdatedAt(): DateTime;

    public function setCreatedAt(DateTime $createdAt): void;

    public function setUpdatedAt(DateTime $updatedAt): void;
}
