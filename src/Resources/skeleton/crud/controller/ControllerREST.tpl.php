<?= "<?php\n" ?>

namespace <?= $namespace ?>;

use Symfony\Bundle\FrameworkBundle\Controller\<?= $parent_class_name ?>;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use JMS\Serializer\SerializerInterface;
use <?= $entity_full_class_name ?>;
use <?= str_replace('Controller', 'Service', $namespace).'\\'.'Add'.$entity_class_name.'Service' ?>;
use <?= str_replace('Controller', 'Service', $namespace).'\\'.'Get'.$entity_class_name.'Service' ?>;
use <?= str_replace('Controller', 'Service', $namespace).'\\'.'GetAll'.$entity_class_name.'Service' ?>;
use <?= str_replace('Controller', 'Service', $namespace).'\\'.'Remove'.$entity_class_name.'Service' ?>;
use <?= str_replace('Controller', 'Service', $namespace).'\\'.'Edit'.$entity_class_name.'Service' ?>;

#[Route('<?= $route_path ?>')]
class <?= $class_name ?> extends <?= $parent_class_name; ?><?= "\n" ?>
{

	public function __construct(
		private SerializerInterface $serializer,
		private Add<?= $entity_class_name ?>Service $add<?= $entity_class_name ?>Service,
		private Get<?= $entity_class_name ?>Service $get<?= $entity_class_name ?>Service,
		private GetAll<?= $entity_class_name ?>Service $getAll<?= $entity_class_name ?>Service,
		private Edit<?= $entity_class_name ?>Service $edit<?= $entity_class_name ?>Service,
		private Remove<?= $entity_class_name ?>Service $remove<?= $entity_class_name ?>Service
	)
	{
	}

<?= $generator->generateRouteForControllerMethod('/', sprintf('GetAll%s', $entity_class_name), ['GET']) ?>
	public function getAll(): JsonResponse
	{
		return new JsonResponse(
			json_decode(
				$this->serializer->serialize(
					$this->getAll<?= $entity_class_name ?>Service->getAll(),
					'json'
				)
			),
		Response::HTTP_OK
		);
	}

<?= $generator->generateRouteForControllerMethod('/', sprintf('Add%s', $entity_class_name), ['POST']) ?>
	public function add(Request $request): JsonResponse
	{
		return new JsonResponse(
			json_decode(
				$this->serializer->serialize(
					$this->add<?= $entity_class_name ?>Service->add($request),
					'json'
				)
			),
			Response::HTTP_CREATED
		);
	}

<?= $generator->generateRouteForControllerMethod(sprintf('/{%s}', $entity_identifier), sprintf('Get%s', $entity_class_name), ['GET']) ?>
	public function get<?= $entity_class_name ?>(<?= $entity_class_name ?> $<?= $entity_var_singular ?>): JsonResponse
	{
		return new JsonResponse(
			json_decode(
				$this->serializer->serialize(
					$this->get<?= $entity_class_name ?>Service->get<?= $entity_class_name ?>($<?= $entity_var_singular ?>),
					'json'
				)
			),
			Response::HTTP_OK
		);
	}

<?= $generator->generateRouteForControllerMethod(sprintf('/{%s}', $entity_identifier), sprintf('Edit%s', $entity_class_name), ['PATCH']) ?>
	public function edit(Request $request, <?= $entity_class_name ?> $<?= $entity_var_singular ?>): JsonResponse
	{
		return new JsonResponse(
			json_decode(
				$this->serializer->serialize(
					$this->edit<?= $entity_class_name ?>Service->edit($request, $<?= $entity_var_singular ?>),
					'json'
				)
			),
			Response::HTTP_OK
		);
	}

<?= $generator->generateRouteForControllerMethod(sprintf('/{%s}', $entity_identifier), sprintf('Remove%s', $entity_class_name), ['DELETE']) ?>
	public function remove(<?= $entity_class_name ?> $<?= $entity_var_singular ?>): JsonResponse
	{
		return new JsonResponse(
			json_decode(
				$this->serializer->serialize(
					$this->remove<?= $entity_class_name ?>Service->remove($<?= $entity_var_singular ?>),
					'json'
				)
			),
			Response::HTTP_OK
		);
	}
}
