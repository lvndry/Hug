<?php

  namespace Tests\Framework;

  use Framework\App;
  use GuzzleHttp\Psr7\ServerRequest;
  use PHPUnit\Framework\TestCase;
  /**
   *
   */
  class AppTest extends TestCase {

    public function testRedirectTrainlingSlash(){
      $app = new App();
      $request = new ServerRequest('GET', '/bloguri/');
      $response = $app->run($request);
      $this->assertContains('/bloguri', $response->getHeader('Location'));
      $this->assertEquals('301', $response->getStatusCode());
    }

    public function testBlog(){
      $app = new App();
      $request = new ServerRequest('GET', '/blog');
      $response = $app->run($request);
      $this->assertContains('<h1>Welcome!</h1>', (string)$response->getBody());
      $this->assertEquals('200', $response->getStatusCode());
    }

    public function Error404(){
      $app = new App();
      $request = new ServerRequest('GET', '/random');
      $response = $app->run($request);
      $this->assertContains('<h1>Error 404</h1>', (string)$response->getBody());
        $this->assertEquals('404', $response->getStatusCode());
    }
  }

 ?>
