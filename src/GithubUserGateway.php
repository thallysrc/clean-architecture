<?php

namespace CleanArchitecture;

/**
 * @author Thallys Rodrigues Costa
 */
class GithubUserGateway
{
	private $endpoint;

	public function __construct($endpoint)
	{
		$this->endpoint = $endpoint;
	}

	public function stream()
	{
	}

	public function getRepositories()
	{
		$opts = [
			'http' => [
				'method' => 'GET',
				'header' => [
					'Content-Type: application/json',
					'User-Agent: PHP'
				],
			],
		];

		$context = stream_context_create($opts);
		return json_decode(file_get_contents($this->endpoint.'/users/thallysrc/repos', false, $context));
	}

	public function getProfile()
	{
		$opts = [
			'http' => [
				'method' => 'GET',
				'header' => [
					'Content-Type: application/json',
					'User-Agent: PHP'
				],
			],
		];

		$context = stream_context_create($opts);
		return json_decode(file_get_contents($this->endpoint.'/users/thallysrc', false, $context));

	}
}
