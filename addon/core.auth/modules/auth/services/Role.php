<?php
class Auth_Service_Role 
{

    public function __construct(Auth_Model_Mapper_Role $roleMapper = null)
    {
        $this->_mapper = null === $roleMapper ? new Auth_Model_Mapper_Role() : $roleMapper;
    }

    public function getRolesForForm()
    {
        $rows = $this->_mapper->getRoles();
        $return = array();
        foreach($rows as $i => $row){
            $return[$row['role_id']] = $row['role'];
        }
        return $return;
    }
}
