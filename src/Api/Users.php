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
        $response = $this->get('users', ['$top' => 500]);   // Max $top is 999

        return $this->_respond($response);
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
        $response = $this->get("users/{$userId}");

        return $this->_respond($response);
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
        $response = $this->post("users", $user);

        return $this->_respond($response);
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
        $response = $this->patch("users/{$userId}", $user);

        return $this->_respond($response);
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
        return $this->_respond($this->delete("users/{$userId}"));
    }
}
