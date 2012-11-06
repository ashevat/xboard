<?php


// Routes for standard actions
//Router::connect('/Marketing/ContactManager/*', array('plugin' => 'Contact_Manager', 'controller' => 'contacts', 'action' => 'index'));
Router::connect('/Marketing/ContactManager/', array('plugin' => 'Contact_Manager', 'controller' => 'contacts', 'action' => 'index'));