<?= "<?php\n" ?>

namespace <?= $namespace ?>;

use <?= $entity_full_class_name ?>;
use Doctrine\ORM\EntityManagerInterface;

class <?= $class_name ?>
{
	public function __construct(private EntityManagerInterface $em)
	{
	}

	public function remove(<?= $entity_class_name ?> $<?= $entity_var_singular ?>): bool
	{
		$this->em->remove($<?= $entity_var_singular ?>);
		$this->em->flush();

		return $<?= $entity_var_singular ?>->getId();
	}
}
