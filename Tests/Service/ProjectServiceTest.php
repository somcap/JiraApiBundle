<?php

namespace JiraApiBundle\Tests\Service;

use JiraApiBundle\Tests\TestCase;
use JiraApiBundle\Service\ProjectService;

class ProjectServiceTest extends TestCase
{
    public function testProjectServiceGetAll()
    {        
        $jsonFile = __DIR__ . '/../assets/response/project.json';

        $service = new ProjectService(
            $this->getClientMock($jsonFile)
        );

        $result = $service->getAll();

        $this->assertEquals(2, count($result));
    }

    /**
     * @expectedException \Guzzle\Http\Exception\BadResponseException
     */
    public function testProjectServiceGetAllException()
    {
        $service = new ProjectService($this->getClientMockException());

        $service->getAll('PROJECT', 'repository', 'branch');
    }

    public function testProjectServiceGetAllNoData()
    {
        $service = new ProjectService($this->getClientMockNoData());

        $result = $service->getAll('PROJECT', 'repository', 'branch');

        $this->assertEquals(array(), $result);
    }

    public function testProjectServiceGetAllErrors()
    {
        $service = new ProjectService($this->getClientMockErrors());

        $result = $service->getAll(array());

        $this->assertEquals(false, $result);
    }
}
