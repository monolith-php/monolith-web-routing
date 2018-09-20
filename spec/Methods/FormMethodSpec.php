<?php namespace spec\Monolith\WebRouting\Methods;

use Monolith\WebRouting\CompiledRoute;
use Monolith\WebRouting\CompiledRoutes;
use Monolith\WebRouting\Methods\FormMethod;
use Monolith\WebRouting\Route;
use PhpSpec\ObjectBehavior;

class FormMethodSpec extends ObjectBehavior {

    function it_is_initializable() {
        $this->shouldHaveType(FormMethod::class);
    }

    function it_can_define_a_form_route() {
        $route = $this::defineRoute('uri', 'controllerclass');
        $route->method()->shouldBe('form');
        $route->uri()->shouldBe('uri');
        $route->controllerClass()->shouldBe('controllerclass');
    }

    function it_can_compile_a_form_route() {
        $route = new Route('form', 'uri', 'controller');

        $compiled = $this->compile($route);
        $compiled->shouldHaveType(CompiledRoutes::class);
        $compiled->count()->shouldBe(2);

        $compiled->toArray()[0]->shouldHaveType(CompiledRoute::class);
        $compiled->toArray()[0]->httpMethod()->shouldBe('get');
        $compiled->toArray()[0]->controllerName()->shouldBe('controller');
        $compiled->toArray()[0]->controllerMethod()->shouldBe('get');

        $compiled->toArray()[1]->shouldHaveType(CompiledRoute::class);
        $compiled->toArray()[1]->httpMethod()->shouldBe('post');
        $compiled->toArray()[1]->controllerName()->shouldBe('controller');
        $compiled->toArray()[1]->controllerMethod()->shouldBe('post');
    }

}