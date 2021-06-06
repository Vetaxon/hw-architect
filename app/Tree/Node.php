<?php

namespace App\Tree;

class Node implements NodeInterface
{
    protected ?NodeInterface $parent = null;

    protected ?NodeInterface $left = null;

    protected ?NodeInterface $right = null;

    protected int $key;

    protected array $data = [];

    /**
     * @param int $key
     * @param array $data
     */
    public function __construct(int $key, array $data)
    {
        $this->key = $key;
        $this->data = $data;
    }

    /**
     * @return void
     */
    public function doEmpty(): void
    {
        $this->data = [];
    }

    /**
     * @return NodeInterface|null
     */
    public function getParent(): ?NodeInterface
    {
        return $this->parent;
    }

    /**
     * @param NodeInterface $parent
     *
     * @return void
     */
    public function setParent(NodeInterface $parent): void
    {
        $this->parent = $parent;
    }

    /**
     * @return NodeInterface|null
     */
    public function getLeft(): ?NodeInterface
    {
        return $this->left;
    }

    /**
     * @param NodeInterface|null $left
     *
     * @return void
     */
    public function setLeft(?NodeInterface $left): void
    {
        $this->left = $left;
    }

    /**
     * @return NodeInterface|null
     */
    public function getRight(): ?NodeInterface
    {
        return $this->right;
    }

    /**
     * @param NodeInterface|null $right
     *
     * @return void
     */
    public function setRight(?NodeInterface $right): void
    {
        $this->right = $right;
    }

    /**
     * @return int
     */
    public function getKey(): int
    {
        return $this->key;
    }

    /**
     * @param int $key
     *
     * @return void
     */
    public function setKey(int $key): void
    {
        $this->key = $key;
    }

    /**
     * @return array
     */
    public function getData(): array
    {
        return $this->data;
    }

    /**
     * @param array $data
     *
     * @return void
     */
    public function setData(array $data): void
    {
        $this->data = $data;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->getKey() . ':' . implode(';', $this->data);
    }
}
