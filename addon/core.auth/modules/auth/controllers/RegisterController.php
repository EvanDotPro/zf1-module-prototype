<?php
class Auth_RegisterController extends Zend_Controller_Action
{
    public function init()
    {
        $this->_userService = Zend_Registry::get('Auth_DiContainer')->getUserService();
        $fm = $this->getHelper('FlashMessenger')->setNamespace('registerForm')->getMessages(); 
        $this->view->registerForm = (count($fm) > 0) ? $fm[0] : $this->getRegisterForm();
    }

    public function indexAction()
    {}

    public function postAction()
    {
        $form = $this->view->registerForm;
        $request = $this->getRequest();
        if (!$request->isPost()) return $this->_helper->redirector('index');
        if (false === $form->isValid($request->getPost())) {
            $form->setDescription('Registration Failed');
            $this->_helper->FlashMessenger->setNamespace('registerForm')->addMessage($form);
            return $this->_helper->redirector('index');
        }
        if (!$this->_userService->createUserFromForm($form)) {
            $form->setDescription('Registration Failed!');
            $this->_helper->FlashMessenger->setNamespace('registerForm')->addMessage($form);
            return $this->_helper->redirector('index');
        }
        return $this->_helper->redirector('login', 'index');
    }

    public function getRegisterForm()
    {
        return $this->_userService->getRegisterForm()->setAction($this->_helper->url->direct('post'));
    }

}

