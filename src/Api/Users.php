<?php

namespace Azure\Api;

use \Azure\Interfaces\EntityInterface;

class Users extends AbstractApi implements EntityInterface
{

    /**
     * Fetch all Users
     *
     * @return stdClass         Standard response object from $this->_respond()
     *
     * @todo Implement pagination...
     */
    public function all()
    {
        return $this->get('users', ['$top' => 500]);   // Max $top is 999
    }

    /**
     * Fetch the User identified by $userId
     *
     * @param  string $userId   Azure objectId of the User to fetch
     *
     * @return stdClass         Standard response object from $this->_respond()
     */
    public function one($userId)
    {
        return $this->get("users/{$userId}");
    }

    /**
     * [find description]
     *
     * @param  [type] $filters [description]
     *
     * @return stdClass         Standard response object from $this->_respond()
     */
    public function find($filters)
    {
    }

    /**
     * Create a new User
     *
     * @param  array $user Array of properties that describe the new User
     *
     * @return stdClass         Standard response object from $this->_respond()
     */
    public function create($user)
    {
        return $this->post("users", $user);
    }

    /**
     * Update an existing User identified by $userId. Properties in $user
     * overwrite the current properties of the User, if defined.
     *
     * @param  string $userId   Azure objectId of the User to update
     * @param  array  $user     Array of properties describing the User
     *
     * @return stdClass         Standard response object from $this->_respond()
     */
    public function edit($userId, $user)
    {
        return $this->patch("users/{$userId}", $user);
    }

    /**
     * Delete the user represented by $userId
     *
     * @param  string $userId   The Azure objectId of the User to delete
     *
     * @return stdClass         Standard response object from $this->_respond()
     */
    public function remove($userId)
    {
        return $this->delete("users/{$userId}");
    }
}
