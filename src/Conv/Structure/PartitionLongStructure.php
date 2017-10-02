<?php

namespace Conv\Structure;

class PartitionLongStructure
{
    private $type;
    private $value;
    private $parts;

    /**
     * @param string                   $type
     * @param string                   $value
     * @param PartitionPartStructure[] $parts
     */
    public function __construct(
        string $type,
        string $value,
        array $parts
    ) {
        $this->type = $type;
        $this->value = $value;
        $this->parts = $parts;
    }

    /**
     * @return string
     */
    public function getQuery(): string
    {
        $query = "PARTITION BY {$this->type}({$this->value}) (" . PHP_EOL;
        $partsLineList = [];
        foreach ($parts as $part) {
            $partsLineList = $part->getQuery();
        }
        $query .= "  ".join(',' . PHP_EOL . '  ', $partsLineList);
        $query .= ')'
        return $query;
    }
}