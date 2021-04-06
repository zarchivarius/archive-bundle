<?php
declare(strict_types=1);

namespace Zarchivarius\ArchiveBundle\Entity;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use App\Exceptions\DateTimeException;
use App\Services\DateTimeService;
use Carbon\Carbon;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Serializer\Annotation\SerializedName;
use Zarchivarius\ArchiveBundle\Contract\Entity\ArchiveRecordInterface;
use DateTime;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use Zarchivarius\ArchiveBundle\Exceptions\ArchiveException;

/**
 * @ApiResource(
 *     shortName="records",
 *     normalizationContext={"groups"="archive_record:read"},
 *     denormalizationContext={"groups"="archive_record:write"}
 * )
 * Class ArchiveRecord
 * @package App\Entity
 * @ApiFilter(SearchFilter::class, properties={"title": "partial", "description": "partial"})
 */
class ArchiveRecord implements ArchiveRecordInterface
{
    private DateTime $createdAt;
    private DateTime $updatedAt;

    /**
     * ArchiveRecord constructor.
     * @param string $id
     * @param string $title
     * @param array $tags
     * @param string $description
     * @param array $documents
     * @param int|float $floatVal
     * @param string $createdBy
     * @throws ArchiveException
     */
    public function __construct(
        /**
         * Unique identifier of the record
         */
        private string $id = '',
        /**
         * @var string
         * @Groups({"archive_record:read", "archive_record:write"})
         */
        private string $title = '',
        /**
         * Assigned list of tags
         * @var array
         * @Groups({"archive_record:read", "archive_record:read"})
         */
        private array $tags = [],
        /**
         * Description of the record, for search and filtering
         * @var string
         * @Groups({"archive_record:read", "archive_record:read"})
         */
        private string $description = '',
        /**
         * List of loaded documents/files
         * @var array
         * @Groups({"archive_record:read", "archive_record:read"})
         */
        private array $documents = [],
        /**
         * When we have price or value that can be calculated
         * @var int|float
         * @Groups({"archive_record:read", "archive_record:read"})
         * @SerializedName("number")
         */
        private int|float $floatVal = 0,

        private string $createdBy = '',

        //private DateTimeService $dateTimeService,
    )
    {
//        try {
//            $this->createdAt = $this->dateTimeService->getUtc();
//            $this->updatedAt = $this->dateTimeService->getUtc();
//        } catch (DateTimeException $e) {
//            throw new ArchiveException($e);
//        }
    }

    public function getId(): ?string
    {
        return $this->id;
    }

    public function setId(string $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getTags(): array
    {
        return $this->tags;
    }

    public function setTags(array $tags): void
    {
        $this->tags = $tags;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $desc): void
    {
        $this->description = $desc;
    }

    public function getDocuments(): array
    {
        return $this->documents;
    }

    public function setDocuments(array $docs): void
    {
        $this->documents = $docs;
    }

    public function getFloatVal(): float
    {
        return $this->floatVal;
    }

    public function setFloatVal(float $val): void
    {
        $this->floatVal = $val;
    }

    /**
     * @return DateTime
     */
    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }

    /**
     * How long ago it was created
     * @return string
     * @Groups({"archive_record:read"})
     */
    public function getCreatedAtAgo(): string
    {
        return Carbon::instance($this->getCreatedAt())->diffForHumans();
    }

    /**
     * @return DateTime
     */
    public function getUpdatedAt(): DateTime
    {
        return $this->updatedAt;
    }

    /**
     * @return string
     */
    public function getCreatedBy(): string
    {
        return $this->createdBy;
    }

    /**
     * @param string $createdBy
     */
    public function setCreatedBy(string $createdBy): void
    {
        $this->createdBy = $createdBy;
    }

    /**
     * @param DateTime $createdAt
     */
    public function setCreatedAt(DateTime $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @param DateTime $updatedAt
     */
    public function setUpdatedAt(DateTime $updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }

    #[ArrayShape([
        'id' => "null|string",
        'title' => "string",
        'documents' => "array",
        'description' => "string",
        'tags' => "array",
        'floatVal' => "float",
        'createdBy' => "string",
        'createdAt' => "string",
        'updatedAt' => "string"
    ])] public function jsonSerialize(): array
    {
        return [
            'id'    => $this->getId(),
            'title' => $this->getTitle(),
            'documents' => $this->getDocuments(),
            'description' => $this->getDescription(),
            'tags' => $this->getTags(),
            'floatVal' => $this->getFloatVal(),
            'createdBy' => $this->getCreatedBy(),
            'createdAt' => $this->getCreatedAt()->format('Y.m.d H:i'),
            'updatedAt' => $this->getUpdatedAt()->format('Y.m.d H:i'),
        ];
    }
}
