<?php
class Auth_DiContainer extends \BaseApp\DiContainerAbstract
{
    /**
     * Get the user service
     *
     * @return Auth_Service_User
     */
    public function getUserService()
    {
        if (!isset($this->_storage['userService'])) {
            $this->_storage['userService'] = new Auth_Service_User($this->getUserMapper());
        }
        return $this->_storage['userService'];
    }

    /**
     * Get the user mapper
     *
     * @return Auth_Model_Mapper_User
     */
    public function getUserMapper()
    {
        if (!isset($this->_storage['userMapper'])) {
            $this->_storage['userMapper'] = new Auth_Model_Mapper_User();
        }
        return $this->_storage['userMapper'];
    }

    /**
     * Get the role service
     *
     * @return Auth_Service_Role
     */
    public function getRoleService()
    {
        if (!isset($this->_storage['roleService'])) {
            $this->_storage['roleService'] = new Auth_Service_Role($this->getRoleMapper());
        }
        return $this->_storage['roleService'];
    }

    /**
     * Get the role mapper
     *
     * @return Auth_Model_Mapper_Role
     */
    public function getRoleMapper()
    {
        if (!isset($this->_storage['roleMapper'])) {
            $this->_storage['roleMapper'] = new Auth_Model_Mapper_Role();
        }
        return $this->_storage['roleMapper'];
    }
}
