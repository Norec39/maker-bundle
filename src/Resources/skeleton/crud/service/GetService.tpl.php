<?= "<?php\n" ?>

namespace <?= $namespace ?>;

use <?= $entity_full_class_name ?>;

class <?= $class_name ?>
{
	public function get<?= $entity_class_name ?>(<?= $entity_class_name ?> $<?= $entity_var_singular ?>): <?= $entity_class_name ?>
	{
		return $<?= $entity_var_singular ?>;
	}
}
