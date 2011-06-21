<?php
class Default_DiContainer extends \BaseApp\DiContainerAbstract
{
    /**
     * Get the user service
     *
     * @return Default_Service_Addon
     */
    public function getAddonService()
    {
        if (!isset($this->_storage['addonService'])) {
            $this->_storage['addonService'] = new Default_Service_Addon();
        }
        return $this->_storage['addonService'];
    }
}
