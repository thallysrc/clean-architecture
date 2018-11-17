<?php

declare(strict_types=1);

namespace CleanArchitecture;

/**
 * @author Thallys Rodrigues Costa <thallys.rc@gmail.com>
 */
class GithubUserTest extends \PHPUnit\Framework\TestCase
{
	public function testGetInfo_shouldReturnGithubProfileInfo()
	{
		$mock = $this->prophesize(GithubUserGateway::class);
		$repositories = (object) [
			'id' => 666,
			'name' => 'Juggernault',
			'description' => 'ahhhhhhhhh',
			'fork' => 1,
			'html_url' => 'https://hello.com',
		];
		$profile = (object) [
			'name' => 'Spirit Crusher',
			'bio' => 'Deathhhhh',
			'html_url' => 'https://onehundredpercentsatan.com',
			'repositories' => [],
		];
		$mock->getRepositories()->willReturn([$repositories]);
		$mock->getProfile()->willReturn($profile);

		$service = new GithubUser($mock->reveal());
		$result = $service->getInfo();
		$this->assertCount(4, $result);
	}
}
