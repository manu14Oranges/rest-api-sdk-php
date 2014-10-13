<?php

namespace PayPal\Api;

use PayPal\Common\PPModel;
use PayPal\Rest\ApiContext;
use PayPal\Rest\IResource;
use PayPal\Api\CreateProfileResponse;
use PayPal\Transport\PPRestCall;
use PayPal\Validation\ArgumentValidator;

/**
 * Class WebProfile
 *
 * Payment Web experience profile resource
 *
 * @package PayPal\Api
 *
 * @property string id
 * @property string name
 * @property \PayPal\Api\FlowConfig flow_config
 * @property \PayPal\Api\InputFields input_fields
 * @property \PayPal\Api\Presentation presentation
 */
class WebProfile extends PPModel implements IResource
{
    /**
     * OAuth Credentials to use for this call
     *
     * @var \PayPal\Auth\OAuthTokenCredential $credential
     */
    protected static $credential;

    /**
     * Sets Credential
     *
     * @deprecated Pass ApiContext to create/get methods instead
     * @param \PayPal\Auth\OAuthTokenCredential $credential
     */
    public static function setCredential($credential)
    {
        self::$credential = $credential;
    }

    /**
     * ID of the web experience profile.
     * 
     *
     * @param string $id
     * 
     * @return $this
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * ID of the web experience profile.
     *
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Name of the web experience profile.
     * 
     *
     * @param string $name
     * 
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Name of the web experience profile.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Parameters for flow configuration.
     * 
     *
     * @param \PayPal\Api\FlowConfig $flow_config
     * 
     * @return $this
     */
    public function setFlowConfig($flow_config)
    {
        $this->flow_config = $flow_config;
        return $this;
    }

    /**
     * Parameters for flow configuration.
     *
     * @return \PayPal\Api\FlowConfig
     */
    public function getFlowConfig()
    {
        return $this->flow_config;
    }

    /**
     * Parameters for flow configuration.
     *
     * @deprecated Instead use setFlowConfig
     *
     * @param \PayPal\Api\FlowConfig $flow_config
     * @return $this
     */
    public function setFlow_config($flow_config)
    {
        $this->flow_config = $flow_config;
        return $this;
    }

    /**
     * Parameters for flow configuration.
     * @deprecated Instead use getFlowConfig
     *
     * @return \PayPal\Api\FlowConfig
     */
    public function getFlow_config()
    {
        return $this->flow_config;
    }

    /**
     * Parameters for input fields customization.
     * 
     *
     * @param \PayPal\Api\InputFields $input_fields
     * 
     * @return $this
     */
    public function setInputFields($input_fields)
    {
        $this->input_fields = $input_fields;
        return $this;
    }

    /**
     * Parameters for input fields customization.
     *
     * @return \PayPal\Api\InputFields
     */
    public function getInputFields()
    {
        return $this->input_fields;
    }

    /**
     * Parameters for input fields customization.
     *
     * @deprecated Instead use setInputFields
     *
     * @param \PayPal\Api\InputFields $input_fields
     * @return $this
     */
    public function setInput_fields($input_fields)
    {
        $this->input_fields = $input_fields;
        return $this;
    }

    /**
     * Parameters for input fields customization.
     * @deprecated Instead use getInputFields
     *
     * @return \PayPal\Api\InputFields
     */
    public function getInput_fields()
    {
        return $this->input_fields;
    }

    /**
     * Parameters for style and presentation.
     * 
     *
     * @param \PayPal\Api\Presentation $presentation
     * 
     * @return $this
     */
    public function setPresentation($presentation)
    {
        $this->presentation = $presentation;
        return $this;
    }

    /**
     * Parameters for style and presentation.
     *
     * @return \PayPal\Api\Presentation
     */
    public function getPresentation()
    {
        return $this->presentation;
    }

    /**
     * Create a web experience profile by passing the name of the profile and other profile details in the request JSON to the request URI.
     *
     * @param \PayPal\Rest\ApiContext $apiContext is the APIContext for this call. It can be used to pass dynamic configuration and credentials.
     * @return CreateProfileResponse
     */
    public function create($apiContext = null)
    {
        $payLoad = $this->toJSON();
        if ($apiContext == null) {
            $apiContext = new ApiContext(self::$credential);
        }
        $call = new PPRestCall($apiContext);
        $json = $call->execute(array('PayPal\Rest\RestHandler'), "/v1/payment-experience/web-profiles/", "POST", $payLoad);
        $ret = new CreateProfileResponse();
        $ret->fromJson($json);
        return $ret;
    }

