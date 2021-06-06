<?php

namespace App\Tree;


interface NodeInterface
{
    /**
     * @return void
     */
    public function doEmpty(): void;

    /**
     * @return NodeInterface|null
     */
    public function getParent(): ?NodeInterface;

    /**
     * @param NodeInterface $parent
     */
    public function setParent(NodeInterface $parent): void;

    /**
     * @return NodeInterface|null
     */
    public function getLeft(): ?NodeInterface;

    /**
     * @param NodeInterface|null $left
     */
    public function setLeft(?NodeInterface $left): void;

    /**
     * @return NodeInterface|null
     */
    public function getRight(): ?NodeInterface;

    /**
     * @param NodeInterface|null $right
     */
    public function setRight(?NodeInterface $right): void;

    /**
     * @return int
     */
    public function getKey(): int;

    /**
     * @param int $key
     *
     * @return void
     */
    public function setKey(int $key): void;

    /**
     * @return array
     */
    public function getData(): array;

    /**
     * @param array $data
     *
     * @return void
     */
    public function setData(array $data): void;
}
