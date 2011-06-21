<?php
class Auth_Model_Role extends BaseApp\Model\ModelAbstract
{
    protected $_roleId;

    protected $_role;
    
    /**
     * Get roleId.
     *
     * @return roleId
     */
    public function getRoleId()
    {
        return $this->_roleId;
    }
 
    /**
     * Set roleId.
     *
     * @param $roleId the value to be set
     */
    public function setRoleId($roleId)
    {
        $this->_roleId = (int)$roleId;
    }
 
    /**
     * Get role.
     *
     * @return role
     */
    public function getRole()
    {
        return $this->_role;
    }
 
    /**
     * Set role.
     *
     * @param $role the value to be set
     */
    public function setRole($role)
    {
        $this->_role = $role;
    }
}