    /**
     * Update a web experience profile by passing the ID of the profile to the request URI. In addition, pass the profile details in the request JSON. If your request does not include values for all profile detail fields, the previously set values for the omitted fields are removed by this operation.
     *
     * @param \PayPal\Rest\ApiContext $apiContext is the APIContext for this call. It can be used to pass dynamic configuration and credentials.
     * @return bool
     */
    public function update($apiContext = null)
    {
        ArgumentValidator::validate($this->getId(), "Id");
        $payLoad = $this->toJSON();
        if ($apiContext == null) {
            $apiContext = new ApiContext(self::$credential);
        }
        $call = new PPRestCall($apiContext);
        $json = $call->execute(array('PayPal\Rest\RestHandler'), "/v1/payment-experience/web-profiles/{$this->getId()}", "PUT", $payLoad);
        return true;
    }

    /**
     * Partially update an existing web experience profile by passing the ID of the profile to the request URI. In addition, pass a patch object in the request JSON that specifies the operation to perform, path of the profile location to update, and a new value if needed to complete the operation.
     *
     * @param Patch[] $patch
     * @param \PayPal\Rest\ApiContext $apiContext is the APIContext for this call. It can be used to pass dynamic configuration and credentials.
     * @return bool
     */
    public function partial_update($patch, $apiContext = null)
    {
        ArgumentValidator::validate($this->getId(), "Id");
        ArgumentValidator::validate($patch, 'patch');
        foreach ($patch as $patchObject) {
            $payload[] = $patchObject->toArray();
        }

        $payLoad = json_encode($payload);
        if ($apiContext == null) {
            $apiContext = new ApiContext(self::$credential);
        }
        $call = new PPRestCall($apiContext);
        $json = $call->execute(array('PayPal\Rest\RestHandler'), "/v1/payment-experience/web-profiles/{$this->getId()}", "PATCH", $payLoad);
        return true;
    }

    /**
     * Retrieve the details of a particular web experience profile by passing the ID of the profile to the request URI.
     *
     * @param string $profileId
     * @param \PayPal\Rest\ApiContext $apiContext is the APIContext for this call. It can be used to pass dynamic configuration and credentials.
     * @return WebProfile
     */
    public static function get($profileId, $apiContext = null)
    {
        ArgumentValidator::validate($profileId, 'profileId');
        $payLoad = "";
        if ($apiContext == null) {
            $apiContext = new ApiContext(self::$credential);
        }
        $call = new PPRestCall($apiContext);
        $json = $call->execute(array('PayPal\Rest\RestHandler'), "/v1/payment-experience/web-profiles/$profileId", "GET", $payLoad);
        $ret = new WebProfile();
        $ret->fromJson($json);
        return $ret;
    }

    /**
     * Lists all web experience profiles that exist for a merchant (or subject).
     *
     * @param \PayPal\Rest\ApiContext $apiContext is the APIContext for this call. It can be used to pass dynamic configuration and credentials.
     * @return WebProfile[]
     */
    public static function get_list($apiContext = null)
    {
        $payLoad = "";
        if ($apiContext == null) {
            $apiContext = new ApiContext(self::$credential);
        }
        $call = new PPRestCall($apiContext);
        $json = $call->execute(array('PayPal\Rest\RestHandler'), "/v1/payment-experience/web-profiles/", "GET", $payLoad);
        return WebProfile::getList($json);
    }

    /**
     * Delete an existing web experience profile by passing the profile ID to the request URI.
     *
     * @param \PayPal\Rest\ApiContext $apiContext is the APIContext for this call. It can be used to pass dynamic configuration and credentials.
     * @return bool
     */
    public function delete($apiContext = null)
    {
        ArgumentValidator::validate($this->getId(), "Id");
        $payLoad = "";
        if ($apiContext == null) {
            $apiContext = new ApiContext(self::$credential);
        }
        $call = new PPRestCall($apiContext);
        $json = $call->execute(array('PayPal\Rest\RestHandler'), "/v1/payment-experience/web-profiles/{$this->getId()}", "DELETE", $payLoad);
        return true;
    }

}