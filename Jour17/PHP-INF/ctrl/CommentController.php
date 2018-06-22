<?php
Zend_Loader::loadClass("Zend_Controller_Action");
Zend_Loader::loadClass("Zend_Validate_EmailAddress");
Zend_Loader::loadClass("Zend_Filter_StripTags");
 
class CommentController extends Zend_Controller_Action {
 
    public function displayAction() {
        Zend_Loader::loadClass("Kitpages_Tutoriaux_Facade");
        $commentList = Kitpages_Tutoriaux_Facade::
            getInstance()->getAllComments();
        $this->view->commentList = $commentList;
        $this->view->rootUrl = ROOT_URL;
    }
 
    public function editAction() {
        // vérifie l'existence d'un post :
        if (count($_POST) > 0) {
            // validation de l'email
            $email = $_POST["email"];
            $validator = new Zend_Validate_EmailAddress();
            if (!$validator->isValid($email)) {
                $this->_redirect(
                    "comment/edit?error=email+invalide"
                );
            }
            // filtre du sujet et du contenu
            $filter = new Zend_Filter_StripTags(array("b","em"));
            $subject = $filter->filter($_POST["subject"]);
            $content = $filter->filter($_POST["content"]);
            // sauvegarde
            Zend_Loader::loadClass('Kitpages_Tutoriaux_Facade');
            $facade = Kitpages_Tutoriaux_Facade::getInstance();
            $facade->saveComment($email,
                                 $subject,
                                 $content);
            // redirection
            $url = ROOT_URL."/comment";
            Zend_Registry::get("logger")
                ->debug("before redirection, url=$url");
            $this->_redirect($url);
        }
    }
}
?>