<?php
/**
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

$cakeDescription = __d('SOGRA_dev', 'Singular Order gateway Request Apostilas');
?>
<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $cakeDescription ?>:
		<?php echo $title_for_layout; ?>
                
	</title>
	<?php
		//echo $this->Html->meta('favicon.ico');
                
		echo $this->Html->css('cake.generic');
                echo $this->Html->css('thickbox.css');
                echo $this->Html->css('jquery-ui-1.10.2.custom.css');
                

		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
                echo $this->Html->script('jquery-1.9.1.js');
                echo $this->Html->script('jquery-ui-1.10.2.custom.js');
                echo $this->Html->script('thickbox.js');
                echo $this->Html->script('jquery-migrate-1.1.1.min.js'); 
                echo $this->Html->script('cv_ou_livro.js');
                echo $this->Html->script('refresh');
	?>
</head>
<body>
	<div id="container">
		<div id="header">
				<?php echo $this->element('menu') ?>
                                 <div id="logo">

                                    <?php echo $this->Html->link($this->Html->image("logo.jpg", array("alt" => "Home")), "/pages/home", array('escape' => false)); ?>

                                </div>
		</div>
		<div id="content">

			<?php echo $this->Session->flash(); ?>

			<?php echo $this->fetch('content'); ?>
		</div>
		<div id="footer">
			
		</div>
	</div>
	
</body>
</html>
