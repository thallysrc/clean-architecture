<?php
declare(strict_types=1);

namespace CleanArchitecture;

/**
 * @author Thallys Rodrigues Costa <thallys.rc@gmail.com>
 */
class GithubUser
{
	private $gateway;

	public static function factory($endpoint)
	{
		return new self(
			new GithubUserGateway($endpoint)
		);
	}

	public function __construct(GithubUserGateway $gateway)
	{
		$this->gateway = $gateway;
	}

	public function getInfo($user)
	{
		$response = $this->gateway->getRepositories($user);

		$repositories = array_reduce($response, function ($carry, $repository) {
			$carry[] = [
				'id' => $repository->id,
				'name' => $repository->name,
				'description' => $repository->description,
				'is_fork' => $repository->fork,
				'html_url' => $repository->html_url,
			];

			return $carry;
		}, []);

		$response = $this->gateway->getProfile($user);

		$profile = [
			'name' => $response->name,
			'bio' => $response->bio,
			'html_url' => $response->html_url,
			'repositories' => $repositories,
		];

		return $profile;
	}

}
