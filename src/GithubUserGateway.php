<?php

namespace CleanArchitecture;

/**
 * @author Thallys Rodrigues Costa <thallys.rc@gmail.com>
 */
class GithubUserGateway
{
	private $endpoint;

	public function __construct($endpoint)
	{
		$this->endpoint = $endpoint;
	}

	public function stream($url)
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

		return json_decode(file_get_contents($this->endpoint.$url, false, $context));
	}

	public function getRepositories($user)
	{
		return $this->stream('/users/'.$user.'/repos');
	}

	public function getProfile($user)
	{
		return $this->stream('/users/'.$user);
	}
}
