<?php


namespace Dotlines\GhooriOnDemand\Interfaces;

interface IRequest
{
    public function params(): array;
    public function headers(): array;
    public function send(): array;
}
