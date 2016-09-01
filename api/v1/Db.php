<?php

namespace CountryCity\API;


use MongoDB\Client;

/**
 * This Class handles MongoDB.
 *
 * Class Db
 * @package CountryCity\API
 */
Class Db implements iDb
{
    /**
     * Connect to MongoDB database and return the database object.
     *
     * @author Shivam Mathur <shivam_jpr@hotmail.com>
     *
     * @param $databaseName
     * @param $collectionName
     * @return \MongoDB\Collection
     */
    public function connect($databaseName, $collectionName)
    {
        return $this->_connect($databaseName, $collectionName);
    }

    /**
     * Connect to MongoDB database and return the database object.
     *
     * @author Shivam Mathur <shivam_jpr@hotmail.com>
     *
     * @param $databaseName
     * @param $collectionName
     * @return \MongoDB\Collection
     * @throws \Exception
     */
    private function _connect($databaseName, $collectionName)
    {
        if ($databaseName == '') {
            throw new \Exception("No database name provided");
        }

        $client = $this->_getClient();
        $database = $client->selectDatabase($databaseName);
        $collection = $database->selectCollection($collectionName);

        return $collection;
    }

    /**
     * Initialise a MongoDB Client.
     *
     * @author Shivam Mathur <shivam_jpr@hotmail.com>
     *
     * @return Client
     * @throws \Exception
     */
    private function _getClient()
    {
        /** @var \MongoDB\Client $client */
        $client = new Client();

        if (!$client instanceof Client) {
            throw new \Exception("MongoDB process is not running", 1);
        }

        return $client;
    }
}