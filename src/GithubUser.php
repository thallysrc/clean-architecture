<?php
declare(strict_types=1);

namespace CleanArchitecture;

/**
 * @author Thallys Rodrigues Costa
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

	public function getInfo()
	{
		$response = $this->gateway->getRepositories();

		$repositories = array_reduce($response, function ($carry, $item) {
			$carry[] = [
				'id' => $item->id,
				'name' => $item->name,
				'description' => $item->description,
				'is_fork' => $item->fork,
				'html_url' => $item->html_url,
			];

			return $carry;
		}, []);

		$response = $this->gateway->getProfile();

		$profile = [
			'name' => $response->name,
			'bio' => $response->bio,
			'html_url' => $response->html_url,
			'repositories' => $repositories,
		];

		return $profile;
	}

}
