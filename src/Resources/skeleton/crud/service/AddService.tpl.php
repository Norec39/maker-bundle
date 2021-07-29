<?= "<?php\n" ?>

namespace <?= $namespace ?>;

use <?= $entity_full_class_name ?>;
use <?= $form_full_class_name ?>;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormFactoryInterface;
use InvalidArgumentException;

class <?= $class_name ?>
{
	public function __construct(
		private EntityManagerInterface $em,
		private FormFactoryInterface $formFactory
	) {
	}

	public function add(Request $request): <?= $entity_class_name ?>
	{
		$data = json_decode($request->getContent(), true);

		$<?= $entity_var_singular ?> = new <?= $entity_class_name ?>();
		$form = $this->formFactory->create(<?= $form_class_name ?>::class, $<?= $entity_var_singular ?>, ['csrf_protection' => false]);
		$form->submit($data);

		if ($form->isValid()) {
				$this->em->persist($<?= $entity_var_singular ?>);
				$this->em->flush();

				return $<?= $entity_var_singular ?>;
		}

		$errors = [];

		foreach ($form->getErrors(true) as $error) {
			$errors[] = $error->getMessage();
		}

		throw new InvalidArgumentException(json_encode($errors));
	}
}
