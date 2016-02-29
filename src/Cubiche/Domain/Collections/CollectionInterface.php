<?php

/**
 * This file is part of the Cubiche package.
 *
 * Copyright (c) Cubiche
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Cubiche\Domain\Collections;

use Cubiche\Domain\Specification\SpecificationInterface;
use Cubiche\Domain\Comparable\ComparatorInterface;

/**
 * Collection Interface.
 *
 * @author Karel Osorio Ramírez <osorioramirez@gmail.com>
 * @author Ivannis Suárez Jerez <ivannis.suarez@gmail.com>
 */
interface CollectionInterface extends \Countable, \IteratorAggregate
{
    /**
     * Adds an element at the end of the collection.
     *
     * @param mixed $item
     */
    public function add($item);

    /**
     * Removes an element from the collection.
     *
     * @param mixed $item
     */
    public function remove($item);

    /**
     * Clears the collection, removing all elements.
     */
    public function clear();

    /**
     * Find all elements that match with a given specification.
     *
     * @param SpecificationInterface $criteria
     *
     * @return \Cubiche\Domain\Collections\CollectionInterface
     */
    public function find(SpecificationInterface $criteria);

    /**
     * Find an element collection by a given specification.
     *
     * @param SpecificationInterface $criteria
     *
     * @return mixed
     */
    public function findOne(SpecificationInterface $criteria);

    /**
     * Gets a native PHP array representation of the collection.
     *
     * @return array
     */
    public function toArray();

    /**
     * Extracts a slice of $length elements starting at position $offset from the Collection.
     *
     * @param int $offset
     * @param int $length
     *
     * @return \Cubiche\Domain\Collections\CollectionInterface
     */
    public function slice($offset, $length = null);

    /**
     * @param ComparatorInterface $criteria
     *
     * @return \Cubiche\Domain\Collections\CollectionInterface
     */
    public function sorted(ComparatorInterface $criteria);
}
