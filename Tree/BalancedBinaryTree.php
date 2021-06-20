<?php

include_once 'BalancedBinaryTreeInterface.php';

class BalancedBinaryTree implements BalancedBinaryTreeInterface
{
    /**
     * @var NodeInterface|null
     */
    protected ?NodeInterface $root = null;

    /**
     * @param NodeInterface $newNode
     * @return void
     */
    public function insert(NodeInterface $newNode): void
    {
        $this->insertNode($newNode, $this->root);
    }

    /**
     * @param int $key
     *
     * @return bool
     */
    public function delete(int $key): bool
    {
        $node = $this->searchNodeByKey($key, $this->root);

        if ($node === null) {
            return true;
        }

        $parent = $node->getParent();

        if ($parent === null) {
            $this->root = null;
            return true;
        }

        if ($parent->getLeft() !== null && $parent->getLeft()->getKey() === $key) {
            $parent->setLeft(null);
        } else {
            $parent->setRight(null);
        }

        if ($node->getLeft() !== null) {
            $this->insertNode($node->getLeft(), $this->root);
        }

        if ($node->getRight() !== null) {
            $this->insertNode($node->getRight(), $this->root);
        }

        return true;
    }

    /**
     * @param int $key
     *
     * @return NodeInterface|null
     */
    public function searchByKey(int $key): ?NodeInterface
    {
        return $this->searchNodeByKey($key, $this->root);
    }

    /**
     * @return void
     */
    public function balance(): void
    {
        if ($this->root === null) {
            return;
        }

        if ($this->root->getLeft() === null && $this->root->getRight() === null) {
            return;
        }

        $list = $this->leftRootRight($this->root);

        $chunks = array_chunk($list, ceil(count($list) / 2));
        $mid = array_pop($chunks[0]);

        $this->root = null;

        $node = new Node($mid['key'], $mid['data']);
        $this->insert($node);

        $this->balanceList($chunks[0]);
        $this->balanceList($chunks[1]);
    }

    /**
     * @param NodeInterface|null $tree
     */
    protected function leftRootRight(?NodeInterface $tree): array
    {
        if ($tree == null) {
            return [];
        }

        return array_merge(
            $this->leftRootRight($tree->getLeft()),
            [
                ['key' => $tree->getKey(), 'data' => $tree->getData()]
            ],
            $this->leftRootRight($tree->getRight()));
    }

    /**
     * @param array $list
     */
    protected function balanceList(array $list): void
    {
        if (empty($list)) {
            return;
        }

        $chunks = array_chunk($list, ceil(count($list) / 2));
        $mid = array_pop($chunks[0]);

        $node = new Node($mid['key'], $mid['data']);
        $this->insert($node);

        $this->balanceList($chunks[0]);

        if (isset($chunks[1])) {
            $this->balanceList($chunks[1]);
        }
    }

    /**
     * @param NodeInterface $new
     * @param NodeInterface|null $root
     *
     * @return void
     */
    protected function insertNode(NodeInterface $new, ?NodeInterface $root): void
    {
        if ($this->root === null) {
            $this->root = $new;
            return;
        }

        if ($new->getKey() <= $root->getKey()) {
            if ($root->getLeft() === null) {
                $root->setLeft($new);
                $new->setParent($root);
                return;
            }

            $this->insertNode($new, $root->getLeft());
            return;
        }

        if ($root->getRight() == null) {
            $root->setRight($new);
            $new->setParent($root);
            return;
        }

        $this->insertNode($new, $root->getRight());
    }

    /**
     *
     * @param int $key
     * @param NodeInterface|null $node
     * @return NodeInterface|null
     */
    protected function searchNodeByKey(int $key, ?NodeInterface $node): ?NodeInterface
    {
        if ($node === null) {
            return null;
        }

        if ($node->getKey() === $key) {
            return $node;
        }

        return $node->getKey() > $key
            ? $this->searchNodeByKey($key, $node->getLeft())
            : $this->searchNodeByKey($key, $node->getRight());
    }


    /**
     * @param NodeInterface|null $tree
     * @return string
     */
    protected function print(?NodeInterface $tree)
    {
        if ($tree === null) {
            return '';
        }

        return $this->print($tree->getLeft()) . ' '
            . $tree->getKey() . ' '
            . $this->print($tree->getRight());
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        if ($this->root === null) {
            return '';
        }

        return $this->print($this->root->getLeft())
            . ' '
            . $this->root->getKey() . ' '
            . $this->print($this->root->getRight());
    }
}
