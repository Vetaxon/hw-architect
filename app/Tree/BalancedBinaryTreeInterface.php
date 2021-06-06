<?php

namespace App\Tree;

interface BalancedBinaryTreeInterface
{
    /**
     * @param NodeInterface $newNode
     * @return void
     */
    public function insert(NodeInterface $newNode): void;

    /**
     * @param int $key
     *
     * @return bool
     */
    public function delete(int $key): bool;

    /**
     * @param int $key
     *
     * @return NodeInterface|null
     */
    public function searchByKey(int $key): ?NodeInterface;

    /**
     * @return void
     */
    public function balance(): void;
}
