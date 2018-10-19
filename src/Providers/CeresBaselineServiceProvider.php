<?php

namespace CeresBaseline\Providers;

use CeresEigenesBaseline\Extensions\ShopActionServiceProvider;
use Ceres\Caching\HomepageCacheSettings;
use Ceres\Caching\NavigationCacheSettings;
use Ceres\Caching\SideNavigationCacheSettings;
use Ceres\Extensions\TwigStyleScriptTagFilter;
use IO\Extensions\Functions\Partial;
use IO\Helper\CategoryKey;
use IO\Helper\CategoryMap;
use IO\Helper\TemplateContainer;
use IO\Services\ContentCaching\Services\Container;
use Plenty\Plugin\ServiceProvider;
use Plenty\Plugin\Templates\Twig;
use Plenty\Plugin\Events\Dispatcher;
use Plenty\Plugin\ConfigRepository;

use Plenty\Log\Services\ReferenceContainer;
use Plenty\Log\Exceptions\ReferenceTypeException;


use Plenty\Modules\Item\DataLayer\Contracts\ItemDataLayerRepositoryContract;

class CeresEigenesBaselineServiceProvider extends ServiceProvider
{

    const EVENT_LISTENER_PRIORITY = 50;

    /**
     * Register the service provider.
     */
    public function register() {

    }

    public function boot (Twig $twig, Dispatcher $eventDispatcher,ConfigRepository $config, ItemDataLayerRepositoryContract $itemRepository ,ReferenceContainer $referenceContainer)
    {

        // Register CeresBaselineServiceProvider
        $twig->addExtension('Twig_Extension_StringLoader');
        $twig->addExtension(ShopActionServiceProvider::class);


        $eventDispatcher->listen('IO.init.templates', function (Partial $partial) {
            $partial->set('header', 'CeresEigenesBaseline::PageDesign.Partials.Header.Header');
            $partial->set('footer', 'CeresEigenesBaseline::PageDesign.Partials.Footer');
            $partial->set('page-design', 'CeresEigenesBaseline::PageDesign.PageDesign');

            return false;

        }, self::EVENT_LISTENER_PRIORITY);



        $eventDispatcher->listen('IO.tpl.home', function(TemplateContainer $container, $templateData) {

            $container->setTemplate("CeresEigenesBaseline::Homepage.Homepage");

            return false;

        }, self::EVENT_LISTENER_PRIORITY);


        $eventDispatcher->listen('IO.tpl.category.item', function(TemplateContainer $container, $templateData) {
            $container->setTemplate("CeresEigenesBaseline::Category.Item.CategoryItem");

            return false;

        }, self::EVENT_LISTENER_PRIORITY);


                $eventDispatcher->listen('IO.tpl.item', function(TemplateContainer $container, $templateData) {
                    $container->setTemplate("CeresEigenesBaseline::Item.SingleItemWrapper");

                    return false;

                }, self::EVENT_LISTENER_PRIORITY);

                $eventDispatcher->listen('IO.tpl.basket', function(TemplateContainer $container, $templateData) {
                    $container->setTemplate("CeresEigenesBaseline::Basket.Basket");

                    return false;

                }, self::EVENT_LISTENER_PRIORITY);


                $eventDispatcher->listen('IO.tpl.login', function(TemplateContainer $container, $templateData) {
                    $container->setTemplate("CeresEigenesBaseline::Customer.Login");

                    return false;

                }, self::EVENT_LISTENER_PRIORITY);

                $eventDispatcher->listen('IO.tpl.register', function(TemplateContainer $container, $templateData) {
                    $container->setTemplate("CeresEigenesBaseline::Customer.Register");

                    return false;

                }, self::EVENT_LISTENER_PRIORITY);

                $eventDispatcher->listen('IO.tpl.search', function(TemplateContainer $container, $templateData) {
                    $container->setTemplate("CeresEigenesBaseline::ItemList.ItemListView");

                    return false;

                }, self::EVENT_LISTENER_PRIORITY);

        /*
         *
         * */
        // Register reference types for logs.
        try
        {
            $referenceContainer->add([ 'CeresBaselineId' => 'CeresBaselineId' ]);
        }
        catch(ReferenceTypeException $ex)
        {
        }
    }
}
