<?php
namespace Azelea\Core;
use Azelea\Core\Standard\Controller;
use Azelea\Core\Database\DatabaseManager;

class HomeController extends Controller {
    public function home($db = new DatabaseManager) {
        $this->addFlash("hi", "success");
        $this->addFlash("NO", "danger");
        $user = new Users();
        $form = $this->buildForm(LoginForm::class);

        if ($form->submitForm()) {
            $user->setEmail($form->getData("email"));
            $user->setPassword($form->getData("password"));
            $db->parse($user);
            $db->push();
            return $this->routeToUri("/");
        }

        // $personf = $db->getModel(Users::class, 1);
        // Core::dd($personf);

        return $this->render("home.loom.php", [
            'form' => $form,
            'items' => ["1", "2", "2"]
        ]);
    }
}
