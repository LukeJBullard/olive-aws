<?php
    /**
     * AWS Module for OliveWeb
     * Luke Bullard, May 2018
     */
    
    //make sure we are included securely
    if (!defined("INPROCESS")) { header("HTTP/1.0 403 Forbidden"); exit(0); }

    use Aws\Common\Aws;

    /**
     * The AWS OliveWeb Module
     */
    class MOD_aws
    {
        private $m_dynamoDB;
        private $m_aws;

        public function __construct()
        {
            require_once("../../vendor/autoload.php");
        }

        /**
         * Retrieves the AWS object. Creates the AWS object if it has not been created already.
         * 
         * @return Aws
         */
        public function getAWS()
        {
            if (isset($this->m_aws))
            {
                return $this->m_aws;
            }

            $this->m_aws = Aws::factory(__DIR__ . "/config.php");
            return $this->m_aws;
        }

        /**
         * Retrieves the DynamoDB object from AWS.
         * 
         * @return DynamoDbClient
         */
        public function getDynamoDB()
        {
            if (isset($this->m_dynamoDB))
            {
                return $this->m_dynamoDB;
            }

            $aws = $this->getAWS();
            $this->m_dynamoDB = $aws->get("DynamoDb");

            return $this->m_dynamoDB;
        }
    }
?>