<?php
// app/Plugin/ContactManager/Controller/ContactsController.php
class ContactsController extends ContactManagerAppController {
    public $uses = array('ContactManager.Contact');

    public function index() {
        //...
    }
}