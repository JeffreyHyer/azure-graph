<?php

namespace Azure\Api;

use \Azure\Interfaces\EntityInterface;

class Applications extends AbstractApi implements EntityInterface
{

    /**
     * Fetch all Applications
     *
     * @return stdClass         Standard response object from $this->_respond()
     */
    public function all()
    {
        $response = $this->get('applications');

        return $this->_respond($response);
    }

    /**
     * Fetch the Application identified by $appId
     *
     * @param  string $appId   Azure objectId of the Application to fetch
     *
     * @return stdClass         Standard response object from $this->_respond()
     */
    public function one($appId)
    {
        $response = $this->get("applications/{$appId}");

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
     * Create a new Application
     *
     * @param  array $app       Array of properties that describe the new Application
     *
     * @return stdClass         Standard response object from $this->_respond()
     */
    public function create($app)
    {
        $response = $this->post("applications", $app);

        return $this->_respond($response);
    }

    /**
     * Update an existing Application identified by $appId. Properties in $app
     * overwrite the current properties of the Application, if defined.
     *
     * @param  string $userId   Azure objectId of the Application to update
     * @param  array  $user     Array of properties describing the Application
     *
     * @return stdClass         Standard response object from $this->_respond()
     */
    public function edit($appId, $app)
    {
        $response = $this->patch("applications/{$appId}", $app);

        return $this->_respond($response);
    }

    /**
     * Delete the Application represented by $appId
     *
     * @param  string $userId   The Azure objectId of the Application to delete
     *
     * @return stdClass         Standard response object from $this->_respond()
     */
    public function remove($appId)
    {
        return $this->_respond($this->delete("applications/{$appId}"));
    }

    /**
     * [extensionProperties description]
     *
     * @param  [type] $appId [description]
     *
     * @return [type]        [description]
     */
    public function extensionProperties($appId)
    {
        return $this->_respond($this->get("applications/{$appId}/extensionProperties"));
    }

    /**
     * [createExtensionProperty description]
     *
     * @param  [type] $appId     [description]
     * @param  [type] $extension [description]
     *
     * @return [type]            [description]
     */
    public function createExtensionProperty($appId, $extension)
    {
        return $this->_respond($this->post("applications/{$appId}/extensionProperties", $extension));
    }

    public function deleteExtensionProperty($appId, $extensionId)
    {
        return $this->_respond($this->delete("applications/{$appId}/extensionProperties/{$extensionId}"));
    }
}
