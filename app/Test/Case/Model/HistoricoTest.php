<?php
App::uses('Historico', 'Model');

/**
 * Historico Test Case
 *
 */
class HistoricoTest extends CakeTestCase {

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Historico = ClassRegistry::init('Historico');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Historico);

		parent::tearDown();
	}

}
