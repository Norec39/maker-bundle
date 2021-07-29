<?= "<?php\n" ?>

namespace <?= $namespace ?>;

use Doctrine\ORM\EntityManagerInterface;
<?php if (isset($repository_full_class_name)): ?>
use <?= $repository_full_class_name ?>;
<?php endif ?>

class <?= $class_name ?>
{
	public function __construct(private EntityManagerInterface $em)
	{
	}

	public function getAll(): array
	{
		return $this->em->getRepository(<?= $repository_class_name ?>::class)->findAll();
	}
}
