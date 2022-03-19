<?php

// Home
Breadcrumbs::register('home', function($breadcrumbs)
{
    $breadcrumbs->push('Home', url('/admin'));
});

Breadcrumbs::register('category', function($breadcrumbs, $titleBreadcrumb)
{
    //$breadcrumbs->parent('home');
    foreach ($titleBreadcrumb as $key => $breadcrumb) {
        $breadcrumbs->push($breadcrumb['title'], $breadcrumb['url']);
    }
});