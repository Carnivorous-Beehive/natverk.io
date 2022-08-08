<?php

namespace Natverk\Models;

use DomainException;

abstract class Model
{
    /**
     * Magic method to get properties off of the child class.
     * Classes should document readable properties in a doc block.
     */
    public function __get(string $member)
    {
        if (!property_exists($this, $member)) {
            $class = get_class($this);
            throw new DomainException("$class does not have '$member'");
        }

        return $this->$member;
    }

    /**
     * Do not attempt to set data through magic.
     * Setters should be implemented specifically
     * for any data. A better pattern would probably
     * be to push data into a repository and leave the
     * model to be as close to immutable as possible.
     *
     * @throws DomainException
     */
    public function __set(string $member, mixed $value)
    {
        $builder = array(
            'Setting data is not available through magic.',
            'Call $this->set' . ucfirst($member) . "($value);",
        );

        throw new DomainException(implode(' ', $builder));
    }
}
